<?php

namespace Modules\Opencart\Entities;

// "url_alias" (for 2.x) or "seo_url" (for 3.x)
/*class Alias extends Model
{
    protected $_table = 'url_alias';
    protected $primaryKey = 'url_alias_id';
}
*/

class SeoUrl extends Model
{
    protected $_table = 'seo_url';
    protected $primaryKey = 'seo_url_id';
}
   