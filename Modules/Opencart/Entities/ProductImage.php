<?php

namespace Modules\Opencart\Entities;

class ProductImage extends Model
{
    protected $_table = 'product_image';
    protected $primaryKey = 'product_image_id';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}