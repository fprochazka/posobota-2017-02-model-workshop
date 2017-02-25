<?php

declare(strict_types=1);

namespace Workshop\Mock;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Kdyby;
use Psr\Http\Message\ResponseInterface;
use function GuzzleHttp\Psr7\stream_for;

class ExternalService
{

	use Kdyby\StrictObjects\Scream;

	/**
	 * @param string $method
	 * @param string $url
	 * @param array $headers
	 * @param string $body
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function request($method, $url, array $headers = [], $body = null): ResponseInterface
	{
		$request = new Request($method, $url, $headers, stream_for($body));

		if (mt_rand(0, 10) == 5) {
			throw new ConnectException('Connection refused', $request);
		}
		if (mt_rand(0, 10) == 5) {
			throw new ClientException('You fucked it up', $request, new Response(422));
		}
		if (mt_rand(0, 20) == 5) {
			throw new ServerException('Shit happens', $request, new Response(500));
		}

		return new Response(
			200,
			[],
			stream_for('')
		);
	}

}
