<?php

namespace Modules\Opencart\Entities;

//use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use EloquentDbTree;
    protected $_table = 'category';
    protected $primaryKey = 'category_id';
    public $timestamps = true;

    public function description()
    {
        return $this->hasOne(CategoryDescription::class, 'category_id');
    }


    public function products()
    {
        return $this->belongsToMany(Product::class, $this->prefix . 'product_to_category', 'category_id', 'product_id');
    }
}
