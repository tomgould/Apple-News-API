<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

use InvalidArgumentException;

/**
 * Live Coverage container component.
 *
 * The live_container component holds the live_post updates of a Live
 * Coverage article and displays them in real time. It may only contain
 * LivePost components and needs an identifier unique within the article.
 *
 * Apple must enable Live Coverage for the channel. Publish the article with
 * ArticleMetadata::setLiveCoverageState(LiveCoverageState::LIVE).
 *
 * Usage:
 * ```php
 * $live = (new LiveContainer('live-coverage'))
 *     ->addComponent(
 *         (new LivePost('post-2'))
 *             ->addComponent(new Body('Updated at 13:50'))
 *             ->addComponent(new Body('Latest update text.'))
 *     );
 * ```
 */
final class LiveContainer extends Container
{
    /**
     * Create a new LiveContainer component.
     *
     * @param string $identifier Identifier for the container, unique across the article.
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
        return 'live_container';
    }

    /**
     * Set the identifier for this container.
     *
     * Apple requires an identifier on every live_container, so an empty
     * string is rejected.
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
            throw new InvalidArgumentException('LiveContainer requires a non-empty identifier');
        }

        return parent::setIdentifier($identifier);
    }

    /**
     * Add a live post to this container.
     *
     * Posts are rendered in the order they are added. Apple expects reverse
     * chronological order, so add the newest post first.
     *
     * @param Component $component The LivePost to add.
     *
     * @return self
     *
     * @throws InvalidArgumentException If the component is not a LivePost.
     */
    public function addComponent(Component $component): self
    {
        if (!$component instanceof LivePost) {
            throw new InvalidArgumentException(
                'LiveContainer can only contain LivePost components, got ' . $component::class
            );
        }

        parent::addComponent($component);
        return $this;
    }
}
