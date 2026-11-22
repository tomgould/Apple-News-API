
Interface for all ANF content display types.

Content displays control how child components are arranged within
container components like Section, Chapter, and Container.

***

* Full name: `\TomGould\AppleNews\Document\Layouts\ContentDisplayInterface`
* Parent interfaces:
  `JsonSerializable`

**See Also:**

* https://developer.apple.com/documentation/apple_news/collectiondisplay
* https://developer.apple.com/documentation/apple_news/horizontalstackdisplay

## Methods

### getType

Get the content display type identifier.

```php
public getType(): string
```

**Return Value:**

The display type (e.g., 'horizontal_stack', 'collection').

***
