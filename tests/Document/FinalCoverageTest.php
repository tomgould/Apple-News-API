<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Conditionals\ConditionalAutoPlacement;
use TomGould\AppleNews\Document\Conditionals\ConditionalComponent;
use TomGould\AppleNews\Document\Conditionals\ConditionalComponentLayout;
use TomGould\AppleNews\Document\Conditionals\ConditionalComponentStyle;
use TomGould\AppleNews\Document\Conditionals\ConditionalDocumentStyle;
use TomGould\AppleNews\Document\Conditionals\ConditionalTableCellStyle;
use TomGould\AppleNews\Document\Conditionals\ConditionalTableRowStyle;
use TomGould\AppleNews\Document\Conditionals\ConditionalTextStyle;
use TomGould\AppleNews\Document\Layouts\AdvertisementAutoPlacement;
use TomGould\AppleNews\Document\Layouts\AutoPlacement;
use TomGould\AppleNews\Document\Layouts\Condition;

/**
 * Final coverage tests targeting all remaining 0% methods.
 */
final class FinalCoverageTest extends TestCase
{
    // ==================== Condition setters ====================

    public function testConditionSetMaxSpecifiedWidth(): void
    {
        $condition = (new Condition())->setMaxSpecifiedWidth(600);
        $data = $condition->jsonSerialize();
        $this->assertSame(600, $data['maxSpecifiedWidth']);
    }

    public function testConditionSetMinSpecifiedWidth(): void
    {
        $condition = (new Condition())->setMinSpecifiedWidth(300);
        $data = $condition->jsonSerialize();
        $this->assertSame(300, $data['minSpecifiedWidth']);
    }

    public function testConditionSetMaxContentSizeCategory(): void
    {
        $condition = (new Condition())->setMaxContentSizeCategory('XL');
        $data = $condition->jsonSerialize();
        $this->assertSame('XL', $data['maxContentSizeCategory']);
    }

    public function testConditionSetMinContentSizeCategory(): void
    {
        $condition = (new Condition())->setMinContentSizeCategory('S');
        $data = $condition->jsonSerialize();
        $this->assertSame('S', $data['minContentSizeCategory']);
    }

    // ==================== AutoPlacement::setConditional ====================

    public function testAutoPlacementSetConditional(): void
    {
        $autoPlacement = (new AutoPlacement())
            ->setAdvertisement(AdvertisementAutoPlacement::withFrequency(10))
            ->setConditional([
                [
                    'conditions' => [['horizontalSizeClass' => 'compact']],
                    'advertisement' => ['enabled' => false],
                ],
            ]);

        $data = $autoPlacement->jsonSerialize();

        $this->assertArrayHasKey('conditional', $data);
        $this->assertCount(1, $data['conditional']);
    }

    // ==================== ConditionalComponent::setConditions ====================

    public function testConditionalComponentSetConditions(): void
    {
        $conditions = [
            Condition::darkMode(),
            Condition::iOS(),
        ];

        $conditional = (new ConditionalComponent())
            ->setConditions($conditions)
            ->setHidden(true);

        $this->assertTrue($conditional->hasConditions());
        $data = $conditional->jsonSerialize();
        $this->assertCount(2, $data['conditions']);
    }

    // ==================== All hasConditions() methods ====================

    public function testConditionalAutoPlacementHasConditions(): void
    {
        $conditional = new ConditionalAutoPlacement();
        $this->assertFalse($conditional->hasConditions());

        $conditional->addCondition(Condition::compactWidth());
        $this->assertTrue($conditional->hasConditions());
    }

    public function testConditionalComponentLayoutHasConditions(): void
    {
        $conditional = new ConditionalComponentLayout();
        $this->assertFalse($conditional->hasConditions());

        $conditional->addCondition(Condition::regularWidth());
        $this->assertTrue($conditional->hasConditions());
    }

    public function testConditionalComponentStyleHasConditions(): void
    {
        $conditional = new ConditionalComponentStyle();
        $this->assertFalse($conditional->hasConditions());

        $conditional->addCondition(Condition::darkMode());
        $this->assertTrue($conditional->hasConditions());
    }

    public function testConditionalDocumentStyleHasConditions(): void
    {
        $conditional = new ConditionalDocumentStyle();
        $this->assertFalse($conditional->hasConditions());

        $conditional->addCondition(Condition::darkMode());
        $this->assertTrue($conditional->hasConditions());
    }

    public function testConditionalTableCellStyleHasConditions(): void
    {
        $conditional = new ConditionalTableCellStyle();
        $this->assertFalse($conditional->hasConditions());

        $conditional->addCondition(Condition::darkMode());
        $this->assertTrue($conditional->hasConditions());
    }

    public function testConditionalTableRowStyleHasConditions(): void
    {
        $conditional = new ConditionalTableRowStyle();
        $this->assertFalse($conditional->hasConditions());

        $conditional->addCondition(Condition::darkMode());
        $this->assertTrue($conditional->hasConditions());
    }

    public function testConditionalTextStyleHasConditions(): void
    {
        $conditional = new ConditionalTextStyle();
        $this->assertFalse($conditional->hasConditions());

        $conditional->addCondition(Condition::compactWidth());
        $this->assertTrue($conditional->hasConditions());
    }

    // ==================== ConditionalTextStyle::lightMode ====================

    public function testConditionalTextStyleLightMode(): void
    {
        $conditional = ConditionalTextStyle::lightMode('#000000');

        $data = $conditional->jsonSerialize();

        $this->assertSame('#000000', $data['textColor']);
        $this->assertSame('light', $data['conditions'][0]['preferredColorScheme']);
    }
}
