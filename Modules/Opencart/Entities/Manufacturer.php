<?php

namespace Modules\Opencart\Entities;

class Manufacturer extends Model
{
    protected $_table = 'manufacturer';
    protected $primaryKey = 'manufacturer_id';

    public function products()
    {
        return $this->hasMany(Product::class, 'manufacturer_id');
    }

    public function description()
    {
        return $this->hasOne(ManufacturerDescription::class);
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, $this->prefix . 'manufacturer_to_store', 'manufacturer_id', 'store_id');
    }

}