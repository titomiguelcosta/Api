<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141228155115 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sl_oauth_access_token (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_63D1F85E5F37A13B (token), INDEX IDX_63D1F85E19EB6921 (client_id), INDEX IDX_63D1F85EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sl_oauth_auth_code (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, redirect_uri LONGTEXT NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_7E7AE5615F37A13B (token), INDEX IDX_7E7AE56119EB6921 (client_id), INDEX IDX_7E7AE561A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sl_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_294E8BA692FC23A8 (username_canonical), UNIQUE INDEX UNIQ_294E8BA6A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sl_blog (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, points INT DEFAULT 0, photo_path VARCHAR(255) DEFAULT NULL, photo_name VARCHAR(255) DEFAULT NULL, photo_mime_type VARCHAR(255) DEFAULT NULL, photo_size NUMERIC(10, 0) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sl_oauth_refresh_token (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_820C7295F37A13B (token), INDEX IDX_820C72919EB6921 (client_id), INDEX IDX_820C729A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sl_oauth_client (id INT AUTO_INCREMENT NOT NULL, random_id VARCHAR(255) NOT NULL, redirect_uris LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', secret VARCHAR(255) NOT NULL, allowed_grant_types LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sl_news (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, points INT DEFAULT 0, photo_path VARCHAR(255) DEFAULT NULL, photo_name VARCHAR(255) DEFAULT NULL, photo_mime_type VARCHAR(255) DEFAULT NULL, photo_size NUMERIC(10, 0) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX slug_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE LinkedInStorage (id INT AUTO_INCREMENT NOT NULL, field VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sl_oauth_access_token ADD CONSTRAINT FK_63D1F85E19EB6921 FOREIGN KEY (client_id) REFERENCES sl_oauth_client (id)');
        $this->addSql('ALTER TABLE sl_oauth_access_token ADD CONSTRAINT FK_63D1F85EA76ED395 FOREIGN KEY (user_id) REFERENCES sl_user (id)');
        $this->addSql('ALTER TABLE sl_oauth_auth_code ADD CONSTRAINT FK_7E7AE56119EB6921 FOREIGN KEY (client_id) REFERENCES sl_oauth_client (id)');
        $this->addSql('ALTER TABLE sl_oauth_auth_code ADD CONSTRAINT FK_7E7AE561A76ED395 FOREIGN KEY (user_id) REFERENCES sl_user (id)');
        $this->addSql('ALTER TABLE sl_oauth_refresh_token ADD CONSTRAINT FK_820C72919EB6921 FOREIGN KEY (client_id) REFERENCES sl_oauth_client (id)');
        $this->addSql('ALTER TABLE sl_oauth_refresh_token ADD CONSTRAINT FK_820C729A76ED395 FOREIGN KEY (user_id) REFERENCES sl_user (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sl_oauth_access_token DROP FOREIGN KEY FK_63D1F85EA76ED395');
        $this->addSql('ALTER TABLE sl_oauth_auth_code DROP FOREIGN KEY FK_7E7AE561A76ED395');
        $this->addSql('ALTER TABLE sl_oauth_refresh_token DROP FOREIGN KEY FK_820C729A76ED395');
        $this->addSql('ALTER TABLE sl_oauth_access_token DROP FOREIGN KEY FK_63D1F85E19EB6921');
        $this->addSql('ALTER TABLE sl_oauth_auth_code DROP FOREIGN KEY FK_7E7AE56119EB6921');
        $this->addSql('ALTER TABLE sl_oauth_refresh_token DROP FOREIGN KEY FK_820C72919EB6921');
        $this->addSql('DROP TABLE sl_oauth_access_token');
        $this->addSql('DROP TABLE sl_oauth_auth_code');
        $this->addSql('DROP TABLE sl_user');
        $this->addSql('DROP TABLE sl_blog');
        $this->addSql('DROP TABLE sl_oauth_refresh_token');
        $this->addSql('DROP TABLE sl_oauth_client');
        $this->addSql('DROP TABLE sl_news');
        $this->addSql('DROP TABLE LinkedInStorage');
    }
}
