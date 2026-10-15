<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Components;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Article;
use TomGould\AppleNews\Document\Components\Body;
use TomGould\AppleNews\Document\Components\LiveContainer;
use TomGould\AppleNews\Document\Components\LivePost;
use TomGould\AppleNews\Document\Components\Tweet;
use TomGould\AppleNews\Document\Components\Video;

final class LiveContainerTest extends TestCase
{
    public function testLiveContainerComponent(): void
    {
        $container = new LiveContainer('live-coverage');

        $data = $container->jsonSerialize();

        $this->assertSame('live_container', $data['role']);
        $this->assertSame('live-coverage', $data['identifier']);
    }

    public function testLiveContainerWithPosts(): void
    {
        $container = (new LiveContainer('live-coverage'))
            ->addComponent((new LivePost('post-2'))->addComponent(new Body('Newest update.')))
            ->addComponent((new LivePost('post-1'))->addComponent(new Body('First update.')));

        $data = $container->jsonSerialize();

        $this->assertSame('live_container', $data['role']);
        $this->assertCount(2, $data['components']);
        $this->assertSame('live_post', $data['components'][0]['role']);
        $this->assertSame('post-2', $data['components'][0]['identifier']);
        $this->assertSame('live_post', $data['components'][1]['role']);
        $this->assertSame('post-1', $data['components'][1]['identifier']);
    }

    public function testLiveContainerWithBaseProperties(): void
    {
        $container = (new LiveContainer('live-coverage'))
            ->setLayout('liveLayout')
            ->setStyle('liveStyle');

        $data = $container->jsonSerialize();

        $this->assertInstanceOf(LiveContainer::class, $container);
        $this->assertSame('live-coverage', $data['identifier']);
        $this->assertSame('liveLayout', $data['layout']);
        $this->assertSame('liveStyle', $data['style']);
    }

    /**
     * The serialised nesting matches the live_container > live_post > components shape Apple expects.
     */
    public function testLiveContainerMatchesAppleSpecStructure(): void
    {
        $post = (new LivePost('post-1'))
            ->addComponent(new Body('Updated at 13:50'))
            ->addComponent(new Tweet('https://twitter.com/example/status/1234567890'))
            ->addComponent(new Video('https://example.com/stream.m3u8'));

        $container = (new LiveContainer('live-coverage'))->addComponent($post);

        $this->assertSame(
            [
                'role' => 'live_container',
                'identifier' => 'live-coverage',
                'components' => [
                    [
                        'role' => 'live_post',
                        'identifier' => 'post-1',
                        'components' => [
                            ['role' => 'body', 'text' => 'Updated at 13:50'],
                            ['role' => 'tweet', 'URL' => 'https://twitter.com/example/status/1234567890'],
                            ['role' => 'video', 'URL' => 'https://example.com/stream.m3u8'],
                        ],
                    ],
                ],
            ],
            $container->jsonSerialize()
        );
    }

    public function testLiveContainerInArticle(): void
    {
        $article = Article::create('liveCoverageArticle', 'Live Coverage Sample', 'en')
            ->addComponent(
                (new LiveContainer('live-coverage'))
                    ->addComponent((new LivePost('post-1'))->addComponent(new Body('Update')))
            );

        $data = json_decode($article->toJson(), true);

        $this->assertSame('live_container', $data['components'][0]['role']);
        $this->assertSame('live-coverage', $data['components'][0]['identifier']);
        $this->assertSame('post-1', $data['components'][0]['components'][0]['identifier']);
    }
}
