<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Styles;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Styles\TableBorder;
use TomGould\AppleNews\Document\Styles\TableCellStyle;
use TomGould\AppleNews\Document\Styles\TableColumnSelector;
use TomGould\AppleNews\Document\Styles\TableColumnStyle;
use TomGould\AppleNews\Document\Styles\TableRowSelector;
use TomGould\AppleNews\Document\Styles\TableRowStyle;
use TomGould\AppleNews\Document\Styles\TableStrokeStyle;
use TomGould\AppleNews\Document\Styles\TableStyle;

final class TableStyleTest extends TestCase
{
    public function testTableStrokeStyleSolid(): void
    {
        $stroke = TableStrokeStyle::solid('#000000', 2);

        $data = $stroke->jsonSerialize();

        $this->assertSame('#000000', $data['color']);
        $this->assertSame('solid', $data['style']);
        $this->assertSame(2, $data['width']);
    }

    public function testTableStrokeStyleDashed(): void
    {
        $stroke = TableStrokeStyle::dashed('#CCCCCC');

        $data = $stroke->jsonSerialize();

        $this->assertSame('dashed', $data['style']);
        $this->assertSame(1, $data['width']);
    }

    public function testTableBorderUniform(): void
    {
        $border = TableBorder::uniform('#000000', 1);

        $data = $border->jsonSerialize();

        $this->assertArrayHasKey('all', $data);
        $this->assertSame('#000000', $data['all']['color']);
    }

    public function testTableBorderIndividualSides(): void
    {
        $border = (new TableBorder())
            ->setTop(TableStrokeStyle::solid('#FF0000', 2))
            ->setBottom(TableStrokeStyle::solid('#00FF00', 2));

        $data = $border->jsonSerialize();

        $this->assertArrayHasKey('top', $data);
        $this->assertArrayHasKey('bottom', $data);
        $this->assertArrayNotHasKey('left', $data);
        $this->assertArrayNotHasKey('right', $data);
    }

    public function testTableRowSelectorOddRows(): void
    {
        $selector = TableRowSelector::oddRows();

        $data = $selector->jsonSerialize();

        $this->assertTrue($data['odd']);
    }

    public function testTableRowSelectorEvenRows(): void
    {
        $selector = TableRowSelector::evenRows();

        $data = $selector->jsonSerialize();

        $this->assertTrue($data['even']);
    }

    public function testTableRowSelectorSpecificRow(): void
    {
        $selector = TableRowSelector::row(0);

        $data = $selector->jsonSerialize();

        $this->assertSame(0, $data['rowIndex']);
    }

    public function testTableColumnSelectorOddColumns(): void
    {
        $selector = TableColumnSelector::oddColumns();

        $data = $selector->jsonSerialize();

        $this->assertTrue($data['odd']);
    }

    public function testTableColumnSelectorSpecificColumn(): void
    {
        $selector = TableColumnSelector::column(2);

        $data = $selector->jsonSerialize();

        $this->assertSame(2, $data['columnIndex']);
    }

    public function testTableCellStyle(): void
    {
        $style = (new TableCellStyle())
            ->setBackgroundColor('#F5F5F5')
            ->setPadding(10)
            ->setTextStyle('cellText')
            ->setHorizontalAlignment('center')
            ->setVerticalAlignment('middle');

        $data = $style->jsonSerialize();

        $this->assertSame('#F5F5F5', $data['backgroundColor']);
        $this->assertSame(10, $data['padding']);
        $this->assertSame('cellText', $data['textStyle']);
        $this->assertSame('center', $data['horizontalAlignment']);
    }

    public function testTableRowStyle(): void
    {
        $style = (new TableRowStyle())
            ->setBackgroundColor('#EEEEEE')
            ->setHeight(48)
            ->setDivider(TableStrokeStyle::solid('#CCCCCC'));

        $data = $style->jsonSerialize();

        $this->assertSame('#EEEEEE', $data['backgroundColor']);
        $this->assertSame(48, $data['height']);
        $this->assertArrayHasKey('divider', $data);
    }

    public function testTableColumnStyle(): void
    {
        $style = (new TableColumnStyle())
            ->setWidth(150)
            ->setMinimumWidth(100)
            ->setMaximumWidth(200);

        $data = $style->jsonSerialize();

        $this->assertSame(150, $data['width']);
        $this->assertSame(100, $data['minimumWidth']);
        $this->assertSame(200, $data['maximumWidth']);
    }

    public function testTableStyle(): void
    {
        $tableStyle = (new TableStyle())
            ->setCells((new TableCellStyle())->setPadding(8))
            ->setHeaderCells((new TableCellStyle())->setBackgroundColor('#333333'))
            ->setRows((new TableRowStyle())->setHeight(44))
            ->setHeaderRows((new TableRowStyle())->setBackgroundColor('#222222'));

        $data = $tableStyle->jsonSerialize();

        $this->assertArrayHasKey('cells', $data);
        $this->assertArrayHasKey('headerCells', $data);
        $this->assertArrayHasKey('rows', $data);
        $this->assertArrayHasKey('headerRows', $data);
    }
}

