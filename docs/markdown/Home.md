
This is an automatically generated documentation for **Apple News API PHP Client**.

## Namespaces

### \TomGould\AppleNews\Client

#### Classes

| Class                                                                    | Description                                                     |
|--------------------------------------------------------------------------|-----------------------------------------------------------------|
| [`AppleNewsClient`](./classes/TomGould/AppleNews/Client/AppleNewsClient.md) | Apple News Publisher API Client.                                |
| [`Authenticator`](./classes/TomGould/AppleNews/Client/Authenticator.md)     | Handles HMAC-SHA256 authentication for Apple News API requests. |

### \TomGould\AppleNews\Document

#### Classes

| Class                                                        | Description                                             |
|--------------------------------------------------------------|---------------------------------------------------------|
| [`Article`](./classes/TomGould/AppleNews/Document/Article.md)   | Represents an Apple News Format (ANF) article document. |
| [`Issue`](./classes/TomGould/AppleNews/Document/Issue.md)       | Issue information for magazine and periodical content.  |
| [`Metadata`](./classes/TomGould/AppleNews/Document/Metadata.md) | Article metadata for Apple News Format.                 |

### \TomGould\AppleNews\Document\Additions

#### Classes

| Class                                                                                            | Description                                           |
|--------------------------------------------------------------------------------------------------|-------------------------------------------------------|
| [`CalendarEventAddition`](./classes/TomGould/AppleNews/Document/Additions/CalendarEventAddition.md) | Calendar event addition for creating calendar events. |
| [`ComponentLink`](./classes/TomGould/AppleNews/Document/Additions/ComponentLink.md)                 | Component link for making entire components tappable. |
| [`LinkAddition`](./classes/TomGould/AppleNews/Document/Additions/LinkAddition.md)                   | Link addition for making text ranges tappable.        |

#### Interfaces

| Interface                                                                                | Description                       |
|------------------------------------------------------------------------------------------|-----------------------------------|
| [`AdditionInterface`](./classes/TomGould/AppleNews/Document/Additions/AdditionInterface.md) | Interface for all addition types. |

### \TomGould\AppleNews\Document\Animations

#### Classes

| Class                                                                                       | Description                          |
|---------------------------------------------------------------------------------------------|--------------------------------------|
| [`AppearAnimation`](./classes/TomGould/AppleNews/Document/Animations/AppearAnimation.md)       | Appear animation for components.     |
| [`FadeInAnimation`](./classes/TomGould/AppleNews/Document/Animations/FadeInAnimation.md)       | Fade-in animation for components.    |
| [`MoveInAnimation`](./classes/TomGould/AppleNews/Document/Animations/MoveInAnimation.md)       | Move-in animation for components.    |
| [`ScaleFadeAnimation`](./classes/TomGould/AppleNews/Document/Animations/ScaleFadeAnimation.md) | Scale-fade animation for components. |

#### Interfaces

| Interface                                                                                   | Description                                 |
|---------------------------------------------------------------------------------------------|---------------------------------------------|
| [`AnimationInterface`](./classes/TomGould/AppleNews/Document/Animations/AnimationInterface.md) | Interface for all ANF component animations. |

### \TomGould\AppleNews\Document\Behaviors

#### Classes

| Class                                                                                      | Description                                                       |
|--------------------------------------------------------------------------------------------|-------------------------------------------------------------------|
| [`BackgroundMotion`](./classes/TomGould/AppleNews/Document/Behaviors/BackgroundMotion.md)     | BackgroundMotion behavior for background motion effects.          |
| [`BackgroundParallax`](./classes/TomGould/AppleNews/Document/Behaviors/BackgroundParallax.md) | BackgroundParallax behavior for scroll-based background parallax. |
| [`Motion`](./classes/TomGould/AppleNews/Document/Behaviors/Motion.md)                         | Motion behavior for device motion-based parallax.                 |
| [`Parallax`](./classes/TomGould/AppleNews/Document/Behaviors/Parallax.md)                     | Parallax behavior for scroll-based parallax effects.              |
| [`Springy`](./classes/TomGould/AppleNews/Document/Behaviors/Springy.md)                       | Springy behavior for device tilt-based movement.                  |

#### Interfaces

| Interface                                                                                | Description                                |
|------------------------------------------------------------------------------------------|--------------------------------------------|
| [`BehaviorInterface`](./classes/TomGould/AppleNews/Document/Behaviors/BehaviorInterface.md) | Interface for all ANF component behaviors. |

### \TomGould\AppleNews\Document\Components

#### Classes

| Class                                                                                                           | Description                                                               |
|-----------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------|
| [`ARKit`](./classes/TomGould/AppleNews/Document/Components/ARKit.md)                                               | ARKit component for augmented reality experiences.                        |
| [`ArticleLink`](./classes/TomGould/AppleNews/Document/Components/ArticleLink.md)                                   | Article link component.                                                   |
| [`Aside`](./classes/TomGould/AppleNews/Document/Components/Aside.md)                                               | Aside container component.                                                |
| [`Audio`](./classes/TomGould/AppleNews/Document/Components/Audio.md)                                               | Audio component for audio content playback.                               |
| [`Author`](./classes/TomGould/AppleNews/Document/Components/Author.md)                                             | Author name component.                                                    |
| [`BannerAdvertisement`](./classes/TomGould/AppleNews/Document/Components/BannerAdvertisement.md)                   | Banner advertisement component.                                           |
| [`Body`](./classes/TomGould/AppleNews/Document/Components/Body.md)                                                 | The standard text component for body paragraphs.                          |
| [`Byline`](./classes/TomGould/AppleNews/Document/Components/Byline.md)                                             | Byline component for publication date and contributor credits.            |
| [`Caption`](./classes/TomGould/AppleNews/Document/Components/Caption.md)                                           | A standard text component for captions.                                   |
| [`Chapter`](./classes/TomGould/AppleNews/Document/Components/Chapter.md)                                           | Chapter container component.                                              |
| [`Component`](./classes/TomGould/AppleNews/Document/Components/Component.md)                                       | Base class for all Apple News Format (ANF) components.                    |
| [`Container`](./classes/TomGould/AppleNews/Document/Components/Container.md)                                       | A container component used to group other components together.            |
| [`DataTable`](./classes/TomGould/AppleNews/Document/Components/DataTable.md)                                       | DataTable component for structured tabular data.                          |
| [`Divider`](./classes/TomGould/AppleNews/Document/Components/Divider.md)                                           | A visual separator line used between other components.                    |
| [`EmbedWebVideo`](./classes/TomGould/AppleNews/Document/Components/EmbedWebVideo.md)                               | Embeds third-party video content (YouTube, Vimeo, etc.).                  |
| [`FacebookPost`](./classes/TomGould/AppleNews/Document/Components/FacebookPost.md)                                 | Component for embedding Facebook posts.                                   |
| [`Figure`](./classes/TomGould/AppleNews/Document/Components/Figure.md)                                             | Figure component for images with semantic meaning.                        |
| [`FlexibleSpacer`](./classes/TomGould/AppleNews/Document/Components/FlexibleSpacer.md)                             | Flexible spacer component for dynamic spacing in horizontal stacks.       |
| [`Gallery`](./classes/TomGould/AppleNews/Document/Components/Gallery.md)                                           | Component for displaying a collection of images as a gallery.             |
| [`Header`](./classes/TomGould/AppleNews/Document/Components/Header.md)                                             | Header container component.                                               |
| [`Heading`](./classes/TomGould/AppleNews/Document/Components/Heading.md)                                           | A heading component (supports levels 1 through 6).                        |
| [`HTMLTable`](./classes/TomGould/AppleNews/Document/Components/HTMLTable.md)                                       | HTMLTable component for HTML-formatted tables.                            |
| [`Illustrator`](./classes/TomGould/AppleNews/Document/Components/Illustrator.md)                                   | Illustrator credit component.                                             |
| [`Image`](./classes/TomGould/AppleNews/Document/Components/Image.md)                                               | Generic image component.                                                  |
| [`Instagram`](./classes/TomGould/AppleNews/Document/Components/Instagram.md)                                       | Component for embedding Instagram posts.                                  |
| [`Intro`](./classes/TomGould/AppleNews/Document/Components/Intro.md)                                               | Introductory or deck text component.                                      |
| [`LinkButton`](./classes/TomGould/AppleNews/Document/Components/LinkButton.md)                                     | A call-to-action button that links to an external URL or article section. |
| [`Logo`](./classes/TomGould/AppleNews/Document/Components/Logo.md)                                                 | Logo component for brand or publication logos.                            |
| [`Map`](./classes/TomGould/AppleNews/Document/Components/Map.md)                                                   | Map component for displaying Apple Maps.                                  |
| [`MediumRectangleAdvertisement`](./classes/TomGould/AppleNews/Document/Components/MediumRectangleAdvertisement.md) | Medium rectangle advertisement component (MREC).                          |
| [`Mosaic`](./classes/TomGould/AppleNews/Document/Components/Mosaic.md)                                             | Mosaic component for multi-image tile layouts.                            |
| [`Music`](./classes/TomGould/AppleNews/Document/Components/Music.md)                                               | Music component for Apple Music integration.                              |
| [`Photo`](./classes/TomGould/AppleNews/Document/Components/Photo.md)                                               | Component for displaying single images in an article.                     |
| [`Photographer`](./classes/TomGould/AppleNews/Document/Components/Photographer.md)                                 | Photographer credit component.                                            |
| [`Place`](./classes/TomGould/AppleNews/Document/Components/Place.md)                                               | Place component for displaying a specific location.                       |
| [`Podcast`](./classes/TomGould/AppleNews/Document/Components/Podcast.md)                                           | Podcast component for Apple Podcasts integration.                         |
| [`Portrait`](./classes/TomGould/AppleNews/Document/Components/Portrait.md)                                         | Portrait component for face-optimized image cropping.                     |
| [`Pullquote`](./classes/TomGould/AppleNews/Document/Components/Pullquote.md)                                       | Component for highlighting a quote within an article.                     |
| [`Quote`](./classes/TomGould/AppleNews/Document/Components/Quote.md)                                               | Block quote component.                                                    |
| [`ReplicaAdvertisement`](./classes/TomGould/AppleNews/Document/Components/ReplicaAdvertisement.md)                 | Replica advertisement component.                                          |
| [`Section`](./classes/TomGould/AppleNews/Document/Components/Section.md)                                           | Section container component.                                              |
| [`TextComponent`](./classes/TomGould/AppleNews/Document/Components/TextComponent.md)                               | Base class for all components that primarily contain text content.        |
| [`TikTok`](./classes/TomGould/AppleNews/Document/Components/TikTok.md)                                             | TikTok component for embedding TikTok videos.                             |
| [`Title`](./classes/TomGould/AppleNews/Document/Components/Title.md)                                               | The main title component for an article.                                  |
| [`Tweet`](./classes/TomGould/AppleNews/Document/Components/Tweet.md)                                               | Component for embedding X/Twitter posts.                                  |
| [`Video`](./classes/TomGould/AppleNews/Document/Components/Video.md)                                               | Component for displaying native hosted videos.                            |

### \TomGould\AppleNews\Document\Conditionals

#### Classes

| Class                                                                                                               | Description                                      |
|---------------------------------------------------------------------------------------------------------------------|--------------------------------------------------|
| [`ConditionalAutoPlacement`](./classes/TomGould/AppleNews/Document/Conditionals/ConditionalAutoPlacement.md)           | Conditional auto-placement configuration.        |
| [`ConditionalButton`](./classes/TomGould/AppleNews/Document/Conditionals/ConditionalButton.md)                         | Conditional properties for button components.    |
| [`ConditionalComponent`](./classes/TomGould/AppleNews/Document/Conditionals/ConditionalComponent.md)                   | Conditional properties for any component.        |
| [`ConditionalComponentLayout`](./classes/TomGould/AppleNews/Document/Conditionals/ConditionalComponentLayout.md)       | Conditional properties for component layouts.    |
| [`ConditionalComponentStyle`](./classes/TomGould/AppleNews/Document/Conditionals/ConditionalComponentStyle.md)         | Conditional properties for component styles.     |
| [`ConditionalComponentTextStyle`](./classes/TomGould/AppleNews/Document/Conditionals/ConditionalComponentTextStyle.md) | Conditional text style for component text.       |
| [`ConditionalContainer`](./classes/TomGould/AppleNews/Document/Conditionals/ConditionalContainer.md)                   | Conditional properties for container components. |
| [`ConditionalDivider`](./classes/TomGould/AppleNews/Document/Conditionals/ConditionalDivider.md)                       | Conditional properties for divider components.   |
| [`ConditionalDocumentStyle`](./classes/TomGould/AppleNews/Document/Conditionals/ConditionalDocumentStyle.md)           | Conditional properties for document styles.      |
| [`ConditionalSection`](./classes/TomGould/AppleNews/Document/Conditionals/ConditionalSection.md)                       | Conditional properties for section components.   |
| [`ConditionalTableCellStyle`](./classes/TomGould/AppleNews/Document/Conditionals/ConditionalTableCellStyle.md)         | Conditional properties for table cell styles.    |
| [`ConditionalTableRowStyle`](./classes/TomGould/AppleNews/Document/Conditionals/ConditionalTableRowStyle.md)           | Conditional properties for table row styles.     |
| [`ConditionalText`](./classes/TomGould/AppleNews/Document/Conditionals/ConditionalText.md)                             | Conditional properties for text components.      |
| [`ConditionalTextStyle`](./classes/TomGould/AppleNews/Document/Conditionals/ConditionalTextStyle.md)                   | Conditional properties for text styles.          |

#### Interfaces

| Interface                                                                                         | Description                            |
|---------------------------------------------------------------------------------------------------|----------------------------------------|
| [`ConditionalInterface`](./classes/TomGould/AppleNews/Document/Conditionals/ConditionalInterface.md) | Interface for all conditional objects. |

### \TomGould\AppleNews\Document\Layouts

#### Classes

| Class                                                                                                    | Description                                                     |
|----------------------------------------------------------------------------------------------------------|-----------------------------------------------------------------|
| [`AdvertisementAutoPlacement`](./classes/TomGould/AppleNews/Document/Layouts/AdvertisementAutoPlacement.md) | Advertisement auto-placement configuration.                     |
| [`AutoPlacement`](./classes/TomGould/AppleNews/Document/Layouts/AutoPlacement.md)                           | Auto-placement configuration for automatic component insertion. |
| [`CollectionDisplay`](./classes/TomGould/AppleNews/Document/Layouts/CollectionDisplay.md)                   | Collection display for grid-like component arrangements.        |
| [`Condition`](./classes/TomGould/AppleNews/Document/Layouts/Condition.md)                                   | Condition object for conditional component properties.          |
| [`HorizontalStackDisplay`](./classes/TomGould/AppleNews/Document/Layouts/HorizontalStackDisplay.md)         | Horizontal stack display for arranging components horizontally. |
| [`Layout`](./classes/TomGould/AppleNews/Document/Layouts/Layout.md)                                         | Defines the column system and base grid for an article.         |

#### Interfaces

| Interface                                                                                          | Description                                  |
|----------------------------------------------------------------------------------------------------|----------------------------------------------|
| [`ContentDisplayInterface`](./classes/TomGould/AppleNews/Document/Layouts/ContentDisplayInterface.md) | Interface for all ANF content display types. |

### \TomGould\AppleNews\Document\Scenes

#### Classes

| Class                                                                                     | Description                  |
|-------------------------------------------------------------------------------------------|------------------------------|
| [`FadingStickyHeader`](./classes/TomGould/AppleNews/Document/Scenes/FadingStickyHeader.md)   | Fading sticky header scene.  |
| [`ParallaxScaleHeader`](./classes/TomGould/AppleNews/Document/Scenes/ParallaxScaleHeader.md) | Parallax scale header scene. |

#### Interfaces

| Interface                                                                       | Description                        |
|---------------------------------------------------------------------------------|------------------------------------|
| [`SceneInterface`](./classes/TomGould/AppleNews/Document/Scenes/SceneInterface.md) | Interface for all ANF scene types. |

### \TomGould\AppleNews\Document\Styles

#### Classes

| Class                                                                                     | Description                                           |
|-------------------------------------------------------------------------------------------|-------------------------------------------------------|
| [`ComponentShadow`](./classes/TomGould/AppleNews/Document/Styles/ComponentShadow.md)         | Shadow effect for components.                         |
| [`ComponentTextStyle`](./classes/TomGould/AppleNews/Document/Styles/ComponentTextStyle.md)   | Detailed text styling options for components.         |
| [`CornerMask`](./classes/TomGould/AppleNews/Document/Styles/CornerMask.md)                   | Rounded corner clipping for components.               |
| [`DocumentStyle`](./classes/TomGould/AppleNews/Document/Styles/DocumentStyle.md)             | Global styles applied to the entire article document. |
| [`ListItemStyle`](./classes/TomGould/AppleNews/Document/Styles/ListItemStyle.md)             | Style for bullet or numbered list items.              |
| [`TableBorder`](./classes/TomGould/AppleNews/Document/Styles/TableBorder.md)                 | Border configuration for tables.                      |
| [`TableCellStyle`](./classes/TomGould/AppleNews/Document/Styles/TableCellStyle.md)           | Style for table cells.                                |
| [`TableColumnSelector`](./classes/TomGould/AppleNews/Document/Styles/TableColumnSelector.md) | Selector for targeting specific table columns.        |
| [`TableColumnStyle`](./classes/TomGould/AppleNews/Document/Styles/TableColumnStyle.md)       | Style for table columns.                              |
| [`TableRowSelector`](./classes/TomGould/AppleNews/Document/Styles/TableRowSelector.md)       | Selector for targeting specific table rows.           |
| [`TableRowStyle`](./classes/TomGould/AppleNews/Document/Styles/TableRowStyle.md)             | Style for table rows.                                 |
| [`TableStrokeStyle`](./classes/TomGould/AppleNews/Document/Styles/TableStrokeStyle.md)       | Stroke style for table borders and dividers.          |
| [`TableStyle`](./classes/TomGould/AppleNews/Document/Styles/TableStyle.md)                   | Overall table style configuration.                    |
| [`TextShadow`](./classes/TomGould/AppleNews/Document/Styles/TextShadow.md)                   | Shadow effect for text.                               |
| [`TextShadowOffset`](./classes/TomGould/AppleNews/Document/Styles/TextShadowOffset.md)       | Offset positioning for text shadows.                  |
| [`TextStrokeStyle`](./classes/TomGould/AppleNews/Document/Styles/TextStrokeStyle.md)         | Text outline/stroke styling.                          |

### \TomGould\AppleNews\Document\Styles\Fills

#### Classes

| Class                                                                                           | Description                             |
|-------------------------------------------------------------------------------------------------|-----------------------------------------|
| [`ColorStop`](./classes/TomGould/AppleNews/Document/Styles/Fills/ColorStop.md)                     | Color stop for gradient fills.          |
| [`ImageFill`](./classes/TomGould/AppleNews/Document/Styles/Fills/ImageFill.md)                     | Image background fill.                  |
| [`LinearGradientFill`](./classes/TomGould/AppleNews/Document/Styles/Fills/LinearGradientFill.md)   | Linear gradient background fill.        |
| [`RepeatableImageFill`](./classes/TomGould/AppleNews/Document/Styles/Fills/RepeatableImageFill.md) | Tiled/repeatable image background fill. |
| [`VideoFill`](./classes/TomGould/AppleNews/Document/Styles/Fills/VideoFill.md)                     | Video background fill.                  |

#### Interfaces

| Interface                                                                           | Description                   |
|-------------------------------------------------------------------------------------|-------------------------------|
| [`FillInterface`](./classes/TomGould/AppleNews/Document/Styles/Fills/FillInterface.md) | Interface for all fill types. |

### \TomGould\AppleNews\Document\Text

#### Classes

| Class                                                                               | Description                                        |
|-------------------------------------------------------------------------------------|----------------------------------------------------|
| [`CaptionDescriptor`](./classes/TomGould/AppleNews/Document/Text/CaptionDescriptor.md) | Caption descriptor for media components.           |
| [`FormattedText`](./classes/TomGould/AppleNews/Document/Text/FormattedText.md)         | Formatted text with styling support.               |
| [`InlineTextStyle`](./classes/TomGould/AppleNews/Document/Text/InlineTextStyle.md)     | Inline text style for specific ranges within text. |

### \TomGould\AppleNews\Exception

#### Classes

| Class                                                                                       | Description                                                                   |
|---------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------|
| [`AppleNewsException`](./classes/TomGould/AppleNews/Exception/AppleNewsException.md)           | Base exception class for all errors returned by the Apple News API.           |
| [`AuthenticationException`](./classes/TomGould/AppleNews/Exception/AuthenticationException.md) | Exception thrown specifically when API authentication fails (401/403 errors). |

### \TomGould\AppleNews\Request

#### Classes

| Class                                                                       | Description                                                                  |
|-----------------------------------------------------------------------------|------------------------------------------------------------------------------|
| [`ArticleMetadata`](./classes/TomGould/AppleNews/Request/ArticleMetadata.md)   | Builder for API-level metadata sent with Create and Update Article requests. |
| [`MultipartBuilder`](./classes/TomGould/AppleNews/Request/MultipartBuilder.md) | Builds multipart/form-data request bodies for the Apple News API.            |

### \TomGould\AppleNews\Response

#### Classes

| Class                                                                      | Description                                                                       |
|----------------------------------------------------------------------------|-----------------------------------------------------------------------------------|
| [`ArticleLinks`](./classes/TomGould/AppleNews/Response/ArticleLinks.md)       | Links associated with an article response.                                        |
| [`ArticleResponse`](./classes/TomGould/AppleNews/Response/ArticleResponse.md) | Complete response from Create, Read, and Update Article endpoints.                |
| [`Meta`](./classes/TomGould/AppleNews/Response/Meta.md)                       | Meta object wrapping throttling information from Create/Update Article responses. |
| [`Throttling`](./classes/TomGould/AppleNews/Response/Throttling.md)           | Throttling information returned by Create and Update Article endpoints.           |
| [`Warning`](./classes/TomGould/AppleNews/Response/Warning.md)                 | Warning message returned by the Apple News API for non-fatal issues.              |
