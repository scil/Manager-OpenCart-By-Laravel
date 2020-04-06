<?php

namespace Modules\Opencart\Entities;

use Illuminate\Database\Eloquent\Model as Base;

abstract class Model extends Base
{
    protected $prefix = '';

    public $timestamps = false;
    const CREATED_AT = 'date_added';
    const UPDATED_AT = 'date_modified';

    protected $fillable = [];
    protected $guarded = [];

    public function __construct($attrs = false)
    {
        $this->prefix = DB_PREFIX;
        $this->table = $this->prefix . $this->_table;

        if (!empty($attrs)) {
            parent::__construct($attrs);
        } else {
            parent::__construct();
        }
    }

}