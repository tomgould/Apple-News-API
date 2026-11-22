<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles;

use JsonSerializable;

/**
 * Selector for targeting specific table rows.
 *
 * @see https://developer.apple.com/documentation/apple_news/tablerowselector
 */
final class TableRowSelector implements JsonSerializable
{
    /**
     * The row index.
     */
    private ?int $rowIndex = null;

    /**
     * The descriptor identifier.
     */
    private ?string $descriptor = null;

    /**
     * Whether to select odd rows.
     */
    private ?bool $odd = null;

    /**
     * Whether to select even rows.
     */
    private ?bool $even = null;

    /**
     * Set the row index.
     *
     * @param int $index The row index.
     *
     * @return $this
     */
    public function setRowIndex(int $index): self
    {
        $this->rowIndex = $index;
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
     * Set to select odd rows.
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
     * Set to select even rows.
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
     * Create a selector for odd rows.
     *
     * @return self A new instance.
     */
    public static function oddRows(): self
    {
        return (new self())->setOdd();
    }

    /**
     * Create a selector for even rows.
     *
     * @return self A new instance.
     */
    public static function evenRows(): self
    {
        return (new self())->setEven();
    }

    /**
     * Create a selector for a specific row.
     *
     * @param int $index The row index.
     *
     * @return self A new instance.
     */
    public static function row(int $index): self
    {
        return (new self())->setRowIndex($index);
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->rowIndex !== null) {
            $data['rowIndex'] = $this->rowIndex;
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

