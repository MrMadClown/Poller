<?php

namespace MrMadClown\Poller;

use function is_null;
use function sleep;
use function time;

final class TimedPoller implements PollingInterface
{
  private int $delay;

  private int $timeout;

  public function __construct(int $delay, int $timeout)
  {
    $this->delay = $delay;
    $this->timeout = $timeout;
  }

  public function run(callable $task)
  {
    $waitUntil = time() + $this->timeout;

    while (is_null($result = $task())) {
      sleep($this->delay);

      if (time() >= $waitUntil) throw new PollTimeoutException(sprintf('Poller has exceeded the timout of %d seconds!', $this->timeout));
    }

    return $result;
  }
}
