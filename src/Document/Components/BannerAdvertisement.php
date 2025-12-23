<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Banner advertisement component.
 *
 * The banner_advertisement component reserves space for a banner ad
 * that Apple News will fill based on available inventory.
 *
 * @see https://developer.apple.com/documentation/apple_news/banneradvertisement
 */
final class BannerAdvertisement extends Component
{
    /**
     * The banner type (standard, double_height, large).
     */
    private ?string $bannerType = null;

    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'banner_advertisement';
    }

    /**
     * Set the banner type.
     *
     * @param string $bannerType The banner type ('standard', 'double_height', 'large').
     *
     * @return $this
     */
    public function setBannerType(string $bannerType): self
    {
        $this->bannerType = $bannerType;
        return $this;
    }

    /**
     * Set the banner type to standard.
     *
     * @return $this
     */
    public function asStandard(): self
    {
        $this->bannerType = 'standard';
        return $this;
    }

    /**
     * Set the banner type to double height.
     *
     * @return $this
     */
    public function asDoubleHeight(): self
    {
        $this->bannerType = 'double_height';
        return $this;
    }

    /**
     * Set the banner type to large.
     *
     * @return $this
     */
    public function asLarge(): self
    {
        $this->bannerType = 'large';
        return $this;
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

        if ($this->bannerType !== null) {
            $data['bannerType'] = $this->bannerType;
        }

        return $data;
    }
}

