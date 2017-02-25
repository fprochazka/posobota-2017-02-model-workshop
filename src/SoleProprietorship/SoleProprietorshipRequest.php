<?php

namespace Workshop\SoleProprietorship;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Kdyby\StrictObjects\Scream;
use Ramsey\Uuid\Uuid;
use Workshop\DateTime\IDateTimeProvider;
use Workshop\SocialSecurity\CitizenSocialSecurity;

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

	/**
	 * @ORM\ManyToOne(targetEntity=CitizenSocialSecurity::class, cascade={"persist"})
	 * @var CitizenSocialSecurity|null
	 */
	private $citizenSocialSecurity;

	/**
	 * @ORM\Column(type="datetime_immutable")
	 * @var DateTimeImmutable
	 */
	private $createdAt;

	public function __construct(
		string $name,
		int $socialSecurityNumber,
		CitizenSocialSecurity $citizenSocialSecurity,
		IDateTimeProvider $dateTimeProvider
	)
	{
		$this->id = Uuid::uuid4();
		$this->name = $name;
		$this->socialSecurityNumber = $socialSecurityNumber;
		$this->citizenSocialSecurity = $citizenSocialSecurity;
		$this->createdAt = $dateTimeProvider->getNow();
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

	public function getCitizenSocialSecurity(): ?CitizenSocialSecurity
	{
		return $this->citizenSocialSecurity;
	}

	public function dropForeignPersonalInfo()
	{
		$this->citizenSocialSecurity = null;
	}

	public function getCreatedAt(): \DateTimeImmutable
	{
		return $this->createdAt;
	}

}
