<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Scenes;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Scenes\FadingStickyHeader;
use TomGould\AppleNews\Document\Scenes\ParallaxScaleHeader;
use TomGould\AppleNews\Document\Scenes\SceneInterface;

final class SceneTest extends TestCase
{
    public function testFadingStickyHeaderBasic(): void
    {
        $scene = new FadingStickyHeader();

        $this->assertSame('fading_sticky_header', $scene->getType());
        $this->assertSame([
            'type' => 'fading_sticky_header',
        ], $scene->jsonSerialize());
    }

    public function testFadingStickyHeaderWithFadeColor(): void
    {
        $scene = (new FadingStickyHeader())->setFadeColor('#333333');

        $this->assertSame([
            'type' => 'fading_sticky_header',
            'fadeColor' => '#333333',
        ], $scene->jsonSerialize());
    }

    public function testFadingStickyHeaderWithFadeColorFactory(): void
    {
        $scene = FadingStickyHeader::withFadeColor('#FF5500');

        $this->assertSame('#FF5500', $scene->jsonSerialize()['fadeColor']);
    }

    public function testFadingStickyHeaderFadeToBlack(): void
    {
        $scene = FadingStickyHeader::fadeToBlack();

        $this->assertSame([
            'type' => 'fading_sticky_header',
            'fadeColor' => '#000000',
        ], $scene->jsonSerialize());
    }

    public function testFadingStickyHeaderFadeToWhite(): void
    {
        $scene = FadingStickyHeader::fadeToWhite();

        $this->assertSame([
            'type' => 'fading_sticky_header',
            'fadeColor' => '#FFFFFF',
        ], $scene->jsonSerialize());
    }

    public function testParallaxScaleHeader(): void
    {
        $scene = new ParallaxScaleHeader();

        $this->assertSame('parallax_scale', $scene->getType());
        $this->assertSame([
            'type' => 'parallax_scale',
        ], $scene->jsonSerialize());
    }

    public function testAllScenesImplementInterface(): void
    {
        $scenes = [
            new FadingStickyHeader(),
            new ParallaxScaleHeader(),
        ];

        foreach ($scenes as $scene) {
            $this->assertInstanceOf(SceneInterface::class, $scene);
        }
    }

    public function testScenesAreJsonSerializable(): void
    {
        $scenes = [
            FadingStickyHeader::fadeToBlack(),
            new ParallaxScaleHeader(),
        ];

        foreach ($scenes as $scene) {
            $json = json_encode($scene);
            $this->assertIsString($json);
            $this->assertNotFalse($json);

            $decoded = json_decode($json, true);
            $this->assertArrayHasKey('type', $decoded);
        }
    }
}

