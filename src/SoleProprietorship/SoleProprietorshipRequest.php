<?php

namespace Workshop\SoleProprietorship;

use Doctrine\ORM\Mapping as ORM;
use Kdyby\StrictObjects\Scream;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 */
class SoleProprietorshipRequest
{

	use Scream;

	/**
	 * @ORM\Id()
	 * @ORM\Column(type="uuid")
	 * @var Uuid
	 */
	private $id;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	private $name;

	/**
	 * @ORM\Column(type="integer")
	 * @var int
	 */
	private $socialSecurityNumber;

	public function __construct(string $name, int $socialSecurityNumber)
	{
		$this->id = Uuid::uuid4();
		$this->name = $name;
		$this->socialSecurityNumber = $socialSecurityNumber;
	}

	public function getId(): Uuid
	{
		return $this->id;
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
