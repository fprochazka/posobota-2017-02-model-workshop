<?php

namespace Workshop\SoleProprietorship;

use Doctrine\ORM\EntityManager;
use Kdyby\StrictObjects\Scream;

class SoleProprietorshipFacade
{

	use Scream;

	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	private $entityManager;

	/**
	 * @var \Workshop\SoleProprietorship\SoleProprietorshipRepository
	 */
	private $soleProprietorshipRepository;

	/**
	 * @var \Workshop\SoleProprietorship\SoleProprietorshipService
	 */
	private $soleProprietorshipService;

	public function __construct(
		SoleProprietorshipService $soleProprietorshipService,
		SoleProprietorshipRepository $soleProprietorshipRepository,
		EntityManager $entityManager
	)
	{
		$this->entityManager = $entityManager;
		$this->soleProprietorshipRepository = $soleProprietorshipRepository;
		$this->soleProprietorshipService = $soleProprietorshipService;
	}

	public function createRequest(
		string $name,
		int $socialSecurityNumber
	): SoleProprietorshipRequest
	{
		$existingSoleProprietorshipRequest = $this->soleProprietorshipRepository
			->findSoleProprietorshipRequestBySocialSecurityNumber($socialSecurityNumber);

		$soleProprietorshipRequest = $this->soleProprietorshipService->createRequest(
			$existingSoleProprietorshipRequest,
			$name,
			$socialSecurityNumber
		);

		$this->entityManager->persist($soleProprietorshipRequest);
		$this->entityManager->flush();

		return $soleProprietorshipRequest;
	}

}
