<?php
declare(strict_types=1);
namespace DoctrineMigrations;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
final class Version20261118090000 extends AbstractMigration {
    public function getDescription():string{return 'Create Hianpe user accounts and Stripe subscription records.';}
    public function up(Schema $schema):void {
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB');
        $this->addSql('CREATE TABLE app_subscription (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, product_key VARCHAR(40) NOT NULL, stripe_customer_id VARCHAR(100) NOT NULL, stripe_subscription_id VARCHAR(100) NOT NULL, status VARCHAR(40) NOT NULL, trial_ends_at DATETIME DEFAULT NULL COMMENT "(DC2Type:datetime_immutable)", current_period_ends_at DATETIME DEFAULT NULL COMMENT "(DC2Type:datetime_immutable)", cancel_at_period_end TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT "(DC2Type:datetime_immutable)", UNIQUE INDEX UNIQ_STRIPE_SUBSCRIPTION (stripe_subscription_id), INDEX IDX_APP_SUBSCRIPTION_USER (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB');
        $this->addSql('ALTER TABLE app_subscription ADD CONSTRAINT FK_APP_SUBSCRIPTION_USER FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }
    public function down(Schema $schema):void {
        $this->addSql('ALTER TABLE app_subscription DROP FOREIGN KEY FK_APP_SUBSCRIPTION_USER');
        $this->addSql('DROP TABLE app_subscription');$this->addSql('DROP TABLE user');
    }
}
