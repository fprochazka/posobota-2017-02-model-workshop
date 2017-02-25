<?php

namespace Workshop\SocialSecurity;

use Kdyby\StrictObjects\Scream;
use Workshop\Mock\ExternalService;

class SocialSecurityFacade
{

	use Scream;

	/**
	 * @var \Workshop\Mock\ExternalService
	 */
	private $externalService;

	public function __construct(ExternalService $externalService)
	{
		$this->externalService = $externalService;
	}

	public function getUserData(int $socialSecurityNumber): SocialSecurityUserDataResult
	{
		try {
			$response = $this->externalService->request(
				"GET",
				sprintf("/citizen/%d", $socialSecurityNumber)
			);

			return new SocialSecurityUserDataResult(
				$socialSecurityNumber,
				random_int(1, 10) !== 10
			);

		} catch (\GuzzleHttp\Exception\ConnectException $e) {
			throw new SocialSecurityServiceCommunicationFailedException($e->getMessage(), 0, $e);

		} catch (\GuzzleHttp\Exception\ServerException $e) {
			throw new SocialSecurityServiceCommunicationFailedException($e->getMessage(), 0, $e);
		}
	}

}
