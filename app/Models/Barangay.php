<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Barangay extends Model implements HasMedia
{
  use InteractsWithMedia;
  protected $fillable = ['name', 'longitude', 'latitude'];

  public function registerMediaCollections(): void
  {
    $this->addMediaCollection('barangay-image')
      ->singleFile()
      ->useDisk('public');
  }
  public function registerMediaConversions(Media $media = null): void
  {
    $this->addMediaConversion('thumb')
      ->width(100)
      ->height(50);
  }

  public function adminUsers()
  {
    return $this->hasMany(User::class, 'barangay_id', 'id')->where('user_type', 'barangay_admin');
  }

  public function drivers()
  {
    return $this->hasMany(User::class, 'barangay_id', 'id')->where('user_type', 'driver');
  }
  
  public function vehicles()
  {
    return $this->hasMany(User::class, 'barangay_id', 'id');
  }

  public function incidents()
  {
    return $this->hasMany(User::class, 'barangay_id', 'id');
  }
}
