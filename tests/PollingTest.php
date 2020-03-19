<?php
/**
 * Luca Perna - Webdeveloper
 * Team Dementia
 * luc@rissc.com
 *
 * Date: 19.03.20
 */

namespace MrMadClown\Poller\Tests;

use LogicException;
use MrMadClown\Poller\FixedTriesPoller;
use MrMadClown\Poller\PollingException;
use MrMadClown\Poller\PollingInterface;
use MrMadClown\Poller\TimedPoller;
use PHPUnit\Framework\TestCase;

class PollingTest extends TestCase
{
  public function pollerProvider()
  {
    yield [new FixedTriesPoller(1, 10)];
    yield [new TimedPoller(1, 10)];
  }

  /** @dataProvider pollerProvider */
  public function testRun(PollingInterface $poller)
  {
    $poller = new FixedTriesPoller(1, 10);

    $result = $poller->run(function () {
      return true;
    });

    static::assertTrue($result);
  }

  /** @dataProvider pollerProvider */
  public function testPollingException(PollingInterface $poller)
  {
    static::expectException(PollingException::class);

    $poller->run(function () {
      return null;
    });
  }

  /** @dataProvider pollerProvider */
  public function testPollingDoenstEatExceptions(PollingInterface $poller)
  {
    static::expectException(LogicException::class);

    $poller->run(function () {
      throw new LogicException();
    });
  }
}
