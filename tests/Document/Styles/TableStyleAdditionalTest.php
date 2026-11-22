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

/**
 * Additional tests to achieve full coverage on table style classes.
 */
final class TableStyleAdditionalTest extends TestCase
{
    // ==================== TableBorder ====================

    public function testTableBorderSetLeft(): void
    {
        $border = (new TableBorder())
            ->setLeft(TableStrokeStyle::solid('#FF0000', 2));

        $data = $border->jsonSerialize();

        $this->assertArrayHasKey('left', $data);
        $this->assertSame('#FF0000', $data['left']['color']);
    }

    public function testTableBorderSetRight(): void
    {
        $border = (new TableBorder())
            ->setRight(TableStrokeStyle::dashed('#00FF00', 3));

        $data = $border->jsonSerialize();

        $this->assertArrayHasKey('right', $data);
        $this->assertSame('#00FF00', $data['right']['color']);
        $this->assertSame('dashed', $data['right']['style']);
    }

    public function testTableBorderAllSides(): void
    {
        $border = (new TableBorder())
            ->setTop(TableStrokeStyle::solid('#111111'))
            ->setBottom(TableStrokeStyle::solid('#222222'))
            ->setLeft(TableStrokeStyle::solid('#333333'))
            ->setRight(TableStrokeStyle::solid('#444444'));

        $data = $border->jsonSerialize();

        $this->assertCount(4, $data);
        $this->assertSame('#111111', $data['top']['color']);
        $this->assertSame('#222222', $data['bottom']['color']);
        $this->assertSame('#333333', $data['left']['color']);
        $this->assertSame('#444444', $data['right']['color']);
    }

    // ==================== TableCellStyle ====================

    public function testTableCellStyleSetBorder(): void
    {
        $style = (new TableCellStyle())
            ->setBorder(TableBorder::uniform('#000000', 1));

        $data = $style->jsonSerialize();

        $this->assertArrayHasKey('border', $data);
        $this->assertArrayHasKey('all', $data['border']);
    }

    public function testTableCellStyleSetMinimumWidth(): void
    {
        $style = (new TableCellStyle())
            ->setMinimumWidth(100);

        $data = $style->jsonSerialize();

        $this->assertSame(100, $data['minimumWidth']);
    }

    public function testTableCellStyleSetWidth(): void
    {
        $style = (new TableCellStyle())
            ->setWidth(200);

        $data = $style->jsonSerialize();

        $this->assertSame(200, $data['width']);
    }

    public function testTableCellStyleSetHeight(): void
    {
        $style = (new TableCellStyle())
            ->setHeight(50);

        $data = $style->jsonSerialize();

        $this->assertSame(50, $data['height']);
    }

    public function testTableCellStyleSetConditional(): void
    {
        $style = (new TableCellStyle())
            ->setConditional([
                ['conditions' => [['preferredColorScheme' => 'dark']], 'backgroundColor' => '#333333'],
            ]);

        $data = $style->jsonSerialize();

        $this->assertArrayHasKey('conditional', $data);
        $this->assertCount(1, $data['conditional']);
    }

    public function testTableCellStyleAllProperties(): void
    {
        $style = (new TableCellStyle())
            ->setBackgroundColor('#FFFFFF')
            ->setBorder(TableBorder::uniform('#CCCCCC'))
            ->setMinimumWidth(80)
            ->setPadding(['top' => 5, 'bottom' => 5])
            ->setTextStyle('cellText')
            ->setHorizontalAlignment('center')
            ->setVerticalAlignment('middle')
            ->setWidth(150)
            ->setHeight(40)
            ->setConditional([]);

        $data = $style->jsonSerialize();

        $this->assertSame('#FFFFFF', $data['backgroundColor']);
        $this->assertArrayHasKey('border', $data);
        $this->assertSame(80, $data['minimumWidth']);
        $this->assertSame(['top' => 5, 'bottom' => 5], $data['padding']);
        $this->assertSame('cellText', $data['textStyle']);
        $this->assertSame('center', $data['horizontalAlignment']);
        $this->assertSame('middle', $data['verticalAlignment']);
        $this->assertSame(150, $data['width']);
        $this->assertSame(40, $data['height']);
    }

    // ==================== TableColumnSelector ====================

    public function testTableColumnSelectorSetDescriptor(): void
    {
        $selector = (new TableColumnSelector())
            ->setDescriptor('price_column');

        $data = $selector->jsonSerialize();

        $this->assertSame('price_column', $data['descriptor']);
    }

    public function testTableColumnSelectorSetEven(): void
    {
        $selector = (new TableColumnSelector())
            ->setEven();

        $data = $selector->jsonSerialize();

        $this->assertTrue($data['even']);
        $this->assertArrayNotHasKey('odd', $data);
    }

    public function testTableColumnSelectorEvenColumns(): void
    {
        $selector = TableColumnSelector::evenColumns();

        $data = $selector->jsonSerialize();

        $this->assertTrue($data['even']);
    }

    public function testTableColumnSelectorOddThenEven(): void
    {
        $selector = (new TableColumnSelector())
            ->setOdd()
            ->setEven();

        $data = $selector->jsonSerialize();

        $this->assertTrue($data['even']);
        $this->assertArrayNotHasKey('odd', $data);
    }

    // ==================== TableColumnStyle ====================

    public function testTableColumnStyleSetBackgroundColor(): void
    {
        $style = (new TableColumnStyle())
            ->setBackgroundColor('#F0F0F0');

        $data = $style->jsonSerialize();

        $this->assertSame('#F0F0F0', $data['backgroundColor']);
    }

    public function testTableColumnStyleSetDivider(): void
    {
        $style = (new TableColumnStyle())
            ->setDivider(TableStrokeStyle::solid('#CCCCCC'));

        $data = $style->jsonSerialize();

        $this->assertArrayHasKey('divider', $data);
        $this->assertSame('#CCCCCC', $data['divider']['color']);
    }

    public function testTableColumnStyleSetConditional(): void
    {
        $style = (new TableColumnStyle())
            ->setConditional([
                ['conditions' => [['preferredColorScheme' => 'dark']], 'backgroundColor' => '#222222'],
            ]);

        $data = $style->jsonSerialize();

        $this->assertArrayHasKey('conditional', $data);
    }

    public function testTableColumnStyleAllProperties(): void
    {
        $style = (new TableColumnStyle())
            ->setBackgroundColor('#FAFAFA')
            ->setDivider(TableStrokeStyle::dashed('#DDDDDD'))
            ->setWidth(120)
            ->setMinimumWidth(80)
            ->setMaximumWidth(200)
            ->setConditional([]);

        $data = $style->jsonSerialize();

        $this->assertSame('#FAFAFA', $data['backgroundColor']);
        $this->assertSame('dashed', $data['divider']['style']);
        $this->assertSame(120, $data['width']);
        $this->assertSame(80, $data['minimumWidth']);
        $this->assertSame(200, $data['maximumWidth']);
    }

    // ==================== TableRowSelector ====================

    public function testTableRowSelectorSetDescriptor(): void
    {
        $selector = (new TableRowSelector())
            ->setDescriptor('header_row');

        $data = $selector->jsonSerialize();

        $this->assertSame('header_row', $data['descriptor']);
    }

    public function testTableRowSelectorOddThenEven(): void
    {
        $selector = (new TableRowSelector())
            ->setOdd()
            ->setEven();

        $data = $selector->jsonSerialize();

        $this->assertTrue($data['even']);
        $this->assertArrayNotHasKey('odd', $data);
    }

    // ==================== TableRowStyle ====================

    public function testTableRowStyleSetConditional(): void
    {
        $style = (new TableRowStyle())
            ->setConditional([
                ['conditions' => [['preferredColorScheme' => 'dark']], 'backgroundColor' => '#1A1A1A'],
            ]);

        $data = $style->jsonSerialize();

        $this->assertArrayHasKey('conditional', $data);
    }

    public function testTableRowStyleZebraStripe(): void
    {
        $style = TableRowStyle::zebraStripe('#F5F5F5');

        $data = $style->jsonSerialize();

        $this->assertSame('#F5F5F5', $data['backgroundColor']);
    }

    // ==================== TableStyle ====================

    public function testTableStyleSetColumns(): void
    {
        $tableStyle = (new TableStyle())
            ->setColumns((new TableColumnStyle())->setWidth(100));

        $data = $tableStyle->jsonSerialize();

        $this->assertArrayHasKey('columns', $data);
        $this->assertSame(100, $data['columns']['width']);
    }

    public function testTableStyleSetHeaderColumns(): void
    {
        $tableStyle = (new TableStyle())
            ->setHeaderColumns((new TableColumnStyle())->setBackgroundColor('#333333'));

        $data = $tableStyle->jsonSerialize();

        $this->assertArrayHasKey('headerColumns', $data);
        $this->assertSame('#333333', $data['headerColumns']['backgroundColor']);
    }

    public function testTableStyleSetConditional(): void
    {
        $tableStyle = (new TableStyle())
            ->setConditional([
                ['conditions' => [['preferredColorScheme' => 'dark']]],
            ]);

        $data = $tableStyle->jsonSerialize();

        $this->assertArrayHasKey('conditional', $data);
    }

    public function testTableStyleAllProperties(): void
    {
        $tableStyle = (new TableStyle())
            ->setCells((new TableCellStyle())->setPadding(8))
            ->setColumns((new TableColumnStyle())->setWidth(100))
            ->setHeaderCells((new TableCellStyle())->setBackgroundColor('#333'))
            ->setHeaderColumns((new TableColumnStyle())->setBackgroundColor('#222'))
            ->setHeaderRows((new TableRowStyle())->setHeight(50))
            ->setRows((new TableRowStyle())->setHeight(40))
            ->setConditional([]);

        $data = $tableStyle->jsonSerialize();

        $this->assertCount(7, $data);
    }
}
