<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Animations;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Animations\ScaleFadeAnimation;

/**
 * Additional tests to achieve full coverage on animation classes.
 */
final class AnimationAdditionalTest extends TestCase
{
    public function testScaleFadeAnimationSetUserControllable(): void
    {
        $animation = ScaleFadeAnimation::subtle()
            ->setUserControllable(true);

        $data = $animation->jsonSerialize();

        $this->assertTrue($data['userControllable']);
    }

    public function testScaleFadeAnimationSetUserControllableFalse(): void
    {
        $animation = ScaleFadeAnimation::moderate()
            ->setUserControllable(false);

        $data = $animation->jsonSerialize();

        $this->assertFalse($data['userControllable']);
    }

    public function testScaleFadeAnimationAllProperties(): void
    {
        $animation = ScaleFadeAnimation::with(0.8, 0.6)
            ->setUserControllable(true);

        $data = $animation->jsonSerialize();

        $this->assertSame('scale_fade', $data['type']);
        $this->assertSame(0.8, $data['initialAlpha']);
        $this->assertSame(0.6, $data['initialScale']);
        $this->assertTrue($data['userControllable']);
    }
}

