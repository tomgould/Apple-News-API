<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Components;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Components\DataTable;
use TomGould\AppleNews\Document\Components\HTMLTable;

final class TableComponentsTest extends TestCase
{
    public function testDataTableComponent(): void
    {
        $table = new DataTable();

        $data = $table->jsonSerialize();

        $this->assertSame('datatable', $data['role']);
    }

    public function testDataTableWithData(): void
    {
        $tableData = [
            'descriptors' => [
                ['identifier' => 'name', 'dataType' => 'string', 'label' => 'Name'],
                ['identifier' => 'score', 'dataType' => 'integer', 'label' => 'Score'],
            ],
            'records' => [
                ['name' => 'Alice', 'score' => 95],
                ['name' => 'Bob', 'score' => 87],
            ],
        ];

        $table = (new DataTable())->setData($tableData);

        $data = $table->jsonSerialize();

        $this->assertSame('datatable', $data['role']);
        $this->assertSame($tableData, $data['data']);
    }

    public function testDataTableWithSorting(): void
    {
        $table = (new DataTable())
            ->addSortBy('score', 'descending')
            ->addSortBy('name', 'ascending');

        $data = $table->jsonSerialize();

        $this->assertSame([
            ['descriptor' => 'score', 'direction' => 'descending'],
            ['descriptor' => 'name', 'direction' => 'ascending'],
        ], $data['sortBy']);
    }

    public function testDataTableWithOptions(): void
    {
        $table = (new DataTable())
            ->setShowDescriptorLabels(true)
            ->setDataTableStyle('customTableStyle');

        $data = $table->jsonSerialize();

        $this->assertTrue($data['showDescriptorLabels']);
        $this->assertSame('customTableStyle', $data['dataTableStyle']);
    }

    public function testHTMLTableComponent(): void
    {
        $html = '<table><tr><td>Cell</td></tr></table>';
        $table = new HTMLTable($html);

        $data = $table->jsonSerialize();

        $this->assertSame('htmltable', $data['role']);
        $this->assertSame($html, $data['html']);
    }

    public function testHTMLTableFromHtml(): void
    {
        $html = '<table><tr><th>Header</th></tr><tr><td>Data</td></tr></table>';
        $table = HTMLTable::fromHtml($html);

        $data = $table->jsonSerialize();

        $this->assertSame('htmltable', $data['role']);
        $this->assertSame($html, $data['html']);
    }

    public function testHTMLTableWithStyle(): void
    {
        $table = (new HTMLTable('<table></table>'))
            ->setTableStyle('customHtmlTableStyle');

        $data = $table->jsonSerialize();

        $this->assertSame('customHtmlTableStyle', $data['tableStyle']);
    }
}

