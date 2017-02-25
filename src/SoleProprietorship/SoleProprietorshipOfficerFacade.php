<?php

namespace Workshop\SoleProprietorship;

use Doctrine\ORM\EntityManager;
use Kdyby\StrictObjects\Scream;
use Workshop\SocialSecurity\SocialSecurityFacade;

class SoleProprietorshipOfficerFacade
{

	use Scream;

	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	private $entityManager;

	public function __construct(
		EntityManager $entityManager
	)
	{
		$this->entityManager = $entityManager;
	}

}
