<?php

namespace MrMadClown\Poller\Tests;

use MrMadClown\Poller\PollTimeoutException;
use MrMadClown\Poller\TimedPoller;
use PHPUnit\Framework\TestCase;

class TimedPollerTest extends TestCase
{
  public function testRun()
  {
    $poller = new TimedPoller(1, 10);

    $result = $poller->run(function () {
      return true;
    });

    static::assertTrue($result);
  }

  public function testException()
  {
    $poller = new TimedPoller(1, 10);

    static::expectException(PollTimeoutException::class);

    $poller->run(function () {
      return null;
    });
  }
}
