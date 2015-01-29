<?php

class Model_Food extends \Model_Crud
{
	protected static $_primary_key = array('id');

	protected static $_properties = array(
		'id',
		'food_name' => array('data_type' => 'var_char',
//             'validation' => array(
//                 'match_pattern' => array('@\A(A|B|O|AB)\z@'),
//             ),
		),
		'user_id',
		'ate_time',
		'calorie',
		 'created_at' => array(
            'data_type' => 'time_mysql',
        ),
		'deleted',
	);

	/**
	 * オブサーバー
	 * 特定のイベント発生時に処理を行う
	 * @var unknown
	 */
	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => true,
		),
		'Orm\Observer_Validation' => array(
			'events' => array('before_insert', 'before_save'),
		),
	);

	protected static $_table_name = 'foods';

}
