<?php
/**
 * @copyright 2013-2024 Nekrasov Vitaliy
 * @license GNU General Public License version 2 or later
 */
namespace Wishbox\ShippingService\Russianpost\Registrator\Exception;

use AntistressStore\CdekSDK2\Constants;

class Exception extends \Exception
{
    public static function getTranslation($code, $message)
    {
        if (array_key_exists($code, Constants::ERRORS)) {
            return Constants::ERRORS[$code].'. '.$message;
        }

        return $message;
    }
}
