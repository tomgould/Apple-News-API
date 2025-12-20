<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document;

use DateTimeInterface;
use JsonSerializable;

/**
 * Article metadata for Apple News Format.
 *
 * @see https://developer.apple.com/documentation/apple_news/metadata
 */
final class Metadata implements JsonSerializable
{
    /** @var array<string> */
    private array $authors = [];

    private ?string $canonicalURL = null;
    private ?string $dateCreated = null;
    private ?string $dateModified = null;
    private ?string $datePublished = null;
    private ?string $excerpt = null;
    private ?string $generatorIdentifier = null;
    private ?string $generatorName = null;
    private ?string $generatorVersion = null;

    /** @var array<string> */
    private array $keywords = [];

    /** @var array<array<string, string>> */
    private array $links = [];

    private ?string $thumbnailURL = null;
    private ?bool $transparentToolbar = null;
    private ?string $videoURL = null;

    /**
     * Add an author.
     */
    public function addAuthor(string $author): self
    {
        $this->authors[] = $author;
        return $this;
    }

    /**
     * Set the canonical URL.
     */
    public function setCanonicalURL(string $url): self
    {
        $this->canonicalURL = $url;
        return $this;
    }

    /**
     * Set the date created.
     */
    public function setDateCreated(DateTimeInterface|string $date): self
    {
        $this->dateCreated = $date instanceof DateTimeInterface
            ? $date->format('c')
            : $date;
        return $this;
    }

    /**
     * Set the date modified.
     */
    public function setDateModified(DateTimeInterface|string $date): self
    {
        $this->dateModified = $date instanceof DateTimeInterface
            ? $date->format('c')
            : $date;
        return $this;
    }

    /**
     * Set the date published.
     */
    public function setDatePublished(DateTimeInterface|string $date): self
    {
        $this->datePublished = $date instanceof DateTimeInterface
            ? $date->format('c')
            : $date;
        return $this;
    }

    /**
     * Set the excerpt.
     */
    public function setExcerpt(string $excerpt): self
    {
        $this->excerpt = $excerpt;
        return $this;
    }

    /**
     * Set the generator identifier.
     */
    public function setGeneratorIdentifier(string $identifier): self
    {
        $this->generatorIdentifier = $identifier;
        return $this;
    }

    /**
     * Set the generator name.
     */
    public function setGeneratorName(string $name): self
    {
        $this->generatorName = $name;
        return $this;
    }

    /**
     * Set the generator version.
     */
    public function setGeneratorVersion(string $version): self
    {
        $this->generatorVersion = $version;
        return $this;
    }

    /**
     * Add a keyword.
     */
    public function addKeyword(string $keyword): self
    {
        $this->keywords[] = $keyword;
        return $this;
    }

    /**
     * Add multiple keywords.
     *
     * @param array<string> $keywords
     */
    public function addKeywords(array $keywords): self
    {
        foreach ($keywords as $keyword) {
            $this->addKeyword($keyword);
        }
        return $this;
    }

    /**
     * Add a linked article.
     */
    public function addLinkedArticle(string $url, string $relationship): self
    {
        $this->links[] = [
            'URL' => $url,
            'relationship' => $relationship,
        ];
        return $this;
    }

    /**
     * Set the thumbnail URL.
     */
    public function setThumbnailURL(string $url): self
    {
        $this->thumbnailURL = $url;
        return $this;
    }

    /**
     * Set transparent toolbar.
     */
    public function setTransparentToolbar(bool $transparent): self
    {
        $this->transparentToolbar = $transparent;
        return $this;
    }

    /**
     * Set the video URL for the article tile.
     */
    public function setVideoURL(string $url): self
    {
        $this->videoURL = $url;
        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if (!empty($this->authors)) {
            $data['authors'] = $this->authors;
        }

        if ($this->canonicalURL !== null) {
            $data['canonicalURL'] = $this->canonicalURL;
        }

        if ($this->dateCreated !== null) {
            $data['dateCreated'] = $this->dateCreated;
        }

        if ($this->dateModified !== null) {
            $data['dateModified'] = $this->dateModified;
        }

        if ($this->datePublished !== null) {
            $data['datePublished'] = $this->datePublished;
        }

        if ($this->excerpt !== null) {
            $data['excerpt'] = $this->excerpt;
        }

        if ($this->generatorIdentifier !== null) {
            $data['generatorIdentifier'] = $this->generatorIdentifier;
        }

        if ($this->generatorName !== null) {
            $data['generatorName'] = $this->generatorName;
        }

        if ($this->generatorVersion !== null) {
            $data['generatorVersion'] = $this->generatorVersion;
        }

        if (!empty($this->keywords)) {
            $data['keywords'] = $this->keywords;
        }

        if (!empty($this->links)) {
            $data['links'] = $this->links;
        }

        if ($this->thumbnailURL !== null) {
            $data['thumbnailURL'] = $this->thumbnailURL;
        }

        if ($this->transparentToolbar !== null) {
            $data['transparentToolbar'] = $this->transparentToolbar;
        }

        if ($this->videoURL !== null) {
            $data['videoURL'] = $this->videoURL;
        }

        return $data;
    }
}
