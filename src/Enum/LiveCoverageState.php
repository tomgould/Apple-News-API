<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Enum;

/**
 * Live coverage state sent with Create and Update Article requests.
 *
 * Controls how Apple News treats an article that contains a `live_container`.
 * This is request metadata (set via ArticleMetadata::setLiveCoverageState()),
 * not part of the article.json document.
 *
 * Apple must enable Live Coverage for the channel before it accepts it.
 */
enum LiveCoverageState: string
{
    /** Live coverage has not started. */
    case NONE = 'NONE';

    /** Live updates are being sent. */
    case LIVE = 'LIVE';

    /** Live coverage has finished. */
    case COMPLETED = 'COMPLETED';
}
