<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Components;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Components\Figure;
use TomGould\AppleNews\Document\Components\Image;
use TomGould\AppleNews\Document\Components\Logo;
use TomGould\AppleNews\Document\Components\Mosaic;
use TomGould\AppleNews\Document\Components\Portrait;

final class MediaComponentsTest extends TestCase
{
    public function testFigureComponent(): void
    {
        $figure = new Figure('https://example.com/chart.png');

        $data = $figure->jsonSerialize();

        $this->assertSame('figure', $data['role']);
        $this->assertSame('https://example.com/chart.png', $data['URL']);
    }

    public function testFigureFromUrl(): void
    {
        $figure = Figure::fromUrl('https://example.com/diagram.png');

        $data = $figure->jsonSerialize();

        $this->assertSame('figure', $data['role']);
        $this->assertSame('https://example.com/diagram.png', $data['URL']);
    }

    public function testFigureFromBundle(): void
    {
        $figure = Figure::fromBundle('chart.png');

        $data = $figure->jsonSerialize();

        $this->assertSame('bundle://chart.png', $data['URL']);
    }

    public function testFigureWithAllOptions(): void
    {
        $figure = (new Figure('https://example.com/chart.png'))
            ->setCaption('Figure 1: Sales data')
            ->setAccessibilityCaption('Bar chart showing sales data')
            ->setExplicitContent(false);

        $data = $figure->jsonSerialize();

        $this->assertSame('Figure 1: Sales data', $data['caption']);
        $this->assertSame('Bar chart showing sales data', $data['accessibilityCaption']);
        $this->assertFalse($data['explicitContent']);
    }

    public function testPortraitComponent(): void
    {
        $portrait = new Portrait('https://example.com/headshot.jpg');

        $data = $portrait->jsonSerialize();

        $this->assertSame('portrait', $data['role']);
        $this->assertSame('https://example.com/headshot.jpg', $data['URL']);
    }

    public function testPortraitFromUrl(): void
    {
        $portrait = Portrait::fromUrl('https://example.com/author.jpg');

        $data = $portrait->jsonSerialize();

        $this->assertSame('portrait', $data['role']);
    }

    public function testPortraitFromBundle(): void
    {
        $portrait = Portrait::fromBundle('headshot.jpg');

        $data = $portrait->jsonSerialize();

        $this->assertSame('bundle://headshot.jpg', $data['URL']);
    }

    public function testPortraitWithAllOptions(): void
    {
        $portrait = (new Portrait('https://example.com/ceo.jpg'))
            ->setCaption('John Smith, CEO')
            ->setAccessibilityCaption('Portrait photo of John Smith')
            ->setExplicitContent(false);

        $data = $portrait->jsonSerialize();

        $this->assertSame('John Smith, CEO', $data['caption']);
        $this->assertSame('Portrait photo of John Smith', $data['accessibilityCaption']);
        $this->assertFalse($data['explicitContent']);
    }

    public function testLogoComponent(): void
    {
        $logo = new Logo('https://example.com/logo.png');

        $data = $logo->jsonSerialize();

        $this->assertSame('logo', $data['role']);
        $this->assertSame('https://example.com/logo.png', $data['URL']);
    }

    public function testLogoFromUrl(): void
    {
        $logo = Logo::fromUrl('https://example.com/brand.png');

        $data = $logo->jsonSerialize();

        $this->assertSame('logo', $data['role']);
    }

    public function testLogoFromBundle(): void
    {
        $logo = Logo::fromBundle('publication-logo.png');

        $data = $logo->jsonSerialize();

        $this->assertSame('bundle://publication-logo.png', $data['URL']);
    }

    public function testLogoWithCaption(): void
    {
        $logo = (new Logo('https://example.com/logo.png'))
            ->setCaption('Company Inc.')
            ->setAccessibilityCaption('Company Inc. logo');

        $data = $logo->jsonSerialize();

        $this->assertSame('Company Inc.', $data['caption']);
        $this->assertSame('Company Inc. logo', $data['accessibilityCaption']);
    }

    public function testImageComponent(): void
    {
        $image = new Image('https://example.com/image.jpg');

        $data = $image->jsonSerialize();

        $this->assertSame('image', $data['role']);
        $this->assertSame('https://example.com/image.jpg', $data['URL']);
    }

    public function testImageFromUrl(): void
    {
        $image = Image::fromUrl('https://example.com/photo.jpg');

        $data = $image->jsonSerialize();

        $this->assertSame('image', $data['role']);
    }

    public function testImageFromBundle(): void
    {
        $image = Image::fromBundle('background.jpg');

        $data = $image->jsonSerialize();

        $this->assertSame('bundle://background.jpg', $data['URL']);
    }

    public function testImageWithAllOptions(): void
    {
        $image = (new Image('https://example.com/image.jpg'))
            ->setCaption('A beautiful sunset')
            ->setAccessibilityCaption('Sunset over the ocean')
            ->setExplicitContent(false);

        $data = $image->jsonSerialize();

        $this->assertSame('A beautiful sunset', $data['caption']);
        $this->assertSame('Sunset over the ocean', $data['accessibilityCaption']);
        $this->assertFalse($data['explicitContent']);
    }

    public function testMosaicComponent(): void
    {
        $mosaic = new Mosaic();

        $data = $mosaic->jsonSerialize();

        $this->assertSame('mosaic', $data['role']);
    }

    public function testMosaicWithItems(): void
    {
        $mosaic = (new Mosaic())
            ->addItem('https://example.com/image1.jpg')
            ->addItem('https://example.com/image2.jpg')
            ->addItem('https://example.com/image3.jpg');

        $data = $mosaic->jsonSerialize();

        $this->assertSame('mosaic', $data['role']);
        $this->assertCount(3, $data['items']);
        $this->assertSame('https://example.com/image1.jpg', $data['items'][0]['URL']);
    }

    public function testMosaicWithFullItemOptions(): void
    {
        $mosaic = (new Mosaic())
            ->addItem(
                'https://example.com/image.jpg',
                'Image caption',
                'Accessibility description',
                true
            );

        $data = $mosaic->jsonSerialize();

        $this->assertSame('Image caption', $data['items'][0]['caption']);
        $this->assertSame('Accessibility description', $data['items'][0]['accessibilityCaption']);
        $this->assertTrue($data['items'][0]['explicitContent']);
    }

    public function testMosaicAddBundleItem(): void
    {
        $mosaic = (new Mosaic())
            ->addBundleItem('photo1.jpg', 'First photo')
            ->addBundleItem('photo2.jpg');

        $data = $mosaic->jsonSerialize();

        $this->assertSame('bundle://photo1.jpg', $data['items'][0]['URL']);
        $this->assertSame('First photo', $data['items'][0]['caption']);
        $this->assertSame('bundle://photo2.jpg', $data['items'][1]['URL']);
        $this->assertArrayNotHasKey('caption', $data['items'][1]);
    }

    public function testMediaComponentsWithBaseProperties(): void
    {
        $figure = (new Figure('https://example.com/chart.png'))
            ->setIdentifier('main-chart')
            ->setLayout('figureLayout')
            ->setStyle('figureStyle');

        $data = $figure->jsonSerialize();

        $this->assertSame('main-chart', $data['identifier']);
        $this->assertSame('figureLayout', $data['layout']);
        $this->assertSame('figureStyle', $data['style']);
    }
}
