
Throttling information returned by Create and Update Article endpoints.

This object provides rate limit information to help you implement smart
request scheduling and avoid hitting API rate limits. It is included in
the Meta object of Create and Update Article responses.

***

* Full name: `\TomGould\AppleNews\Response\Throttling`
* This class is marked as **final** and can't be subclassed
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/applenewsapi/throttling

## Properties

### estimatedDelayInSeconds

```php
public ?int $estimatedDelayInSeconds
```

***

### queueSize

```php
public ?int $queueSize
```

***

### quotaAvailable

```php
public ?int $quotaAvailable
```

***

## Methods

### __construct

Create a new Throttling instance.

```php
public __construct(int|null $estimatedDelayInSeconds = null, int|null $queueSize = null, int|null $quotaAvailable = null): mixed
```

**Parameters:**

| Parameter                  | Type          | Description                                                          |
|----------------------------|---------------|----------------------------------------------------------------------|
| `$estimatedDelayInSeconds` | **int\|null** | Estimated delay in seconds before the next request can be processed. |
| `$queueSize`               | **int\|null** | Number of requests currently queued for processing.                  |
| `$quotaAvailable`          | **int\|null** | Number of requests remaining in the current quota period.            |

***

### fromArray

Create a Throttling instance from API response data.

```php
public static fromArray(array<string,mixed> $data): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type                    | Description                                |
|-----------|-------------------------|--------------------------------------------|
| `$data`   | **array<string,mixed>** | The throttling data from the API response. |

**Return Value:**

A new Throttling instance populated with the response data.

***

### shouldDelay

Check if we should delay before making another request.

```php
public shouldDelay(): bool
```

Returns true if estimatedDelayInSeconds is set and greater than zero,
indicating that the API is requesting a delay before the next request.

**Return Value:**

True if a delay is recommended before the next request.

***

### isQuotaLow

Check if quota is exhausted or nearly exhausted.

```php
public isQuotaLow(int $threshold = 10): bool
```

Use this to proactively pause requests before hitting rate limits.

**Parameters:**

| Parameter    | Type    | Description                                                |
|--------------|---------|------------------------------------------------------------|
| `$threshold` | **int** | The minimum quota level to consider "low". Defaults to 10. |

**Return Value:**

True if quotaAvailable is at or below the threshold.

***
