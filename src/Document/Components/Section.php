<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

use TomGould\AppleNews\Document\Scenes\SceneInterface;

/**
 * Section container component.
 *
 * The section component organizes article content into logical sections.
 * Each section can have its own header and contains other components.
 *
 * @see https://developer.apple.com/documentation/apple_news/section-ka8
 */
class Section extends Container
{
    /**
     * The scene for this section's header area.
     *
     * @var array<string, mixed>|null
     */
    protected ?array $scene = null;

    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'section';
    }

    /**
     * Set the scene for animated header effects using an array.
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
     * Set the scene for animated header effects using a typed Scene object.
     *
     * This method provides type-safe scene configuration:
     * ```php
     * $section->setSceneObject(FadingStickyHeader::fadeToBlack());
     * $section->setSceneObject(new ParallaxScaleHeader());
     * ```
     *
     * @param SceneInterface $scene The scene object.
     *
     * @return $this
     */
    public function setSceneObject(SceneInterface $scene): self
    {
        $this->scene = $scene->jsonSerialize();
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
