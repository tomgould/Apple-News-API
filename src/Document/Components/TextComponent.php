<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Base class for text-based components.
 *
 * @see https://developer.apple.com/documentation/apple_news/text-2
 */
abstract class TextComponent extends Component
{
    protected ?string $textStyle = null;
    protected ?array $inlineTextStyles = null;
    protected ?string $format = null;

    public function __construct(
        protected readonly string $text
    ) {
    }

    /**
     * Set the text style name.
     */
    public function setTextStyle(string $textStyle): static
    {
        $this->textStyle = $textStyle;
        return $this;
    }

    /**
     * Set inline text styles.
     *
     * @param array<array<string, mixed>> $styles
     */
    public function setInlineTextStyles(array $styles): static
    {
        $this->inlineTextStyles = $styles;
        return $this;
    }

    /**
     * Set the text format (none, html, markdown).
     */
    public function setFormat(string $format): static
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = $this->getBaseProperties();
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

        return $data;
    }
}
