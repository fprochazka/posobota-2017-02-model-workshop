<?php

namespace Workshop\SocialSecurity;

use Kdyby\StrictObjects\Scream;

class SocialSecurityUserDataResult
{
	use Scream;

	/**
	 * @var int
	 */
	private $socialSecurityNumber;

	/**
	 * @var bool
	 */
	private $reliable;

	public function __construct(int $socialSecurityNumber, bool $reliable)
	{
		$this->socialSecurityNumber = $socialSecurityNumber;
		$this->reliable = $reliable;
	}

	public function getSocialSecurityNumber(): int
	{
		return $this->socialSecurityNumber;
	}

	public function isReliable(): bool
	{
		return $this->reliable;
	}

}
