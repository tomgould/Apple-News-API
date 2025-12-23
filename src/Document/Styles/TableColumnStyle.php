<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles;

use JsonSerializable;

/**
 * Style for table columns.
 *
 * @see https://developer.apple.com/documentation/apple_news/tablecolumnstyle
 */
final class TableColumnStyle implements JsonSerializable
{
    /**
     * The background color.
     */
    private ?string $backgroundColor = null;

    /**
     * The column divider.
     */
    private ?TableStrokeStyle $divider = null;

    /**
     * The column width.
     */
    private ?int $width = null;

    /**
     * The minimum column width.
     */
    private ?int $minimumWidth = null;

    /**
     * The maximum column width.
     */
    private ?int $maximumWidth = null;

    /**
     * Conditional styles.
     *
     * @var list<array<string, mixed>>|null
     */
    private ?array $conditional = null;

    /**
     * Set the background color.
     *
     * @param string $color The color in hex format.
     *
     * @return $this
     */
    public function setBackgroundColor(string $color): self
    {
        $this->backgroundColor = $color;
        return $this;
    }

    /**
     * Set the column divider.
     *
     * @param TableStrokeStyle $divider The divider stroke.
     *
     * @return $this
     */
    public function setDivider(TableStrokeStyle $divider): self
    {
        $this->divider = $divider;
        return $this;
    }

    /**
     * Set the column width.
     *
     * @param int $width The width in points.
     *
     * @return $this
     */
    public function setWidth(int $width): self
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Set the minimum column width.
     *
     * @param int $width The minimum width in points.
     *
     * @return $this
     */
    public function setMinimumWidth(int $width): self
    {
        $this->minimumWidth = $width;
        return $this;
    }

    /**
     * Set the maximum column width.
     *
     * @param int $width The maximum width in points.
     *
     * @return $this
     */
    public function setMaximumWidth(int $width): self
    {
        $this->maximumWidth = $width;
        return $this;
    }

    /**
     * Set conditional styles.
     *
     * @param list<array<string, mixed>> $conditional The conditional styles.
     *
     * @return $this
     */
    public function setConditional(array $conditional): self
    {
        $this->conditional = $conditional;
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->backgroundColor !== null) {
            $data['backgroundColor'] = $this->backgroundColor;
        }

        if ($this->divider !== null) {
            $data['divider'] = $this->divider->jsonSerialize();
        }

        if ($this->width !== null) {
            $data['width'] = $this->width;
        }

        if ($this->minimumWidth !== null) {
            $data['minimumWidth'] = $this->minimumWidth;
        }

        if ($this->maximumWidth !== null) {
            $data['maximumWidth'] = $this->maximumWidth;
        }

        if ($this->conditional !== null) {
            $data['conditional'] = $this->conditional;
        }

        return $data;
    }
}

