<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Components;

use TomGould\AppleNews\Document\Components\Container;
use TomGould\AppleNews\Document\Components\Body;
use TomGould\AppleNews\Document\Components\Title;
use TomGould\AppleNews\Document\Components\Photo;
use PHPUnit\Framework\TestCase;

/**
 * Additional Container tests for full jsonSerialize coverage.
 */
final class ContainerFullTest extends TestCase
{
    public function testEmptyContainerJsonSerialize(): void
    {
        $container = new Container();
        $data = $container->jsonSerialize();

        $this->assertEquals('container', $data['role']);
        $this->assertArrayNotHasKey('components', $data);
        $this->assertArrayNotHasKey('contentDisplay', $data);
    }

    public function testContainerWithOnlyContentDisplay(): void
    {
        $container = (new Container())->setContentDisplay('horizontal');
        $data = $container->jsonSerialize();

        $this->assertEquals('container', $data['role']);
        $this->assertEquals('horizontal', $data['contentDisplay']);
        $this->assertArrayNotHasKey('components', $data);
    }

    public function testContainerWithNestedContainers(): void
    {
        $innerContainer = (new Container())
            ->addComponent(new Body('Inner content'));

        $outerContainer = (new Container())
            ->addComponent(new Title('Outer title'))
            ->addComponent($innerContainer);

        $data = $outerContainer->jsonSerialize();

        $this->assertCount(2, $data['components']);
        $this->assertEquals('title', $data['components'][0]['role']);
        $this->assertEquals('container', $data['components'][1]['role']);
        $this->assertCount(1, $data['components'][1]['components']);
    }

    public function testContainerWithAllBaseProperties(): void
    {
        $container = (new Container())
            ->setIdentifier('main-container')
            ->setLayout('containerLayout')
            ->setStyle('containerStyle')
            ->setAnchor('top-anchor')
            ->setAnimation(['type' => 'fade_in'])
            ->setBehavior(['type' => 'parallax'])
            ->setHidden(false)
            ->setConditional(['conditions' => ['platform' => 'ios']])
            ->setContentDisplay('horizontal')
            ->addComponent(new Body('Content'));

        $data = $container->jsonSerialize();

        $this->assertEquals('main-container', $data['identifier']);
        $this->assertEquals('containerLayout', $data['layout']);
        $this->assertEquals('containerStyle', $data['style']);
        $this->assertEquals('top-anchor', $data['anchor']);
        $this->assertEquals('fade_in', $data['animation']['type']);
        $this->assertEquals('parallax', $data['behavior']['type']);
        $this->assertArrayNotHasKey('hidden', $data); // false is not included
        $this->assertEquals('ios', $data['conditional']['conditions']['platform']);
        $this->assertEquals('horizontal', $data['contentDisplay']);
        $this->assertCount(1, $data['components']);
    }

    public function testContainerWithManyComponents(): void
    {
        $container = new Container();

        for ($i = 0; $i < 10; $i++) {
            $container->addComponent(new Body("Paragraph {$i}"));
        }

        $data = $container->jsonSerialize();

        $this->assertCount(10, $data['components']);
    }
}

