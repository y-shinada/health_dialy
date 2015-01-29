<?php
namespace api;
class Controller_List extends \Controller_Rest
{
	public function get_list()
	{
		$query = \Model_Food::find(function ($data)
				{
					//SQL文発行
					$data->select('users.id', 'food_name', 'user_id', 'ate_time', 'calorie')
							->from('foods')
							->join('users')
							->on('users.id', '=', 'foods.user_id')
							->where('users.deleted', '=', '0');

					// 					//検索項目を設定
					// 					$searchid = \Input::get('employee_id');
					// 					$searchname = \Input::get('employee_name');
					// 					$searchjoin = \Input::get('employee_join_mst');

					// 					if($searchid != null)
					// 					{
					// 						$data->where('employee_id', '=', $searchid);
					// 					}
					// 					if($searchname != null)
					// 					{
					// 						$data->where('employee_name',  'like',  '%'.$searchname.'%');
					// 					}

					// 					//所属部署を検索　完全一致のみデータを返す
					// 					if($searchjoin != null)
					// 					{
					// 						$data->where('employee_join_mst.name',  '=',  $searchjoin);
					// 					}
					// 					$data->order_by('employee_id');
		var_dump($data);
		exit;
					return $data;
				});

		$list = array();
		if ($query != null)
		{
			$list['code'] = 200;
			$list['list'] = $query;
			//データが一件も存在しない場合
		}
		else if ($query == null)
		{
			$list['code'] = 400;
			$list['list'] = 'データがありません';
		}
		;
		return $this->response($list);
	}

}
