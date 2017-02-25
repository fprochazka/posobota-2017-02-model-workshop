<?php

namespace Workshop\SoleProprietorship;

use Kdyby\StrictObjects\Scream;
use Workshop\DateTime\IDateTimeProvider;

class SoleProprietorshipOfficerService
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

	public function acceptRequest(
		SoleProprietorshipRequest $soleProprietorshipRequest,
		SoleProprietorshipTypes $types
	): SoleProprietorship
	{
		$soleProprietorshipRequest->markSolved($this->dateTimeProvider);

		return new SoleProprietorship(
			$soleProprietorshipRequest,
			$types,
			$this->dateTimeProvider
		);
	}
}
