<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Components;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Components\DataTable;

/**
 * Additional tests to achieve full coverage on DataTable component.
 */
final class DataTableAdditionalTest extends TestCase
{
    public function testDataTableSetSortBy(): void
    {
        $descriptors = [
            ['identifier' => 'name', 'dataType' => 'string', 'label' => 'Name'],
            ['identifier' => 'price', 'dataType' => 'float', 'label' => 'Price'],
        ];

        $records = [
            ['name' => 'Product A', 'price' => 29.99],
            ['name' => 'Product B', 'price' => 19.99],
        ];

        $table = (new DataTable($descriptors, $records))
            ->setSortBy([
                ['descriptor' => 'price', 'direction' => 'ascending'],
            ]);

        $data = $table->jsonSerialize();

        $this->assertArrayHasKey('sortBy', $data);
        $this->assertCount(1, $data['sortBy']);
        $this->assertSame('price', $data['sortBy'][0]['descriptor']);
        $this->assertSame('ascending', $data['sortBy'][0]['direction']);
    }

    public function testDataTableSetSortByMultiple(): void
    {
        $descriptors = [
            ['identifier' => 'category', 'dataType' => 'string', 'label' => 'Category'],
            ['identifier' => 'name', 'dataType' => 'string', 'label' => 'Name'],
            ['identifier' => 'price', 'dataType' => 'float', 'label' => 'Price'],
        ];

        $records = [
            ['category' => 'Electronics', 'name' => 'Phone', 'price' => 999.99],
        ];

        $table = (new DataTable($descriptors, $records))
            ->setSortBy([
                ['descriptor' => 'category', 'direction' => 'ascending'],
                ['descriptor' => 'price', 'direction' => 'descending'],
            ]);

        $data = $table->jsonSerialize();

        $this->assertCount(2, $data['sortBy']);
    }
}

