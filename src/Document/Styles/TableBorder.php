<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles;

use JsonSerializable;

/**
 * Border configuration for tables.
 *
 * @see https://developer.apple.com/documentation/apple_news/tableborder
 */
final class TableBorder implements JsonSerializable
{
    /**
     * The border for all sides.
     */
    private ?TableStrokeStyle $all = null;

    /**
     * The top border.
     */
    private ?TableStrokeStyle $top = null;

    /**
     * The bottom border.
     */
    private ?TableStrokeStyle $bottom = null;

    /**
     * The left border.
     */
    private ?TableStrokeStyle $left = null;

    /**
     * The right border.
     */
    private ?TableStrokeStyle $right = null;

    /**
     * Set all borders.
     *
     * @param TableStrokeStyle $stroke The stroke style.
     *
     * @return $this
     */
    public function setAll(TableStrokeStyle $stroke): self
    {
        $this->all = $stroke;
        return $this;
    }

    /**
     * Set the top border.
     *
     * @param TableStrokeStyle $stroke The stroke style.
     *
     * @return $this
     */
    public function setTop(TableStrokeStyle $stroke): self
    {
        $this->top = $stroke;
        return $this;
    }

    /**
     * Set the bottom border.
     *
     * @param TableStrokeStyle $stroke The stroke style.
     *
     * @return $this
     */
    public function setBottom(TableStrokeStyle $stroke): self
    {
        $this->bottom = $stroke;
        return $this;
    }

    /**
     * Set the left border.
     *
     * @param TableStrokeStyle $stroke The stroke style.
     *
     * @return $this
     */
    public function setLeft(TableStrokeStyle $stroke): self
    {
        $this->left = $stroke;
        return $this;
    }

    /**
     * Set the right border.
     *
     * @param TableStrokeStyle $stroke The stroke style.
     *
     * @return $this
     */
    public function setRight(TableStrokeStyle $stroke): self
    {
        $this->right = $stroke;
        return $this;
    }

    /**
     * Create a uniform border.
     *
     * @param string $color The border color.
     * @param int    $width The border width.
     *
     * @return self A new instance.
     */
    public static function uniform(string $color, int $width = 1): self
    {
        return (new self())->setAll(TableStrokeStyle::solid($color, $width));
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->all !== null) {
            $data['all'] = $this->all->jsonSerialize();
        }

        if ($this->top !== null) {
            $data['top'] = $this->top->jsonSerialize();
        }

        if ($this->bottom !== null) {
            $data['bottom'] = $this->bottom->jsonSerialize();
        }

        if ($this->left !== null) {
            $data['left'] = $this->left->jsonSerialize();
        }

        if ($this->right !== null) {
            $data['right'] = $this->right->jsonSerialize();
        }

        return $data;
    }
}

