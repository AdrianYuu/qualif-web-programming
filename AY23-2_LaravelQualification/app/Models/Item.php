<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'price',
        'description',
        'image_url'
    ];
    
    protected $primaryKey = 'item_id';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'carts', 'item_id', 'user_id');
    }
}
