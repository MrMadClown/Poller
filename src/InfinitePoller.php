<?php

namespace MrMadClown\Poller;

use function sleep;

final class InfinitePoller implements PollingInterface
{
  private int $delay;

  public function __construct(int $delay)
  {
    $this->delay = $delay;
  }

  public function run(callable $task)
  {
    while (is_null($result = $task())) sleep($this->delay);

    return $result;
  }
}
