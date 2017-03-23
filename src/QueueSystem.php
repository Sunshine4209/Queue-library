<?php
declare(strict_types=1);


namespace Bws\QueueSystem;


use Aws\Sqs\SqsClient;


/**
 * Class QueueSystem
 * @package Bws\QueueSystem
 */
class QueueSystem implements QueueInterface
{
	protected $client;

	public function __construct(SqsClient $client)
	{
		$this->client = $client;
	}

	public function getQueueList() : array
	{
		return $this->client->listQueues();
	}

	public function sendMessage(array $message)
	{

	}

	public function retrieveMessage()
	{

	}
}