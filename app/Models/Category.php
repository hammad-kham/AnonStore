<?php

namespace App\Models;

// use Str;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Category extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'name', 'slug', 'description', 'parent_id'
    ];
    // Define the relationship for subcategories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

     // Define the relationship for parent category
     public function parent()
     {
         return $this->belongsTo(Category::class, 'parent_id');
     }

      // Mutator to automatically set the slug when saving the name
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
        // return $this->hasMany(Product::class, 'cat_id');
    }





}
