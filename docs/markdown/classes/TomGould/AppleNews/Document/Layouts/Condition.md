
Condition object for conditional component properties.

Conditions allow components to have different properties based on
device characteristics like screen size, orientation, or platform.

***

* Full name: `\TomGould\AppleNews\Document\Layouts\Condition`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/condition

## Constants

| Constant                       | Visibility | Type | Value                     |
|--------------------------------|------------|------|---------------------------|
| `PLATFORM_ANY`                 | public     |      | 'any'                     |
| `PLATFORM_IOS`                 | public     |      | 'ios'                     |
| `PLATFORM_MACOS`               | public     |      | 'macos'                   |
| `SIZE_CLASS_ANY`               | public     |      | 'any'                     |
| `SIZE_CLASS_COMPACT`           | public     |      | 'compact'                 |
| `SIZE_CLASS_REGULAR`           | public     |      | 'regular'                 |
| `SUBSCRIPTION_BUNDLE`          | public     |      | 'bundle'                  |
| `SUBSCRIPTION_SUBSCRIBED`      | public     |      | 'subscribed'              |
| `VIEW_ARTICLE`                 | public     |      | 'article'                 |
| `VIEW_ISSUE_TABLE_OF_CONTENTS` | public     |      | 'issue_table_of_contents' |
| `VIEW_ISSUE`                   | public     |      | 'issue'                   |
| `COLOR_SCHEME_ANY`             | public     |      | 'any'                     |
| `COLOR_SCHEME_LIGHT`           | public     |      | 'light'                   |
| `COLOR_SCHEME_DARK`            | public     |      | 'dark'                    |

## Properties

### platform

The platform to match.

```php
private ?string $platform
```

***

### maxColumns

The maximum number of columns.

```php
private ?int $maxColumns
```

***

### minColumns

The minimum number of columns.

```php
private ?int $minColumns
```

***

### maxContentSizeCategory

The maximum content size category.

```php
private ?string $maxContentSizeCategory
```

***

### minContentSizeCategory

The minimum content size category.

```php
private ?string $minContentSizeCategory
```

***

### maxViewportAspectRatio

The maximum viewport aspect ratio.

```php
private ?float $maxViewportAspectRatio
```

***

### minViewportAspectRatio

The minimum viewport aspect ratio.

```php
private ?float $minViewportAspectRatio
```

***

### maxViewportWidth

The maximum viewport width in points.

```php
private ?int $maxViewportWidth
```

***

### minViewportWidth

The minimum viewport width in points.

```php
private ?int $minViewportWidth
```

***

### maxSpecifiedWidth

The maximum specified width.

```php
private ?int $maxSpecifiedWidth
```

***

### minSpecifiedWidth

The minimum specified width.

```php
private ?int $minSpecifiedWidth
```

***

### horizontalSizeClass

The horizontal size class.

```php
private ?string $horizontalSizeClass
```

***

### verticalSizeClass

The vertical size class.

```php
private ?string $verticalSizeClass
```

***

### subscriptionStatus

The subscription status.

```php
private list<string>|null $subscriptionStatus
```

***

### viewLocation

The view location.

```php
private ?string $viewLocation
```

***

### preferredColorScheme

The preferred color scheme.

```php
private ?string $preferredColorScheme
```

***

## Methods

### setPlatform

Set the platform.

```php
public setPlatform(string $platform): $this
```

**Parameters:**

| Parameter   | Type       | Description                   |
|-------------|------------|-------------------------------|
| `$platform` | **string** | One of 'any', 'ios', 'macos'. |

***

### setMaxColumns

Set the maximum columns.

```php
public setMaxColumns(int $columns): $this
```

**Parameters:**

| Parameter  | Type    | Description           |
|------------|---------|-----------------------|
| `$columns` | **int** | Maximum column count. |

***

### setMinColumns

Set the minimum columns.

```php
public setMinColumns(int $columns): $this
```

**Parameters:**

| Parameter  | Type    | Description           |
|------------|---------|-----------------------|
| `$columns` | **int** | Minimum column count. |

***

### setMaxViewportWidth

Set the maximum viewport width.

```php
public setMaxViewportWidth(int $width): $this
```

**Parameters:**

| Parameter | Type    | Description              |
|-----------|---------|--------------------------|
| `$width`  | **int** | Maximum width in points. |

***

### setMinViewportWidth

Set the minimum viewport width.

```php
public setMinViewportWidth(int $width): $this
```

**Parameters:**

| Parameter | Type    | Description              |
|-----------|---------|--------------------------|
| `$width`  | **int** | Minimum width in points. |

***

### setMaxViewportAspectRatio

Set the maximum viewport aspect ratio.

```php
public setMaxViewportAspectRatio(float $ratio): $this
```

**Parameters:**

| Parameter | Type      | Description                          |
|-----------|-----------|--------------------------------------|
| `$ratio`  | **float** | Maximum aspect ratio (width/height). |

***

### setMinViewportAspectRatio

Set the minimum viewport aspect ratio.

```php
public setMinViewportAspectRatio(float $ratio): $this
```

**Parameters:**

| Parameter | Type      | Description                          |
|-----------|-----------|--------------------------------------|
| `$ratio`  | **float** | Minimum aspect ratio (width/height). |

***

### setMaxSpecifiedWidth

Set the maximum specified width.

```php
public setMaxSpecifiedWidth(int $width): $this
```

**Parameters:**

| Parameter | Type    | Description    |
|-----------|---------|----------------|
| `$width`  | **int** | Maximum width. |

***

### setMinSpecifiedWidth

Set the minimum specified width.

```php
public setMinSpecifiedWidth(int $width): $this
```

**Parameters:**

| Parameter | Type    | Description    |
|-----------|---------|----------------|
| `$width`  | **int** | Minimum width. |

***

### setHorizontalSizeClass

Set the horizontal size class.

```php
public setHorizontalSizeClass(string $sizeClass): $this
```

**Parameters:**

| Parameter    | Type       | Description                         |
|--------------|------------|-------------------------------------|
| `$sizeClass` | **string** | One of 'any', 'compact', 'regular'. |

***

### setVerticalSizeClass

Set the vertical size class.

```php
public setVerticalSizeClass(string $sizeClass): $this
```

**Parameters:**

| Parameter    | Type       | Description                         |
|--------------|------------|-------------------------------------|
| `$sizeClass` | **string** | One of 'any', 'compact', 'regular'. |

***

### setMaxContentSizeCategory

Set the maximum content size category.

```php
public setMaxContentSizeCategory(string $category): $this
```

**Parameters:**

| Parameter   | Type       | Description                |
|-------------|------------|----------------------------|
| `$category` | **string** | The content size category. |

***

### setMinContentSizeCategory

Set the minimum content size category.

```php
public setMinContentSizeCategory(string $category): $this
```

**Parameters:**

| Parameter   | Type       | Description                |
|-------------|------------|----------------------------|
| `$category` | **string** | The content size category. |

***

### setSubscriptionStatus

Set the subscription status.

```php
public setSubscriptionStatus(list<string> $status): $this
```

**Parameters:**

| Parameter | Type             | Description                     |
|-----------|------------------|---------------------------------|
| `$status` | **list<string>** | Array of subscription statuses. |

***

### setViewLocation

Set the view location.

```php
public setViewLocation(string $location): $this
```

**Parameters:**

| Parameter   | Type       | Description                                           |
|-------------|------------|-------------------------------------------------------|
| `$location` | **string** | One of 'article', 'issue_table_of_contents', 'issue'. |

***

### setPreferredColorScheme

Set the preferred color scheme.

```php
public setPreferredColorScheme(string $scheme): $this
```

**Parameters:**

| Parameter | Type       | Description                    |
|-----------|------------|--------------------------------|
| `$scheme` | **string** | One of 'any', 'light', 'dark'. |

***

### iOS

Create a condition for iOS platform only.

```php
public static iOS(): self
```

* This method is **static**.
**Return Value:**

A new Condition instance.

***

### macOS

Create a condition for macOS platform only.

```php
public static macOS(): self
```

* This method is **static**.
**Return Value:**

A new Condition instance.

***

### compactWidth

Create a condition for compact horizontal size class.

```php
public static compactWidth(): self
```

* This method is **static**.
**Return Value:**

A new Condition instance.

***

### regularWidth

Create a condition for regular horizontal size class.

```php
public static regularWidth(): self
```

* This method is **static**.
**Return Value:**

A new Condition instance.

***

### darkMode

Create a condition for dark mode.

```php
public static darkMode(): self
```

* This method is **static**.
**Return Value:**

A new Condition instance.

***

### lightMode

Create a condition for light mode.

```php
public static lightMode(): self
```

* This method is **static**.
**Return Value:**

A new Condition instance.

***

### viewportWidth

Create a condition for a viewport width range.

```php
public static viewportWidth(int|null $min = null, int|null $max = null): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type          | Description              |
|-----------|---------------|--------------------------|
| `$min`    | **int\|null** | Minimum width in points. |
| `$max`    | **int\|null** | Maximum width in points. |

**Return Value:**

A new Condition instance.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
