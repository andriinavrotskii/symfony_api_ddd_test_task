<?php

namespace App\Persistence\Doctrine\Types;

use App\Domain\Model\Vat;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class VatType extends Type
{
    const VAT_TYPE = 'vat_type';

    const SQL_DATA_TYPE = 'TINYINT(2)';

    /**
     * @param Vat $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->getValue();
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return Vat
     * @throws \App\Domain\Exceptions\VatException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Vat($value);
    }

    /**
     * @param array $fieldDeclaration
     * @param AbstractPlatform $platform
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return self::SQL_DATA_TYPE;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::VAT_TYPE;
    }


}