<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document;

use TomGould\AppleNews\Document\Styles\ComponentTextStyle;
use TomGould\AppleNews\Document\Styles\DocumentStyle;
use PHPUnit\Framework\TestCase;

final class StylesTest extends TestCase
{
    // ==========================================
    // DocumentStyle Tests
    // ==========================================

    public function testDocumentStyleEmpty(): void
    {
        $style = new DocumentStyle();
        $data = $style->jsonSerialize();

        $this->assertEmpty($data);
    }

    public function testDocumentStyleBackgroundColor(): void
    {
        $style = (new DocumentStyle())->setBackgroundColor('#FFFFFF');
        $data = $style->jsonSerialize();

        $this->assertEquals('#FFFFFF', $data['backgroundColor']);
    }

    // ==========================================
    // ComponentTextStyle Tests
    // ==========================================

    public function testComponentTextStyleEmpty(): void
    {
        $style = new ComponentTextStyle();
        $data = $style->jsonSerialize();

        $this->assertEmpty($data);
    }

    public function testComponentTextStyleFontName(): void
    {
        $style = (new ComponentTextStyle())->setFontName('Helvetica Neue');
        $data = $style->jsonSerialize();

        $this->assertEquals('Helvetica Neue', $data['fontName']);
    }

    public function testComponentTextStyleFontSize(): void
    {
        $style = (new ComponentTextStyle())->setFontSize(18);
        $data = $style->jsonSerialize();

        $this->assertEquals(18, $data['fontSize']);
    }

    public function testComponentTextStyleTextColor(): void
    {
        $style = (new ComponentTextStyle())->setTextColor('#333333');
        $data = $style->jsonSerialize();

        $this->assertEquals('#333333', $data['textColor']);
    }

    public function testComponentTextStyleTextAlignment(): void
    {
        $style = (new ComponentTextStyle())->setTextAlignment('center');
        $data = $style->jsonSerialize();

        $this->assertEquals('center', $data['textAlignment']);
    }

    public function testComponentTextStyleLineHeight(): void
    {
        $style = (new ComponentTextStyle())->setLineHeight(28.5);
        $data = $style->jsonSerialize();

        $this->assertEquals(28.5, $data['lineHeight']);
    }

    public function testComponentTextStyleTracking(): void
    {
        $style = (new ComponentTextStyle())->setTracking(0.5);
        $data = $style->jsonSerialize();

        $this->assertEquals(0.5, $data['tracking']);
    }

    public function testComponentTextStyleHyphenation(): void
    {
        $style = (new ComponentTextStyle())->setHyphenation(true);
        $data = $style->jsonSerialize();

        $this->assertTrue($data['hyphenation']);
    }

    public function testComponentTextStyleFontWeight(): void
    {
        $style = (new ComponentTextStyle())->setFontWeight('bold');
        $data = $style->jsonSerialize();

        $this->assertEquals('bold', $data['fontWeight']);
    }

    public function testComponentTextStyleFontStyle(): void
    {
        $style = (new ComponentTextStyle())->setFontStyle('italic');
        $data = $style->jsonSerialize();

        $this->assertEquals('italic', $data['fontStyle']);
    }

    public function testComponentTextStyleTextDecoration(): void
    {
        $style = (new ComponentTextStyle())->setTextDecoration('underline');
        $data = $style->jsonSerialize();

        $this->assertEquals('underline', $data['textDecoration']);
    }

    public function testComponentTextStyleTextTransform(): void
    {
        $style = (new ComponentTextStyle())->setTextTransform('uppercase');
        $data = $style->jsonSerialize();

        $this->assertEquals('uppercase', $data['textTransform']);
    }

    public function testComponentTextStyleLinkStyle(): void
    {
        $style = (new ComponentTextStyle())->setLinkStyle([
            'textColor' => '#0066CC',
            'underline' => true,
        ]);
        $data = $style->jsonSerialize();

        $this->assertEquals('#0066CC', $data['linkStyle']['textColor']);
        $this->assertTrue($data['linkStyle']['underline']);
    }

    public function testComponentTextStyleDropCapStyle(): void
    {
        $style = (new ComponentTextStyle())->setDropCapStyle([
            'numberOfLines' => 3,
            'numberOfCharacters' => 1,
            'fontName' => 'Georgia',
        ]);
        $data = $style->jsonSerialize();

        $this->assertEquals(3, $data['dropCapStyle']['numberOfLines']);
        $this->assertEquals('Georgia', $data['dropCapStyle']['fontName']);
    }

    public function testComponentTextStyleBackgroundColor(): void
    {
        $style = (new ComponentTextStyle())->setBackgroundColor('#FFFF00');
        $data = $style->jsonSerialize();

        $this->assertEquals('#FFFF00', $data['backgroundColor']);
    }

    public function testComponentTextStyleTextShadow(): void
    {
        $style = (new ComponentTextStyle())->setTextShadow([
            'radius' => 5,
            'color' => '#00000066',
            'offset' => ['x' => 2, 'y' => 2],
        ]);
        $data = $style->jsonSerialize();

        $this->assertEquals(5, $data['textShadow']['radius']);
        $this->assertEquals('#00000066', $data['textShadow']['color']);
    }

    public function testComponentTextStyleParagraphSpacing(): void
    {
        $style = (new ComponentTextStyle())
            ->setParagraphSpacingBefore(10)
            ->setParagraphSpacingAfter(20);
        $data = $style->jsonSerialize();

        $this->assertEquals(10, $data['paragraphSpacingBefore']);
        $this->assertEquals(20, $data['paragraphSpacingAfter']);
    }

    public function testComponentTextStyleFirstLineIndent(): void
    {
        $style = (new ComponentTextStyle())->setFirstLineIndent(24);
        $data = $style->jsonSerialize();

        $this->assertEquals(24, $data['firstLineIndent']);
    }

    public function testComponentTextStyleHangingPunctuation(): void
    {
        $style = (new ComponentTextStyle())->setHangingPunctuation(1);
        $data = $style->jsonSerialize();

        $this->assertEquals(1, $data['hangingPunctuation']);
    }

    public function testComponentTextStyleFullConfiguration(): void
    {
        $style = (new ComponentTextStyle())
            ->setFontName('Georgia')
            ->setFontSize(16)
            ->setTextColor('#000000')
            ->setTextAlignment('justify')
            ->setLineHeight(24)
            ->setFontWeight('normal')
            ->setHyphenation(true)
            ->setParagraphSpacingAfter(12);

        $data = $style->jsonSerialize();

        $this->assertCount(8, $data);
        $this->assertEquals('Georgia', $data['fontName']);
        $this->assertEquals(16, $data['fontSize']);
        $this->assertEquals('#000000', $data['textColor']);
        $this->assertEquals('justify', $data['textAlignment']);
        $this->assertEquals(24, $data['lineHeight']);
        $this->assertEquals('normal', $data['fontWeight']);
        $this->assertTrue($data['hyphenation']);
        $this->assertEquals(12, $data['paragraphSpacingAfter']);
    }
}

