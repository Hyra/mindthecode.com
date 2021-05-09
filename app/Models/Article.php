<?php

namespace App\Models;

use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

use Spatie\Sluggable\HasSlug;

class Article extends Model implements Feedable
{
    use HasSlug;

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create([
            'id' => $this->id,
            'title' => $this->title,
            'summary' => $this->description,
            'updated' => $this->updated_at,
            'link' => 'https://mindthecode.com/blog/' . $this->slug,
            'author' => 'Stef van den Ham',
        ]);
    }

    public static function getFeedItems()
    {
        return Article::where('online', 1)->get();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }
}
