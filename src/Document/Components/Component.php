<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

use JsonSerializable;

/**
 * Base class for all Apple News Format components.
 *
 * @see https://developer.apple.com/documentation/apple_news/components
 */
abstract class Component implements JsonSerializable
{
    protected ?string $identifier = null;
    protected ?string $layout = null;
    protected ?string $style = null;
    protected ?string $anchor = null;
    protected ?array $animation = null;
    protected ?array $behavior = null;
    protected bool $hidden = false;
    protected ?array $conditional = null;

    /**
     * Get the component role.
     */
    abstract public function getRole(): string;

    /**
     * Set a unique identifier for this component.
     */
    public function setIdentifier(string $identifier): static
    {
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * Set the layout name or inline layout.
     */
    public function setLayout(string $layout): static
    {
        $this->layout = $layout;
        return $this;
    }

    /**
     * Set the style name.
     */
    public function setStyle(string $style): static
    {
        $this->style = $style;
        return $this;
    }

    /**
     * Set the anchor configuration.
     */
    public function setAnchor(string $anchor): static
    {
        $this->anchor = $anchor;
        return $this;
    }

    /**
     * Set component animation.
     *
     * @param array<string, mixed> $animation
     */
    public function setAnimation(array $animation): static
    {
        $this->animation = $animation;
        return $this;
    }

    /**
     * Set component behavior.
     *
     * @param array<string, mixed> $behavior
     */
    public function setBehavior(array $behavior): static
    {
        $this->behavior = $behavior;
        return $this;
    }

    /**
     * Set whether the component is hidden.
     */
    public function setHidden(bool $hidden): static
    {
        $this->hidden = $hidden;
        return $this;
    }

    /**
     * Set conditional properties.
     *
     * @param array<string, mixed> $conditional
     */
    public function setConditional(array $conditional): static
    {
        $this->conditional = $conditional;
        return $this;
    }

    /**
     * Get base component properties.
     *
     * @return array<string, mixed>
     */
    protected function getBaseProperties(): array
    {
        $data = ['role' => $this->getRole()];

        if ($this->identifier !== null) {
            $data['identifier'] = $this->identifier;
        }

        if ($this->layout !== null) {
            $data['layout'] = $this->layout;
        }

        if ($this->style !== null) {
            $data['style'] = $this->style;
        }

        if ($this->anchor !== null) {
            $data['anchor'] = $this->anchor;
        }

        if ($this->animation !== null) {
            $data['animation'] = $this->animation;
        }

        if ($this->behavior !== null) {
            $data['behavior'] = $this->behavior;
        }

        if ($this->hidden) {
            $data['hidden'] = true;
        }

        if ($this->conditional !== null) {
            $data['conditional'] = $this->conditional;
        }

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->getBaseProperties();
    }
}
