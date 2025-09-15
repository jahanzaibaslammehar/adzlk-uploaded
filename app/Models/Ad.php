<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{
    use SoftDeletes;
    
    protected $table = 'ads';
    protected $fillable = [
          'poster_id',
          'image',
          'thumbnail',
          'title',
          'category_id',
          'location',
          'price',
          'description',
          'is_on_whatsapp',
          'is_on_telegram',
          'is_on_imo',
          'is_on_viber',
          'is_active',
          'is_fake',
          'ad_type',
          'total_likes',
          'total_views'
      ];


    public function poster()
    {
        return $this->belongsTo(Poster::class);
    }

    public function category()
    {
        return $this->belongsTo(AdCategory::class, 'category_id');
    }

    public function adType()
    {
        return $this->belongsTo(AdType::class, 'ad_type');
    }

    /**
     * Get the reports for this ad.
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
