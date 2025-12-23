<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Components;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Components\ARKit;
use TomGould\AppleNews\Document\Components\BannerAdvertisement;
use TomGould\AppleNews\Document\Components\MediumRectangleAdvertisement;
use TomGould\AppleNews\Document\Components\ReplicaAdvertisement;
use TomGould\AppleNews\Document\Components\TikTok;

final class SpecialComponentsTest extends TestCase
{
    public function testARKitComponent(): void
    {
        $arkit = new ARKit('https://example.com/model.usdz');

        $data = $arkit->jsonSerialize();

        $this->assertSame('arkit', $data['role']);
        $this->assertSame('https://example.com/model.usdz', $data['URL']);
    }

    public function testARKitFromUrl(): void
    {
        $arkit = ARKit::fromUrl('https://example.com/chair.usdz');

        $data = $arkit->jsonSerialize();

        $this->assertSame('arkit', $data['role']);
    }

    public function testARKitFromBundle(): void
    {
        $arkit = ARKit::fromBundle('product.usdz');

        $data = $arkit->jsonSerialize();

        $this->assertSame('bundle://product.usdz', $data['URL']);
    }

    public function testARKitWithCaptions(): void
    {
        $arkit = (new ARKit('https://example.com/model.usdz'))
            ->setCaption('Interactive 3D Model')
            ->setAccessibilityCaption('3D model of a chair');

        $data = $arkit->jsonSerialize();

        $this->assertSame('Interactive 3D Model', $data['caption']);
        $this->assertSame('3D model of a chair', $data['accessibilityCaption']);
    }

    public function testTikTokComponent(): void
    {
        $tiktok = new TikTok('https://www.tiktok.com/@user/video/123');

        $data = $tiktok->jsonSerialize();

        $this->assertSame('tiktok', $data['role']);
        $this->assertSame('https://www.tiktok.com/@user/video/123', $data['URL']);
    }

    public function testTikTokFromUrl(): void
    {
        $tiktok = TikTok::fromUrl('https://www.tiktok.com/@creator/video/456');

        $data = $tiktok->jsonSerialize();

        $this->assertSame('tiktok', $data['role']);
    }

    public function testBannerAdvertisementComponent(): void
    {
        $banner = new BannerAdvertisement();

        $data = $banner->jsonSerialize();

        $this->assertSame('banner_advertisement', $data['role']);
    }

    public function testBannerAdvertisementWithType(): void
    {
        $banner = (new BannerAdvertisement())
            ->setBannerType('double_height');

        $data = $banner->jsonSerialize();

        $this->assertSame('double_height', $data['bannerType']);
    }

    public function testBannerAdvertisementConvenienceMethods(): void
    {
        $standard = (new BannerAdvertisement())->asStandard();
        $double = (new BannerAdvertisement())->asDoubleHeight();
        $large = (new BannerAdvertisement())->asLarge();

        $this->assertSame('standard', $standard->jsonSerialize()['bannerType']);
        $this->assertSame('double_height', $double->jsonSerialize()['bannerType']);
        $this->assertSame('large', $large->jsonSerialize()['bannerType']);
    }

    public function testMediumRectangleAdvertisementComponent(): void
    {
        $mrec = new MediumRectangleAdvertisement();

        $data = $mrec->jsonSerialize();

        $this->assertSame('medium_rectangle_advertisement', $data['role']);
    }

    public function testMediumRectangleAdvertisementWithLayout(): void
    {
        $mrec = (new MediumRectangleAdvertisement())
            ->setIdentifier('mrec-1')
            ->setLayout('adLayout');

        $data = $mrec->jsonSerialize();

        $this->assertSame('medium_rectangle_advertisement', $data['role']);
        $this->assertSame('mrec-1', $data['identifier']);
        $this->assertSame('adLayout', $data['layout']);
    }

    public function testReplicaAdvertisementComponent(): void
    {
        $replica = new ReplicaAdvertisement();

        $data = $replica->jsonSerialize();

        $this->assertSame('replica_advertisement', $data['role']);
    }

    public function testReplicaAdvertisementWithLayout(): void
    {
        $replica = (new ReplicaAdvertisement())
            ->setIdentifier('replica-ad-1')
            ->setStyle('replicaStyle');

        $data = $replica->jsonSerialize();

        $this->assertSame('replica_advertisement', $data['role']);
        $this->assertSame('replica-ad-1', $data['identifier']);
        $this->assertSame('replicaStyle', $data['style']);
    }
}
