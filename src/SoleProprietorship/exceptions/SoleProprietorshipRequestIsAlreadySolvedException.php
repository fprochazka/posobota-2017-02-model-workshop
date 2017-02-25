<?php

namespace Workshop\SoleProprietorship;

use Kdyby\StrictObjects\Scream;

class SoleProprietorshipRequestIsAlreadySolvedException extends \RuntimeException
{

	use Scream;

	/**
	 * @var SoleProprietorshipRequest
	 */
	private $request;

	public function __construct(SoleProprietorshipRequest $request)
	{
		parent::__construct("Request was already solved");
		$this->request = $request;
	}

	public function getRequest(): SoleProprietorshipRequest
	{
		return $this->request;
	}

}
