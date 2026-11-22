<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document;

use TomGould\AppleNews\Document\Components\Body;
use TomGould\AppleNews\Document\Components\Caption;
use TomGould\AppleNews\Document\Components\Container;
use TomGould\AppleNews\Document\Components\Divider;
use TomGould\AppleNews\Document\Components\EmbedWebVideo;
use TomGould\AppleNews\Document\Components\FacebookPost;
use TomGould\AppleNews\Document\Components\Gallery;
use TomGould\AppleNews\Document\Components\Heading;
use TomGould\AppleNews\Document\Components\Instagram;
use TomGould\AppleNews\Document\Components\LinkButton;
use TomGould\AppleNews\Document\Components\Photo;
use TomGould\AppleNews\Document\Components\Pullquote;
use TomGould\AppleNews\Document\Components\Title;
use TomGould\AppleNews\Document\Components\Tweet;
use TomGould\AppleNews\Document\Components\Video;
use PHPUnit\Framework\TestCase;

final class ComponentsTest extends TestCase
{
    // ==========================================
    // Text Components
    // ==========================================

    public function testBodyComponent(): void
    {
        $body = new Body('Paragraph text here.');
        $data = $body->jsonSerialize();

        $this->assertEquals('body', $data['role']);
        $this->assertEquals('Paragraph text here.', $data['text']);
    }

    public function testBodyWithHtmlFormat(): void
    {
        $body = (new Body('<p>HTML content</p>'))->setFormat('html');
        $data = $body->jsonSerialize();

        $this->assertEquals('html', $data['format']);
    }

    public function testBodyWithTextStyle(): void
    {
        $body = (new Body('Styled text'))->setTextStyle('bodyStyle');
        $data = $body->jsonSerialize();

        $this->assertEquals('bodyStyle', $data['textStyle']);
    }

    public function testBodyWithInlineTextStyles(): void
    {
        $body = (new Body('Text with inline styles'))
            ->setInlineTextStyles([
                ['rangeStart' => 0, 'rangeLength' => 4, 'textStyle' => 'bold'],
            ]);
        $data = $body->jsonSerialize();

        $this->assertCount(1, $data['inlineTextStyles']);
        $this->assertEquals(0, $data['inlineTextStyles'][0]['rangeStart']);
    }

    public function testCaptionComponent(): void
    {
        $caption = new Caption('Image caption text');
        $data = $caption->jsonSerialize();

        $this->assertEquals('caption', $data['role']);
        $this->assertEquals('Image caption text', $data['text']);
    }

    public function testPullquoteComponent(): void
    {
        $pullquote = new Pullquote('An important quote.');
        $data = $pullquote->jsonSerialize();

        $this->assertEquals('pullquote', $data['role']);
        $this->assertEquals('An important quote.', $data['text']);
    }

    public function testTitleComponent(): void
    {
        $title = new Title('Article Title');
        $data = $title->jsonSerialize();

        $this->assertEquals('title', $data['role']);
        $this->assertEquals('Article Title', $data['text']);
    }

    public function testHeadingLevels(): void
    {
        $h1 = new Heading('Heading 1', 1);
        $h2 = new Heading('Heading 2', 2);
        $h3 = new Heading('Heading 3', 3);
        $h6 = new Heading('Heading 6', 6);

        $this->assertEquals('heading1', $h1->getRole());
        $this->assertEquals('heading2', $h2->getRole());
        $this->assertEquals('heading3', $h3->getRole());
        $this->assertEquals('heading6', $h6->getRole());
    }

    public function testHeadingDefaultLevel(): void
    {
        $heading = new Heading('Default Heading');

        $this->assertEquals('heading1', $heading->getRole());
    }

    public function testHeadingLevelClamping(): void
    {
        $tooLow = new Heading('Too Low', 0);
        $tooHigh = new Heading('Too High', 10);

        // Level 0 should become heading1, level 10 should become heading6
        $this->assertEquals('heading1', $tooLow->getRole());
        $this->assertEquals('heading6', $tooHigh->getRole());
    }

    // ==========================================
    // Media Components
    // ==========================================

    public function testPhotoFromUrl(): void
    {
        $photo = Photo::fromUrl('https://example.com/image.jpg');
        $data = $photo->jsonSerialize();

        $this->assertEquals('photo', $data['role']);
        $this->assertEquals('https://example.com/image.jpg', $data['URL']);
    }

    public function testPhotoFromBundle(): void
    {
        $photo = Photo::fromBundle('hero.jpg');
        $data = $photo->jsonSerialize();

        $this->assertEquals('bundle://hero.jpg', $data['URL']);
    }

    public function testPhotoWithCaption(): void
    {
        $photo = Photo::fromUrl('https://example.com/image.jpg')
            ->setCaption('A beautiful sunset');
        $data = $photo->jsonSerialize();

        $this->assertEquals('A beautiful sunset', $data['caption']);
    }

    public function testPhotoWithAccessibilityCaption(): void
    {
        $photo = Photo::fromUrl('https://example.com/image.jpg')
            ->setAccessibilityCaption('Description for VoiceOver');
        $data = $photo->jsonSerialize();

        $this->assertEquals('Description for VoiceOver', $data['accessibilityCaption']);
    }

    public function testPhotoWithExplicitContent(): void
    {
        $photo = Photo::fromUrl('https://example.com/image.jpg')
            ->setExplicitContent(true);
        $data = $photo->jsonSerialize();

        $this->assertTrue($data['explicitContent']);
    }

    public function testVideoComponent(): void
    {
        $video = new Video('https://example.com/video.mp4');
        $data = $video->jsonSerialize();

        $this->assertEquals('video', $data['role']);
        $this->assertEquals('https://example.com/video.mp4', $data['URL']);
    }

    public function testVideoWithAllOptions(): void
    {
        $video = (new Video('https://example.com/video.mp4'))
            ->setCaption('Video caption')
            ->setStillURL('https://example.com/thumbnail.jpg')
            ->setAccessibilityCaption('Video description')
            ->setExplicitContent(true);
        $data = $video->jsonSerialize();

        $this->assertEquals('Video caption', $data['caption']);
        $this->assertEquals('https://example.com/thumbnail.jpg', $data['stillURL']);
        $this->assertEquals('Video description', $data['accessibilityCaption']);
        $this->assertTrue($data['explicitContent']);
    }

    public function testEmbedWebVideoComponent(): void
    {
        $video = new EmbedWebVideo('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        $data = $video->jsonSerialize();

        $this->assertEquals('embedwebvideo', $data['role']);
        $this->assertEquals('https://www.youtube.com/watch?v=dQw4w9WgXcQ', $data['URL']);
    }

    public function testEmbedWebVideoWithOptions(): void
    {
        $video = (new EmbedWebVideo('https://vimeo.com/123456'))
            ->setCaption('Vimeo video')
            ->setAccessibilityCaption('A video from Vimeo')
            ->setExplicitContent(false)
            ->setAspectRatio('1.777');
        $data = $video->jsonSerialize();

        $this->assertEquals('Vimeo video', $data['caption']);
        $this->assertEquals('A video from Vimeo', $data['accessibilityCaption']);
        $this->assertFalse($data['explicitContent']);
        $this->assertEquals('1.777', $data['aspectRatio']);
    }

    public function testGalleryComponent(): void
    {
        $gallery = new Gallery();
        $data = $gallery->jsonSerialize();

        $this->assertEquals('gallery', $data['role']);
        $this->assertEmpty($data['items']);
    }

    public function testGalleryWithItems(): void
    {
        $gallery = (new Gallery())
            ->addItem('https://example.com/image1.jpg')
            ->addItem('https://example.com/image2.jpg', 'Second image')
            ->addItem('https://example.com/image3.jpg', 'Third image', 'Accessibility text');
        $data = $gallery->jsonSerialize();

        $this->assertCount(3, $data['items']);

        $this->assertEquals('https://example.com/image1.jpg', $data['items'][0]['URL']);
        $this->assertArrayNotHasKey('caption', $data['items'][0]);

        $this->assertEquals('Second image', $data['items'][1]['caption']);

        $this->assertEquals('Third image', $data['items'][2]['caption']);
        $this->assertEquals('Accessibility text', $data['items'][2]['accessibilityCaption']);
    }

    // ==========================================
    // Social Embed Components
    // ==========================================

    public function testTweetComponent(): void
    {
        $tweet = new Tweet('https://twitter.com/user/status/123456');
        $data = $tweet->jsonSerialize();

        $this->assertEquals('tweet', $data['role']);
        $this->assertEquals('https://twitter.com/user/status/123456', $data['URL']);
    }

    public function testInstagramComponent(): void
    {
        $instagram = new Instagram('https://www.instagram.com/p/ABC123/');
        $data = $instagram->jsonSerialize();

        $this->assertEquals('instagram', $data['role']);
        $this->assertEquals('https://www.instagram.com/p/ABC123/', $data['URL']);
    }

    public function testFacebookPostComponent(): void
    {
        $facebook = new FacebookPost('https://www.facebook.com/user/posts/123456');
        $data = $facebook->jsonSerialize();

        $this->assertEquals('facebook_post', $data['role']);
        $this->assertEquals('https://www.facebook.com/user/posts/123456', $data['URL']);
    }

    // ==========================================
    // UI Components
    // ==========================================

    public function testDividerComponent(): void
    {
        $divider = new Divider();
        $data = $divider->jsonSerialize();

        $this->assertEquals('divider', $data['role']);
        $this->assertArrayNotHasKey('stroke', $data);
    }

    public function testDividerWithStroke(): void
    {
        $divider = (new Divider())->setStroke([
            'color' => '#000000',
            'width' => 1,
        ]);
        $data = $divider->jsonSerialize();

        $this->assertEquals('#000000', $data['stroke']['color']);
        $this->assertEquals(1, $data['stroke']['width']);
    }

    public function testLinkButtonComponent(): void
    {
        $button = new LinkButton('Read More', 'https://example.com/article');
        $data = $button->jsonSerialize();

        $this->assertEquals('link_button', $data['role']);
        $this->assertEquals('Read More', $data['text']);
        $this->assertEquals('https://example.com/article', $data['URL']);
    }

    public function testLinkButtonWithTextStyle(): void
    {
        $button = (new LinkButton('Click Me', 'https://example.com'))
            ->setTextStyle('buttonTextStyle');
        $data = $button->jsonSerialize();

        $this->assertEquals('buttonTextStyle', $data['textStyle']);
    }

    // ==========================================
    // Container Component
    // ==========================================

    public function testContainerComponent(): void
    {
        $container = new Container();
        $data = $container->jsonSerialize();

        $this->assertEquals('container', $data['role']);
    }

    public function testContainerWithChildren(): void
    {
        $container = (new Container())
            ->addComponent(new Title('Title in container'))
            ->addComponent(new Body('Body in container'));
        $data = $container->jsonSerialize();

        $this->assertCount(2, $data['components']);
        $this->assertEquals('title', $data['components'][0]['role']);
        $this->assertEquals('body', $data['components'][1]['role']);
    }

    public function testContainerWithContentDisplay(): void
    {
        $container = (new Container())
            ->setContentDisplay('horizontal');
        $data = $container->jsonSerialize();

        $this->assertEquals('horizontal', $data['contentDisplay']);
    }

    // ==========================================
    // Base Component Properties
    // ==========================================

    public function testComponentWithIdentifier(): void
    {
        $body = (new Body('Text'))->setIdentifier('unique-id-123');
        $data = $body->jsonSerialize();

        $this->assertEquals('unique-id-123', $data['identifier']);
    }

    public function testComponentWithLayout(): void
    {
        $body = (new Body('Text'))->setLayout('bodyLayout');
        $data = $body->jsonSerialize();

        $this->assertEquals('bodyLayout', $data['layout']);
    }

    public function testComponentWithStyle(): void
    {
        $body = (new Body('Text'))->setStyle('bodyStyle');
        $data = $body->jsonSerialize();

        $this->assertEquals('bodyStyle', $data['style']);
    }

    public function testComponentWithAnchor(): void
    {
        $body = (new Body('Text'))->setAnchor('header-component');
        $data = $body->jsonSerialize();

        $this->assertEquals('header-component', $data['anchor']);
    }

    public function testComponentWithAnimation(): void
    {
        $body = (new Body('Text'))->setAnimation([
            'type' => 'fade_in',
            'userControllable' => true,
        ]);
        $data = $body->jsonSerialize();

        $this->assertEquals('fade_in', $data['animation']['type']);
        $this->assertTrue($data['animation']['userControllable']);
    }

    public function testComponentWithBehavior(): void
    {
        $photo = Photo::fromUrl('https://example.com/image.jpg')
            ->setBehavior([
                'type' => 'parallax',
                'factor' => 0.8,
            ]);
        $data = $photo->jsonSerialize();

        $this->assertEquals('parallax', $data['behavior']['type']);
        $this->assertEquals(0.8, $data['behavior']['factor']);
    }

    public function testComponentHiddenProperty(): void
    {
        $body = (new Body('Hidden text'))->setHidden(true);
        $data = $body->jsonSerialize();

        $this->assertTrue($data['hidden']);
    }

    public function testComponentHiddenNotIncludedWhenFalse(): void
    {
        $body = (new Body('Visible text'))->setHidden(false);
        $data = $body->jsonSerialize();

        $this->assertArrayNotHasKey('hidden', $data);
    }

    public function testComponentWithConditional(): void
    {
        $body = (new Body('Conditional text'))->setConditional([
            'conditions' => [
                'platform' => 'ios',
            ],
            'hidden' => false,
        ]);
        $data = $body->jsonSerialize();

        $this->assertArrayHasKey('conditional', $data);
        $this->assertEquals('ios', $data['conditional']['conditions']['platform']);
    }
}

