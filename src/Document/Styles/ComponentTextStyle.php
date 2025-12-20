<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles;

use JsonSerializable;

/**
 * Text styles for components in Apple News Format.
 *
 * @see https://developer.apple.com/documentation/apple_news/componenttextstyle
 */
final class ComponentTextStyle implements JsonSerializable
{
    private ?string $fontName = null;
    private ?int $fontSize = null;
    private ?string $textColor = null;
    private ?string $textAlignment = null;
    private ?float $lineHeight = null;
    private ?float $tracking = null;
    private ?bool $hyphenation = null;
    private ?string $fontWeight = null;
    private ?string $fontStyle = null;
    private ?string $textDecoration = null;
    private ?string $textTransform = null;
    private ?array $linkStyle = null;
    private ?array $dropCapStyle = null;
    private ?string $backgroundColor = null;
    private ?array $textShadow = null;
    private ?int $paragraphSpacingBefore = null;
    private ?int $paragraphSpacingAfter = null;
    private ?int $firstLineIndent = null;
    private ?int $hangingPunctuation = null;

    /**
     * Set the font name.
     */
    public function setFontName(string $fontName): self
    {
        $this->fontName = $fontName;
        return $this;
    }

    /**
     * Set the font size.
     */
    public function setFontSize(int $fontSize): self
    {
        $this->fontSize = $fontSize;
        return $this;
    }

    /**
     * Set the text color.
     */
    public function setTextColor(string $color): self
    {
        $this->textColor = $color;
        return $this;
    }

    /**
     * Set the text alignment.
     */
    public function setTextAlignment(string $alignment): self
    {
        $this->textAlignment = $alignment;
        return $this;
    }

    /**
     * Set the line height.
     */
    public function setLineHeight(float $lineHeight): self
    {
        $this->lineHeight = $lineHeight;
        return $this;
    }

    /**
     * Set the letter spacing (tracking).
     */
    public function setTracking(float $tracking): self
    {
        $this->tracking = $tracking;
        return $this;
    }

    /**
     * Enable or disable hyphenation.
     */
    public function setHyphenation(bool $hyphenation): self
    {
        $this->hyphenation = $hyphenation;
        return $this;
    }

    /**
     * Set the font weight.
     */
    public function setFontWeight(string $weight): self
    {
        $this->fontWeight = $weight;
        return $this;
    }

    /**
     * Set the font style (normal, italic, oblique).
     */
    public function setFontStyle(string $style): self
    {
        $this->fontStyle = $style;
        return $this;
    }

    /**
     * Set text decoration (underline, line-through).
     */
    public function setTextDecoration(string $decoration): self
    {
        $this->textDecoration = $decoration;
        return $this;
    }

    /**
     * Set text transform (uppercase, lowercase, capitalize).
     */
    public function setTextTransform(string $transform): self
    {
        $this->textTransform = $transform;
        return $this;
    }

    /**
     * Set the link style.
     *
     * @param array<string, mixed> $style
     */
    public function setLinkStyle(array $style): self
    {
        $this->linkStyle = $style;
        return $this;
    }

    /**
     * Set the drop cap style.
     *
     * @param array<string, mixed> $style
     */
    public function setDropCapStyle(array $style): self
    {
        $this->dropCapStyle = $style;
        return $this;
    }

    /**
     * Set the background color.
     */
    public function setBackgroundColor(string $color): self
    {
        $this->backgroundColor = $color;
        return $this;
    }

    /**
     * Set the text shadow.
     *
     * @param array<string, mixed> $shadow
     */
    public function setTextShadow(array $shadow): self
    {
        $this->textShadow = $shadow;
        return $this;
    }

    /**
     * Set paragraph spacing before.
     */
    public function setParagraphSpacingBefore(int $spacing): self
    {
        $this->paragraphSpacingBefore = $spacing;
        return $this;
    }

    /**
     * Set paragraph spacing after.
     */
    public function setParagraphSpacingAfter(int $spacing): self
    {
        $this->paragraphSpacingAfter = $spacing;
        return $this;
    }

    /**
     * Set first line indent.
     */
    public function setFirstLineIndent(int $indent): self
    {
        $this->firstLineIndent = $indent;
        return $this;
    }

    /**
     * Set hanging punctuation.
     */
    public function setHangingPunctuation(int $value): self
    {
        $this->hangingPunctuation = $value;
        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->fontName !== null) {
            $data['fontName'] = $this->fontName;
        }

        if ($this->fontSize !== null) {
            $data['fontSize'] = $this->fontSize;
        }

        if ($this->textColor !== null) {
            $data['textColor'] = $this->textColor;
        }

        if ($this->textAlignment !== null) {
            $data['textAlignment'] = $this->textAlignment;
        }

        if ($this->lineHeight !== null) {
            $data['lineHeight'] = $this->lineHeight;
        }

        if ($this->tracking !== null) {
            $data['tracking'] = $this->tracking;
        }

        if ($this->hyphenation !== null) {
            $data['hyphenation'] = $this->hyphenation;
        }

        if ($this->fontWeight !== null) {
            $data['fontWeight'] = $this->fontWeight;
        }

        if ($this->fontStyle !== null) {
            $data['fontStyle'] = $this->fontStyle;
        }

        if ($this->textDecoration !== null) {
            $data['textDecoration'] = $this->textDecoration;
        }

        if ($this->textTransform !== null) {
            $data['textTransform'] = $this->textTransform;
        }

        if ($this->linkStyle !== null) {
            $data['linkStyle'] = $this->linkStyle;
        }

        if ($this->dropCapStyle !== null) {
            $data['dropCapStyle'] = $this->dropCapStyle;
        }

        if ($this->backgroundColor !== null) {
            $data['backgroundColor'] = $this->backgroundColor;
        }

        if ($this->textShadow !== null) {
            $data['textShadow'] = $this->textShadow;
        }

        if ($this->paragraphSpacingBefore !== null) {
            $data['paragraphSpacingBefore'] = $this->paragraphSpacingBefore;
        }

        if ($this->paragraphSpacingAfter !== null) {
            $data['paragraphSpacingAfter'] = $this->paragraphSpacingAfter;
        }

        if ($this->firstLineIndent !== null) {
            $data['firstLineIndent'] = $this->firstLineIndent;
        }

        if ($this->hangingPunctuation !== null) {
            $data['hangingPunctuation'] = $this->hangingPunctuation;
        }

        return $data;
    }
}
