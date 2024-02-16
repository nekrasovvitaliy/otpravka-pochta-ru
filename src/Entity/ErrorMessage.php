<?php
/**
 * @copyright 2013-2024 Nekrasov Vitaliy
 * @license GNU General Public License version 2 or later
 */
namespace Wishbox\SendingRussianPostSDK\Entity;

/**
 * @since 1.0.0
 */
class ErrorMessage
{
	/**
	 * @var string $code Code
	 *
	 * @since 1.0.0
	 */
	protected string $code;

	/**
	 * @var string $message Message
	 *
	 * @since 1.0.0
	 */
	protected string $message;

	/**
	 * @param   string  $code     Code
	 * @param   string  $message  Message
	 *
	 * @since 1.0.0
	 */
	public function __construct(string $code, string $message)
	{
		$this->code = $code;
		$this->message = $message;
	}
}
