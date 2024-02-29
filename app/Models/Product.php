<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'vpngestio';

    protected $fillable = [
        'vpn3e_group',
        'vpn3e_company',
        'vpn3e_network',
        'vpn3e_description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    
    public function subcategory()
    {
        return $this->belongsTo(SubCateory::class,'sub_category_id');
    }

    public function collection()
    {
        return $this->belongsTo(SubCateory::class,'collection_id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
}
