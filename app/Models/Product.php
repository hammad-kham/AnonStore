<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description', 'price', 'category_id'];

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

     // Polymorphic relationship to images
     public function images()
     {
         return $this->morphMany(Image::class, 'imageable');
     }

    // Mutator to automatically set the slug when saving the name
    public function setNameAttribute($value)
    {
        // str -> php class to create slug
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}