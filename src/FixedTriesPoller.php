<?php

namespace MrMadClown\Poller;

final class FixedTriesPoller implements PollingInterface
{
  private int $delay;
  private int $tries;

  public function __construct(int $delay, int $tries)
  {
    $this->delay = $delay;
    $this->tries = $tries;
  }

  public function run(callable $task)
  {
    $tries = 1;
    while (is_null($result = $task())) {
      sleep($this->delay);
      if ($this->tries <= $tries) throw new PollTriesExceededException(sprintf('Poller has exceeded the amount of %s tries!', $this->tries));
      $tries++;
    }

    return $result;
  }
}
