<?php declare(strict_types=1);

namespace App\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181205083846 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE selected_products CHANGE cost cost INT(12) NOT NULL COMMENT \'(DC2Type:money_type)\'');
        $this->addSql('DROP INDEX barcode ON products');
        $this->addSql('ALTER TABLE products CHANGE barcode barcode VARCHAR(128) NOT NULL UNIQUE, CHANGE cost cost INT(12) NOT NULL COMMENT \'(DC2Type:money_type)\', CHANGE vat vat TINYINT(2) NOT NULL COMMENT \'(DC2Type:vat_type)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE products CHANGE barcode barcode VARCHAR(128) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE cost cost INT(12) NOT NULL COMMENT \'(DC2Type:money_type)\', CHANGE vat vat TINYINT(2) NOT NULL COMMENT \'(DC2Type:vat_type)\'');
        $this->addSql('CREATE UNIQUE INDEX barcode ON products (barcode)');
        $this->addSql('ALTER TABLE selected_products CHANGE cost cost INT(12) NOT NULL COMMENT \'(DC2Type:money_type)\'');
    }
}
