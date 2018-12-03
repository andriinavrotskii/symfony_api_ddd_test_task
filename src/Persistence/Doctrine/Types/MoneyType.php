<?php

namespace App\Persistence\Doctrine\Types;

use App\Domain\Model\Money;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class MoneyType extends Type
{
    const MONEY_TYPE = 'money_type';

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
        return self::MONEY_TYPE;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::MONEY_TYPE;
    }
}