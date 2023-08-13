<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Product extends Model implements HasMedia, Searchable
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['name', 'price', 'detail', 'category_id', 'img_path'];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    public function stock()
    {
        return $this->hasOne(Stock::class, 'product_id', 'id');
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
        $url = route('product.details', $this->id);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
