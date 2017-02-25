<?php

namespace Workshop\SoleProprietorship;

use Kdyby\StrictObjects\Scream;
use Workshop\SocialSecurity\SocialSecurityUserDataResult;

class SoleProprietorshipService
{

	use Scream;

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

		return new SoleProprietorshipRequest($name, $socialSecurityNumber);
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
