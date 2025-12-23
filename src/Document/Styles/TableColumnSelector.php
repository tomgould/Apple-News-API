<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles;

use JsonSerializable;

/**
 * Selector for targeting specific table columns.
 *
 * @see https://developer.apple.com/documentation/apple_news/tablecolumnselector
 */
final class TableColumnSelector implements JsonSerializable
{
    /**
     * The column index.
     */
    private ?int $columnIndex = null;

    /**
     * The descriptor identifier.
     */
    private ?string $descriptor = null;

    /**
     * Whether to select odd columns.
     */
    private ?bool $odd = null;

    /**
     * Whether to select even columns.
     */
    private ?bool $even = null;

    /**
     * Set the column index.
     *
     * @param int $index The column index.
     *
     * @return $this
     */
    public function setColumnIndex(int $index): self
    {
        $this->columnIndex = $index;
        return $this;
    }

    /**
     * Set the descriptor identifier.
     *
     * @param string $descriptor The descriptor ID.
     *
     * @return $this
     */
    public function setDescriptor(string $descriptor): self
    {
        $this->descriptor = $descriptor;
        return $this;
    }

    /**
     * Set to select odd columns.
     *
     * @return $this
     */
    public function setOdd(): self
    {
        $this->odd = true;
        $this->even = null;
        return $this;
    }

    /**
     * Set to select even columns.
     *
     * @return $this
     */
    public function setEven(): self
    {
        $this->even = true;
        $this->odd = null;
        return $this;
    }

    /**
     * Create a selector for odd columns.
     *
     * @return self A new instance.
     */
    public static function oddColumns(): self
    {
        return (new self())->setOdd();
    }

    /**
     * Create a selector for even columns.
     *
     * @return self A new instance.
     */
    public static function evenColumns(): self
    {
        return (new self())->setEven();
    }

    /**
     * Create a selector for a specific column.
     *
     * @param int $index The column index.
     *
     * @return self A new instance.
     */
    public static function column(int $index): self
    {
        return (new self())->setColumnIndex($index);
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->columnIndex !== null) {
            $data['columnIndex'] = $this->columnIndex;
        }

        if ($this->descriptor !== null) {
            $data['descriptor'] = $this->descriptor;
        }

        if ($this->odd !== null) {
            $data['odd'] = $this->odd;
        }

        if ($this->even !== null) {
            $data['even'] = $this->even;
        }

        return $data;
    }
}

