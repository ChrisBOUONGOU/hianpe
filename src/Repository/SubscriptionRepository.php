<?php
namespace App\Repository;
use App\Entity\Subscription;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
/** @extends ServiceEntityRepository<Subscription> */
class SubscriptionRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry){parent::__construct($registry,Subscription::class);}
    /** @return list<Subscription> */
    public function findForUser(User $user):array{return $this->findBy(['user'=>$user],['createdAt'=>'DESC']);}
    public function findActiveForProduct(User $user,string $key):?Subscription{
        return $this->createQueryBuilder('s')->andWhere('s.user=:user')->andWhere('s.productKey=:product')
            ->andWhere('s.status IN (:statuses)')->setParameter('user',$user)->setParameter('product',$key)
            ->setParameter('statuses',['trialing','active','past_due','incomplete'])->orderBy('s.createdAt','DESC')
            ->setMaxResults(1)->getQuery()->getOneOrNullResult();
    }
    public function findByStripeId(string $id):?Subscription{return $this->findOneBy(['stripeSubscriptionId'=>$id]);}
}
