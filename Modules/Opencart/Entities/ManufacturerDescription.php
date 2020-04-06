<?php

namespace Modules\Opencart\Entities;

// for extension Manufacturer Description - add description and meta-tag
// https://www.opencart.com/index.php?route=marketplace/extension/info&extension_id=23062

class ManufacturerDescription extends Model
{
    protected $_table = 'manufacturer_description';
    protected $primaryKey = 'manufacturer_id';

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
}