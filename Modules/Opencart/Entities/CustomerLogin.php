<?php
namespace Modules\Opencart\Entities;

class CustomerLogin extends Model
{
	protected $_table = 'customer_login';
	protected $primaryKey = 'customer_login_id';

	protected $fillable = array('email','ip','total');
}