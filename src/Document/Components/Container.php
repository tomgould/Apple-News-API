<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Container component for grouping other components.
 *
 * @see https://developer.apple.com/documentation/apple_news/container
 */
class Container extends Component
{
    /** @var array<Component> */
    protected array $components = [];

    protected ?string $contentDisplay = null;

    public function getRole(): string
    {
        return 'container';
    }

    /**
     * Add a component to the container.
     */
    public function addComponent(Component $component): self
    {
        $this->components[] = $component;
        return $this;
    }

    /**
     * Set content display mode.
     */
    public function setContentDisplay(string $contentDisplay): self
    {
        $this->contentDisplay = $contentDisplay;
        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = $this->getBaseProperties();

        if (!empty($this->components)) {
            $data['components'] = array_map(
                fn(Component $c) => $c->jsonSerialize(),
                $this->components
            );
        }

        if ($this->contentDisplay !== null) {
            $data['contentDisplay'] = $this->contentDisplay;
        }

        return $data;
    }
}
