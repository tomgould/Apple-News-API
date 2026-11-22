<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Animations;

/**
 * Scale-fade animation for components.
 *
 * The scale_fade animation causes a component to scale up while fading
 * in when it enters the viewport, creating a zoom-in effect.
 *
 * @see https://developer.apple.com/documentation/apple_news/scalefadeanimation
 */
final class ScaleFadeAnimation implements AnimationInterface
{
    /**
     * The initial opacity of the component (0.0 to 1.0).
     */
    private ?float $initialAlpha = null;

    /**
     * The initial scale of the component (e.g., 0.75 for 75% size).
     */
    private ?float $initialScale = null;

    /**
     * Whether the animation is controllable by user scroll position.
     */
    private ?bool $userControllable = null;

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return 'scale_fade';
    }

    /**
     * Set the initial alpha (opacity) value.
     *
     * The component will fade from this value to 1.0.
     *
     * @param float $initialAlpha Initial opacity from 0.0 to 1.0.
     *
     * @return $this
     */
    public function setInitialAlpha(float $initialAlpha): self
    {
        $this->initialAlpha = max(0.0, min(1.0, $initialAlpha));
        return $this;
    }

    /**
     * Set the initial scale value.
     *
     * The component will scale from this value to 1.0.
     * Values less than 1.0 create a zoom-in effect.
     *
     * @param float $initialScale Initial scale factor (e.g., 0.75 for 75%).
     *
     * @return $this
     */
    public function setInitialScale(float $initialScale): self
    {
        $this->initialScale = max(0.0, $initialScale);
        return $this;
    }

    /**
     * Set whether the animation is user controllable.
     *
     * When true, the animation progress is tied to scroll position.
     *
     * @param bool $userControllable Whether user can control the animation.
     *
     * @return $this
     */
    public function setUserControllable(bool $userControllable): self
    {
        $this->userControllable = $userControllable;
        return $this;
    }

    /**
     * Create a ScaleFadeAnimation with specific values.
     *
     * @param float $initialAlpha Initial opacity (0.0 to 1.0).
     * @param float $initialScale Initial scale factor.
     *
     * @return self A new ScaleFadeAnimation instance.
     */
    public static function with(float $initialAlpha, float $initialScale): self
    {
        return (new self())
            ->setInitialAlpha($initialAlpha)
            ->setInitialScale($initialScale);
    }

    /**
     * Create a subtle scale-fade animation.
     *
     * Starts at 90% size and 50% opacity.
     *
     * @return self A new ScaleFadeAnimation instance.
     */
    public static function subtle(): self
    {
        return self::with(0.5, 0.9);
    }

    /**
     * Create a moderate scale-fade animation.
     *
     * Starts at 75% size and 25% opacity.
     *
     * @return self A new ScaleFadeAnimation instance.
     */
    public static function moderate(): self
    {
        return self::with(0.25, 0.75);
    }

    /**
     * Create a dramatic scale-fade animation.
     *
     * Starts at 50% size and fully transparent.
     *
     * @return self A new ScaleFadeAnimation instance.
     */
    public static function dramatic(): self
    {
        return self::with(0.0, 0.5);
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [
            'type' => $this->getType(),
        ];

        if ($this->initialAlpha !== null) {
            $data['initialAlpha'] = $this->initialAlpha;
        }

        if ($this->initialScale !== null) {
            $data['initialScale'] = $this->initialScale;
        }

        if ($this->userControllable !== null) {
            $data['userControllable'] = $this->userControllable;
        }

        return $data;
    }
}

