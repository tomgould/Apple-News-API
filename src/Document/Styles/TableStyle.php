<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles;

use JsonSerializable;

/**
 * Overall table style configuration.
 *
 * @see https://developer.apple.com/documentation/apple_news/tablestyle
 */
final class TableStyle implements JsonSerializable
{
    /**
     * The default cell style.
     */
    private ?TableCellStyle $cells = null;

    /**
     * The default column style.
     */
    private ?TableColumnStyle $columns = null;

    /**
     * The header cell style.
     */
    private ?TableCellStyle $headerCells = null;

    /**
     * The header column style.
     */
    private ?TableColumnStyle $headerColumns = null;

    /**
     * The header row style.
     */
    private ?TableRowStyle $headerRows = null;

    /**
     * The default row style.
     */
    private ?TableRowStyle $rows = null;

    /**
     * Conditional styles.
     *
     * @var list<array<string, mixed>>|null
     */
    private ?array $conditional = null;

    /**
     * Set the default cell style.
     *
     * @param TableCellStyle $style The cell style.
     *
     * @return $this
     */
    public function setCells(TableCellStyle $style): self
    {
        $this->cells = $style;
        return $this;
    }

    /**
     * Set the default column style.
     *
     * @param TableColumnStyle $style The column style.
     *
     * @return $this
     */
    public function setColumns(TableColumnStyle $style): self
    {
        $this->columns = $style;
        return $this;
    }

    /**
     * Set the header cell style.
     *
     * @param TableCellStyle $style The cell style.
     *
     * @return $this
     */
    public function setHeaderCells(TableCellStyle $style): self
    {
        $this->headerCells = $style;
        return $this;
    }

    /**
     * Set the header column style.
     *
     * @param TableColumnStyle $style The column style.
     *
     * @return $this
     */
    public function setHeaderColumns(TableColumnStyle $style): self
    {
        $this->headerColumns = $style;
        return $this;
    }

    /**
     * Set the header row style.
     *
     * @param TableRowStyle $style The row style.
     *
     * @return $this
     */
    public function setHeaderRows(TableRowStyle $style): self
    {
        $this->headerRows = $style;
        return $this;
    }

    /**
     * Set the default row style.
     *
     * @param TableRowStyle $style The row style.
     *
     * @return $this
     */
    public function setRows(TableRowStyle $style): self
    {
        $this->rows = $style;
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

        if ($this->cells !== null) {
            $data['cells'] = $this->cells->jsonSerialize();
        }

        if ($this->columns !== null) {
            $data['columns'] = $this->columns->jsonSerialize();
        }

        if ($this->headerCells !== null) {
            $data['headerCells'] = $this->headerCells->jsonSerialize();
        }

        if ($this->headerColumns !== null) {
            $data['headerColumns'] = $this->headerColumns->jsonSerialize();
        }

        if ($this->headerRows !== null) {
            $data['headerRows'] = $this->headerRows->jsonSerialize();
        }

        if ($this->rows !== null) {
            $data['rows'] = $this->rows->jsonSerialize();
        }

        if ($this->conditional !== null) {
            $data['conditional'] = $this->conditional;
        }

        return $data;
    }
}
