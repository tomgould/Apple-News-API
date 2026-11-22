<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles;

use JsonSerializable;

/**
 * Style for table cells.
 *
 * @see https://developer.apple.com/documentation/apple_news/tablecellstyle
 */
final class TableCellStyle implements JsonSerializable
{
    /**
     * The background color.
     */
    private ?string $backgroundColor = null;

    /**
     * The border configuration.
     */
    private ?TableBorder $border = null;

    /**
     * The minimum column width.
     */
    private ?int $minimumWidth = null;

    /**
     * The cell padding.
     *
     * @var int|array<string, int>|null
     */
    private int|array|null $padding = null;

    /**
     * The text style reference.
     */
    private ?string $textStyle = null;

    /**
     * The horizontal alignment.
     */
    private ?string $horizontalAlignment = null;

    /**
     * The vertical alignment.
     */
    private ?string $verticalAlignment = null;

    /**
     * The cell width.
     */
    private ?int $width = null;

    /**
     * The cell height.
     */
    private ?int $height = null;

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
     * Set the border.
     *
     * @param TableBorder $border The border configuration.
     *
     * @return $this
     */
    public function setBorder(TableBorder $border): self
    {
        $this->border = $border;
        return $this;
    }

    /**
     * Set the minimum width.
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
     * Set the padding.
     *
     * @param int|array<string, int> $padding The padding.
     *
     * @return $this
     */
    public function setPadding(int|array $padding): self
    {
        $this->padding = $padding;
        return $this;
    }

    /**
     * Set the text style reference.
     *
     * @param string $textStyle The text style name.
     *
     * @return $this
     */
    public function setTextStyle(string $textStyle): self
    {
        $this->textStyle = $textStyle;
        return $this;
    }

    /**
     * Set the horizontal alignment.
     *
     * @param string $alignment One of 'left', 'center', 'right'.
     *
     * @return $this
     */
    public function setHorizontalAlignment(string $alignment): self
    {
        $this->horizontalAlignment = $alignment;
        return $this;
    }

    /**
     * Set the vertical alignment.
     *
     * @param string $alignment One of 'top', 'center', 'bottom'.
     *
     * @return $this
     */
    public function setVerticalAlignment(string $alignment): self
    {
        $this->verticalAlignment = $alignment;
        return $this;
    }

    /**
     * Set the width.
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
     * Set the height.
     *
     * @param int $height The height in points.
     *
     * @return $this
     */
    public function setHeight(int $height): self
    {
        $this->height = $height;
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

        if ($this->border !== null) {
            $data['border'] = $this->border->jsonSerialize();
        }

        if ($this->minimumWidth !== null) {
            $data['minimumWidth'] = $this->minimumWidth;
        }

        if ($this->padding !== null) {
            $data['padding'] = $this->padding;
        }

        if ($this->textStyle !== null) {
            $data['textStyle'] = $this->textStyle;
        }

        if ($this->horizontalAlignment !== null) {
            $data['horizontalAlignment'] = $this->horizontalAlignment;
        }

        if ($this->verticalAlignment !== null) {
            $data['verticalAlignment'] = $this->verticalAlignment;
        }

        if ($this->width !== null) {
            $data['width'] = $this->width;
        }

        if ($this->height !== null) {
            $data['height'] = $this->height;
        }

        if ($this->conditional !== null) {
            $data['conditional'] = $this->conditional;
        }

        return $data;
    }
}

