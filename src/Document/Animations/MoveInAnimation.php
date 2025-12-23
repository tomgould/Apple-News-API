<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Animations;

/**
 * Move-in animation for components.
 *
 * The move_in animation causes a component to slide into view from
 * a specified direction when it enters the viewport.
 *
 * @see https://developer.apple.com/documentation/apple_news/moveinanimation
 */
final class MoveInAnimation implements AnimationInterface
{
    /**
     * Valid preferred starting positions.
     */
    public const POSITION_LEFT = 'left';
    public const POSITION_RIGHT = 'right';
    public const POSITION_TOP = 'top';
    public const POSITION_BOTTOM = 'bottom';

    /**
     * The direction from which the component moves in.
     */
    private ?string $preferredStartingPosition = null;

    /**
     * Whether the animation is controllable by user scroll position.
     */
    private ?bool $userControllable = null;

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return 'move_in';
    }

    /**
     * Set the preferred starting position (direction).
     *
     * @param string $position One of 'left', 'right', 'top', 'bottom'.
     *
     * @return $this
     */
    public function setPreferredStartingPosition(string $position): self
    {
        $this->preferredStartingPosition = $position;
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
     * Create a MoveInAnimation from the left.
     *
     * @return self A new MoveInAnimation instance.
     */
    public static function fromLeft(): self
    {
        return (new self())->setPreferredStartingPosition(self::POSITION_LEFT);
    }

    /**
     * Create a MoveInAnimation from the right.
     *
     * @return self A new MoveInAnimation instance.
     */
    public static function fromRight(): self
    {
        return (new self())->setPreferredStartingPosition(self::POSITION_RIGHT);
    }

    /**
     * Create a MoveInAnimation from the top.
     *
     * @return self A new MoveInAnimation instance.
     */
    public static function fromTop(): self
    {
        return (new self())->setPreferredStartingPosition(self::POSITION_TOP);
    }

    /**
     * Create a MoveInAnimation from the bottom.
     *
     * @return self A new MoveInAnimation instance.
     */
    public static function fromBottom(): self
    {
        return (new self())->setPreferredStartingPosition(self::POSITION_BOTTOM);
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

        if ($this->preferredStartingPosition !== null) {
            $data['preferredStartingPosition'] = $this->preferredStartingPosition;
        }

        if ($this->userControllable !== null) {
            $data['userControllable'] = $this->userControllable;
        }

        return $data;
    }
}

