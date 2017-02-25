<?php

namespace Workshop\SoleProprietorship;

use Doctrine\ORM\EntityManager;
use Kdyby\StrictObjects\Scream;
use Ramsey\Uuid\Uuid;
use Workshop\RabbitMq\IProducer;

class SoleProprietorshipOfficerFacade
{

	use Scream;

	/**
	 * @var \Workshop\SoleProprietorship\SoleProprietorshipRepository
	 */
	private $soleProprietorshipRepository;

	/**
	 * @var \Workshop\SoleProprietorship\SoleProprietorshipOfficerService
	 */
	private $soleProprietorshipOfficerService;

	/**
	 * @var \Workshop\RabbitMq\IProducer
	 */
	private $taxHellProducer;

	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	private $entityManager;

	public function __construct(
		SoleProprietorshipRepository $soleProprietorshipRepository,
		SoleProprietorshipOfficerService $soleProprietorshipOfficerService,
		IProducer $taxHellProducer,
		EntityManager $entityManager
	)
	{
		$this->soleProprietorshipRepository = $soleProprietorshipRepository;
		$this->soleProprietorshipOfficerService = $soleProprietorshipOfficerService;
		$this->taxHellProducer = $taxHellProducer;
		$this->entityManager = $entityManager;
	}

	/**
	 * @return \Workshop\SoleProprietorship\SoleProprietorshipRequest[]
	 */
	public function getRequestList(
		// AccessToken $officerToken
	): array
	{
		// todo: check access

		return $this->soleProprietorshipRepository
			->getAwaitingSoleProprietorshipRequests();
	}

	/**
	 * @return \Workshop\SoleProprietorship\SoleProprietorshipRequest[]
	 */
	public function acceptRequest(
		// AccessToken $officerToken,
		Uuid $soleProprietorshipRequestId,
		SoleProprietorshipTypes $types
	): SoleProprietorship
	{
		$soleProprietorshipRequest = $this->soleProprietorshipRepository
			->getSoleProprietorshipRequest($soleProprietorshipRequestId);

		$soleProprietorship = $this->soleProprietorshipOfficerService->acceptRequest(
			$soleProprietorshipRequest,
			$types
		);

		$this->entityManager->persist($soleProprietorship);
		$this->entityManager->transactional(function () use ($soleProprietorship) {
			$this->entityManager->flush();

			$this->taxHellProducer->publish([
				'id' => $soleProprietorship->getId()->toString(),
			]);
		});

		return $soleProprietorship;
	}

}
