<?php


namespace GussiApi;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\StreamInterface;

class GussiApiClient
{


	/**
	 * @var Client
	 */
	private $client;

	public function __construct()
	{
		$this->client = new Client(config('gussi'));
	}

	/**
	 * @param string $email
	 * @param string $password
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function login(string $email, string $password, string $deviceName)
	{


		try {
			$response = $this->client->post('/api/airlock/token', [
				'form_params' => [
					'email'       => $email,
					'password'    => $password,
					'device_name' => $deviceName
				]
			]);

			$json = json_decode($response->getBody()->getContents());

			return response()->json([
				'token'   => $json->token,
				'success' => true
			]);


		} catch (BadResponseException $exception) {
			return response()->json($this->error($exception), $exception->getCode());
		}
	}


	/**
	 * @param $token
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function foods($token)
	{
		try {
			$response = $this->client->get('/api/foods', [
				'headers' => [
					'Authorization' => 'Bearer ' . $token
				]
			]);
			$json     = json_decode($response->getBody()->getContents());

			return response()->json([
				'success' => true,
				'foods'   => $json->data,
			]);

		} catch (BadResponseException $exception) {
			return response()->json($this->error($exception), $exception->getCode());
		}
	}


	/**
	 * @param RequestException $exception
	 * @return array
	 */
	private function error(RequestException $exception)
	{
		$json = json_decode($exception->getResponse()->getBody()->getContents());

		return [
			'message' => $json->message,
			'success' => false
		];
	}
}
