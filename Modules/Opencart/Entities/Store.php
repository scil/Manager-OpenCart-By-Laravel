<?php

namespace Modules\Opencart\Entities;

class Store extends Model
{
    protected $_table = 'store';
    protected $primaryKey = 'store_id';

    public function products()
    {
        return $this->hasMany(Product::class, $this->prefix . 'product_to_category');
    }
}