<?php

namespace Workshop\SoleProprietorship;

use Doctrine\ORM\EntityManager;
use Kdyby\StrictObjects\Scream;
use Ramsey\Uuid\Uuid;

class SoleProprietorshipRepository
{

	use Scream;

	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	private $entityManager;

	public function __construct(EntityManager $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	public function findSoleProprietorship(Uuid $soleProprietorshipId): ?SoleProprietorship
	{
		return $this->entityManager->createQueryBuilder()
			->select("p")
			->from(SoleProprietorship::class, "p")
			->andWhere("p.id = :id")->setParameter("id", $soleProprietorshipId->toString())
			->getQuery()
			->getOneOrNullResult();
	}

	public function findSoleProprietorshipRequest(
		Uuid $soleProprietorshipRequestId
	): ?SoleProprietorshipRequest
	{
		return $this->entityManager->createQueryBuilder()
			->select("p")
			->from(SoleProprietorshipRequest::class, "p")
			->andWhere("p.id = :id")->setParameter("id", $soleProprietorshipRequestId->toString())
			->getQuery()
			->getOneOrNullResult();
	}

	public function findSoleProprietorshipRequestBySocialSecurityNumber(
		int $socialSecurityNumber
	): ?SoleProprietorshipRequest
	{
		return $this->entityManager->createQueryBuilder()
			->select("p")
			->from(SoleProprietorshipRequest::class, "p")
			->andWhere("p.socialSecurityNumber = :ssn")
			->setParameter("ssn", $socialSecurityNumber)
			->getQuery()
			->getOneOrNullResult();
	}

}
