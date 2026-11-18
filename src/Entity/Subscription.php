<?php
namespace App\Entity;
use App\Repository\SubscriptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(repositoryClass: SubscriptionRepository::class)]
#[ORM\Table(name: 'app_subscription')]
#[ORM\UniqueConstraint(name: 'UNIQ_STRIPE_SUBSCRIPTION', columns: ['stripe_subscription_id'])]
class Subscription {
    #[ORM\Id, ORM\GeneratedValue, ORM\Column] private ?int $id=null;
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable:false,onDelete:'CASCADE')] private ?User $user=null;
    #[ORM\Column(length:40)] private string $productKey;
    #[ORM\Column(length:100)] private string $stripeCustomerId;
    #[ORM\Column(length:100)] private string $stripeSubscriptionId;
    #[ORM\Column(length:40)] private string $status='incomplete';
    #[ORM\Column(type:Types::DATETIME_IMMUTABLE,nullable:true)] private ?\DateTimeImmutable $trialEndsAt=null;
    #[ORM\Column(type:Types::DATETIME_IMMUTABLE,nullable:true)] private ?\DateTimeImmutable $currentPeriodEndsAt=null;
    #[ORM\Column] private bool $cancelAtPeriodEnd=false;
    #[ORM\Column(type:Types::DATETIME_IMMUTABLE)] private \DateTimeImmutable $createdAt;
    public function __construct(){ $this->createdAt=new \DateTimeImmutable(); }
    public function getId():?int{return $this->id;}
    public function getUser():?User{return $this->user;}
    public function setUser(User $user):static{$this->user=$user;return $this;}
    public function getProductKey():string{return $this->productKey;}
    public function setProductKey(string $v):static{$this->productKey=$v;return $this;}
    public function getStripeCustomerId():string{return $this->stripeCustomerId;}
    public function setStripeCustomerId(string $v):static{$this->stripeCustomerId=$v;return $this;}
    public function getStripeSubscriptionId():string{return $this->stripeSubscriptionId;}
    public function setStripeSubscriptionId(string $v):static{$this->stripeSubscriptionId=$v;return $this;}
    public function getStatus():string{return $this->status;}
    public function setStatus(string $v):static{$this->status=$v;return $this;}
    public function getTrialEndsAt():?\DateTimeImmutable{return $this->trialEndsAt;}
    public function setTrialEndsAt(?\DateTimeImmutable $v):static{$this->trialEndsAt=$v;return $this;}
    public function getCurrentPeriodEndsAt():?\DateTimeImmutable{return $this->currentPeriodEndsAt;}
    public function setCurrentPeriodEndsAt(?\DateTimeImmutable $v):static{$this->currentPeriodEndsAt=$v;return $this;}
    public function isCancelAtPeriodEnd():bool{return $this->cancelAtPeriodEnd;}
    public function setCancelAtPeriodEnd(bool $v):static{$this->cancelAtPeriodEnd=$v;return $this;}
    public function getCreatedAt():\DateTimeImmutable{return $this->createdAt;}
}
