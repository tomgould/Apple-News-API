<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

use TomGould\AppleNews\Document\Additions\AdditionInterface;

/**
 * Base class for all components that primarily contain text content.
 *
 * @see https://developer.apple.com/documentation/applenewsformat/text
 */
abstract class TextComponent extends Component
{
    /** @var string|null Reference to a named text style. */
    protected ?string $textStyle = null;

    /** @var array<array<string, mixed>>|null Inline style overrides. */
    protected ?array $inlineTextStyles = null;

    /** @var string|null The text format (none, html, markdown). */
    protected ?string $format = null;

    /**
     * @param string $text The raw text content.
     */
    public function __construct(
        protected readonly string $text
    ) {
    }

    /**
     * Set the text style name.
     * @param string $textStyle
     * @return static
     */
    public function setTextStyle(string $textStyle): static
    {
        $this->textStyle = $textStyle;
        return $this;
    }

    /**
     * Get the text style name.
     * @return string|null The name set with setTextStyle(), or null.
     */
    public function getTextStyle(): ?string
    {
        return $this->textStyle;
    }

    /**
     * Define specific styles for ranges of text within this component.
     * @param array<array<string, mixed>> $styles
     * @return static
     */
    public function setInlineTextStyles(array $styles): static
    {
        $this->inlineTextStyles = $styles;
        return $this;
    }

    /**
     * Set the format of the text content ('html' or 'markdown').
     * @param string $format
     * @return static
     */
    public function setFormat(string $format): static
    {
        $this->format = $format;
        return $this;
    }

    /**
     * Set additions (link ranges) for the text component.
     *
     * Additions allow you to apply links to specific ranges of text.
     * Note: Additions are not supported when format is 'html' or 'markdown'.
     *
     * Each addition is an array (with type, URL, rangeStart and rangeLength)
     * or an AdditionInterface object such as LinkAddition. Objects are stored
     * serialized; arrays are kept as given.
     *
     * @param array<int, array<string, mixed>|AdditionInterface> $additions The additions.
     * @return static
     * @see https://developer.apple.com/documentation/applenewsformat/addition
     */
    public function setAdditions(array $additions): static
    {
        $this->additions = array_map(
            static fn(mixed $addition): mixed => $addition instanceof AdditionInterface
                ? $addition->jsonSerialize()
                : $addition,
            $additions
        );
        return $this;
    }

    /**
     * Text components take link ranges through their own setAdditions().
     *
     * @return bool
     */
    protected function supportsComponentLink(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = $this->getBaseProperties();
        // Additions stay after the text properties, as before 2.2.1.
        unset($data['additions']);
        $data['text'] = $this->text;

        if ($this->textStyle !== null) {
            $data['textStyle'] = $this->textStyle;
        }

        if ($this->inlineTextStyles !== null) {
            $data['inlineTextStyles'] = $this->inlineTextStyles;
        }

        if ($this->format !== null) {
            $data['format'] = $this->format;
        }

        if ($this->additions !== null) {
            $data['additions'] = $this->additions;
        }

        return $data;
    }
}
