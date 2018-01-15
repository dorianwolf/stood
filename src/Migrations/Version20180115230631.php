<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180115230631 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__to_do_item AS SELECT id, stood, completed FROM to_do_item');
        $this->addSql('DROP TABLE to_do_item');
        $this->addSql('CREATE TABLE to_do_item (id INTEGER NOT NULL, stood CLOB NOT NULL COLLATE BINARY, completed BOOLEAN DEFAULT \'0\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO to_do_item (id, stood, completed) SELECT id, stood, completed FROM __temp__to_do_item');
        $this->addSql('DROP TABLE __temp__to_do_item');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__to_do_item AS SELECT id, stood, completed FROM to_do_item');
        $this->addSql('DROP TABLE to_do_item');
        $this->addSql('CREATE TABLE to_do_item (id INTEGER NOT NULL, stood CLOB NOT NULL, completed BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO to_do_item (id, stood, completed) SELECT id, stood, completed FROM __temp__to_do_item');
        $this->addSql('DROP TABLE __temp__to_do_item');
    }
}
