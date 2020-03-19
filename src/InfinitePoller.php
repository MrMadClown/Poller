<?php
/**
 * Luca Perna - Webdeveloper
 * Team Dementia
 * luc@rissc.com
 *
 * Date: 19.03.20
 */

namespace MrMadClown\Poller;

use function sleep;

final class InfinitePoller implements PollingInterface
{
  /** @var int */
  private $delay;

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
