<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document;

use TomGould\AppleNews\Document\Components\Component;
use TomGould\AppleNews\Document\Layouts\Layout;
use TomGould\AppleNews\Document\Styles\ComponentTextStyle;
use TomGould\AppleNews\Document\Styles\DocumentStyle;
use JsonSerializable;

/**
 * Represents an Apple News Format article document.
 *
 * This is the root object that contains all article content, layout, and styles.
 *
 * @see https://developer.apple.com/documentation/apple_news/articledocument
 */
final class Article implements JsonSerializable
{
    private const CURRENT_VERSION = '1.24';

    /** @var array<Component> */
    private array $components = [];

    /** @var array<string, mixed> */
    private array $componentLayouts = [];

    /** @var array<string, ComponentTextStyle> */
    private array $componentTextStyles = [];

    /** @var array<string, mixed> */
    private array $componentStyles = [];

    private ?Metadata $metadata = null;
    private ?DocumentStyle $documentStyle = null;

    /** @var array<string, mixed> */
    private array $autoplacement = [];

    public function __construct(
        private readonly string $identifier,
        private readonly string $title,
        private readonly string $language,
        private readonly Layout $layout,
        private readonly string $version = self::CURRENT_VERSION
    ) {
    }

    /**
     * Create a new article with default layout.
     */
    public static function create(
        string $identifier,
        string $title,
        string $language = 'en',
        int $columns = 7,
        int $width = 1024
    ): self {
        return new self(
            $identifier,
            $title,
            $language,
            new Layout($columns, $width)
        );
    }

    /**
     * Add a component to the article.
     */
    public function addComponent(Component $component): self
    {
        $this->components[] = $component;
        return $this;
    }

    /**
     * Add multiple components.
     *
     * @param array<Component> $components
     */
    public function addComponents(array $components): self
    {
        foreach ($components as $component) {
            $this->addComponent($component);
        }
        return $this;
    }

    /**
     * Add a named component layout.
     *
     * @param array<string, mixed> $layout
     */
    public function addComponentLayout(string $name, array $layout): self
    {
        $this->componentLayouts[$name] = $layout;
        return $this;
    }

    /**
     * Add a named component text style.
     */
    public function addComponentTextStyle(string $name, ComponentTextStyle $style): self
    {
        $this->componentTextStyles[$name] = $style;
        return $this;
    }

    /**
     * Add a named component style.
     *
     * @param array<string, mixed> $style
     */
    public function addComponentStyle(string $name, array $style): self
    {
        $this->componentStyles[$name] = $style;
        return $this;
    }

    /**
     * Set the article metadata.
     */
    public function setMetadata(Metadata $metadata): self
    {
        $this->metadata = $metadata;
        return $this;
    }

    /**
     * Set the document style.
     */
    public function setDocumentStyle(DocumentStyle $style): self
    {
        $this->documentStyle = $style;
        return $this;
    }

    /**
     * Set autoplacement configuration.
     *
     * @param array<string, mixed> $autoplacement
     */
    public function setAutoplacement(array $autoplacement): self
    {
        $this->autoplacement = $autoplacement;
        return $this;
    }

    /**
     * Get the article identifier.
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * Get the article title.
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Get all components.
     *
     * @return array<Component>
     */
    public function getComponents(): array
    {
        return $this->components;
    }

    /**
     * Convert to JSON string.
     */
    public function toJson(int $flags = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES): string
    {
        return json_encode($this, $flags | JSON_THROW_ON_ERROR);
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [
            'version' => $this->version,
            'identifier' => $this->identifier,
            'title' => $this->title,
            'language' => $this->language,
            'layout' => $this->layout,
            'components' => array_map(
                fn(Component $c) => $c->jsonSerialize(),
                $this->components
            ),
        ];

        if ($this->metadata !== null) {
            $data['metadata'] = $this->metadata;
        }

        if ($this->documentStyle !== null) {
            $data['documentStyle'] = $this->documentStyle;
        }

        if (!empty($this->componentLayouts)) {
            $data['componentLayouts'] = $this->componentLayouts;
        }

        if (!empty($this->componentTextStyles)) {
            $data['componentTextStyles'] = array_map(
                fn(ComponentTextStyle $s) => $s->jsonSerialize(),
                $this->componentTextStyles
            );
        }

        if (!empty($this->componentStyles)) {
            $data['componentStyles'] = $this->componentStyles;
        }

        if (!empty($this->autoplacement)) {
            $data['autoplacement'] = $this->autoplacement;
        }

        return $data;
    }
}
