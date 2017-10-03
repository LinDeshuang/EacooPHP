<?php
// 行为日志模型       
// +----------------------------------------------------------------------
// | PHP version 5.4+                
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://www.eacoo123.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author:  心云间、凝听 <981248356@qq.com>
// +----------------------------------------------------------------------
namespace app\common\model;

use think\Model;
use think\Request;

class ActionLog extends Model {
    
    protected $updateTime = false;

    /**
     * 行为日志记录
     * @param  integer $action_id 为0则不属于行为ID记录
     * @param  integer $uid [description]
     * @param  array $data [description]
     * @param  string $remark [description]
     * @return [type] [description]
     * @date   2017-10-03
     * @author 心云间、凝听 <981248356@qq.com>
     */
	public function record($action_id = 0, $uid = 0, $data = [], $remark = '')
	{
		if ($uid>0) {
			$request = Request::instance();
			$username = db('users')->where('uid',$uid)->value('username');
			$data = [
				'action_id'      => $action_id,
				'uid'            => $uid,
				'nickname'       => $username,
				'request_method' => $request->method(),
				'url'            => $request->url(),
				'data'           => $data,
				'ip'             => $request->ip(),
				'remark'         => $remark,
				'user_agent'     => $_SERVER['HTTP_USER_AGENT'],
			];
			$result = $this->isUpdate(false)->data($data)->save();
		}
	}
}
