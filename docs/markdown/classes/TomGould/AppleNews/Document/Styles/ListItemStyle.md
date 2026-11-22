
Style for bullet or numbered list items.

***

* Full name: `\TomGould\AppleNews\Document\Styles\ListItemStyle`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/listitemstyle

## Constants

| Constant           | Visibility | Type | Value                |
|--------------------|------------|------|----------------------|
| `TYPE_BULLET`      | public     |      | 'bullet'             |
| `TYPE_DECIMAL`     | public     |      | 'decimal'            |
| `TYPE_LOWER_ALPHA` | public     |      | 'lower_alphabetical' |
| `TYPE_UPPER_ALPHA` | public     |      | 'upper_alphabetical' |
| `TYPE_LOWER_ROMAN` | public     |      | 'lower_roman'        |
| `TYPE_UPPER_ROMAN` | public     |      | 'upper_roman'        |
| `TYPE_CHARACTER`   | public     |      | 'character'          |
| `TYPE_NONE`        | public     |      | 'none'               |

## Properties

### type

The list type.

```php
private ?string $type
```

***

### character

Custom character for character type.

```php
private ?string $character
```

***

## Methods

### setType

Set the list type.

```php
public setType(string $type): $this
```

**Parameters:**

| Parameter | Type       | Description    |
|-----------|------------|----------------|
| `$type`   | **string** | The list type. |

***

### setCharacter

Set a custom character for bullet.

```php
public setCharacter(string $character): $this
```

**Parameters:**

| Parameter    | Type       | Description           |
|--------------|------------|-----------------------|
| `$character` | **string** | The character to use. |

***

### bullet

Create a bullet list style.

```php
public static bullet(): self
```

* This method is **static**.
**Return Value:**

A new instance.

***

### decimal

Create a numbered list style.

```php
public static decimal(): self
```

* This method is **static**.
**Return Value:**

A new instance.

***

### lowerAlpha

Create a lower alpha list style (a, b, c...).

```php
public static lowerAlpha(): self
```

* This method is **static**.
**Return Value:**

A new instance.

***

### upperAlpha

Create an upper alpha list style (A, B, C...).

```php
public static upperAlpha(): self
```

* This method is **static**.
**Return Value:**

A new instance.

***

### lowerRoman

Create a lower roman list style (i, ii, iii...).

```php
public static lowerRoman(): self
```

* This method is **static**.
**Return Value:**

A new instance.

***

### upperRoman

Create an upper roman list style (I, II, III...).

```php
public static upperRoman(): self
```

* This method is **static**.
**Return Value:**

A new instance.

***

### withCharacter

Create a custom character list style.

```php
public static withCharacter(string $char): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description           |
|-----------|------------|-----------------------|
| `$char`   | **string** | The character to use. |

**Return Value:**

A new instance.

***

### none

Create a no-bullet list style.

```php
public static none(): self
```

* This method is **static**.
**Return Value:**

A new instance.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
