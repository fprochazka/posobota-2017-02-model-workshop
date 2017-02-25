<?php

namespace Workshop\SoleProprietorship;

use Tester\Assert;
use Tester\TestCase;
use Workshop\DateTime\IDateTimeProvider;
use Workshop\SocialSecurity\CitizenSocialSecurity;
use Workshop\SocialSecurity\SocialSecurityUserDataResult;

require_once __DIR__ . '/../bootstrap.php';

class SoleProprietorshipServiceTest extends TestCase
{

	const SOCIAL_SECURITY_NUMBER = 12345678;
	const SOLE_PROPRIETOR_NAME = "Filip";

	public function testCreateRequest()
	{
		$service = $this->getSoleProprietorshipService();
		$request = $service->createRequest(
			null,
			new SocialSecurityUserDataResult(self::SOCIAL_SECURITY_NUMBER, true),
			self::SOLE_PROPRIETOR_NAME,
			self::SOCIAL_SECURITY_NUMBER
		);
		Assert::type(SoleProprietorshipRequest::class, $request);
		Assert::same(self::SOLE_PROPRIETOR_NAME, $request->getName());
		Assert::same(self::SOCIAL_SECURITY_NUMBER, $request->getSocialSecurityNumber());

		$citizenSocialSecurity = $request->getCitizenSocialSecurity();
		Assert::type(CitizenSocialSecurity::class, $citizenSocialSecurity);
		Assert::same(self::SOCIAL_SECURITY_NUMBER, $citizenSocialSecurity->getSocialSecurityNumber());
		Assert::true($citizenSocialSecurity->isReliable());
	}

	public function testCreateRequestWithExistingRequest()
	{
		$service = $this->getSoleProprietorshipService();
		$exception = Assert::exception(
			function () use ($service) {
				$service->createRequest(
					new SoleProprietorshipRequest(
						self::SOLE_PROPRIETOR_NAME,
						self::SOCIAL_SECURITY_NUMBER,
						new CitizenSocialSecurity(
							self::SOCIAL_SECURITY_NUMBER,
							true
						),
						$this->getDateTimeProvider()
					),
					new SocialSecurityUserDataResult(self::SOCIAL_SECURITY_NUMBER, true),
					self::SOLE_PROPRIETOR_NAME,
					self::SOCIAL_SECURITY_NUMBER
				);
			},
			SoleProprietorshipRequestAlreadySubmittedException::class
		);
		Assert::same(self::SOLE_PROPRIETOR_NAME, $exception->getName());
		Assert::same(self::SOCIAL_SECURITY_NUMBER, $exception->getSocialSecurityNumber());
	}

	public function testCreateRequestWithNotReliableCitizen()
	{
		$service = $this->getSoleProprietorshipService();
		$exception = Assert::exception(
			function () use ($service) {
				$service->createRequest(
					null,
					new SocialSecurityUserDataResult(self::SOCIAL_SECURITY_NUMBER, false),
					self::SOLE_PROPRIETOR_NAME,
					self::SOCIAL_SECURITY_NUMBER
				);
			},
			SoleProprietorshipRequestDeniedException::class
		);
		Assert::same(self::SOLE_PROPRIETOR_NAME, $exception->getName());
		Assert::same(self::SOCIAL_SECURITY_NUMBER, $exception->getSocialSecurityNumber());
	}

	private function getSoleProprietorshipService(): SoleProprietorshipService
	{
		return new SoleProprietorshipService(
			$this->getDateTimeProvider()
		);
	}

	private function getDateTimeProvider(): IDateTimeProvider
	{
		return \Mockery::mock(IDateTimeProvider::class, [
			'getNow' => new \DateTimeImmutable(),
		]);
	}

}

(new SoleProprietorshipServiceTest())->run();
