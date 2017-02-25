<?php

namespace Workshop\SoleProprietorship;

use Consistence\Enum\MultiEnum;
use Consistence\Type\ArrayType\ArrayType;

class SoleProprietorshipTypes extends MultiEnum
{

	/** @var integer[] format: single Enum value (string) => MultiEnum value (integer) */
	private static $singleMultiMap = [
		SoleProprietorshipType::ACCOUNTING => 1,
		SoleProprietorshipType::MASSAGE => 2,
		SoleProprietorshipType::DRIVING_EDUCATION => 4,
		SoleProprietorshipType::BUTCHER => 8,
		SoleProprietorshipType::PROGRAMMER => 16,
		SoleProprietorshipType::WHOLESALE => 32,
		SoleProprietorshipType::RETAIL => 64,
	];

	public static function getSingleEnumClass(): string
	{
		return SoleProprietorshipType::class;
	}

	protected static function convertSingleEnumValueToValue($singleEnumValue): int
	{
		return ArrayType::getValue(self::$singleMultiMap, $singleEnumValue);
	}

	protected static function convertValueToSingleEnumValue($value): string
	{
		return ArrayType::getKey(self::$singleMultiMap, $value);
	}

}
