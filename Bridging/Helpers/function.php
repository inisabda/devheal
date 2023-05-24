<?php

namespace Bridging\Helpers;

use GuzzleHttp\Client;

class HelperFunc
{
	protected $header;
	public function __construct()
	{
		$this->header = [
			'headers' => [
				'secret-header' => 'megono'
			]
			];
	}
	public function getRequest($url)
	{

		$client = new Client();

		$response = $client->request('GET', $url, $this->header);

		return $response->getBody()->getContents();
	}
}
