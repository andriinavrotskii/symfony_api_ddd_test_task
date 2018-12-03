<?php

namespace App\Persistence\Doctrine\Types;

use App\Domain\ValueObject\Money;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class MoneyType extends Type
{
    const MONEY_TYPE = 'money_type';

    const SQL_DATA_TYPE = 'INT(12)';

    /**
     * @param Money $value
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
     * @return Money
     * @throws \App\Domain\Exceptions\MoneyException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Money($value);
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
        return self::MONEY_TYPE;
    }
}