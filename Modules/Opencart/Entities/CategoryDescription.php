<?php

namespace Modules\Opencart\Entities;

class CategoryDescription extends Model
{
    protected $_table = 'category_description';
    protected $primaryKey = 'category_id';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}