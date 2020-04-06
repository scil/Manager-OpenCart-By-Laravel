<?php
namespace Modules\Opencart\Entities;

class Address extends Model
{
	protected $_table = 'address';
	protected $primaryKey = 'address_id';

	protected $fillable = array('firstname','lastname','company','address_1','address_2','city','postcode','country_id','zone_id');

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
	public function zone()
	{
		return $this->belongsTo(Zone::class,'zone_id');
	}
	public function country()
	{
		return $this->belongsTo(Country::class,'country_id');
	}

	public function getData()
	{
		return array(
			'address_id'     => $this->address_id,
			'firstname'      => $this->firstname,
			'lastname'       => $this->lastname,
			'company'        => $this->company,
			'address_1'      => $this->address_1,
			'address_2'      => $this->address_2,
			'city'           => $this->city,
            'postcode'       => $this->postcode,

            'country_id'     => $this->country_id,
            'iso_code_2'     => $this->country->iso_code_2,
            'iso_code_3'     => $this->country->iso_code_3,
            'address_format' => $this->country->address_format,
            'country'        => $this->country->name,

			'zone_id'        => $this->zone_id,
			'zone'           => $this->zone->name,
			'zone_code'      => $this->zone->code,
			'custom_field'   => $this->custom_field
		);
	}
}
