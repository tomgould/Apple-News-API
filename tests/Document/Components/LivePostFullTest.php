<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Components;

use InvalidArgumentException;
use TomGould\AppleNews\Document\Components\Body;
use TomGould\AppleNews\Document\Components\Container;
use TomGould\AppleNews\Document\Components\LiveContainer;
use TomGould\AppleNews\Document\Components\LivePost;
use PHPUnit\Framework\TestCase;

/**
 * Edge cases and validation for LivePost.
 */
final class LivePostFullTest extends TestCase
{
    public function testEmptyLivePostJsonSerialize(): void
    {
        $post = new LivePost('post-1');
        $data = $post->jsonSerialize();

        $this->assertEquals('live_post', $data['role']);
        $this->assertEquals('post-1', $data['identifier']);
        $this->assertArrayNotHasKey('components', $data);
        $this->assertArrayNotHasKey('contentDisplay', $data);
    }

    public function testIsAContainer(): void
    {
        $this->assertInstanceOf(Container::class, new LivePost('post-1'));
    }

    public function testAddComponentReturnsSameInstance(): void
    {
        $post = new LivePost('post-1');

        $this->assertSame($post, $post->addComponent(new Body('Update')));
    }

    public function testAddComponentRejectsLivePost(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('LivePost cannot contain another LivePost or LiveContainer');

        (new LivePost('outer'))->addComponent(new LivePost('inner'));
    }

    public function testAddComponentRejectsLiveContainer(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('LivePost cannot contain another LivePost or LiveContainer');

        (new LivePost('post-1'))->addComponent(new LiveContainer('live-coverage'));
    }

    public function testRejectedComponentIsNotAdded(): void
    {
        $post = (new LivePost('post-1'))->addComponent(new Body('Update'));

        try {
            $post->addComponent(new LivePost('post-2'));
            $this->fail('Expected InvalidArgumentException');
        } catch (InvalidArgumentException) {
            // Expected.
        }

        $data = $post->jsonSerialize();
        $this->assertCount(1, $data['components']);
        $this->assertEquals('body', $data['components'][0]['role']);
    }

    public function testConstructorRejectsEmptyIdentifier(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('LivePost requires a non-empty identifier');

        new LivePost('');
    }

    public function testSetIdentifierReplacesIdentifier(): void
    {
        $post = (new LivePost('first'))->setIdentifier('second');

        $this->assertEquals('second', $post->jsonSerialize()['identifier']);
    }

    public function testSetIdentifierRejectsEmptyIdentifier(): void
    {
        $this->expectException(InvalidArgumentException::class);

        (new LivePost('post-1'))->setIdentifier('');
    }
}
