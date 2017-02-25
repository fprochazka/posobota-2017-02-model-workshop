<?php

namespace Workshop\SoleProprietorship;

use Tester\Assert;
use Tester\TestCase;
use Workshop\SoleProprietorship\exceptions\SoleProprietorshipRequestAlreadySubmittedException;


require_once __DIR__ . '/../bootstrap.php';

class SoleProprietorshipServiceTest extends TestCase
{

	const SOCIAL_SECURITY_NUMBER = 12345678;
	const SOLE_PROPRIETOR_NAME = "Filip";

	public function testCreateRequest()
	{
		$service = new SoleProprietorshipService();
		$request = $service->createRequest(
			null,
			self::SOLE_PROPRIETOR_NAME,
			self::SOCIAL_SECURITY_NUMBER
		);
		Assert::type(SoleProprietorshipRequest::class, $request);
	}

	public function testCreateRequestWithExistingRequest()
	{
		$service = new SoleProprietorshipService();
		$exception = Assert::exception(function () use ($service) {
			$service->createRequest(
				new SoleProprietorshipRequest(
					self::SOLE_PROPRIETOR_NAME,
					self::SOCIAL_SECURITY_NUMBER
				),
				self::SOLE_PROPRIETOR_NAME,
				self::SOCIAL_SECURITY_NUMBER
			);
		}, SoleProprietorshipRequestAlreadySubmittedException::class);
		Assert::same(self::SOLE_PROPRIETOR_NAME, $exception->getName());
		Assert::same(self::SOCIAL_SECURITY_NUMBER, $exception->getSocialSecurityNumber());
	}

}

(new SoleProprietorshipServiceTest())->run();
