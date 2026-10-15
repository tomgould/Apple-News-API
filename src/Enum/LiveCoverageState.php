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
 * Apple only accepts the transitions NONE -> LIVE -> COMPLETED; any other
 * change (for example LIVE -> NONE) is rejected by the API with BAD_REQUEST.
 * The library does not track or enforce this, as it cannot know the
 * article's current state without an extra API call.
 *
 * Live Coverage is an invitation-only Apple News feature: the channel must be
 * approved by Apple before articles with live content are accepted.
 */
enum LiveCoverageState: string
{
    /** Publish an article before live coverage begins. */
    case NONE = 'NONE';

    /** Live updates are actively being sent. Required for the LIVE badge to display. */
    case LIVE = 'LIVE';

    /** Live coverage has finished. */
    case COMPLETED = 'COMPLETED';
}
