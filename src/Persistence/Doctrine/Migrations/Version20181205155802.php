<?php declare(strict_types=1);

namespace App\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181205155802 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE receipts (id INT AUTO_INCREMENT NOT NULL, status INT UNSIGNED NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE selected_products (id INT AUTO_INCREMENT NOT NULL, receipt_id INT NOT NULL, product_id INT NOT NULL, cost INT(12) NOT NULL COMMENT \'(DC2Type:money_type)\', amount INT UNSIGNED NOT NULL, INDEX IDX_A4E5A0672B5CA896 (receipt_id), INDEX IDX_A4E5A0674584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE selected_products ADD CONSTRAINT FK_A4E5A0672B5CA896 FOREIGN KEY (receipt_id) REFERENCES receipts (id)');
        $this->addSql('ALTER TABLE selected_products ADD CONSTRAINT FK_A4E5A0674584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('DROP INDEX barcode ON products');
        $this->addSql('ALTER TABLE products CHANGE barcode barcode VARCHAR(128) NOT NULL UNIQUE, CHANGE cost cost INT(12) NOT NULL COMMENT \'(DC2Type:money_type)\', CHANGE vat vat TINYINT(2) NOT NULL COMMENT \'(DC2Type:vat_type)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE selected_products DROP FOREIGN KEY FK_A4E5A0672B5CA896');
        $this->addSql('DROP TABLE receipts');
        $this->addSql('DROP TABLE selected_products');
        $this->addSql('ALTER TABLE products CHANGE barcode barcode VARCHAR(128) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE cost cost INT(12) NOT NULL COMMENT \'(DC2Type:money_type)\', CHANGE vat vat TINYINT(2) NOT NULL COMMENT \'(DC2Type:vat_type)\'');
        $this->addSql('CREATE UNIQUE INDEX barcode ON products (barcode)');
    }
}
