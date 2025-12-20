
This is an automatically generated documentation for **Apple News API PHP Client**.

## Namespaces

### \TomGould\AppleNews\Client

#### Classes

| Class                                                                    | Description                                                     |
|--------------------------------------------------------------------------|-----------------------------------------------------------------|
| [`AppleNewsClient`](./markdown/AppleNews/Client/AppleNewsClient) | Apple News Publisher API Client.                                |
| [`Authenticator`](./markdown/AppleNews/Client/Authenticator)     | Handles HMAC-SHA256 authentication for Apple News API requests. |

### \TomGould\AppleNews\Document

#### Classes

| Class                                                        | Description                                             |
|--------------------------------------------------------------|---------------------------------------------------------|
| [`Article`](./markdown/AppleNews/Document/Article)   | Represents an Apple News Format (ANF) article document. |
| [`Metadata`](./markdown/AppleNews/Document/Metadata) | Article metadata for Apple News Format.                 |

### \TomGould\AppleNews\Document\Components

#### Classes

| Class                                                                             | Description                                                               |
|-----------------------------------------------------------------------------------|---------------------------------------------------------------------------|
| [`Body`](./markdown/AppleNews/Document/Components/Body)                   | The standard text component for body paragraphs.                          |
| [`Caption`](./markdown/AppleNews/Document/Components/Caption)             | A standard text component for captions.                                   |
| [`Component`](./markdown/AppleNews/Document/Components/Component)         | Base class for all Apple News Format (ANF) components.                    |
| [`Container`](./markdown/AppleNews/Document/Components/Container)         | A container component used to group other components together.            |
| [`Divider`](./markdown/AppleNews/Document/Components/Divider)             | A visual separator line used between other components.                    |
| [`EmbedWebVideo`](./markdown/AppleNews/Document/Components/EmbedWebVideo) | Embeds third-party video content (YouTube, Vimeo, etc.).                  |
| [`FacebookPost`](./markdown/AppleNews/Document/Components/FacebookPost)   | Component for embedding Facebook posts.                                   |
| [`Gallery`](./markdown/AppleNews/Document/Components/Gallery)             | Component for displaying a collection of images as a gallery.             |
| [`Heading`](./markdown/AppleNews/Document/Components/Heading)             | A heading component (supports levels 1 through 6).                        |
| [`Instagram`](./markdown/AppleNews/Document/Components/Instagram)         | Component for embedding Instagram posts.                                  |
| [`LinkButton`](./markdown/AppleNews/Document/Components/LinkButton)       | A call-to-action button that links to an external URL or article section. |
| [`Photo`](./markdown/AppleNews/Document/Components/Photo)                 | Component for displaying single images in an article.                     |
| [`Pullquote`](./markdown/AppleNews/Document/Components/Pullquote)         | Component for highlighting a quote within an article.                     |
| [`TextComponent`](./markdown/AppleNews/Document/Components/TextComponent) | Base class for all components that primarily contain text content.        |
| [`Title`](./markdown/AppleNews/Document/Components/Title)                 | The main title component for an article.                                  |
| [`Tweet`](./markdown/AppleNews/Document/Components/Tweet)                 | Component for embedding X/Twitter posts.                                  |
| [`Video`](./markdown/AppleNews/Document/Components/Video)                 | Component for displaying native hosted videos.                            |

### \TomGould\AppleNews\Document\Layouts

#### Classes

| Class                                                            | Description                                             |
|------------------------------------------------------------------|---------------------------------------------------------|
| [`Layout`](./markdown/AppleNews/Document/Layouts/Layout) | Defines the column system and base grid for an article. |

### \TomGould\AppleNews\Document\Styles

#### Classes

| Class                                                                                   | Description                                           |
|-----------------------------------------------------------------------------------------|-------------------------------------------------------|
| [`ComponentTextStyle`](./markdown/AppleNews/Document/Styles/ComponentTextStyle) | Detailed text styling options for components.         |
| [`DocumentStyle`](./markdown/AppleNews/Document/Styles/DocumentStyle)           | Global styles applied to the entire article document. |

### \TomGould\AppleNews\Exception

#### Classes

| Class                                                                                       | Description                                                                   |
|---------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------|
| [`AppleNewsException`](./markdown/AppleNews/Exception/AppleNewsException)           | Base exception class for all errors returned by the Apple News API.           |
| [`AuthenticationException`](./markdown/AppleNews/Exception/AuthenticationException) | Exception thrown specifically when API authentication fails (401/403 errors). |

### \TomGould\AppleNews\Request

#### Classes

| Class                                                                       | Description                                                       |
|-----------------------------------------------------------------------------|-------------------------------------------------------------------|
| [`MultipartBuilder`](./markdown/AppleNews/Request/MultipartBuilder) | Builds multipart/form-data request bodies for the Apple News API. |
