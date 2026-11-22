
Meta object wrapping throttling information from Create/Update Article responses.

The Meta object is returned as part of Create Article and Update Article
responses and contains information about rate limiting and request quotas.

***

* Full name: `\TomGould\AppleNews\Response\Meta`
* This class is marked as **final** and can't be subclassed
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/applenewsapi/meta

## Properties

### throttling

```php
public ?\TomGould\AppleNews\Response\Throttling $throttling
```

***

## Methods

### __construct

Create a new Meta instance.

```php
public __construct(\TomGould\AppleNews\Response\Throttling|null $throttling = null): mixed
```

**Parameters:**

| Parameter     | Type                                              | Description                                       |
|---------------|---------------------------------------------------|---------------------------------------------------|
| `$throttling` | **\TomGould\AppleNews\Response\Throttling\|null** | Throttling information for rate limit management. |

***

### fromArray

Create a Meta instance from API response data.

```php
public static fromArray(array<string,mixed> $data): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type                    | Description                          |
|-----------|-------------------------|--------------------------------------|
| `$data`   | **array<string,mixed>** | The meta data from the API response. |

**Return Value:**

A new Meta instance populated with the response data.

***
