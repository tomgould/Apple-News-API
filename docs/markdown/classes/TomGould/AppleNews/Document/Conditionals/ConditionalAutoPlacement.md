
Conditional auto-placement configuration.

Allows ad placement settings to change based on conditions,
such as disabling ads on small screens.

***

* Full name: `\TomGould\AppleNews\Document\Conditionals\ConditionalAutoPlacement`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Conditionals\ConditionalInterface`](./ConditionalInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/conditionalautoplacement

## Properties

### conditions

The conditions that must be met.

```php
private list<\TomGould\AppleNews\Document\Layouts\Condition> $conditions
```

***

### advertisement

The advertisement configuration.

```php
private ?\TomGould\AppleNews\Document\Layouts\AdvertisementAutoPlacement $advertisement
```

***

### enabled

Whether auto-placement is enabled.

```php
private ?bool $enabled
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

### setAdvertisement

Set the advertisement configuration.

```php
public setAdvertisement(\TomGould\AppleNews\Document\Layouts\AdvertisementAutoPlacement $advertisement): $this
```

**Parameters:**

| Parameter        | Type                                                                | Description           |
|------------------|---------------------------------------------------------------------|-----------------------|
| `$advertisement` | **\TomGould\AppleNews\Document\Layouts\AdvertisementAutoPlacement** | The ad configuration. |

***

### setEnabled

Set whether auto-placement is enabled.

```php
public setEnabled(bool $enabled): $this
```

**Parameters:**

| Parameter  | Type     | Description      |
|------------|----------|------------------|
| `$enabled` | **bool** | Whether enabled. |

***

### disableOnCompact

Create a conditional that disables ads on compact screens.

```php
public static disableOnCompact(): self
```

* This method is **static**.
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
