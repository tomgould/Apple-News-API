<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Animations;

/**
 * Appear animation for components.
 *
 * The appear animation causes a component to appear instantly when it
 * enters the viewport. This is the simplest animation type.
 *
 * @see https://developer.apple.com/documentation/apple_news/appearanimation
 */
final class AppearAnimation implements AnimationInterface
{
    /**
     * Whether the animation is controllable by user scroll position.
     */
    private ?bool $userControllable = null;

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return 'appear';
    }

    /**
     * Set whether the animation is user controllable.
     *
     * When true, the animation progress is tied to scroll position,
     * allowing users to scrub back and forth through the animation.
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
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [
            'type' => $this->getType(),
        ];

        if ($this->userControllable !== null) {
            $data['userControllable'] = $this->userControllable;
        }

        return $data;
    }
}

