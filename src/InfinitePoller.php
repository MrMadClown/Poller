<?php

namespace MrMadClown\Poller;

use function sleep;

final class InfinitePoller implements PollingInterface
{
  public function __construct(private int $delay)
  {
  }

  public function run(callable $task): mixed
  {
    while (is_null($result = $task())) {
      sleep($this->delay);
    }

    return $result;
  }
}
