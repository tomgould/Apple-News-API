<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles\Fills;

/**
 * Linear gradient background fill.
 *
 * @see https://developer.apple.com/documentation/apple_news/lineargradientfill
 */
final class LinearGradientFill implements FillInterface
{
    /**
     * The color stops.
     *
     * @var list<ColorStop>
     */
    private array $colorStops = [];

    /**
     * The gradient angle in degrees.
     */
    private ?float $angle = null;

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return 'linear_gradient';
    }

    /**
     * Add a color stop.
     *
     * @param ColorStop $stop The color stop.
     *
     * @return $this
     */
    public function addColorStop(ColorStop $stop): self
    {
        $this->colorStops[] = $stop;
        return $this;
    }

    /**
     * Add a color stop at a location.
     *
     * @param string $color    The color.
     * @param float  $location The location (0-100).
     *
     * @return $this
     */
    public function addStop(string $color, float $location): self
    {
        $this->colorStops[] = ColorStop::at($color, $location);
        return $this;
    }

    /**
     * Set the gradient angle.
     *
     * @param float $angle The angle in degrees.
     *
     * @return $this
     */
    public function setAngle(float $angle): self
    {
        $this->angle = $angle;
        return $this;
    }

    /**
     * Create a vertical gradient (top to bottom).
     *
     * @param string $startColor The start color.
     * @param string $endColor   The end color.
     *
     * @return self A new instance.
     */
    public static function vertical(string $startColor, string $endColor): self
    {
        return (new self())
            ->addStop($startColor, 0)
            ->addStop($endColor, 100)
            ->setAngle(180);
    }

    /**
     * Create a horizontal gradient (left to right).
     *
     * @param string $startColor The start color.
     * @param string $endColor   The end color.
     *
     * @return self A new instance.
     */
    public static function horizontal(string $startColor, string $endColor): self
    {
        return (new self())
            ->addStop($startColor, 0)
            ->addStop($endColor, 100)
            ->setAngle(90);
    }

    /**
     * Create a diagonal gradient (top-left to bottom-right).
     *
     * @param string $startColor The start color.
     * @param string $endColor   The end color.
     *
     * @return self A new instance.
     */
    public static function diagonal(string $startColor, string $endColor): self
    {
        return (new self())
            ->addStop($startColor, 0)
            ->addStop($endColor, 100)
            ->setAngle(135);
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [
            'type' => $this->getType(),
        ];

        if (!empty($this->colorStops)) {
            $data['colorStops'] = array_map(
                fn(ColorStop $stop) => $stop->jsonSerialize(),
                $this->colorStops
            );
        }

        if ($this->angle !== null) {
            $data['angle'] = $this->angle;
        }

        return $data;
    }
}

