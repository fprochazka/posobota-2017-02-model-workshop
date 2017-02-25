<?php

namespace Workshop\SoleProprietorship;

use Doctrine\ORM\EntityManager;
use Kdyby\StrictObjects\Scream;
use Workshop\SocialSecurity\SocialSecurityFacade;

class SoleProprietorshipFacade
{

	use Scream;

	/**
	 * @var \Workshop\SoleProprietorship\SoleProprietorshipService
	 */
	private $soleProprietorshipService;

	/**
	 * @var \Workshop\SoleProprietorship\SoleProprietorshipRepository
	 */
	private $soleProprietorshipRepository;

	/**
	 * @var \Workshop\SocialSecurity\SocialSecurityFacade
	 */
	private $socialSecurityFacade;

	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	private $entityManager;

	public function __construct(
		SoleProprietorshipService $soleProprietorshipService,
		SoleProprietorshipRepository $soleProprietorshipRepository,
		SocialSecurityFacade $socialSecurityFacade,
		EntityManager $entityManager
	)
	{
		$this->soleProprietorshipService = $soleProprietorshipService;
		$this->soleProprietorshipRepository = $soleProprietorshipRepository;
		$this->socialSecurityFacade = $socialSecurityFacade;
		$this->entityManager = $entityManager;
	}

	public function createRequest(
		string $name,
		int $socialSecurityNumber
	): SoleProprietorshipRequest
	{
		$existingSoleProprietorshipRequest = $this->soleProprietorshipRepository
			->findSoleProprietorshipRequestBySocialSecurityNumber($socialSecurityNumber);

		$this->soleProprietorshipService->checkCreateRequestRequirements(
			$existingSoleProprietorshipRequest,
			$name,
			$socialSecurityNumber
		);

		$socialSecurityUserData = $this->socialSecurityFacade
			->getUserData($socialSecurityNumber);

		$soleProprietorshipRequest = $this->soleProprietorshipService->createRequest(
			$existingSoleProprietorshipRequest,
			$socialSecurityUserData,
			$name,
			$socialSecurityNumber
		);

		$this->entityManager->persist($soleProprietorshipRequest);
		$this->entityManager->flush();

		return $soleProprietorshipRequest;
	}

}
