<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141228155759 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sl_oauth_access_token (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_63D1F85E5F37A13B (token), INDEX IDX_63D1F85E19EB6921 (client_id), INDEX IDX_63D1F85EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sl_oauth_auth_code (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, redirect_uri LONGTEXT NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_7E7AE5615F37A13B (token), INDEX IDX_7E7AE56119EB6921 (client_id), INDEX IDX_7E7AE561A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sl_oauth_refresh_token (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_820C7295F37A13B (token), INDEX IDX_820C72919EB6921 (client_id), INDEX IDX_820C729A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sl_oauth_client (id INT AUTO_INCREMENT NOT NULL, random_id VARCHAR(255) NOT NULL, redirect_uris LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', secret VARCHAR(255) NOT NULL, allowed_grant_types LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE LinkedInStorage (id INT AUTO_INCREMENT NOT NULL, field VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sl_oauth_access_token ADD CONSTRAINT FK_63D1F85E19EB6921 FOREIGN KEY (client_id) REFERENCES sl_oauth_client (id)');
        $this->addSql('ALTER TABLE sl_oauth_access_token ADD CONSTRAINT FK_63D1F85EA76ED395 FOREIGN KEY (user_id) REFERENCES sl_user (id)');
        $this->addSql('ALTER TABLE sl_oauth_auth_code ADD CONSTRAINT FK_7E7AE56119EB6921 FOREIGN KEY (client_id) REFERENCES sl_oauth_client (id)');
        $this->addSql('ALTER TABLE sl_oauth_auth_code ADD CONSTRAINT FK_7E7AE561A76ED395 FOREIGN KEY (user_id) REFERENCES sl_user (id)');
        $this->addSql('ALTER TABLE sl_oauth_refresh_token ADD CONSTRAINT FK_820C72919EB6921 FOREIGN KEY (client_id) REFERENCES sl_oauth_client (id)');
        $this->addSql('ALTER TABLE sl_oauth_refresh_token ADD CONSTRAINT FK_820C729A76ED395 FOREIGN KEY (user_id) REFERENCES sl_user (id)');
        $this->addSql('DROP INDEX UNIQ_294E8BA6F85E0677 ON sl_user');
        $this->addSql('ALTER TABLE sl_user ADD username_canonical VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD email_canonical VARCHAR(255) NOT NULL, ADD enabled TINYINT(1) NOT NULL, ADD salt VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD last_login DATETIME DEFAULT NULL, ADD locked TINYINT(1) NOT NULL, ADD expired TINYINT(1) NOT NULL, ADD expires_at DATETIME DEFAULT NULL, ADD confirmation_token VARCHAR(255) DEFAULT NULL, ADD password_requested_at DATETIME DEFAULT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD credentials_expired TINYINT(1) NOT NULL, ADD credentials_expire_at DATETIME DEFAULT NULL, CHANGE username username VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_294E8BA692FC23A8 ON sl_user (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_294E8BA6A0D96FBF ON sl_user (email_canonical)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sl_oauth_access_token DROP FOREIGN KEY FK_63D1F85E19EB6921');
        $this->addSql('ALTER TABLE sl_oauth_auth_code DROP FOREIGN KEY FK_7E7AE56119EB6921');
        $this->addSql('ALTER TABLE sl_oauth_refresh_token DROP FOREIGN KEY FK_820C72919EB6921');
        $this->addSql('DROP TABLE sl_oauth_access_token');
        $this->addSql('DROP TABLE sl_oauth_auth_code');
        $this->addSql('DROP TABLE sl_oauth_refresh_token');
        $this->addSql('DROP TABLE sl_oauth_client');
        $this->addSql('DROP TABLE LinkedInStorage');
        $this->addSql('DROP INDEX UNIQ_294E8BA692FC23A8 ON sl_user');
        $this->addSql('DROP INDEX UNIQ_294E8BA6A0D96FBF ON sl_user');
        $this->addSql('ALTER TABLE sl_user DROP username_canonical, DROP email, DROP email_canonical, DROP enabled, DROP salt, DROP password, DROP last_login, DROP locked, DROP expired, DROP expires_at, DROP confirmation_token, DROP password_requested_at, DROP roles, DROP credentials_expired, DROP credentials_expire_at, CHANGE username username VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_294E8BA6F85E0677 ON sl_user (username)');
    }
}
