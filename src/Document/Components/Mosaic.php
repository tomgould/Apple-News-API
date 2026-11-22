<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Mosaic component for multi-image tile layouts.
 *
 * The mosaic component displays multiple images in an attractive tile layout.
 * Images are automatically arranged based on their dimensions and quantity.
 *
 * @see https://developer.apple.com/documentation/apple_news/mosaic
 */
final class Mosaic extends Component
{
    /**
     * The mosaic items (images).
     *
     * @var list<array{URL: string, caption?: string, accessibilityCaption?: string, explicitContent?: bool}>
     */
    private array $items = [];

    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'mosaic';
    }

    /**
     * Add an image to the mosaic.
     *
     * @param string      $url                  The image URL.
     * @param string|null $caption              Optional caption for the image.
     * @param string|null $accessibilityCaption Optional accessibility caption.
     * @param bool|null   $explicitContent      Whether the image contains explicit content.
     *
     * @return $this
     */
    public function addItem(
        string $url,
        ?string $caption = null,
        ?string $accessibilityCaption = null,
        ?bool $explicitContent = null
    ): self {
        $item = ['URL' => $url];

        if ($caption !== null) {
            $item['caption'] = $caption;
        }

        if ($accessibilityCaption !== null) {
            $item['accessibilityCaption'] = $accessibilityCaption;
        }

        if ($explicitContent !== null) {
            $item['explicitContent'] = $explicitContent;
        }

        $this->items[] = $item;
        return $this;
    }

    /**
     * Add an image from a bundle file.
     *
     * @param string      $filename             The filename in the article bundle.
     * @param string|null $caption              Optional caption for the image.
     * @param string|null $accessibilityCaption Optional accessibility caption.
     *
     * @return $this
     */
    public function addBundleItem(
        string $filename,
        ?string $caption = null,
        ?string $accessibilityCaption = null
    ): self {
        return $this->addItem('bundle://' . $filename, $caption, $accessibilityCaption);
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = array_merge(
            ['role' => $this->getRole()],
            $this->getBaseProperties()
        );

        if (!empty($this->items)) {
            $data['items'] = $this->items;
        }

        return $data;
    }
}

