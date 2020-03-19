<?php
/**
 * Luca Perna - Webdeveloper
 * Team Dementia
 * luc@rissc.com
 *
 * Date: 19.03.20
 */

namespace MrMadClown\Poller\Tests;

use MrMadClown\Poller\FixedTriesPoller;
use MrMadClown\Poller\PollTriesExceededException;
use PHPUnit\Framework\TestCase;

class FixedTriesPollerTest extends TestCase
{
  public function testRun()
  {
    $poller = new FixedTriesPoller(1, 10);

    $result = $poller->run(function () {
      return true;
    });

    static::assertTrue($result);
  }

  public function testException()
  {
    $poller = new FixedTriesPoller(1, 10);

    static::expectException(PollTriesExceededException::class);

    $poller->run(function () {
      return null;
    });
  }
}
