<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Article extends Model implements Feedable
{
    use HasFactory;

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->summary_html ?? '')
            ->updated($this->updated_at)
            ->link($this->slug)
            ->author('Stef van den Ham (Hyra)');
    }

    public static function getFeedItems()
    {
        return Article::all();
    }
}
