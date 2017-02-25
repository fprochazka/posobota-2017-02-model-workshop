<?php

namespace Workshop\SoleProprietorship;

use Kdyby\StrictObjects\Scream;
use Workshop\SoleProprietorship\exceptions\SoleProprietorshipRequestAlreadySubmittedException;

class SoleProprietorshipService
{

	use Scream;

	public function createRequest(
		?SoleProprietorshipRequest $proprietorshipRequest,
		string $name,
		int $socialSecurityNumber
	): SoleProprietorshipRequest
	{
		if ($proprietorshipRequest !== null) {
			throw new SoleProprietorshipRequestAlreadySubmittedException(
				$name,
				$socialSecurityNumber
			);
		}

		return new SoleProprietorshipRequest($name, $socialSecurityNumber);
	}

}
