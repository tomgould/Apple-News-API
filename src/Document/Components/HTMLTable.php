<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * HTMLTable component for HTML-formatted tables.
 *
 * The htmltable component renders a table from HTML markup,
 * supporting standard HTML table elements.
 *
 * @see https://developer.apple.com/documentation/apple_news/htmltable
 */
final class HTMLTable extends Component
{
    /**
     * The table style reference.
     */
    private ?string $tableStyle = null;

    /**
     * Create a new HTMLTable component.
     *
     * @param string $html The HTML table markup.
     */
    public function __construct(
        private readonly string $html
    ) {
    }

    /**
     * Create an HTMLTable from HTML markup.
     *
     * @param string $html The HTML table markup.
     *
     * @return self A new HTMLTable instance.
     */
    public static function fromHtml(string $html): self
    {
        return new self($html);
    }

    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'htmltable';
    }

    /**
     * Set the table style reference.
     *
     * @param string $style The style name.
     *
     * @return $this
     */
    public function setTableStyle(string $style): self
    {
        $this->tableStyle = $style;
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = array_merge(
            ['role' => $this->getRole()],
            $this->getBaseProperties(),
            ['html' => $this->html]
        );

        if ($this->tableStyle !== null) {
            $data['tableStyle'] = $this->tableStyle;
        }

        return $data;
    }
}

