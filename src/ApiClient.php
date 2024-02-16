<?php
/**
 * @copyright 2013-2024 Nekrasov Vitaliy
 * @license GNU General Public License version 2 or later
 */
namespace Wishbox\SendingRussianPostSDK;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Wishbox\SendingRussianPostSDK\Entity\Request\Order;
use Wishbox\SendingRussianPostSDK\Entity\Request\RequestInterface;
use Wishbox\SendingRussianPostSDK\Entity\Response\EntityResponse;
use Wishbox\SendingRussianPostSDK\Exception\RequestException;

/**
 * @since 1.0.0
 */
final class ApiClient
{
	/**
	 * $authorisationToken
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	private string $authorisationToken;

	/**
	 * $authorisationKey
	 *
	 * @var string
	 *
	 * @since 1.0.0
	 */
	private string $authorisationKey;

	/**
	 * @var integer
	 *
	 * @since 1.0.0
	 */
	private int $expire = 0;

	/**
	 * @var GuzzleClient
	 *
	 * @since 1.0.0
	 */
	private GuzzleClient $http;

	/**
	 * Конструктор клиента Guzzle.
	 *
	 * @param   string  $authorisationToken  Логин Account в сервисе Интеграции
	 * @param   string  $authorisationKey    Пароль Secure password в сервисе Интеграции
	 * @param   float   $timeout             Настройка клиента задающая общий тайм-аут запроса в секундах.
	 *                                       При использовании 0 ждать бесконечно долго (поведение по умолчанию)
	 *
	 * @since 1.0.0
	 */
	public function __construct(string $authorisationToken, string $authorisationKey, float $timeout = 5.0)
	{
		$this->http = new GuzzleClient(
			[
				'base_uri' => Constants::API_URL,
				'timeout' => $timeout,
				'http_errors' => false,
			]
		);
		$this->authorisationToken = $authorisationToken;
		$this->authorisationKey = $authorisationKey;
	}

	/**
	 * Выполняет вызов к API.
	 *
	 * @param   string                 $type         Метод запроса
	 * @param   string                 $method       url path запроса
	 * @param   RequestInterface|null  $params       массив данных параметров запроса
	 * @param   boolean                $checkErrors  Check errors
	 *
	 * @return array
	 *
	 * @throws RegistratorRequestException|GuzzleException
	 *
	 * @since 1.0.0
	 */
	private function apiRequest(
		string $type,
		string $method,
		?RequestInterface $params = null,
		bool $checkErrors = true
	): array
	{
		$headers = [];
		$headers['Authorization'] = 'AccessToken ' . $this->authorisationToken;
		$headers['X-User-Authorization'] = 'Basic ' . $this->authorisationKey;
		$headers['Content-Type'] = 'application/json';
		$headers['Accept'] = 'application/json;charset=UTF-8';

		// $headers[] = 'Content-Length: ' . strlen($json);

		if (!empty($params) && is_object($params))
		{
			$params = [$params->prepareRequest()];
		}

		$response = null;

		switch ($type)
		{
			case 'GET':
				$response = $this->http->get($method, ['query' => $params, 'headers' => $headers]);
				break;
			case 'DELETE':
				$response = $this->http->delete($method, ['headers' => $headers]);
				break;
			case 'POST':
				$response = $this->http->post($method, ['json' => $params, 'headers' => $headers]);
				break;
			case 'PUT':
				$response = $this->http->put($method, ['json' => $params, 'headers' => $headers]);
				break;
			case 'PATCH':
				$response = $this->http->patch($method, ['json' => $params, 'headers' => $headers]);
				break;
		}

		$json = $response->getBody()->getContents();
		$apiResponse = json_decode($json, true);

		if ($checkErrors)
		{
			$this->checkErrors($method, $response, $apiResponse);
		}

		return $apiResponse;
	}

	/**
	 * Создание заказа.
	 *
	 * @param   Order  $order  - Параметры заказа
	 *
	 * @return EntityResponse
	 *
	 * @throws RequestException|GuzzleException
	 *
	 * @since 1.0.0
	 */
	public function createOrder(Order $order): EntityResponse
	{
		return new EntityResponse(
			$this->apiRequest(
				'PUT',
				Constants::CREATE_ORDER_URL,
				$order
			)
		);
	}

	/**
	 * Проверка ответа на ошибки.
	 *
	 * @param   string  $method       Method
	 * @param   mixed   $response     Response
	 * @param   mixed   $apiResponse  Api response
	 *
	 * @return boolean
	 *
	 * @throws RequestException
	 *
	 * @since 1.0.0
	 */
	private function checkErrors(string $method, $response, $apiResponse): bool
	{
		if (empty($apiResponse))
		{
			throw new RequestException(
				'От API CDEK при вызове метода ' . $method . ' пришел пустой ответ',
				$response->getStatusCode()
			);
		}

		$statusCode = $response->getStatusCode();

		if ($statusCode = 202 && isset($apiResponse['requests'][0]['errors']))
		{
			throw new RequestException(
				'От API otpravka.pochta.ru при вызове метода ' . $method . ' получена ошибки: ' . $message,
				$response->getStatusCode(),
				null,
				$apiResponse['requests'][0]['errors'][0]['code'],
				$apiResponse['requests'][0]['errors'][0]['message']
			);
		}

		return false;
	}
}
