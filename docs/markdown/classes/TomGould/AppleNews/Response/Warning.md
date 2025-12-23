
Warning message returned by the Apple News API for non-fatal issues.

Warnings indicate problems that did not prevent the request from succeeding,
but may affect how the article appears or behaves. You should review warnings
and address them when possible.

***

* Full name: `\TomGould\AppleNews\Response\Warning`
* This class is marked as **final** and can't be subclassed
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/applenewsapi/warning

## Properties

### code

```php
public string $code
```

***

### keyPath

```php
public ?string $keyPath
```

***

### message

```php
public ?string $message
```

***

## Methods

### __construct

Create a new Warning instance.

```php
public __construct(string $code, string|null $keyPath = null, string|null $message = null): mixed
```

**Parameters:**

| Parameter  | Type             | Description                                                      |
|------------|------------------|------------------------------------------------------------------|
| `$code`    | **string**       | The warning code identifying the type of warning.                |
| `$keyPath` | **string\|null** | The path to the field that triggered the warning, if applicable. |
| `$message` | **string\|null** | A human-readable description of the warning.                     |

***

### fromArray

Create a Warning instance from API response data.

```php
public static fromArray(array<string,mixed> $data): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type                    | Description                             |
|-----------|-------------------------|-----------------------------------------|
| `$data`   | **array<string,mixed>** | The warning data from the API response. |

**Return Value:**

A new Warning instance populated with the response data.

***

### fromArrayList

Create multiple Warning instances from an array of warning data.

```php
public static fromArrayList(array<int,array<string,mixed>> $warnings): list<self>
```

* This method is **static**.
**Parameters:**

| Parameter   | Type                               | Description                                  |
|-------------|------------------------------------|----------------------------------------------|
| `$warnings` | **array<int,array<string,mixed>>** | Array of warning data from the API response. |

**Return Value:**

List of Warning instances.

***
