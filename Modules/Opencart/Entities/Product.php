<?php

namespace Modules\Opencart\Entities;

class Product extends Model
{
    protected $_table = 'product';
    protected $primaryKey = 'product_id';
    public $timestamps = true;


    // -------------------------------------------------------------------
    // --[ ORM-связи ]------------------------------------------------------
    // -------------------------------------------------------------------

    public function description()
    {
        return $this->hasOne(ProductDescription::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, $this->prefix . 'product_attribute', 'product_id', 'attribute_id');
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, $this->prefix . 'product_to_store', 'product_id', 'store_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, $this->prefix . 'product_to_category', 'product_id',
            'category_id');
    }

    public function related()
    {
        return $this->belongsToMany(Product::class, $this->prefix . 'product_related',
            'product_id', 'related_id');
    }

    public function enable()
    {
        $this->status = 1;
        $this->save();
    }

    public function disable()
    {
        $this->status = 0;
        $this->save();
    }

}
