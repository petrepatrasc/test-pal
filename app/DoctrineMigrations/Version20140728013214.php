<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140728013214 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE answer DROP identifier");
        $this->addSql("ALTER TABLE question ADD correctAnswer_id INT DEFAULT NULL, DROP correct_answer_identifier");
        $this->addSql("ALTER TABLE question ADD CONSTRAINT FK_B6F7494E73835AB0 FOREIGN KEY (correctAnswer_id) REFERENCES answer (id)");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_B6F7494E73835AB0 ON question (correctAnswer_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE answer ADD identifier VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci");
        $this->addSql("ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E73835AB0");
        $this->addSql("DROP INDEX UNIQ_B6F7494E73835AB0 ON question");
        $this->addSql("ALTER TABLE question ADD correct_answer_identifier VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP correctAnswer_id");
    }
}
