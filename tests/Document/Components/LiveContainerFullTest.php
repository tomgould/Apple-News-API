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
 * Edge cases and validation for LiveContainer.
 */
final class LiveContainerFullTest extends TestCase
{
    public function testEmptyLiveContainerJsonSerialize(): void
    {
        $container = new LiveContainer('live-coverage');
        $data = $container->jsonSerialize();

        $this->assertEquals('live_container', $data['role']);
        $this->assertEquals('live-coverage', $data['identifier']);
        $this->assertArrayNotHasKey('components', $data);
        $this->assertArrayNotHasKey('contentDisplay', $data);
    }

    public function testIsAContainer(): void
    {
        $this->assertInstanceOf(Container::class, new LiveContainer('live-coverage'));
    }

    public function testAddComponentReturnsSameInstance(): void
    {
        $container = new LiveContainer('live-coverage');

        $this->assertSame($container, $container->addComponent(new LivePost('post-1')));
    }

    public function testAddComponentRejectsNonLivePost(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('LiveContainer can only contain LivePost components');

        (new LiveContainer('live-coverage'))->addComponent(new Body('Not allowed'));
    }

    public function testAddComponentRejectsPlainContainer(): void
    {
        $this->expectException(InvalidArgumentException::class);

        (new LiveContainer('live-coverage'))->addComponent(new Container());
    }

    public function testAddComponentRejectsNestedLiveContainer(): void
    {
        $this->expectException(InvalidArgumentException::class);

        (new LiveContainer('outer'))->addComponent(new LiveContainer('inner'));
    }

    public function testRejectedComponentIsNotAdded(): void
    {
        $container = (new LiveContainer('live-coverage'))->addComponent(new LivePost('post-1'));

        try {
            $container->addComponent(new Body('Not allowed'));
            $this->fail('Expected InvalidArgumentException');
        } catch (InvalidArgumentException) {
            // Expected.
        }

        $data = $container->jsonSerialize();
        $this->assertCount(1, $data['components']);
        $this->assertEquals('live_post', $data['components'][0]['role']);
    }

    public function testConstructorRejectsEmptyIdentifier(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('LiveContainer requires a non-empty identifier');

        new LiveContainer('');
    }

    public function testSetIdentifierReplacesIdentifier(): void
    {
        $container = (new LiveContainer('first'))->setIdentifier('second');

        $this->assertEquals('second', $container->jsonSerialize()['identifier']);
    }

    public function testSetIdentifierRejectsEmptyIdentifier(): void
    {
        $this->expectException(InvalidArgumentException::class);

        (new LiveContainer('live-coverage'))->setIdentifier('');
    }

    public function testLiveContainerWithManyPosts(): void
    {
        $container = new LiveContainer('live-coverage');

        for ($i = 10; $i > 0; $i--) {
            $container->addComponent((new LivePost("post-{$i}"))->addComponent(new Body("Update {$i}")));
        }

        $data = $container->jsonSerialize();

        $this->assertCount(10, $data['components']);
        $this->assertEquals('post-10', $data['components'][0]['identifier']);
        $this->assertEquals('post-1', $data['components'][9]['identifier']);
    }
}
