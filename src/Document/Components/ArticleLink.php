<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Article link component.
 *
 * The article_link component creates a link to another Apple News article.
 * It displays a rich preview of the linked article including its thumbnail,
 * title, and excerpt.
 *
 * @see https://developer.apple.com/documentation/apple_news/articlelink
 */
final class ArticleLink extends Component
{
    /**
     * Create a new ArticleLink component.
     *
     * @param string $articleIdentifier The unique identifier of the article to link to.
     */
    public function __construct(
        private readonly string $articleIdentifier
    ) {
    }

    /**
     * Create an ArticleLink from an article ID.
     *
     * @param string $articleId The Apple News article ID.
     *
     * @return self A new ArticleLink instance.
     */
    public static function fromArticleId(string $articleId): self
    {
        return new self($articleId);
    }

    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'article_link';
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return array_merge(
            ['role' => $this->getRole()],
            $this->getBaseProperties(),
            ['articleIdentifier' => $this->articleIdentifier]
        );
    }
}

