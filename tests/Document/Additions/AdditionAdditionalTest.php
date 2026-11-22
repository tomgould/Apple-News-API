<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Additions;

use DateTime;
use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Additions\CalendarEventAddition;

/**
 * Additional tests to achieve full coverage on addition classes.
 */
final class AdditionAdditionalTest extends TestCase
{
    public function testCalendarEventAdditionSetEndDateWithDateTime(): void
    {
        $startDate = new DateTime('2025-01-15 10:00:00');
        $endDate = new DateTime('2025-01-15 11:30:00');

        $event = CalendarEventAddition::startingAt($startDate)
            ->setTitle('Team Meeting')
            ->setEndDate($endDate);

        $data = $event->jsonSerialize();

        $this->assertArrayHasKey('endDate', $data);
        $this->assertStringContainsString('2025-01-15', $data['endDate']);
        $this->assertStringContainsString('11', $data['endDate']);
    }

    public function testCalendarEventAdditionSetEndDateWithString(): void
    {
        $event = CalendarEventAddition::startingAt('2025-01-15T10:00:00-05:00')
            ->setEndDate('2025-01-15T12:00:00-05:00');

        $data = $event->jsonSerialize();

        $this->assertSame('2025-01-15T12:00:00-05:00', $data['endDate']);
    }
}
