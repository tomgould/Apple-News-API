
DataTable component for structured tabular data.

The datatable component displays data in a sortable, interactive table format.
It supports rich data types and automatic formatting.

***

* Full name: `\TomGould\AppleNews\Document\Components\DataTable`
* Parent class: [`\TomGould\AppleNews\Document\Components\Component`](./Component.md)
* This class is marked as **final** and can't be subclassed
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/datatable

## Properties

### data

The table data descriptor.

```php
private array<string,mixed>|null $data
```

***

### showDescriptorLabels

Whether to show the header row.

```php
private ?bool $showDescriptorLabels
```

***

### sortBy

The sort order for data.

```php
private list<array{descriptor: string, direction: string}>|null $sortBy
```

***

### dataTableStyle

The table style reference.

```php
private ?string $dataTableStyle
```

***

## Methods

### getRole

Get the role name for the component (e.g., 'body', 'photo', 'heading1').

```php
public getRole(): string
```

***

### setData

Set the table data.

```php
public setData(array<string,mixed> $data): $this
```

The data array should follow the Apple News data descriptor format
with 'descriptors' and 'records' keys.

**Parameters:**

| Parameter | Type                    | Description     |
|-----------|-------------------------|-----------------|
| `$data`   | **array<string,mixed>** | The table data. |

***

### setShowDescriptorLabels

Set whether to show descriptor labels (header row).

```php
public setShowDescriptorLabels(bool $show): $this
```

**Parameters:**

| Parameter | Type     | Description             |
|-----------|----------|-------------------------|
| `$show`   | **bool** | Whether to show labels. |

***

### setSortBy

Set the sort order for the data.

```php
public setSortBy(list<array{descriptor: string, direction: string}> $sortBy): $this
```

**Parameters:**

| Parameter | Type                                                   | Description         |
|-----------|--------------------------------------------------------|---------------------|
| `$sortBy` | **list<array{descriptor: string, direction: string}>** | Sort configuration. |

***

### addSortBy

Add a sort descriptor.

```php
public addSortBy(string $descriptor, string $direction = 'ascending'): $this
```

**Parameters:**

| Parameter     | Type       | Description                                       |
|---------------|------------|---------------------------------------------------|
| `$descriptor` | **string** | The descriptor identifier to sort by.             |
| `$direction`  | **string** | The sort direction ('ascending' or 'descending'). |

***

### setDataTableStyle

Set the table style reference.

```php
public setDataTableStyle(string $style): $this
```

**Parameters:**

| Parameter | Type       | Description     |
|-----------|------------|-----------------|
| `$style`  | **string** | The style name. |

***

### jsonSerialize

Implementation of JsonSerializable.

```php
public jsonSerialize(): array<string,mixed>
```

***

## Inherited methods

### getRole

Get the role name for the component (e.g., 'body', 'photo', 'heading1').

```php
public getRole(): string
```

* This method is **abstract**.
***

### setIdentifier

Set a unique identifier for this component.

```php
public setIdentifier(string $identifier): static
```

**Parameters:**

| Parameter     | Type       | Description            |
|---------------|------------|------------------------|
| `$identifier` | **string** | The unique identifier. |

***

### setLayout

Set the layout name or inline layout.

```php
public setLayout(string $layout): static
```

**Parameters:**

| Parameter | Type       | Description                              |
|-----------|------------|------------------------------------------|
| `$layout` | **string** | Reference to a name in componentLayouts. |

***

### setStyle

Set the style name.

```php
public setStyle(string $style): static
```

**Parameters:**

| Parameter | Type       | Description                             |
|-----------|------------|-----------------------------------------|
| `$style`  | **string** | Reference to a name in componentStyles. |

***

### setAnchor

Set the anchor configuration.

```php
public setAnchor(string $anchor): static
```

**Parameters:**

| Parameter | Type       | Description               |
|-----------|------------|---------------------------|
| `$anchor` | **string** | The anchor configuration. |

***

### setAnimation

Set component animation using an array.

```php
public setAnimation(array<string,mixed> $animation): static
```

**Parameters:**

| Parameter    | Type                    | Description           |
|--------------|-------------------------|-----------------------|
| `$animation` | **array<string,mixed>** | Animation properties. |

**See Also:**

* https://developer.apple.com/documentation/applenewsformat/fadeinanimation

***

### setAnimationObject

Set the component animation using a typed Animation object.

```php
public setAnimationObject(\TomGould\AppleNews\Document\Animations\AnimationInterface $animation): static
```

This method provides type-safe animation configuration:
```php
$photo->setAnimationObject(FadeInAnimation::fromTransparent());
$body->setAnimationObject(MoveInAnimation::fromLeft());
```

**Parameters:**

| Parameter    | Type                                                           | Description           |
|--------------|----------------------------------------------------------------|-----------------------|
| `$animation` | **\TomGould\AppleNews\Document\Animations\AnimationInterface** | The animation object. |

***

### setBehavior

Set the component behavior using an array.

```php
public setBehavior(array<string,mixed> $behavior): static
```

**Parameters:**

| Parameter   | Type                    | Description                       |
|-------------|-------------------------|-----------------------------------|
| `$behavior` | **array<string,mixed>** | The behavior configuration array. |

**See Also:**

* https://developer.apple.com/documentation/applenewsformat/parallax

***

### setBehaviorObject

Set the component behavior using a typed Behavior object.

```php
public setBehaviorObject(\TomGould\AppleNews\Document\Behaviors\BehaviorInterface $behavior): static
```

This method provides type-safe behavior configuration:
```php
$photo->setBehaviorObject(Parallax::withFactor(0.8));
$photo->setBehaviorObject(new Springy());
```

**Parameters:**

| Parameter   | Type                                                         | Description          |
|-------------|--------------------------------------------------------------|----------------------|
| `$behavior` | **\TomGould\AppleNews\Document\Behaviors\BehaviorInterface** | The behavior object. |

***

### setHidden

Set whether the component is hidden.

```php
public setHidden(bool $hidden): static
```

**Parameters:**

| Parameter | Type     | Description                    |
|-----------|----------|--------------------------------|
| `$hidden` | **bool** | Whether to hide the component. |

***

### setConditional

Set conditional properties for the component.

```php
public setConditional(array<string,mixed> $conditional): static
```

**Parameters:**

| Parameter      | Type                    | Description          |
|----------------|-------------------------|----------------------|
| `$conditional` | **array<string,mixed>** | Array of conditions. |

**See Also:**

* https://developer.apple.com/documentation/applenewsformat/condition

***

### getBaseProperties

Get the base properties common to all components for JSON serialization.

```php
protected getBaseProperties(): array<string,mixed>
```

***

### jsonSerialize

Implementation of JsonSerializable.

```php
public jsonSerialize(): array<string,mixed>
```

***
