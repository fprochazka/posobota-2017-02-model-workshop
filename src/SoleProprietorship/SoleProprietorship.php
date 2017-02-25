<?php

namespace Workshop\SoleProprietorship;

use Consistence\Doctrine\Enum\EnumAnnotation as Enum;
use Doctrine\ORM\Mapping as ORM;
use Kdyby\StrictObjects\Scream;
use Ramsey\Uuid\Uuid;

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
	 * @ORM\Column(type="integer_enum")
	 * @var SoleProprietorshipTypes
	 */
	private $type;

	public function __construct(
		SoleProprietorshipTypes $type
	)
	{
		$this->id = Uuid::uuid4();
		$this->type = $type;
	}

	public function getId(): Uuid
	{
		return $this->id;
	}

	public function getType(): SoleProprietorshipTypes
	{
		return $this->type;
	}

}
