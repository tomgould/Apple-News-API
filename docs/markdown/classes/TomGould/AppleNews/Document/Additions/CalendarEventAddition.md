
Calendar event addition for creating calendar events.

Allows users to add events to their calendar from text.

***

* Full name: `\TomGould\AppleNews\Document\Additions\CalendarEventAddition`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Additions\AdditionInterface`](./AdditionInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/calendareventaddition

## Properties

### title

The event title.

```php
private ?string $title
```

***

### location

The event location.

```php
private ?string $location
```

***

### endDate

The event end date.

```php
private ?string $endDate
```

***

### rangeStart

The start position of the range.

```php
private ?int $rangeStart
```

***

### rangeLength

The length of the range.

```php
private ?int $rangeLength
```

***

### startDate

```php
private string $startDate
```

***

## Methods

### __construct

Create a new CalendarEventAddition.

```php
public __construct(string $startDate): mixed
```

**Parameters:**

| Parameter    | Type       | Description                      |
|--------------|------------|----------------------------------|
| `$startDate` | **string** | The event start date (ISO 8601). |

***

### startingAt

Create a calendar event addition.

```php
public static startingAt(\DateTimeInterface|string $startDate): self
```

* This method is **static**.
**Parameters:**

| Parameter    | Type                           | Description     |
|--------------|--------------------------------|-----------------|
| `$startDate` | **\DateTimeInterface\|string** | The start date. |

**Return Value:**

A new instance.

***

### getType

Get the addition type identifier.

```php
public getType(): string
```

**Return Value:**

The addition type.

***

### setTitle

Set the event title.

```php
public setTitle(string $title): $this
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$title`  | **string** | The title.  |

***

### setLocation

Set the event location.

```php
public setLocation(string $location): $this
```

**Parameters:**

| Parameter   | Type       | Description   |
|-------------|------------|---------------|
| `$location` | **string** | The location. |

***

### setEndDate

Set the event end date.

```php
public setEndDate(\DateTimeInterface|string $endDate): $this
```

**Parameters:**

| Parameter  | Type                           | Description   |
|------------|--------------------------------|---------------|
| `$endDate` | **\DateTimeInterface\|string** | The end date. |

***

### setRange

Set the text range.

```php
public setRange(int $start, int $length): $this
```

**Parameters:**

| Parameter | Type    | Description            |
|-----------|---------|------------------------|
| `$start`  | **int** | The starting position. |
| `$length` | **int** | The length.            |

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
