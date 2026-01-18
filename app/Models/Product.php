<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name'];
    protected $with = ['category'];

    public function category(){
        return $this->belongsTo(category::class);
    }
    public function scopeFilter($query, $filter){
        $query->when($filter['category']??false, function($query, $name){
            $query->whereHas('category', function($query) use($name){
                $query->where('name', $name);
            });
        });
    }
}
