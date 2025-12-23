<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Chapter container component.
 *
 * The chapter component organizes article content into chapters,
 * similar to sections but intended for longer-form content like books
 * or multi-part articles.
 *
 * @see https://developer.apple.com/documentation/apple_news/chapter
 */
class Chapter extends Container
{
    /**
     * The scene for this chapter's header area.
     *
     * @var array<string, mixed>|null
     */
    protected ?array $scene = null;

    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'chapter';
    }

    /**
     * Set the scene for animated header effects.
     *
     * @param array<string, mixed> $scene The scene configuration.
     *
     * @return $this
     */
    public function setScene(array $scene): self
    {
        $this->scene = $scene;
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->scene !== null) {
            $data['scene'] = $this->scene;
        }

        return $data;
    }
}

