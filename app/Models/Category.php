<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Category extends Model implements HasMedia, Searchable
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['name', 'detail', 'img_path'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200)
            ->sharpen(10);
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('ViewAllProduct', $this->id);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
