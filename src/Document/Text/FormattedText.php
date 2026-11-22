<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Text;

use JsonSerializable;
use TomGould\AppleNews\Document\Additions\AdditionInterface;

/**
 * Formatted text with styling support.
 *
 * Used for complex text content that requires inline styling,
 * additions, or specific formatting.
 *
 * @see https://developer.apple.com/documentation/apple_news/formattedtext
 */
final class FormattedText implements JsonSerializable
{
    /**
     * Valid format types.
     */
    public const FORMAT_HTML = 'html';
    public const FORMAT_MARKDOWN = 'markdown';
    public const FORMAT_NONE = 'none';

    /**
     * The text format.
     */
    private ?string $format = null;

    /**
     * The text style reference.
     */
    private ?string $textStyle = null;

    /**
     * Inline text styles.
     *
     * @var list<array<string, mixed>>|null
     */
    private ?array $inlineTextStyles = null;

    /**
     * Additions (links, etc.).
     *
     * @var list<AdditionInterface>|null
     */
    private ?array $additions = null;

    /**
     * Create a new FormattedText.
     *
     * @param string $text The text content.
     */
    public function __construct(
        private readonly string $text
    ) {
    }

    /**
     * Create formatted text from plain text.
     *
     * @param string $text The text content.
     *
     * @return self A new instance.
     */
    public static function plain(string $text): self
    {
        return (new self($text))->setFormat(self::FORMAT_NONE);
    }

    /**
     * Create formatted text from HTML.
     *
     * @param string $html The HTML content.
     *
     * @return self A new instance.
     */
    public static function html(string $html): self
    {
        return (new self($html))->setFormat(self::FORMAT_HTML);
    }

    /**
     * Create formatted text from Markdown.
     *
     * @param string $markdown The Markdown content.
     *
     * @return self A new instance.
     */
    public static function markdown(string $markdown): self
    {
        return (new self($markdown))->setFormat(self::FORMAT_MARKDOWN);
    }

    /**
     * Set the text format.
     *
     * @param string $format One of 'html', 'markdown', 'none'.
     *
     * @return $this
     */
    public function setFormat(string $format): self
    {
        $this->format = $format;
        return $this;
    }

    /**
     * Set the text style reference.
     *
     * @param string $textStyle The text style name.
     *
     * @return $this
     */
    public function setTextStyle(string $textStyle): self
    {
        $this->textStyle = $textStyle;
        return $this;
    }

    /**
     * Set inline text styles.
     *
     * @param list<array<string, mixed>> $styles The inline styles.
     *
     * @return $this
     */
    public function setInlineTextStyles(array $styles): self
    {
        $this->inlineTextStyles = $styles;
        return $this;
    }

    /**
     * Add an inline text style.
     *
     * @param int                  $rangeStart  The starting position.
     * @param int                  $rangeLength The length.
     * @param string|array<string, mixed> $textStyle   The text style name or inline definition.
     *
     * @return $this
     */
    public function addInlineTextStyle(int $rangeStart, int $rangeLength, string|array $textStyle): self
    {
        if ($this->inlineTextStyles === null) {
            $this->inlineTextStyles = [];
        }

        $style = [
            'rangeStart' => $rangeStart,
            'rangeLength' => $rangeLength,
        ];

        if (is_string($textStyle)) {
            $style['textStyle'] = $textStyle;
        } else {
            $style['textStyle'] = $textStyle;
        }

        $this->inlineTextStyles[] = $style;
        return $this;
    }

    /**
     * Set additions.
     *
     * @param list<AdditionInterface> $additions The additions.
     *
     * @return $this
     */
    public function setAdditions(array $additions): self
    {
        $this->additions = $additions;
        return $this;
    }

    /**
     * Add an addition.
     *
     * @param AdditionInterface $addition The addition.
     *
     * @return $this
     */
    public function addAddition(AdditionInterface $addition): self
    {
        if ($this->additions === null) {
            $this->additions = [];
        }

        $this->additions[] = $addition;
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [
            'text' => $this->text,
        ];

        if ($this->format !== null) {
            $data['format'] = $this->format;
        }

        if ($this->textStyle !== null) {
            $data['textStyle'] = $this->textStyle;
        }

        if ($this->inlineTextStyles !== null) {
            $data['inlineTextStyles'] = $this->inlineTextStyles;
        }

        if ($this->additions !== null) {
            $data['additions'] = array_map(
                fn(AdditionInterface $a) => $a->jsonSerialize(),
                $this->additions
            );
        }

        return $data;
    }
}

