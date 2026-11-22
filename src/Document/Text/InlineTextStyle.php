<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Text;

use JsonSerializable;

/**
 * Inline text style for specific ranges within text.
 *
 * @see https://developer.apple.com/documentation/apple_news/inlinetextstyle
 */
final class InlineTextStyle implements JsonSerializable
{
    /**
     * The text style (reference or inline definition).
     *
     * @var string|array<string, mixed>|null
     */
    private string|array|null $textStyle = null;

    /**
     * Create a new InlineTextStyle.
     *
     * @param int $rangeStart  The starting position.
     * @param int $rangeLength The length of the range.
     */
    public function __construct(
        private readonly int $rangeStart,
        private readonly int $rangeLength
    ) {
    }

    /**
     * Create an inline style for a range.
     *
     * @param int $start  The starting position.
     * @param int $length The length.
     *
     * @return self A new instance.
     */
    public static function forRange(int $start, int $length): self
    {
        return new self($start, $length);
    }

    /**
     * Set the text style reference.
     *
     * @param string $styleName The text style name.
     *
     * @return $this
     */
    public function withStyle(string $styleName): self
    {
        $this->textStyle = $styleName;
        return $this;
    }

    /**
     * Set an inline text style definition.
     *
     * @param array<string, mixed> $style The style definition.
     *
     * @return $this
     */
    public function withInlineStyle(array $style): self
    {
        $this->textStyle = $style;
        return $this;
    }

    /**
     * Create a bold style for a range.
     *
     * @param int $start  The starting position.
     * @param int $length The length.
     *
     * @return self A new instance.
     */
    public static function bold(int $start, int $length): self
    {
        return (new self($start, $length))
            ->withInlineStyle(['fontWeight' => 'bold']);
    }

    /**
     * Create an italic style for a range.
     *
     * @param int $start  The starting position.
     * @param int $length The length.
     *
     * @return self A new instance.
     */
    public static function italic(int $start, int $length): self
    {
        return (new self($start, $length))
            ->withInlineStyle(['fontStyle' => 'italic']);
    }

    /**
     * Create a colored text style for a range.
     *
     * @param int    $start  The starting position.
     * @param int    $length The length.
     * @param string $color  The text color.
     *
     * @return self A new instance.
     */
    public static function colored(int $start, int $length, string $color): self
    {
        return (new self($start, $length))
            ->withInlineStyle(['textColor' => $color]);
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [
            'rangeStart' => $this->rangeStart,
            'rangeLength' => $this->rangeLength,
        ];

        if ($this->textStyle !== null) {
            $data['textStyle'] = $this->textStyle;
        }

        return $data;
    }
}
