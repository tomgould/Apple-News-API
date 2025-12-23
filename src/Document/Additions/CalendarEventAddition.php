<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Additions;

use DateTimeInterface;

/**
 * Calendar event addition for creating calendar events.
 *
 * Allows users to add events to their calendar from text.
 *
 * @see https://developer.apple.com/documentation/apple_news/calendareventaddition
 */
final class CalendarEventAddition implements AdditionInterface
{
    /**
     * The event title.
     */
    private ?string $title = null;

    /**
     * The event location.
     */
    private ?string $location = null;

    /**
     * The event end date.
     */
    private ?string $endDate = null;

    /**
     * The start position of the range.
     */
    private ?int $rangeStart = null;

    /**
     * The length of the range.
     */
    private ?int $rangeLength = null;

    /**
     * Create a new CalendarEventAddition.
     *
     * @param string $startDate The event start date (ISO 8601).
     */
    public function __construct(
        private readonly string $startDate
    ) {
    }

    /**
     * Create a calendar event addition.
     *
     * @param DateTimeInterface|string $startDate The start date.
     *
     * @return self A new instance.
     */
    public static function startingAt(DateTimeInterface|string $startDate): self
    {
        $date = $startDate instanceof DateTimeInterface
            ? $startDate->format('c')
            : $startDate;

        return new self($date);
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return 'calendar_event';
    }

    /**
     * Set the event title.
     *
     * @param string $title The title.
     *
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Set the event location.
     *
     * @param string $location The location.
     *
     * @return $this
     */
    public function setLocation(string $location): self
    {
        $this->location = $location;
        return $this;
    }

    /**
     * Set the event end date.
     *
     * @param DateTimeInterface|string $endDate The end date.
     *
     * @return $this
     */
    public function setEndDate(DateTimeInterface|string $endDate): self
    {
        $this->endDate = $endDate instanceof DateTimeInterface
            ? $endDate->format('c')
            : $endDate;
        return $this;
    }

    /**
     * Set the text range.
     *
     * @param int $start  The starting position.
     * @param int $length The length.
     *
     * @return $this
     */
    public function setRange(int $start, int $length): self
    {
        $this->rangeStart = $start;
        $this->rangeLength = $length;
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [
            'type' => $this->getType(),
            'startDate' => $this->startDate,
        ];

        if ($this->title !== null) {
            $data['title'] = $this->title;
        }

        if ($this->location !== null) {
            $data['location'] = $this->location;
        }

        if ($this->endDate !== null) {
            $data['endDate'] = $this->endDate;
        }

        if ($this->rangeStart !== null) {
            $data['rangeStart'] = $this->rangeStart;
        }

        if ($this->rangeLength !== null) {
            $data['rangeLength'] = $this->rangeLength;
        }

        return $data;
    }
}
