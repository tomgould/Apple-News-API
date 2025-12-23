
Auto-placement configuration for automatic component insertion.

The AutoPlacement object controls how advertisements and other components
are automatically placed throughout the article.

***

* Full name: `\TomGould\AppleNews\Document\Layouts\AutoPlacement`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/autoplacement

## Properties

### advertisement

Advertisement auto-placement configuration.

```php
private ?\TomGould\AppleNews\Document\Layouts\AdvertisementAutoPlacement $advertisement
```

***

### conditional

Conditional auto-placement configurations.

```php
private list<array<string,mixed>>|null $conditional
```

***

## Methods

### setAdvertisement

Set the advertisement auto-placement.

```php
public setAdvertisement(\TomGould\AppleNews\Document\Layouts\AdvertisementAutoPlacement $advertisement): $this
```

**Parameters:**

| Parameter        | Type                                                                | Description                      |
|------------------|---------------------------------------------------------------------|----------------------------------|
| `$advertisement` | **\TomGould\AppleNews\Document\Layouts\AdvertisementAutoPlacement** | The advertisement configuration. |

***

### setConditional

Set conditional auto-placements.

```php
public setConditional(list<array<string,mixed>> $conditional): $this
```

**Parameters:**

| Parameter      | Type                          | Description                      |
|----------------|-------------------------------|----------------------------------|
| `$conditional` | **list<array<string,mixed>>** | Array of conditional placements. |

***

### addConditional

Add a conditional auto-placement.

```php
public addConditional(\TomGould\AppleNews\Document\Layouts\Condition $condition, \TomGould\AppleNews\Document\Layouts\AdvertisementAutoPlacement|null $advertisement = null): $this
```

**Parameters:**

| Parameter        | Type                                                                      | Description                            |
|------------------|---------------------------------------------------------------------------|----------------------------------------|
| `$condition`     | **\TomGould\AppleNews\Document\Layouts\Condition**                        | The condition to match.                |
| `$advertisement` | **\TomGould\AppleNews\Document\Layouts\AdvertisementAutoPlacement\|null** | Optional ad config for this condition. |

***

### withAdsDisabled

Create an AutoPlacement with ads disabled.

```php
public static withAdsDisabled(): self
```

* This method is **static**.
**Return Value:**

A new AutoPlacement instance.

***

### withAdFrequency

Create an AutoPlacement with specific ad frequency.

```php
public static withAdFrequency(int $frequency): self
```

* This method is **static**.
**Parameters:**

| Parameter    | Type    | Description                       |
|--------------|---------|-----------------------------------|
| `$frequency` | **int** | Number of components between ads. |

**Return Value:**

A new AutoPlacement instance.

***

### isEmpty

Check if the auto-placement has any configuration.

```php
public isEmpty(): bool
```

**Return Value:**

True if any configuration is set.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
