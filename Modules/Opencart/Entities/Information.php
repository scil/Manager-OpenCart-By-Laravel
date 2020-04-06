<?php
namespace Modules\Opencart\Entities;

class Information extends Model
{
	protected $_table = 'information';
	protected $primaryKey = 'information_id';
	// protected $translatable = array('title', 'description', 'meta_title', 'meta_description', 'meta_keyword');

	public function translation()
	{
		return $this
            ->belongsToMany(Language::class, $this->prefix . 'information_description',
                'information_id','language_id')
            ->withPivot('title', 'description', 'meta_title', 'meta_description', 'meta_keyword');
	} 
	public function setLanguage($language_id)
	{
		$translation = array('title', 'description', 'meta_title', 'meta_description', 'meta_keyword');
		foreach ($translation as $value) {
			$this->{$value} = $this->translation->find($language_id)->pivot->{$value};
		}
	} 
}
