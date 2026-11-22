<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Animations;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Animations\AppearAnimation;
use TomGould\AppleNews\Document\Animations\FadeInAnimation;
use TomGould\AppleNews\Document\Animations\MoveInAnimation;
use TomGould\AppleNews\Document\Animations\ScaleFadeAnimation;
use TomGould\AppleNews\Document\Components\Body;
use TomGould\AppleNews\Document\Components\Photo;
use TomGould\AppleNews\Document\Components\Title;

final class ComponentAnimationIntegrationTest extends TestCase
{
    public function testPhotoWithFadeInAnimation(): void
    {
        $photo = Photo::fromUrl('https://example.com/hero.jpg')
            ->setAnimationObject(FadeInAnimation::fromTransparent());

        $data = $photo->jsonSerialize();

        $this->assertSame([
            'type' => 'fade_in',
            'initialAlpha' => 0.0,
        ], $data['animation']);
    }

    public function testBodyWithMoveInAnimation(): void
    {
        $body = (new Body('Sample text'))
            ->setAnimationObject(MoveInAnimation::fromLeft());

        $data = $body->jsonSerialize();

        $this->assertSame([
            'type' => 'move_in',
            'preferredStartingPosition' => 'left',
        ], $data['animation']);
    }

    public function testTitleWithScaleFadeAnimation(): void
    {
        $title = (new Title('Article Title'))
            ->setAnimationObject(ScaleFadeAnimation::dramatic());

        $data = $title->jsonSerialize();

        $this->assertSame([
            'type' => 'scale_fade',
            'initialAlpha' => 0.0,
            'initialScale' => 0.5,
        ], $data['animation']);
    }

    public function testComponentWithAppearAnimation(): void
    {
        $body = (new Body('Content'))
            ->setAnimationObject((new AppearAnimation())->setUserControllable(true));

        $data = $body->jsonSerialize();

        $this->assertSame([
            'type' => 'appear',
            'userControllable' => true,
        ], $data['animation']);
    }

    public function testArrayAnimationStillWorks(): void
    {
        $photo = Photo::fromUrl('https://example.com/image.jpg')
            ->setAnimation([
                'type' => 'fade_in',
                'initialAlpha' => 0.2,
            ]);

        $data = $photo->jsonSerialize();

        $this->assertSame([
            'type' => 'fade_in',
            'initialAlpha' => 0.2,
        ], $data['animation']);
    }

    public function testAnimationObjectOverwritesArray(): void
    {
        $photo = Photo::fromUrl('https://example.com/image.jpg')
            ->setAnimation(['type' => 'fade_in', 'initialAlpha' => 0.5])
            ->setAnimationObject(MoveInAnimation::fromRight());

        $data = $photo->jsonSerialize();

        $this->assertSame('move_in', $data['animation']['type']);
        $this->assertSame('right', $data['animation']['preferredStartingPosition']);
    }

    public function testMoveInAnimationDirections(): void
    {
        $directions = [
            'left' => MoveInAnimation::fromLeft(),
            'right' => MoveInAnimation::fromRight(),
            'top' => MoveInAnimation::fromTop(),
            'bottom' => MoveInAnimation::fromBottom(),
        ];

        foreach ($directions as $expected => $animation) {
            $body = (new Body('Test'))->setAnimationObject($animation);
            $data = $body->jsonSerialize();

            $this->assertSame($expected, $data['animation']['preferredStartingPosition']);
        }
    }

    public function testFadeInFactoryMethods(): void
    {
        $transparent = (new Photo('https://example.com/1.jpg'))
            ->setAnimationObject(FadeInAnimation::fromTransparent());

        $subtle = (new Photo('https://example.com/2.jpg'))
            ->setAnimationObject(FadeInAnimation::subtle());

        $custom = (new Photo('https://example.com/3.jpg'))
            ->setAnimationObject(FadeInAnimation::withInitialAlpha(0.75));

        $this->assertSame(0.0, $transparent->jsonSerialize()['animation']['initialAlpha']);
        $this->assertSame(0.5, $subtle->jsonSerialize()['animation']['initialAlpha']);
        $this->assertSame(0.75, $custom->jsonSerialize()['animation']['initialAlpha']);
    }

    public function testScaleFadeFactoryMethods(): void
    {
        $subtle = ScaleFadeAnimation::subtle();
        $moderate = ScaleFadeAnimation::moderate();
        $dramatic = ScaleFadeAnimation::dramatic();

        $this->assertSame(0.9, $subtle->jsonSerialize()['initialScale']);
        $this->assertSame(0.75, $moderate->jsonSerialize()['initialScale']);
        $this->assertSame(0.5, $dramatic->jsonSerialize()['initialScale']);
    }
}
