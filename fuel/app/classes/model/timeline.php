<?php
use Orm\Model;

class Model_Timeline extends Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'food_id',
		'ate_at',
		'calorie',
		'price',
		'deleted_at',
		'deleted',
		'created_at',
		'updated_at',
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

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('user_id', 'User Id', 'required');
		$val->add_field('food_id', 'Food Id', 'required');
		$val->add_field('ate_at', 'Ate At', 'required');
		$val->add_field('calorie', 'Calorie', 'required|valid_string[numeric]');
		$val->add_field('price', 'Price', 'required|valid_string[numeric]');
		$val->add_field('deleted_at', 'Deleted At', 'required|valid_string[numeric]');
		$val->add_field('deleted', 'Deleted', 'required');

		return $val;
	}

}
