<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    protected $fillable = [
        'brand_image',
        'brand_name',
        'description',
        'footer_text',
        'address',
        'link_maps',
        'office_hour',
        'email',
        'phone',
        'instagram_link',
        'tiktok_link',
        'facebook_link',
        'youtube_link',
        'marketplace_link',
        'terms_conditions',
        'privacy_policy',
        'dealer_terms',
    ];
}
