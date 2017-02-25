<?php

namespace Workshop\SoleProprietorship;

use Consistence\Enum\Enum;

class SoleProprietorshipType extends Enum
{

	const ACCOUNTING = 'accounting';
	const MASSAGE = 'massage';
	const DRIVING_EDUCATION = 'driving_education';
	const BUTCHER = 'butcher';
	const PROGRAMMER = 'programmer';
	const WHOLESALE = 'wholesale';
	const RETAIL = 'retail';

	private static $crafts = [
		self::BUTCHER,
	];

	private static $bounded = [
		self::ACCOUNTING,
		self::MASSAGE,
		self::DRIVING_EDUCATION,
	];

	private static $open = [
		self::PROGRAMMER,
		self::WHOLESALE,
		self::RETAIL,
	];

	public function isCrafts(): bool
	{
		return in_array($this->getValue(), self::$crafts, true);
	}

	public function isBounded(): bool
	{
		return in_array($this->getValue(), self::$bounded, true);
	}

	public function isOpen(): bool
	{
		return in_array($this->getValue(), self::$open, true);
	}

}
