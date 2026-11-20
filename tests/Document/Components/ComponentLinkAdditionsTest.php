<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Components;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Additions\ComponentLink;
use TomGould\AppleNews\Document\Additions\LinkAddition;
use TomGould\AppleNews\Document\Components\Body;
use TomGould\AppleNews\Document\Components\Container;
use TomGould\AppleNews\Document\Components\Divider;
use TomGould\AppleNews\Document\Components\Photo;
use TomGould\AppleNews\Document\Components\Section;

/**
 * Tests for ComponentLink additions on non-text components.
 */
final class ComponentLinkAdditionsTest extends TestCase
{
    public function testPhotoWithComponentLink(): void
    {
        $photo = Photo::fromUrl('https://example.com/image.jpg')
            ->setLayout('bodyLayout')
            ->setAdditions([ComponentLink::to('https://apple.news/A5vHgPPmQSvuIxPjeXLTdGQ')]);

        $this->assertSame(
            '{"role":"photo","layout":"bodyLayout","additions":[{"type":"link","URL":"https://apple.news/A5vHgPPmQSvuIxPjeXLTdGQ"}],"URL":"https://example.com/image.jpg"}',
            json_encode($photo, JSON_UNESCAPED_SLASHES)
        );
    }

    public function testContainerWithComponentLink(): void
    {
        $container = (new Container())
            ->setAdditions([ComponentLink::to('https://apple.news/A5vHgPPmQSvuIxPjeXLTdGQ')])
            ->addComponent(new Body('Inside'));

        $data = json_decode((string) json_encode($container), true);

        $this->assertSame(
            [['type' => 'link', 'URL' => 'https://apple.news/A5vHgPPmQSvuIxPjeXLTdGQ']],
            $data['additions']
        );
        $this->assertSame('container', $data['role']);
        $this->assertSame('body', $data['components'][0]['role']);
    }

    public function testContainerSubclassInheritsSupport(): void
    {
        $section = (new Section())->setAdditions([ComponentLink::to('#top')]);

        $this->assertSame([['type' => 'link', 'URL' => '#top']], $section->jsonSerialize()['additions']);
    }

    public function testAdditionsOmittedWhenNotSet(): void
    {
        $this->assertArrayNotHasKey('additions', Photo::fromUrl('https://example.com/image.jpg')->jsonSerialize());
        $this->assertArrayNotHasKey('additions', (new Container())->jsonSerialize());
    }

    public function testSetAdditionsReplaces(): void
    {
        $photo = Photo::fromUrl('https://example.com/image.jpg')
            ->setAdditions([ComponentLink::to('https://apple.news/one')])
            ->setAdditions([ComponentLink::to('https://apple.news/two')]);

        $this->assertSame([['type' => 'link', 'URL' => 'https://apple.news/two']], $photo->jsonSerialize()['additions']);
    }

    public function testLinkAdditionRejectedOnPhoto(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('only accepts ComponentLink additions');

        Photo::fromUrl('https://example.com/image.jpg')
            ->setAdditions([LinkAddition::forRange('https://example.com', 0, 4)]);
    }

    public function testArrayAdditionRejectedOnContainer(): void
    {
        $this->expectException(InvalidArgumentException::class);

        (new Container())->setAdditions([['type' => 'link', 'URL' => 'https://apple.news/A5vHgPPmQSvuIxPjeXLTdGQ']]);
    }

    public function testComponentWithoutAdditionsRejectsThem(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('does not support additions');

        (new Divider())->setAdditions([ComponentLink::to('https://apple.news/A5vHgPPmQSvuIxPjeXLTdGQ')]);
    }

    public function testTextComponentAdditionsUnchanged(): void
    {
        $body = (new Body('Hello world'))
            ->setFormat('none')
            ->setAdditions([['type' => 'link', 'rangeStart' => 0, 'rangeLength' => 5, 'URL' => 'https://example.com']]);

        // Same output as 2.2.0: additions last, arrays kept as given.
        $this->assertSame(
            '{"role":"body","text":"Hello world","format":"none","additions":[{"type":"link","rangeStart":0,"rangeLength":5,"URL":"https://example.com"}]}',
            json_encode($body, JSON_UNESCAPED_SLASHES)
        );
    }

    public function testTextComponentAcceptsLinkAdditionObjects(): void
    {
        $body = (new Body('Hello world'))
            ->setAdditions([LinkAddition::forRange('https://example.com', 0, 5)]);

        $this->assertSame(
            [['type' => 'link', 'URL' => 'https://example.com', 'rangeStart' => 0, 'rangeLength' => 5]],
            $body->jsonSerialize()['additions']
        );
    }
}
