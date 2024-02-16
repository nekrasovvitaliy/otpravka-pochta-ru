<?php
/**
 * @copyright 2013-2024 Nekrasov Vitaliy
 * @license GNU General Public License version 2 or later
 */
namespace Wishbox\SendingRussianPostSDK\Exception;

use Throwable;

/**
 * @since 1.0.0
 */
class RequestException extends Exception
{
	/**
	 * @var string|null $errorCode  Error code
	 */
	public ?string $errorCode;

	/**
	 * @var string|null $errorMessage Error message
	 */
	public ?string $errorMessage;

	/**
	 * @param                   $message
	 * @param                   $code
	 * @param   Throwable|null  $previous
	 * @param   string|null     $errorCode
	 * @param   string|null     $errorMessage
	 */
	public function __construct(
		$message,
		$code = 0,
		Throwable $previous = null,
		?string $errorCode = null,
		?string $errorMessage = null
	)
	{
		parent::__construct($message, $code, $previous);

		// Save additional information
		$this->errorCode = $errorCode;
		$this->errorMessage = $errorMessage;
	}
}
