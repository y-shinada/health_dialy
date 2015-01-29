<?php
use Orm\Model_Soft;

class Model_User extends Model_Soft
{
	protected static $_properties = array(
		'id',
		'login_id',
		'password',
		'name',
		'created_at',
		'updated_at',
		'deleted_at',
		'deleted',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_soft_delete = array(
		'deleted_field' => 'deleted_at',
		'mysql_timestamp' => false,
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('login_id', 'Login Id', 'required|max_length[255]');
		$val->add_field('password', 'Password', 'required|max_length[255]');
		$val->add_field('name', 'Name', 'required|max_length[255]');

		return $val;
	}

}
