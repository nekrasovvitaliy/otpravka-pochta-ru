<?php
/**
 * @copyright 2013-2024 Nekrasov Vitaliy
 * @license GNU General Public License version 2 or later
 */
namespace Wishbox\SendingRussianPostSDK;

/**
 * Class Constants.
 *
 * @since 1.0.0
 */
class Constants
{
	/**
	 * Адрес сервиса интеграции.
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	public const API_URL = 'https://otpravka-api.pochta.ru/1.0/';

	/**
	 * URL for create order
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	public const CREATE_ORDER_URL = 'user/backlog';
}
