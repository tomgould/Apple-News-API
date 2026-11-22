<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Components;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Components\Audio;
use TomGould\AppleNews\Document\Components\Music;
use TomGould\AppleNews\Document\Components\Podcast;

final class AudioMediaComponentsTest extends TestCase
{
    public function testAudioComponent(): void
    {
        $audio = new Audio('https://example.com/audio.mp3');

        $data = $audio->jsonSerialize();

        $this->assertSame('audio', $data['role']);
        $this->assertSame('https://example.com/audio.mp3', $data['URL']);
    }

    public function testAudioFromUrl(): void
    {
        $audio = Audio::fromUrl('https://example.com/podcast.mp3');

        $data = $audio->jsonSerialize();

        $this->assertSame('audio', $data['role']);
    }

    public function testAudioFromBundle(): void
    {
        $audio = Audio::fromBundle('interview.mp3');

        $data = $audio->jsonSerialize();

        $this->assertSame('bundle://interview.mp3', $data['URL']);
    }

    public function testAudioWithAllOptions(): void
    {
        $audio = (new Audio('https://example.com/audio.mp3'))
            ->setCaption('Interview with CEO')
            ->setAccessibilityCaption('Audio recording of CEO interview')
            ->setImageURL('https://example.com/thumbnail.jpg')
            ->setExplicitContent(false);

        $data = $audio->jsonSerialize();

        $this->assertSame('Interview with CEO', $data['caption']);
        $this->assertSame('Audio recording of CEO interview', $data['accessibilityCaption']);
        $this->assertSame('https://example.com/thumbnail.jpg', $data['imageURL']);
        $this->assertFalse($data['explicitContent']);
    }

    public function testMusicComponent(): void
    {
        $music = new Music('https://music.apple.com/album/123');

        $data = $music->jsonSerialize();

        $this->assertSame('music', $data['role']);
        $this->assertSame('https://music.apple.com/album/123', $data['URL']);
    }

    public function testMusicFromUrl(): void
    {
        $music = Music::fromUrl('https://music.apple.com/playlist/456');

        $data = $music->jsonSerialize();

        $this->assertSame('music', $data['role']);
    }

    public function testMusicWithAllOptions(): void
    {
        $music = (new Music('https://music.apple.com/album/123'))
            ->setCaption('Featured Album')
            ->setAccessibilityCaption('Album cover art')
            ->setImageURL('https://example.com/album-art.jpg')
            ->setExplicitContent(true);

        $data = $music->jsonSerialize();

        $this->assertSame('Featured Album', $data['caption']);
        $this->assertTrue($data['explicitContent']);
    }

    public function testPodcastComponent(): void
    {
        $podcast = new Podcast('https://podcasts.apple.com/podcast/id123');

        $data = $podcast->jsonSerialize();

        $this->assertSame('podcast', $data['role']);
        $this->assertSame('https://podcasts.apple.com/podcast/id123', $data['URL']);
    }

    public function testPodcastFromUrl(): void
    {
        $podcast = Podcast::fromUrl('https://podcasts.apple.com/episode/456');

        $data = $podcast->jsonSerialize();

        $this->assertSame('podcast', $data['role']);
    }

    public function testPodcastWithAllOptions(): void
    {
        $podcast = (new Podcast('https://podcasts.apple.com/podcast/id123'))
            ->setCaption('Latest Episode')
            ->setAccessibilityCaption('Podcast episode audio player')
            ->setImageURL('https://example.com/podcast-art.jpg')
            ->setExplicitContent(false);

        $data = $podcast->jsonSerialize();

        $this->assertSame('Latest Episode', $data['caption']);
        $this->assertSame('https://example.com/podcast-art.jpg', $data['imageURL']);
    }
}

