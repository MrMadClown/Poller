<?php

namespace MrMadClown\Poller;

interface PollingInterface
{
  public function run(callable $task): mixed;
}
