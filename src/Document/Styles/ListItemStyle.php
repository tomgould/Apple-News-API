<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles;

use JsonSerializable;

/**
 * Style for bullet or numbered list items.
 *
 * @see https://developer.apple.com/documentation/apple_news/listitemstyle
 */
final class ListItemStyle implements JsonSerializable
{
    /**
     * Valid list types.
     */
    public const TYPE_BULLET = 'bullet';
    public const TYPE_DECIMAL = 'decimal';
    public const TYPE_LOWER_ALPHA = 'lower_alphabetical';
    public const TYPE_UPPER_ALPHA = 'upper_alphabetical';
    public const TYPE_LOWER_ROMAN = 'lower_roman';
    public const TYPE_UPPER_ROMAN = 'upper_roman';
    public const TYPE_CHARACTER = 'character';
    public const TYPE_NONE = 'none';

    /**
     * The list type.
     */
    private ?string $type = null;

    /**
     * Custom character for character type.
     */
    private ?string $character = null;

    /**
     * Set the list type.
     *
     * @param string $type The list type.
     *
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Set a custom character for bullet.
     *
     * @param string $character The character to use.
     *
     * @return $this
     */
    public function setCharacter(string $character): self
    {
        $this->character = $character;
        $this->type = self::TYPE_CHARACTER;
        return $this;
    }

    /**
     * Create a bullet list style.
     *
     * @return self A new instance.
     */
    public static function bullet(): self
    {
        return (new self())->setType(self::TYPE_BULLET);
    }

    /**
     * Create a numbered list style.
     *
     * @return self A new instance.
     */
    public static function decimal(): self
    {
        return (new self())->setType(self::TYPE_DECIMAL);
    }

    /**
     * Create a lower alpha list style (a, b, c...).
     *
     * @return self A new instance.
     */
    public static function lowerAlpha(): self
    {
        return (new self())->setType(self::TYPE_LOWER_ALPHA);
    }

    /**
     * Create an upper alpha list style (A, B, C...).
     *
     * @return self A new instance.
     */
    public static function upperAlpha(): self
    {
        return (new self())->setType(self::TYPE_UPPER_ALPHA);
    }

    /**
     * Create a lower roman list style (i, ii, iii...).
     *
     * @return self A new instance.
     */
    public static function lowerRoman(): self
    {
        return (new self())->setType(self::TYPE_LOWER_ROMAN);
    }

    /**
     * Create an upper roman list style (I, II, III...).
     *
     * @return self A new instance.
     */
    public static function upperRoman(): self
    {
        return (new self())->setType(self::TYPE_UPPER_ROMAN);
    }

    /**
     * Create a custom character list style.
     *
     * @param string $char The character to use.
     *
     * @return self A new instance.
     */
    public static function withCharacter(string $char): self
    {
        return (new self())->setCharacter($char);
    }

    /**
     * Create a no-bullet list style.
     *
     * @return self A new instance.
     */
    public static function none(): self
    {
        return (new self())->setType(self::TYPE_NONE);
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->type !== null) {
            $data['type'] = $this->type;
        }

        if ($this->character !== null) {
            $data['character'] = $this->character;
        }

        return $data;
    }
}

