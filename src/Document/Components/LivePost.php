<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

use InvalidArgumentException;

/**
 * Live Coverage post component.
 *
 * The live_post component represents one update inside a LiveContainer. It
 * can hold any other component (text, photos, embeds, etc.) but not another
 * LivePost or a LiveContainer. Each post needs an identifier unique within
 * the article.
 *
 * Usage:
 * ```php
 * $post = (new LivePost('post-1'))
 *     ->addComponent(new Body('Updated at 13:50'))
 *     ->addComponent(new Tweet('https://twitter.com/example/status/1234567890'));
 * ```
 *
 * @see LiveContainer
 */
final class LivePost extends Container
{
    /**
     * Create a new LivePost component.
     *
     * @param string $identifier Identifier for the post, unique across the article.
     *
     * @throws InvalidArgumentException If the identifier is empty.
     */
    public function __construct(string $identifier)
    {
        $this->setIdentifier($identifier);
    }

    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'live_post';
    }

    /**
     * Set the identifier for this post.
     *
     * Apple requires an identifier on every live_post, so an empty string
     * is rejected.
     *
     * @param string $identifier Identifier, unique across the article.
     *
     * @return static
     *
     * @throws InvalidArgumentException If the identifier is empty.
     */
    public function setIdentifier(string $identifier): static
    {
        if ($identifier === '') {
            throw new InvalidArgumentException('LivePost requires a non-empty identifier');
        }

        return parent::setIdentifier($identifier);
    }

    /**
     * Add a child component to this post.
     *
     * Only direct children are checked: a LivePost inside a nested
     * Container is not detected here.
     *
     * @param Component $component Any component except LivePost or LiveContainer.
     *
     * @return self
     *
     * @throws InvalidArgumentException If the component is a LivePost or LiveContainer.
     */
    public function addComponent(Component $component): self
    {
        if ($component instanceof LivePost || $component instanceof LiveContainer) {
            throw new InvalidArgumentException(
                'LivePost cannot contain another LivePost or LiveContainer'
            );
        }

        parent::addComponent($component);
        return $this;
    }
}
