<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Enum;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Enum\LiveCoverageState;

final class LiveCoverageStateTest extends TestCase
{
    public function testAllStatesHaveCorrectValues(): void
    {
        $this->assertSame('NONE', LiveCoverageState::NONE->value);
        $this->assertSame('LIVE', LiveCoverageState::LIVE->value);
        $this->assertSame('COMPLETED', LiveCoverageState::COMPLETED->value);
    }

    public function testHasExactlyThreeStates(): void
    {
        $this->assertCount(3, LiveCoverageState::cases());
    }

    public function testTryFromWithValidState(): void
    {
        $state = LiveCoverageState::tryFrom('LIVE');
        $this->assertSame(LiveCoverageState::LIVE, $state);
    }

    public function testTryFromWithInvalidState(): void
    {
        $state = LiveCoverageState::tryFrom('INVALID');
        $this->assertNull($state);
    }

    public function testFromWithValidState(): void
    {
        $state = LiveCoverageState::from('COMPLETED');
        $this->assertSame(LiveCoverageState::COMPLETED, $state);
    }
}
