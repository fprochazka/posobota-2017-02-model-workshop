<?php

namespace App\Presenters;

use Doctrine\ORM\EntityManager;
use Nette;
use Workshop\SoleProprietorship\SoleProprietorship;
use Workshop\SoleProprietorship\SoleProprietorshipType;
use Workshop\SoleProprietorship\SoleProprietorshipTypes;

final class HomepagePresenter extends Nette\Application\UI\Presenter
{

	/** @var \Doctrine\ORM\EntityManager */
	private $entityManager;

	public function __construct(EntityManager $entityManager)
	{
		parent::__construct();
		$this->entityManager = $entityManager;
	}

	public function actionDefault()
	{
		$type = SoleProprietorshipTypes::getMultiByEnum(SoleProprietorshipType::get(SoleProprietorshipType::WHOLESALE));
		$e = new SoleProprietorship($type);
		$this->entityManager->persist($e);
		$this->entityManager->flush();
		$this->entityManager->clear();

		$f = $this->entityManager->find(SoleProprietorship::class, $e->getId());
		dump($f);
	}

}
