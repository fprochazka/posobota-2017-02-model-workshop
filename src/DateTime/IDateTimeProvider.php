<?php

namespace Workshop\DateTime;

interface IDateTimeProvider
{

	public function getNow(): \DateTimeImmutable;

}
