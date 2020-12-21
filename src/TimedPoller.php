<?php

namespace MrMadClown\Poller;

use function is_null;
use function sleep;
use function time;

final class TimedPoller implements PollingInterface
{
  public function __construct(private int $delay, private int $timeout)
  {
  }

  public function run(callable $task): mixed
  {
    $waitUntil = time() + $this->timeout;

    while (is_null($result = $task())) {
      sleep($this->delay);

      if (time() >= $waitUntil) {
        throw new PollTimeoutException(sprintf('Poller has exceeded the timout of %d seconds!', $this->timeout));
      }
    }

    return $result;
  }
}
