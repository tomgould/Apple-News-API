
Advertisement auto-placement configuration.

Controls how advertisements are automatically placed within the article.

***

* Full name: `\TomGould\AppleNews\Document\Layouts\AdvertisementAutoPlacement`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/advertisementautoplacement

## Properties

### bannerType

Whether banner ads are enabled.

```php
private ?bool $bannerType
```

***

### distanceFromMedia

Distance from article start before first ad (in points or % of content).

```php
private ?int $distanceFromMedia
```

***

### enabled

Whether ads are enabled.

```php
private ?bool $enabled
```

***

### frequency

Frequency of ads (number of components between ads).

```php
private ?int $frequency
```

***

### layout

Layout for the advertisement component.

```php
private ?string $layout
```

***

## Methods

### setBannerType

Set whether banner type ads are enabled.

```php
public setBannerType(bool $enabled): $this
```

**Parameters:**

| Parameter  | Type     | Description                  |
|------------|----------|------------------------------|
| `$enabled` | **bool** | Whether banners are enabled. |

***

### setDistanceFromMedia

Set the distance from media before placing an ad.

```php
public setDistanceFromMedia(int $distance): $this
```

**Parameters:**

| Parameter   | Type    | Description         |
|-------------|---------|---------------------|
| `$distance` | **int** | Distance in points. |

***

### setEnabled

Set whether ads are enabled.

```php
public setEnabled(bool $enabled): $this
```

**Parameters:**

| Parameter  | Type     | Description              |
|------------|----------|--------------------------|
| `$enabled` | **bool** | Whether ads are enabled. |

***

### setFrequency

Set the frequency of ads.

```php
public setFrequency(int $frequency): $this
```

**Parameters:**

| Parameter    | Type    | Description                       |
|--------------|---------|-----------------------------------|
| `$frequency` | **int** | Number of components between ads. |

***

### setLayout

Set the layout reference for ads.

```php
public setLayout(string $layout): $this
```

**Parameters:**

| Parameter | Type       | Description  |
|-----------|------------|--------------|
| `$layout` | **string** | Layout name. |

***

### disabled

Create a disabled advertisement placement.

```php
public static disabled(): self
```

* This method is **static**.
**Return Value:**

A new instance with ads disabled.

***

### withFrequency

Create an advertisement placement with specific frequency.

```php
public static withFrequency(int $frequency): self
```

* This method is **static**.
**Parameters:**

| Parameter    | Type    | Description                       |
|--------------|---------|-----------------------------------|
| `$frequency` | **int** | Number of components between ads. |

**Return Value:**

A new instance.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
