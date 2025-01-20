<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Device extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = ['code', 'longitude', 'latitude'];

    public function registerMediaCollections(): void
    {
      $this->addMediaCollection('device-image')
        ->singleFile()
        ->useDisk('public');
    }
    public function registerMediaConversions(Media $media = null): void
    {
      $this->addMediaConversion('thumb')
        ->width(100)
        ->height(50);
    }
}
