<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Additions;

use DateTime;
use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Additions\AdditionInterface;
use TomGould\AppleNews\Document\Additions\CalendarEventAddition;
use TomGould\AppleNews\Document\Additions\ComponentLink;
use TomGould\AppleNews\Document\Additions\LinkAddition;

final class AdditionTest extends TestCase
{
    public function testLinkAdditionBasic(): void
    {
        $link = LinkAddition::to('https://example.com');

        $data = $link->jsonSerialize();

        $this->assertSame('link', $data['type']);
        $this->assertSame('https://example.com', $data['URL']);
    }

    public function testLinkAdditionWithRange(): void
    {
        $link = LinkAddition::forRange('https://example.com', 0, 10);

        $data = $link->jsonSerialize();

        $this->assertSame(0, $data['rangeStart']);
        $this->assertSame(10, $data['rangeLength']);
    }

    public function testLinkAdditionFluentRange(): void
    {
        $link = LinkAddition::to('https://example.com')
            ->setRange(5, 15);

        $data = $link->jsonSerialize();

        $this->assertSame(5, $data['rangeStart']);
        $this->assertSame(15, $data['rangeLength']);
    }

    public function testComponentLink(): void
    {
        $link = ComponentLink::to('https://example.com/article');

        $data = $link->jsonSerialize();

        $this->assertSame('link', $data['type']);
        $this->assertSame('https://example.com/article', $data['URL']);
        $this->assertArrayNotHasKey('rangeStart', $data);
    }

    public function testCalendarEventAdditionBasic(): void
    {
        $event = CalendarEventAddition::startingAt('2025-01-15T10:00:00-05:00');

        $data = $event->jsonSerialize();

        $this->assertSame('calendar_event', $data['type']);
        $this->assertSame('2025-01-15T10:00:00-05:00', $data['startDate']);
    }

    public function testCalendarEventAdditionWithDateTime(): void
    {
        $startDate = new DateTime('2025-01-15 10:00:00');
        $event = CalendarEventAddition::startingAt($startDate);

        $data = $event->jsonSerialize();

        $this->assertSame('calendar_event', $data['type']);
        $this->assertStringContainsString('2025-01-15', $data['startDate']);
    }

    public function testCalendarEventAdditionWithAllOptions(): void
    {
        $event = CalendarEventAddition::startingAt('2025-01-15T10:00:00-05:00')
            ->setTitle('Team Meeting')
            ->setLocation('Conference Room A')
            ->setEndDate('2025-01-15T11:00:00-05:00')
            ->setRange(20, 12);

        $data = $event->jsonSerialize();

        $this->assertSame('Team Meeting', $data['title']);
        $this->assertSame('Conference Room A', $data['location']);
        $this->assertSame('2025-01-15T11:00:00-05:00', $data['endDate']);
        $this->assertSame(20, $data['rangeStart']);
        $this->assertSame(12, $data['rangeLength']);
    }

    public function testAllAdditionsImplementInterface(): void
    {
        $additions = [
            LinkAddition::to('https://example.com'),
            ComponentLink::to('https://example.com'),
            CalendarEventAddition::startingAt('2025-01-15T10:00:00-05:00'),
        ];

        foreach ($additions as $addition) {
            $this->assertInstanceOf(AdditionInterface::class, $addition);
        }
    }
}

