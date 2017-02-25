<?php

namespace Workshop\SoleProprietorship;

use Kdyby\StrictObjects\Scream;
use Ramsey\Uuid\Uuid;

class SoleProprietorshipRequestNotFoundException extends \RuntimeException
{

	use Scream;

	/**
	 * @var Uuid
	 */
	private $soleProprietorshipRequestId;

	public function __construct(
		Uuid $soleProprietorshipRequestId,
		?\Throwable $previous
	)
	{
		parent::__construct(sprintf(
			"Request %s was not found",
			$soleProprietorshipRequestId->toString()
		), 0, $previous);
		$this->soleProprietorshipRequestId = $soleProprietorshipRequestId;
	}

	public function getSoleProprietorshipRequestId(): Uuid
	{
		return $this->soleProprietorshipRequestId;
	}

}
