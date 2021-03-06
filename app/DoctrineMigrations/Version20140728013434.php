<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140728013434 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E73835AB0");
        $this->addSql("DROP INDEX UNIQ_B6F7494E73835AB0 ON question");
        $this->addSql("ALTER TABLE question CHANGE correctanswer_id correct_answer_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE question ADD CONSTRAINT FK_B6F7494EFD2E7CF7 FOREIGN KEY (correct_answer_id) REFERENCES answer (id)");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_B6F7494EFD2E7CF7 ON question (correct_answer_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EFD2E7CF7");
        $this->addSql("DROP INDEX UNIQ_B6F7494EFD2E7CF7 ON question");
        $this->addSql("ALTER TABLE question CHANGE correct_answer_id correctAnswer_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE question ADD CONSTRAINT FK_B6F7494E73835AB0 FOREIGN KEY (correctAnswer_id) REFERENCES answer (id)");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_B6F7494E73835AB0 ON question (correctAnswer_id)");
    }
}
