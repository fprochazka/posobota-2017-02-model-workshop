<?php

namespace Workshop\SoleProprietorship;

use Kdyby\StrictObjects\Scream;
use Workshop\DateTime\IDateTimeProvider;
use Workshop\SocialSecurity\CitizenSocialSecurity;
use Workshop\SocialSecurity\SocialSecurityUserDataResult;

class SoleProprietorshipService
{

	use Scream;

	/**
	 * @var \Workshop\DateTime\IDateTimeProvider
	 */
	private $dateTimeProvider;

	public function __construct(IDateTimeProvider $dateTimeProvider)
	{
		$this->dateTimeProvider = $dateTimeProvider;
	}

	public function createRequest(
		?SoleProprietorshipRequest $proprietorshipRequest,
		SocialSecurityUserDataResult $socialSecurityUserData,
		string $name,
		int $socialSecurityNumber
	): SoleProprietorshipRequest
	{
		$this->checkCreateRequestRequirements(
			$proprietorshipRequest,
			$name,
			$socialSecurityNumber
		);

		if (!$socialSecurityUserData->isReliable()) {
			throw new SoleProprietorshipRequestDeniedException(
				$name,
				$socialSecurityNumber
			);
		}

		return new SoleProprietorshipRequest(
			$name,
			$socialSecurityNumber,
			new CitizenSocialSecurity(
				$socialSecurityNumber,
				$socialSecurityUserData->isReliable()
			),
			$this->dateTimeProvider
		);
	}

	public function checkCreateRequestRequirements(
		?SoleProprietorshipRequest $proprietorshipRequest,
		string $name,
		int $socialSecurityNumber
	)
	{
		if ($proprietorshipRequest !== null) {
			if ($socialSecurityNumber !== $proprietorshipRequest->getSocialSecurityNumber()) {
				throw new \LogicException("You've fucked up dude");
			}

			throw new SoleProprietorshipRequestAlreadySubmittedException(
				$name,
				$socialSecurityNumber
			);
		}
	}

}
