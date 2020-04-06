<?php
namespace Modules\Opencart\Entities;

class Customer extends Model
{
	protected $_table = 'customer';
	protected $primaryKey = 'customer_id';

	protected $fillable = array('firstname','lastname','email','telephone','fax','wishlist','newsletter');

    public function group()
    {
        return $this->belongsTo(CustomerGroup::class, 'customer_group_id');
    }
	public function addresses()
	{
		return $this->hasMany(Address::class,'customer_id');
	}
    public function activities()
    {
        return $this->hasMany(CustomerActivity::class,'customer_id');
    }

	// todo
	public function setPassword($password)
	{
		$salt = substr(md5(uniqid(mt_rand(), true)), 0, 9);
		$this->status = 1;
		$this->salt = $salt;
		$this->password = sha1($salt.sha1($salt.sha1($password)));
	}

}
