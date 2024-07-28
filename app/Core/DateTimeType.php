<?php declare(strict_types=1);

namespace App\Core;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types;
use Nette\Utils\DateTime;

class DateTimeType extends Types\DateTimeType
{

    private const FORMAT = 'Y-m-d G:i:s';

    public function convertToPHPValue($value, AbstractPlatform $platform): ?DateTime
    {
        $dateTime = parent::convertToPHPValue($value, $platform);

        if (!$dateTime) {
            return null;
        }

        $dateTime = $dateTime->format(self::FORMAT);
        $dateTime = DateTime::createFromFormat(self::FORMAT, $dateTime);

        if (!$dateTime) {
            return null;
        }

        return $dateTime;
    }

}
