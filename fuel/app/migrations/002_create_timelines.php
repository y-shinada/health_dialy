<?php

namespace Fuel\Migrations;

class Create_timelines
{
	public function up()
	{
		\DBUtil::create_table('timelines', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('type' => 'bigint'),
			'food_id' => array('type' => 'bigint'),
			'ate_at' => array('type' => 'datetime'),
			'calorie' => array('constraint' => 11, 'type' => 'int'),
			'price' => array('constraint' => 11, 'type' => 'int'),
			'deleted_at' => array('constraint' => 11, 'type' => 'int'),
			'deleted' => array('type' => 'tinyint'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('timelines');
	}
}