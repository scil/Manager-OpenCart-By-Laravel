<?php

namespace Modules\Opencart\Entities;

class ProductDescription extends Model
{
    protected $_table = 'product_description';
    protected $primaryKey = 'product_id';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}