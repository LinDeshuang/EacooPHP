<?php
// 权限模型       
// +----------------------------------------------------------------------
// | PHP version 5.4+                
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 http://www.eacoo123.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 心云间、凝听 <981248356@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\model;

use app\common\model\Base;

class AuthGroupAccess extends Base
{
	// 设置完整的数据表（包含前缀）
    // protected $table = 'think_access';

    // 设置数据表（不含前缀）
    // protected $name = 'auth_rule';

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    
    /**
     * 用户组信息
     * @param  integer $uid [description]
     * @return [type]       [description]
     */
    public function userGroupInfo($uid = 0)
    {
        if (!$uid) return false;
        $result = $this->alias('a')->join('__AUTH_GROUP__ b','a.group_id = b.id')->where(['a.uid'=>$uid,'a.status'=>1])->field('a.group_id,b.title')->select();
        if ($result) {
            foreach ($result as $key => $row) {
                $return[$row['group_id']] = $row['title'];
            }
            return $return;
        }
        
        return false;
    }
    
    /**
     * 获取组对应的用户Uids
     * @param  string $group_id [description]
     * @return [type] [description]
     * @date   2017-10-17
     * @author 心云间、凝听 <981248356@qq.com>
     */
    public static function groupUserUids($group_id)
    {
        return $return = self::where('group_id',$group_id)->column('uid');
    }
}