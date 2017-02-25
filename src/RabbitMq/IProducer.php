<?php

namespace Workshop\RabbitMq;

interface IProducer
{

	public function publish($data);

}
