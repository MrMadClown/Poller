<?php

namespace MrMadClown\Poller;

use function is_null;
use function sleep;

final class FixedTriesPoller implements PollingInterface
{
  public function __construct(private int $delay, private int $tries)
  {
  }

  public function run(callable $task): mixed
  {
    $tries = 1;
    while (is_null($result = $task())) {
      sleep($this->delay);
      if ($this->tries <= $tries) {
        throw new PollTriesExceededException(sprintf('Poller has exceeded the amount of %s tries!', $this->tries));
      }
      $tries++;
    }

    return $result;
  }
}
