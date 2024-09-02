<?php

namespace App\Models;

use Illuminate\Support\Str;
use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Product extends Model implements AuditableContract
{
    use Auditable;
    use HasFactory;
    protected $fillable = [
        'name',
     'stock',
    'slug',
     'description',
      'price',
       'category_id'];

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
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
