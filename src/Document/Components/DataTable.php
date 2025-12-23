<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * DataTable component for structured tabular data.
 *
 * The datatable component displays data in a sortable, interactive table format.
 * It supports rich data types and automatic formatting.
 *
 * @see https://developer.apple.com/documentation/apple_news/datatable
 */
final class DataTable extends Component
{
    /**
     * The table data descriptor.
     *
     * @var array<string, mixed>|null
     */
    private ?array $data = null;

    /**
     * Whether to show the header row.
     */
    private ?bool $showDescriptorLabels = null;

    /**
     * The sort order for data.
     *
     * @var list<array{descriptor: string, direction: string}>|null
     */
    private ?array $sortBy = null;

    /**
     * The table style reference.
     */
    private ?string $dataTableStyle = null;

    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'datatable';
    }

    /**
     * Set the table data.
     *
     * The data array should follow the Apple News data descriptor format
     * with 'descriptors' and 'records' keys.
     *
     * @param array<string, mixed> $data The table data.
     *
     * @return $this
     */
    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Set whether to show descriptor labels (header row).
     *
     * @param bool $show Whether to show labels.
     *
     * @return $this
     */
    public function setShowDescriptorLabels(bool $show): self
    {
        $this->showDescriptorLabels = $show;
        return $this;
    }

    /**
     * Set the sort order for the data.
     *
     * @param list<array{descriptor: string, direction: string}> $sortBy Sort configuration.
     *
     * @return $this
     */
    public function setSortBy(array $sortBy): self
    {
        $this->sortBy = $sortBy;
        return $this;
    }

    /**
     * Add a sort descriptor.
     *
     * @param string $descriptor The descriptor identifier to sort by.
     * @param string $direction  The sort direction ('ascending' or 'descending').
     *
     * @return $this
     */
    public function addSortBy(string $descriptor, string $direction = 'ascending'): self
    {
        if ($this->sortBy === null) {
            $this->sortBy = [];
        }

        $this->sortBy[] = [
            'descriptor' => $descriptor,
            'direction' => $direction,
        ];

        return $this;
    }

    /**
     * Set the table style reference.
     *
     * @param string $style The style name.
     *
     * @return $this
     */
    public function setDataTableStyle(string $style): self
    {
        $this->dataTableStyle = $style;
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = array_merge(
            ['role' => $this->getRole()],
            $this->getBaseProperties()
        );

        if ($this->data !== null) {
            $data['data'] = $this->data;
        }

        if ($this->showDescriptorLabels !== null) {
            $data['showDescriptorLabels'] = $this->showDescriptorLabels;
        }

        if ($this->sortBy !== null) {
            $data['sortBy'] = $this->sortBy;
        }

        if ($this->dataTableStyle !== null) {
            $data['dataTableStyle'] = $this->dataTableStyle;
        }

        return $data;
    }
}

