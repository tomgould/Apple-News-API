<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Animations;

/**
 * Fade-in animation for components.
 *
 * The fade_in animation causes a component to fade in from transparent
 * to fully opaque when it enters the viewport.
 *
 * @see https://developer.apple.com/documentation/apple_news/fadeinanimation
 */
final class FadeInAnimation implements AnimationInterface
{
    /**
     * The initial opacity of the component (0.0 to 1.0).
     */
    private ?float $initialAlpha = null;

    /**
     * Whether the animation is controllable by user scroll position.
     */
    private ?bool $userControllable = null;

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return 'fade_in';
    }

    /**
     * Set the initial alpha (opacity) value.
     *
     * The component will fade from this value to 1.0 (fully opaque).
     *
     * @param float $initialAlpha Initial opacity from 0.0 (transparent) to 1.0 (opaque).
     *
     * @return $this
     */
    public function setInitialAlpha(float $initialAlpha): self
    {
        $this->initialAlpha = max(0.0, min(1.0, $initialAlpha));
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
     * Create a FadeInAnimation with a specific initial alpha.
     *
     * @param float $initialAlpha The starting opacity (0.0 to 1.0).
     *
     * @return self A new FadeInAnimation instance.
     */
    public static function withInitialAlpha(float $initialAlpha): self
    {
        return (new self())->setInitialAlpha($initialAlpha);
    }

    /**
     * Create a FadeInAnimation starting from fully transparent.
     *
     * @return self A new FadeInAnimation with initialAlpha of 0.
     */
    public static function fromTransparent(): self
    {
        return (new self())->setInitialAlpha(0.0);
    }

    /**
     * Create a subtle fade-in starting from 50% opacity.
     *
     * @return self A new FadeInAnimation with initialAlpha of 0.5.
     */
    public static function subtle(): self
    {
        return (new self())->setInitialAlpha(0.5);
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

        if ($this->userControllable !== null) {
            $data['userControllable'] = $this->userControllable;
        }

        return $data;
    }
}

