<?php
declare(strict_types=1);


namespace Bws\QueueSystem;


use Aws\Result;
use Aws\Sqs\SqsClient;


/**
 * Class QueueSystem
 * @package Bws\QueueSystem
 */
class QueueSystem implements QueueInterface
{
	/**
	 * @var SqsClient
	 */
	protected $client;

	/**
	 * @var array
	 */
	protected $queues = null;

	public function __construct(SqsClient $client)
	{
		assert(func_num_args() === 1);

		$this->client = $client;
		$this->initiateQueueList();
	}

	public function getQueues() : array
	{
		return $this->queues;
	}

	public function sendMessage(string $payload)
	{
		assert(func_num_args() === 1);

		$message = [];
		$message['QueueUrl'] = $this->getQueueUrl();
		$message['MessageBody'] = $payload;

		$this->client->sendMessage($message);
	}

	public function retrieveMessage(string $queueUrl) : Result
	{
		assert(func_num_args() === 1);

		return $this->client->receiveMessage(['QueueUrl' => $queueUrl]);
	}

	protected function initiateQueueList()
	{
		assert(func_num_args() === 0);

		if ($this->queues === null) {
			$this->queues = $this->client->listQueues()->get('QueueUrls');
		}
	}

	protected function getQueueUrl() : string
	{
		assert(func_num_args() === 0);

		$int = rand(0, count($this->queues) - 1);

		return $this->queues[$int];

	}
}