
Horizontal stack display for arranging components horizontally.

The horizontal_stack display arranges child components in a horizontal
row, typically used for side-by-side layouts.

***

* Full name: `\TomGould\AppleNews\Document\Layouts\HorizontalStackDisplay`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Layouts\ContentDisplayInterface`](./ContentDisplayInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/horizontalstackdisplay

## Methods

### getType

Get the content display type identifier.

```php
public getType(): string
```

**Return Value:**

The display type (e.g., 'horizontal_stack', 'collection').

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array{type: string}
```

***
