
Conditional properties for document styles.

Allows document-level style properties to change based on conditions,
typically used for dark mode support.

***

* Full name: `\TomGould\AppleNews\Document\Conditionals\ConditionalDocumentStyle`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Conditionals\ConditionalInterface`](./ConditionalInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/conditionaldocumentstyle

## Properties

### conditions

The conditions that must be met.

```php
private list<\TomGould\AppleNews\Document\Layouts\Condition> $conditions
```

***

### backgroundColor

The background color.

```php
private ?string $backgroundColor
```

***

## Methods

### addCondition

Add a condition.

```php
public addCondition(\TomGould\AppleNews\Document\Layouts\Condition $condition): $this
```

**Parameters:**

| Parameter    | Type                                               | Description           |
|--------------|----------------------------------------------------|-----------------------|
| `$condition` | **\TomGould\AppleNews\Document\Layouts\Condition** | The condition to add. |

***

### setBackgroundColor

Set the background color.

```php
public setBackgroundColor(string $color): $this
```

**Parameters:**

| Parameter | Type       | Description              |
|-----------|------------|--------------------------|
| `$color`  | **string** | The color in hex format. |

***

### darkMode

Create a dark mode document style.

```php
public static darkMode(string $backgroundColor = '#1C1C1E'): self
```

* This method is **static**.
**Parameters:**

| Parameter          | Type       | Description                     |
|--------------------|------------|---------------------------------|
| `$backgroundColor` | **string** | The dark mode background color. |

**Return Value:**

A new instance.

***

### lightMode

Create a light mode document style.

```php
public static lightMode(string $backgroundColor = '#FFFFFF'): self
```

* This method is **static**.
**Parameters:**

| Parameter          | Type       | Description                      |
|--------------------|------------|----------------------------------|
| `$backgroundColor` | **string** | The light mode background color. |

**Return Value:**

A new instance.

***

### hasConditions

Check if any conditions have been set.

```php
public hasConditions(): bool
```

**Return Value:**

True if conditions exist.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
