<?php

namespace Modules\Opencart\Entities;

class Attribute extends Model
{
    protected $_table = 'attribute';
    protected $primaryKey = 'attribute_id';

    public function description()
    {
        return $this->hasOne(AttributeDescription::class, 'attribute_id');
    }
}