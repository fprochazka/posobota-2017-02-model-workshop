<?php

namespace Workshop\SoleProprietorship\exceptions;

use Kdyby\StrictObjects\Scream;

class SoleProprietorshipRequestAlreadySubmittedException extends \RuntimeException
{

	use Scream;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var int
	 */
	private $socialSecurityNumber;

	public function __construct(string $name, int $socialSecurityNumber)
	{
		parent::__construct(sprintf(
			"Citizen %s with social security number %s has already requested the creation of ...",
			$name,
			$socialSecurityNumber
		));
		$this->name = $name;
		$this->socialSecurityNumber = $socialSecurityNumber;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getSocialSecurityNumber(): int
	{
		return $this->socialSecurityNumber;
	}

}
