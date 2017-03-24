<?php
declare(strict_types=1);

namespace Bws\QueueSystem;

use Aws\Result;


interface QueueInterface
{
	public function sendMessage(string $payload);

	public function retrieveMessage(string $queueUrl) : Result;
}