<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document;

use TomGould\AppleNews\Document\Article;
use TomGould\AppleNews\Document\Components\Body;
use TomGould\AppleNews\Document\Components\Container;
use TomGould\AppleNews\Document\Components\Photo;
use TomGould\AppleNews\Document\Components\Title;
use TomGould\AppleNews\Document\Layouts\Layout;
use TomGould\AppleNews\Document\Metadata;
use TomGould\AppleNews\Document\Styles\ComponentTextStyle;
use TomGould\AppleNews\Document\Styles\DocumentStyle;
use PHPUnit\Framework\TestCase;

/**
 * Additional Article tests for full coverage.
 */
final class ArticleFullTest extends TestCase
{
    public function testArticleWithCustomLayout(): void
    {
        $layout = new Layout(12, 1280);
        $layout->setMargin(80)->setGutter(30);

        $article = new Article('test-id', 'Test Title', 'en', $layout);
        $data = json_decode($article->toJson(), true);

        $this->assertEquals(12, $data['layout']['columns']);
        $this->assertEquals(1280, $data['layout']['width']);
        $this->assertEquals(80, $data['layout']['margin']);
        $this->assertEquals(30, $data['layout']['gutter']);
    }

    public function testAddMultipleComponents(): void
    {
        $article = Article::create('test', 'Test', 'en');

        $components = [
            new Title('Title'),
            new Body('Paragraph 1'),
            new Body('Paragraph 2'),
        ];

        $article->addComponents($components);

        $this->assertCount(3, $article->getComponents());
    }

    public function testAddComponentLayout(): void
    {
        $article = Article::create('test', 'Test', 'en');

        $article->addComponentLayout('fullWidth', [
            'columnStart' => 0,
            'columnSpan' => 7,
            'margin' => ['top' => 20, 'bottom' => 20],
        ]);

        $data = json_decode($article->toJson(), true);

        $this->assertArrayHasKey('componentLayouts', $data);
        $this->assertArrayHasKey('fullWidth', $data['componentLayouts']);
        $this->assertEquals(0, $data['componentLayouts']['fullWidth']['columnStart']);
    }

    public function testAddComponentStyle(): void
    {
        $article = Article::create('test', 'Test', 'en');

        $article->addComponentStyle('cardStyle', [
            'backgroundColor' => '#FFFFFF',
            'border' => [
                'all' => ['width' => 1, 'color' => '#CCCCCC'],
            ],
        ]);

        $data = json_decode($article->toJson(), true);

        $this->assertArrayHasKey('componentStyles', $data);
        $this->assertArrayHasKey('cardStyle', $data['componentStyles']);
        $this->assertEquals('#FFFFFF', $data['componentStyles']['cardStyle']['backgroundColor']);
    }

    public function testAddComponentTextStyle(): void
    {
        $article = Article::create('test', 'Test', 'en');

        $style = (new ComponentTextStyle())
            ->setFontName('Georgia')
            ->setFontSize(16)
            ->setTextColor('#333333');

        $article->addComponentTextStyle('bodyText', $style);

        $data = json_decode($article->toJson(), true);

        $this->assertArrayHasKey('componentTextStyles', $data);
        $this->assertArrayHasKey('bodyText', $data['componentTextStyles']);
        $this->assertEquals('Georgia', $data['componentTextStyles']['bodyText']['fontName']);
    }

    public function testSetAutoplacement(): void
    {
        $article = Article::create('test', 'Test', 'en');

        $article->setAutoplacement([
            'advertisement' => [
                'enabled' => true,
                'bannerType' => 'standard',
                'frequency' => 5,
            ],
        ]);

        $data = json_decode($article->toJson(), true);

        $this->assertArrayHasKey('autoplacement', $data);
        $this->assertTrue($data['autoplacement']['advertisement']['enabled']);
        $this->assertEquals(5, $data['autoplacement']['advertisement']['frequency']);
    }

    public function testToJsonWithFlags(): void
    {
        $article = Article::create('test', 'Test', 'en');
        $article->addComponent(new Body('Hello <World>'));

        // Test with different JSON flags
        $jsonPretty = $article->toJson(JSON_PRETTY_PRINT);
        $jsonCompact = $article->toJson(0);

        $this->assertStringContainsString("\n", $jsonPretty);
        $this->assertStringNotContainsString("\n", $jsonCompact);

        // Both should decode to the same data
        $dataPretty = json_decode($jsonPretty, true);
        $dataCompact = json_decode($jsonCompact, true);

        $this->assertEquals($dataPretty['identifier'], $dataCompact['identifier']);
    }

    public function testFullArticleWithAllFeatures(): void
    {
        $article = Article::create('full-article', 'Complete Article', 'en', 12, 1280);

        // Add metadata
        $metadata = (new Metadata())
            ->addAuthor('John Doe')
            ->setExcerpt('A complete test article')
            ->addKeywords(['test', 'complete'])
            ->setCanonicalURL('https://example.com/article');
        $article->setMetadata($metadata);

        // Add document style
        $docStyle = (new DocumentStyle())->setBackgroundColor('#F5F5F5');
        $article->setDocumentStyle($docStyle);

        // Add component layouts
        $article->addComponentLayout('headerLayout', [
            'columnStart' => 0,
            'columnSpan' => 12,
        ]);

        // Add component styles
        $article->addComponentStyle('headerStyle', [
            'backgroundColor' => '#000000',
        ]);

        // Add text styles
        $bodyStyle = (new ComponentTextStyle())
            ->setFontName('Georgia')
            ->setFontSize(18);
        $article->addComponentTextStyle('bodyStyle', $bodyStyle);

        // Add autoplacement
        $article->setAutoplacement([
            'advertisement' => ['enabled' => true],
        ]);

        // Add components
        $article
            ->addComponent(
                (new Title('Complete Article'))
                    ->setLayout('headerLayout')
                    ->setStyle('headerStyle')
            )
            ->addComponent(
                (new Body('This is the body text.'))
                    ->setTextStyle('bodyStyle')
            );

        $data = json_decode($article->toJson(), true);

        // Verify all sections exist
        $this->assertArrayHasKey('version', $data);
        $this->assertArrayHasKey('identifier', $data);
        $this->assertArrayHasKey('title', $data);
        $this->assertArrayHasKey('language', $data);
        $this->assertArrayHasKey('layout', $data);
        $this->assertArrayHasKey('components', $data);
        $this->assertArrayHasKey('metadata', $data);
        $this->assertArrayHasKey('documentStyle', $data);
        $this->assertArrayHasKey('componentLayouts', $data);
        $this->assertArrayHasKey('componentStyles', $data);
        $this->assertArrayHasKey('componentTextStyles', $data);
        $this->assertArrayHasKey('autoplacement', $data);

        $this->assertCount(2, $data['components']);
    }

    public function testArticleVersionDefault(): void
    {
        $article = Article::create('test', 'Test', 'en');
        $data = json_decode($article->toJson(), true);

        $this->assertEquals('1.24', $data['version']);
    }

    public function testEmptyComponentsArray(): void
    {
        $article = Article::create('test', 'Test', 'en');
        $data = json_decode($article->toJson(), true);

        $this->assertArrayHasKey('components', $data);
        $this->assertIsArray($data['components']);
        $this->assertEmpty($data['components']);
    }
}

