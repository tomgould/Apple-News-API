<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Animations;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Animations\AnimationInterface;
use TomGould\AppleNews\Document\Animations\AppearAnimation;
use TomGould\AppleNews\Document\Animations\FadeInAnimation;
use TomGould\AppleNews\Document\Animations\MoveInAnimation;
use TomGould\AppleNews\Document\Animations\ScaleFadeAnimation;

final class AnimationTest extends TestCase
{
    public function testAppearAnimation(): void
    {
        $animation = new AppearAnimation();

        $this->assertSame('appear', $animation->getType());
        $this->assertSame([
            'type' => 'appear',
        ], $animation->jsonSerialize());
    }

    public function testAppearAnimationWithUserControllable(): void
    {
        $animation = (new AppearAnimation())->setUserControllable(true);

        $this->assertSame([
            'type' => 'appear',
            'userControllable' => true,
        ], $animation->jsonSerialize());
    }

    public function testFadeInAnimation(): void
    {
        $animation = new FadeInAnimation();

        $this->assertSame('fade_in', $animation->getType());
        $this->assertSame([
            'type' => 'fade_in',
        ], $animation->jsonSerialize());
    }

    public function testFadeInAnimationWithInitialAlpha(): void
    {
        $animation = (new FadeInAnimation())->setInitialAlpha(0.3);

        $this->assertSame([
            'type' => 'fade_in',
            'initialAlpha' => 0.3,
        ], $animation->jsonSerialize());
    }

    public function testFadeInAnimationClampsAlpha(): void
    {
        $tooLow = (new FadeInAnimation())->setInitialAlpha(-0.5);
        $tooHigh = (new FadeInAnimation())->setInitialAlpha(1.5);

        $this->assertSame(0.0, $tooLow->jsonSerialize()['initialAlpha']);
        $this->assertSame(1.0, $tooHigh->jsonSerialize()['initialAlpha']);
    }

    public function testFadeInAnimationWithInitialAlphaFactory(): void
    {
        $animation = FadeInAnimation::withInitialAlpha(0.25);

        $this->assertSame(0.25, $animation->jsonSerialize()['initialAlpha']);
    }

    public function testFadeInAnimationFromTransparent(): void
    {
        $animation = FadeInAnimation::fromTransparent();

        $this->assertSame(0.0, $animation->jsonSerialize()['initialAlpha']);
    }

    public function testFadeInAnimationSubtle(): void
    {
        $animation = FadeInAnimation::subtle();

        $this->assertSame(0.5, $animation->jsonSerialize()['initialAlpha']);
    }

    public function testFadeInAnimationWithUserControllable(): void
    {
        $animation = (new FadeInAnimation())
            ->setInitialAlpha(0.0)
            ->setUserControllable(true);

        $data = $animation->jsonSerialize();

        $this->assertTrue($data['userControllable']);
    }

    public function testMoveInAnimation(): void
    {
        $animation = new MoveInAnimation();

        $this->assertSame('move_in', $animation->getType());
        $this->assertSame([
            'type' => 'move_in',
        ], $animation->jsonSerialize());
    }

    public function testMoveInAnimationFromLeft(): void
    {
        $animation = MoveInAnimation::fromLeft();

        $this->assertSame([
            'type' => 'move_in',
            'preferredStartingPosition' => 'left',
        ], $animation->jsonSerialize());
    }

    public function testMoveInAnimationFromRight(): void
    {
        $animation = MoveInAnimation::fromRight();

        $this->assertSame('right', $animation->jsonSerialize()['preferredStartingPosition']);
    }

    public function testMoveInAnimationFromTop(): void
    {
        $animation = MoveInAnimation::fromTop();

        $this->assertSame('top', $animation->jsonSerialize()['preferredStartingPosition']);
    }

    public function testMoveInAnimationFromBottom(): void
    {
        $animation = MoveInAnimation::fromBottom();

        $this->assertSame('bottom', $animation->jsonSerialize()['preferredStartingPosition']);
    }

    public function testMoveInAnimationWithUserControllable(): void
    {
        $animation = MoveInAnimation::fromLeft()->setUserControllable(true);

        $data = $animation->jsonSerialize();

        $this->assertSame('left', $data['preferredStartingPosition']);
        $this->assertTrue($data['userControllable']);
    }

    public function testScaleFadeAnimation(): void
    {
        $animation = new ScaleFadeAnimation();

        $this->assertSame('scale_fade', $animation->getType());
        $this->assertSame([
            'type' => 'scale_fade',
        ], $animation->jsonSerialize());
    }

    public function testScaleFadeAnimationWithValues(): void
    {
        $animation = (new ScaleFadeAnimation())
            ->setInitialAlpha(0.5)
            ->setInitialScale(0.8);

        $this->assertSame([
            'type' => 'scale_fade',
            'initialAlpha' => 0.5,
            'initialScale' => 0.8,
        ], $animation->jsonSerialize());
    }

    public function testScaleFadeAnimationWith(): void
    {
        $animation = ScaleFadeAnimation::with(0.3, 0.7);

        $data = $animation->jsonSerialize();

        $this->assertSame(0.3, $data['initialAlpha']);
        $this->assertSame(0.7, $data['initialScale']);
    }

    public function testScaleFadeAnimationSubtle(): void
    {
        $animation = ScaleFadeAnimation::subtle();

        $data = $animation->jsonSerialize();

        $this->assertSame(0.5, $data['initialAlpha']);
        $this->assertSame(0.9, $data['initialScale']);
    }

    public function testScaleFadeAnimationModerate(): void
    {
        $animation = ScaleFadeAnimation::moderate();

        $data = $animation->jsonSerialize();

        $this->assertSame(0.25, $data['initialAlpha']);
        $this->assertSame(0.75, $data['initialScale']);
    }

    public function testScaleFadeAnimationDramatic(): void
    {
        $animation = ScaleFadeAnimation::dramatic();

        $data = $animation->jsonSerialize();

        $this->assertSame(0.0, $data['initialAlpha']);
        $this->assertSame(0.5, $data['initialScale']);
    }

    public function testScaleFadeAnimationClampsValues(): void
    {
        $animation = (new ScaleFadeAnimation())
            ->setInitialAlpha(-0.5)
            ->setInitialScale(-0.5);

        $data = $animation->jsonSerialize();

        $this->assertSame(0.0, $data['initialAlpha']);
        $this->assertSame(0.0, $data['initialScale']);
    }

    public function testAllAnimationsImplementInterface(): void
    {
        $animations = [
            new AppearAnimation(),
            new FadeInAnimation(),
            new MoveInAnimation(),
            new ScaleFadeAnimation(),
        ];

        foreach ($animations as $animation) {
            $this->assertInstanceOf(AnimationInterface::class, $animation);
        }
    }

    public function testAnimationsAreJsonSerializable(): void
    {
        $animations = [
            new AppearAnimation(),
            FadeInAnimation::fromTransparent(),
            MoveInAnimation::fromLeft(),
            ScaleFadeAnimation::subtle(),
        ];

        foreach ($animations as $animation) {
            $json = json_encode($animation);
            $this->assertIsString($json);
            $this->assertNotFalse($json);

            $decoded = json_decode($json, true);
            $this->assertArrayHasKey('type', $decoded);
        }
    }
}

