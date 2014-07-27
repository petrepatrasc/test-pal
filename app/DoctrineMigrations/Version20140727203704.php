<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140727203704 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, identifier VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE question_answer (question_id INT NOT NULL, answer_id INT NOT NULL, INDEX IDX_DD80652D1E27F6BF (question_id), INDEX IDX_DD80652DAA334807 (answer_id), PRIMARY KEY(question_id, answer_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE question_answer ADD CONSTRAINT FK_DD80652D1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE question_answer ADD CONSTRAINT FK_DD80652DAA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE test ADD name VARCHAR(255) NOT NULL, ADD permalink VARCHAR(255) NOT NULL");
        $this->addSql("ALTER TABLE question ADD content LONGTEXT NOT NULL, ADD category VARCHAR(255) NOT NULL, ADD correct_answer_identifier VARCHAR(255) NOT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE question_answer DROP FOREIGN KEY FK_DD80652DAA334807");
        $this->addSql("DROP TABLE answer");
        $this->addSql("DROP TABLE question_answer");
        $this->addSql("ALTER TABLE question DROP content, DROP category, DROP correct_answer_identifier");
        $this->addSql("ALTER TABLE test DROP name, DROP permalink");
    }
}
