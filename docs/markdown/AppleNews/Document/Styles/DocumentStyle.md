
Global styles applied to the entire article document.

***

* Full name: `\TomGould\AppleNews\Document\Styles\DocumentStyle`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/applenewsformat/documentstyle

## Properties

### backgroundColor

```php
private ?string $backgroundColor
```

***

## Methods

### setBackgroundColor

Set the global background color of the article.

```php
public setBackgroundColor(string $color): self
```

**Parameters:**

| Parameter | Type       | Description              |
|-----------|------------|--------------------------|
| `$color`  | **string** | Hex code or named color. |

***

### jsonSerialize

```php
public jsonSerialize(): array<string,mixed>
```

***
