<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Components;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Components\Body;
use TomGould\AppleNews\Document\Components\Container;
use TomGould\AppleNews\Document\Components\Heading;
use TomGould\AppleNews\Document\Components\LivePost;
use TomGould\AppleNews\Document\Components\Photo;
use TomGould\AppleNews\Document\Components\Tweet;
use TomGould\AppleNews\Document\Components\Video;

final class LivePostTest extends TestCase
{
    public function testLivePostComponent(): void
    {
        $post = new LivePost('post-1');

        $data = $post->jsonSerialize();

        $this->assertSame('live_post', $data['role']);
        $this->assertSame('post-1', $data['identifier']);
    }

    public function testLivePostWithMixedComponents(): void
    {
        $post = (new LivePost('post-1'))
            ->addComponent(new Body('Updated at 13:50'))
            ->addComponent(new Heading('Breaking', 2))
            ->addComponent(new Body('Post body text.'))
            ->addComponent(Photo::fromUrl('https://example.com/photo.jpg'))
            ->addComponent(new Tweet('https://twitter.com/example/status/1234567890'))
            ->addComponent(new Video('https://example.com/stream.m3u8'));

        $data = $post->jsonSerialize();

        $this->assertSame('live_post', $data['role']);
        $this->assertCount(6, $data['components']);
        $this->assertSame('body', $data['components'][0]['role']);
        $this->assertSame('heading2', $data['components'][1]['role']);
        $this->assertSame('body', $data['components'][2]['role']);
        $this->assertSame('photo', $data['components'][3]['role']);
        $this->assertSame('tweet', $data['components'][4]['role']);
        $this->assertSame('video', $data['components'][5]['role']);
    }

    public function testLivePostCanContainPlainContainer(): void
    {
        $post = (new LivePost('post-1'))
            ->addComponent((new Container())->addComponent(new Body('Grouped')));

        $data = $post->jsonSerialize();

        $this->assertSame('container', $data['components'][0]['role']);
        $this->assertCount(1, $data['components'][0]['components']);
    }

    public function testLivePostWithBaseProperties(): void
    {
        $post = (new LivePost('post-1'))
            ->setLayout('postLayout')
            ->setStyle('postStyle');

        $data = $post->jsonSerialize();

        $this->assertInstanceOf(LivePost::class, $post);
        $this->assertSame('post-1', $data['identifier']);
        $this->assertSame('postLayout', $data['layout']);
        $this->assertSame('postStyle', $data['style']);
    }
}
