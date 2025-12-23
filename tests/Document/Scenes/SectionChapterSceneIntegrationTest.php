<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Scenes;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Components\Body;
use TomGould\AppleNews\Document\Components\Chapter;
use TomGould\AppleNews\Document\Components\Header;
use TomGould\AppleNews\Document\Components\Photo;
use TomGould\AppleNews\Document\Components\Section;
use TomGould\AppleNews\Document\Components\Title;
use TomGould\AppleNews\Document\Scenes\FadingStickyHeader;
use TomGould\AppleNews\Document\Scenes\ParallaxScaleHeader;

final class SectionChapterSceneIntegrationTest extends TestCase
{
    public function testSectionWithFadingStickyHeader(): void
    {
        $section = (new Section())
            ->setSceneObject(FadingStickyHeader::fadeToBlack())
            ->addComponent(new Title('Section Title'))
            ->addComponent(new Body('Section content.'));

        $data = $section->jsonSerialize();

        $this->assertSame('section', $data['role']);
        $this->assertSame([
            'type' => 'fading_sticky_header',
            'fadeColor' => '#000000',
        ], $data['scene']);
    }

    public function testSectionWithParallaxScaleHeader(): void
    {
        $section = (new Section())
            ->setSceneObject(new ParallaxScaleHeader())
            ->addComponent(Photo::fromUrl('https://example.com/hero.jpg'));

        $data = $section->jsonSerialize();

        $this->assertSame([
            'type' => 'parallax_scale',
        ], $data['scene']);
    }

    public function testChapterWithFadingStickyHeader(): void
    {
        $chapter = (new Chapter())
            ->setSceneObject(FadingStickyHeader::withFadeColor('#1A1A1A'))
            ->addComponent(new Title('Chapter 1: The Beginning'));

        $data = $chapter->jsonSerialize();

        $this->assertSame('chapter', $data['role']);
        $this->assertSame([
            'type' => 'fading_sticky_header',
            'fadeColor' => '#1A1A1A',
        ], $data['scene']);
    }

    public function testChapterWithParallaxScaleHeader(): void
    {
        $chapter = (new Chapter())
            ->setSceneObject(new ParallaxScaleHeader())
            ->addComponent(
                (new Header())
                    ->addComponent(Photo::fromUrl('https://example.com/chapter-hero.jpg'))
            );

        $data = $chapter->jsonSerialize();

        $this->assertSame([
            'type' => 'parallax_scale',
        ], $data['scene']);
    }

    public function testArraySceneStillWorks(): void
    {
        $section = (new Section())
            ->setScene([
                'type' => 'fading_sticky_header',
                'fadeColor' => '#AABBCC',
            ]);

        $data = $section->jsonSerialize();

        $this->assertSame([
            'type' => 'fading_sticky_header',
            'fadeColor' => '#AABBCC',
        ], $data['scene']);
    }

    public function testSceneObjectOverwritesArray(): void
    {
        $section = (new Section())
            ->setScene(['type' => 'fading_sticky_header', 'fadeColor' => '#000000'])
            ->setSceneObject(new ParallaxScaleHeader());

        $data = $section->jsonSerialize();

        $this->assertSame('parallax_scale', $data['scene']['type']);
        $this->assertArrayNotHasKey('fadeColor', $data['scene']);
    }

    public function testComplexSectionWithSceneAndComponents(): void
    {
        $section = (new Section())
            ->setIdentifier('hero-section')
            ->setSceneObject(FadingStickyHeader::fadeToWhite())
            ->addComponent(
                (new Header())
                    ->addComponent(Photo::fromUrl('https://example.com/hero.jpg'))
                    ->addComponent(new Title('Welcome'))
            )
            ->addComponent(new Body('Introduction text...'));

        $data = $section->jsonSerialize();

        $this->assertSame('section', $data['role']);
        $this->assertSame('hero-section', $data['identifier']);
        $this->assertSame('fading_sticky_header', $data['scene']['type']);
        $this->assertSame('#FFFFFF', $data['scene']['fadeColor']);
        $this->assertCount(2, $data['components']);
        $this->assertSame('header', $data['components'][0]['role']);
    }

    public function testFadeColorVariations(): void
    {
        $black = (new Section())->setSceneObject(FadingStickyHeader::fadeToBlack());
        $white = (new Section())->setSceneObject(FadingStickyHeader::fadeToWhite());
        $custom = (new Section())->setSceneObject(FadingStickyHeader::withFadeColor('#FF5500'));

        $this->assertSame('#000000', $black->jsonSerialize()['scene']['fadeColor']);
        $this->assertSame('#FFFFFF', $white->jsonSerialize()['scene']['fadeColor']);
        $this->assertSame('#FF5500', $custom->jsonSerialize()['scene']['fadeColor']);
    }
}
