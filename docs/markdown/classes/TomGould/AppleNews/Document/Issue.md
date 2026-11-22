
Issue information for magazine and periodical content.

Use this class to associate articles with specific publication issues,
allowing Apple News to group related content together.

***

* Full name: `\TomGould\AppleNews\Document\Issue`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/issue

## Properties

### issueIdentifier

The unique identifier for the issue.

```php
private ?string $issueIdentifier
```

***

### issueDate

The publication date of the issue.

```php
private ?string $issueDate
```

***

### issueName

The display name of the issue.

```php
private ?string $issueName
```

***

## Methods

### setIssueIdentifier

Set the unique identifier for this issue.

```php
public setIssueIdentifier(string $identifier): $this
```

This identifier should be unique within your channel and consistent
across all articles belonging to the same issue.

**Parameters:**

| Parameter     | Type       | Description                  |
|---------------|------------|------------------------------|
| `$identifier` | **string** | The unique issue identifier. |

***

### setIssueDate

Set the publication date of the issue.

```php
public setIssueDate(\DateTimeInterface|string $date): $this
```

**Parameters:**

| Parameter | Type                           | Description                                             |
|-----------|--------------------------------|---------------------------------------------------------|
| `$date`   | **\DateTimeInterface\|string** | The issue date as a DateTime object or ISO 8601 string. |

***

### setIssueName

Set the display name of the issue.

```php
public setIssueName(string $name): $this
```

This is the human-readable name shown to users, such as "January 2024"
or "Summer Edition".

**Parameters:**

| Parameter | Type       | Description             |
|-----------|------------|-------------------------|
| `$name`   | **string** | The issue display name. |

***

### fromArray

Create an Issue from an array of data.

```php
public static fromArray(array<string,mixed> $data): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type                    | Description     |
|-----------|-------------------------|-----------------|
| `$data`   | **array<string,mixed>** | The issue data. |

**Return Value:**

A new Issue instance.

***

### isEmpty

Check if the issue has any data set.

```php
public isEmpty(): bool
```

**Return Value:**

True if at least one field is set.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,string>
```

***
