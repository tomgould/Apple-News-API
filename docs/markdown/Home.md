This is an automatically generated documentation for **Apple News API PHP Client**.

## Namespaces

### \TomGould\AppleNews\Client

#### Classes

| Class                                                              | Description                                                     |
|--------------------------------------------------------------------|-----------------------------------------------------------------|
| [`AppleNewsClient`](./AppleNews/Client/AppleNewsClient.md)         | Apple News Publisher API Client.                                |
| [`Authenticator`](./AppleNews/Client/Authenticator.md)             | Handles HMAC-SHA256 authentication for Apple News API requests. |

### \TomGould\AppleNews\Document

#### Classes

| Class                                                    | Description                                             |
|----------------------------------------------------------|---------------------------------------------------------|
| [`Article`](./AppleNews/Document/Article.md)             | Represents an Apple News Format (ANF) article document. |
| [`Metadata`](./AppleNews/Document/Metadata.md)           | Article metadata for Apple News Format.                 |

### \TomGould\AppleNews\Document\Components

#### Classes

| Class                                                                       | Description                                                               |
|-----------------------------------------------------------------------------|---------------------------------------------------------------------------|
| [`Body`](./AppleNews/Document/Components/Body.md)                           | The standard text component for body paragraphs.                          |
| [`Caption`](./AppleNews/Document/Components/Caption.md)                     | A standard text component for captions.                                   |
| [`Component`](./AppleNews/Document/Components/Component.md)                 | Base class for all Apple News Format (ANF) components.                    |
| [`Container`](./AppleNews/Document/Components/Container.md)                 | A container component used to group other components together.            |
| [`Divider`](./AppleNews/Document/Components/Divider.md)                     | A visual separator line used between other components.                    |
| [`EmbedWebVideo`](./AppleNews/Document/Components/EmbedWebVideo.md)         | Embeds third-party video content (YouTube, Vimeo, etc.).                  |
| [`FacebookPost`](./AppleNews/Document/Components/FacebookPost.md)           | Component for embedding Facebook posts.                                   |
| [`Gallery`](./AppleNews/Document/Components/Gallery.md)                     | Component for displaying a collection of images as a gallery.             |
| [`Heading`](./AppleNews/Document/Components/Heading.md)                     | A heading component (supports levels 1 through 6).                        |
| [`Instagram`](./AppleNews/Document/Components/Instagram.md)                 | Component for embedding Instagram posts.                                  |
| [`LinkButton`](./AppleNews/Document/Components/LinkButton.md)               | A call-to-action button that links to an external URL or article section. |
| [`Photo`](./AppleNews/Document/Components/Photo.md)                         | Component for displaying single images in an article.                     |
| [`Pullquote`](./AppleNews/Document/Components/Pullquote.md)                 | Component for highlighting a quote within an article.                     |
| [`TextComponent`](./AppleNews/Document/Components/TextComponent.md)         | Base class for all components that primarily contain text content.        |
| [`Title`](./AppleNews/Document/Components/Title.md)                         | The main title component for an article.                                  |
| [`Tweet`](./AppleNews/Document/Components/Tweet.md)                         | Component for embedding X/Twitter posts.                                  |
| [`Video`](./AppleNews/Document/Components/Video.md)                         | Component for displaying native hosted videos.                            |

### \TomGould\AppleNews\Document\Layouts

#### Classes

| Class                                                      | Description                                             |
|------------------------------------------------------------|---------------------------------------------------------|
| [`Layout`](./AppleNews/Document/Layouts/Layout.md)         | Defines the column system and base grid for an article. |

### \TomGould\AppleNews\Document\Styles

#### Classes

| Class                                                                         | Description                                           |
|-------------------------------------------------------------------------------|-------------------------------------------------------|
| [`ComponentTextStyle`](./AppleNews/Document/Styles/ComponentTextStyle.md)     | Detailed text styling options for components.         |
| [`DocumentStyle`](./AppleNews/Document/Styles/DocumentStyle.md)               | Global styles applied to the entire article document. |

### \TomGould\AppleNews\Exception

#### Classes

| Class                                                                             | Description                                                                   |
|-----------------------------------------------------------------------------------|-------------------------------------------------------------------------------|
| [`AppleNewsException`](./AppleNews/Exception/AppleNewsException.md)               | Base exception class for all errors returned by the Apple News API.           |
| [`AuthenticationException`](./AppleNews/Exception/AuthenticationException.md)     | Exception thrown specifically when API authentication fails (401/403 errors). |

### \TomGould\AppleNews\Request

#### Classes

| Class                                                                 | Description                                                       |
|-----------------------------------------------------------------------|-------------------------------------------------------------------|
| [`MultipartBuilder`](./AppleNews/Request/MultipartBuilder.md)         | Builds multipart/form-data request bodies for the Apple News API. |
