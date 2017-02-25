<?php

namespace Workshop\SoleProprietorship;

use Kdyby\StrictObjects\Scream;

class SoleProprietorshipRequestDeniedException extends \RuntimeException
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
		parent::__construct(
			sprintf(
				"Citizen %s with social security number %s is not reliable payer of social security taxes ...",
				$name,
				$socialSecurityNumber
			)
		);
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
