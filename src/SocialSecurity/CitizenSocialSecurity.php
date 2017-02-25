<?php

namespace Workshop\SocialSecurity;

use Doctrine\ORM\Mapping as ORM;
use Kdyby\StrictObjects\Scream;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 */
class CitizenSocialSecurity
{

	use Scream;

	/**
	 * @ORM\Id()
	 * @ORM\Column(type="uuid")
	 * @var Uuid
	 */
	private $id;

	/**
	 * @ORM\Column(type="integer")
	 * @var int
	 */
	private $socialSecurityNumber;

	/**
	 * @ORM\Column(type="boolean")
	 * @var bool
	 */
	private $reliable;

	public function __construct(
		int $socialSecurityNumber,
		bool $reliable
	)
	{
		$this->id = Uuid::uuid4();
		$this->socialSecurityNumber = $socialSecurityNumber;
		$this->reliable = $reliable;
	}

	public function getId(): Uuid
	{
		return $this->id;
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
