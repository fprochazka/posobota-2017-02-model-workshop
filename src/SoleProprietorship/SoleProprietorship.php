<?php

namespace Workshop\SoleProprietorship;

use Consistence\Doctrine\Enum\EnumAnnotation as Enum;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Kdyby\StrictObjects\Scream;
use Ramsey\Uuid\Uuid;
use Workshop\DateTime\IDateTimeProvider;

/**
 * @ORM\Entity()
 */
class SoleProprietorship
{
	use Scream;

	/**
	 * @ORM\Id()
	 * @ORM\Column(type="uuid")
	 * @var Uuid
	 */
	private $id;

	/**
	 * @Enum(class=SoleProprietorshipTypes::class)
	 * @ORM\Column(type="integer_enum", nullable=false)
	 * @var SoleProprietorshipTypes
	 */
	private $types;

	/**
	 * @ORM\OneToOne(targetEntity=SoleProprietorshipRequest::class, cascade={"persist"})
	 * @ORM\JoinColumn(nullable=FALSE)
	 * @var SoleProprietorshipRequest
	 */
	private $soleProprietorshipRequest;

	/**
	 * @ORM\Column(type="datetime_immutable")
	 * @var \DateTimeImmutable
	 */
	private $createdAt;

	public function __construct(
		SoleProprietorshipRequest $soleProprietorshipRequest,
		SoleProprietorshipTypes $types,
		IDateTimeProvider $dateTimeProvider
	)
	{
		$this->id = Uuid::uuid4();
		$this->types = $types;
		$this->soleProprietorshipRequest = $soleProprietorshipRequest;
		$this->createdAt = $dateTimeProvider->getNow();
	}

	public function getId(): Uuid
	{
		return $this->id;
	}

	public function getTypes(): SoleProprietorshipTypes
	{
		return $this->types;
	}

	public function getSoleProprietorshipRequest(): SoleProprietorshipRequest
	{
		return $this->soleProprietorshipRequest;
	}

}
