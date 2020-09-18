<?php

namespace MrMadClown\Poller\Tests;

use LogicException;
use MrMadClown\Poller\FixedTriesPoller;
use MrMadClown\Poller\InfinitePoller;
use MrMadClown\Poller\PollingException;
use MrMadClown\Poller\PollingInterface;
use MrMadClown\Poller\TimedPoller;
use PHPUnit\Framework\TestCase;

class PollingTest extends TestCase
{
  public function pollerProvider(): \Generator
  {
    yield [new FixedTriesPoller(1, 10)];
    yield [new TimedPoller(1, 10)];
  }

  public function completePollerProvider(): \Generator
  {
    $pollerProvider = [...$this->pollerProvider()];
    foreach ($pollerProvider as $poller) {
      yield $poller;
    }
    yield [new InfinitePoller(1)];
  }

  /** @dataProvider pollerProvider */
  public function testPollingException(PollingInterface $poller): void
  {
    $this->expectException(PollingException::class);

    $poller->run(static fn(): ?bool => null);
  }

  /** @dataProvider completePollerProvider */
  public function testRun(PollingInterface $poller): void
  {
    $arr = [null, 5750.73];

    $result = $poller->run(static function () use (&$arr) {
      return \array_shift($arr);
    });

    static::assertEquals(5750.73, $result);
  }

  /** @dataProvider completePollerProvider */
  public function testPollingDoesntEatExceptions(PollingInterface $poller): void
  {
    $this->expectException(LogicException::class);

    $poller->run(static function (): void {
      throw new LogicException();
    });
  }
}
