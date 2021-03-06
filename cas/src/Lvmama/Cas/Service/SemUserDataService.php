<?php

namespace Lvmama\Cas\Service;

use Phalcon\Db\AdapterInterface;
use Phalcon\DiInterface;
use Lvmama\Cas\Service\DataServiceBase;
use Lvmama\Common\Utils\Misc;

/**
 * 订单信息 服务类
 *
 * @author libiying
 *
 */
class SemUserDataService extends DataServiceBase {

    const TABLE_NAME = 'sem_user';//对应数据库表
    const PRIMARY_KEY = 'user_id'; //对应主键，如果有
    const PV_REAL = 2;
    const LIKE_INIT = 3;

    private $columns = array(
        'user_id',
        'user_no',
        'user_name',
        'created_date',
        'updated_date',
        'is_valid',
        'mobile_number',
        'email',
        'gender',
        'id_number',
        'point',
        'nick_name',
        'memo',
        'birthday',
        'space_url',
        'image_url',
        'is_email_checked',
        'phone_number',
        'is_mobile_checked',
        'membership_card',
        'active_mscard_date',
        'primary_channel',
        'grade',
        'level_validity_date',
        'group_id',
        'last_login_date',
        'is_zj',
        'user_type',
        'user_status',
        'active_status',
        'update_time',
        'career',
    );

    public function getColumns(){
        return $this->columns;
    }

    /**
     * 添加订单信息
     * @param $data array 添加数据
     * @return bool|mixed
     */
    public function insert($data) {
        return $this->getAdapter()->insert(self::TABLE_NAME, array_values($data), array_keys($data));
//        return null;
    }

    /**
     * 更新订单信息
     * @param $id int 编号
     * @param $data array 更新数据
     * @return bool|mixed
     */
    public function update($id, $data) {
        $whereCondition = self::PRIMARY_KEY . ' = ' . $id;
        return $this->getAdapter()->update(self::TABLE_NAME, array_keys($data), array_values($data), $whereCondition);
//        return null;
    }

    /**
     * 删除订单信息
     * @param $id 编号
     * @param $data 更新数据
     * @return bool|mixed
     */
    public function delete($id) {
        $whereCondition = self::PRIMARY_KEY . ' = ' . $id;
        return $this->getAdapter()->delete(self::TABLE_NAME, $whereCondition);
//        return null;
    }

    /**
     * @purpose 根据条件获取订单信息
     * @param $where_condition 查询条件
     * @param $limit 查询条数
     * @param $columns 查询字段
     * @param $order 排序
     * @return array|mixed
     */
    public function getUserList($where_condition, $limit = NULL, $columns = NULL, $order = NULL){
        $data=$this->getList($where_condition, self::TABLE_NAME, $limit, $columns, $order);
        return $data?$data:false;
    }

    /**
     * @purpose 根据条件获取订单信息总数
     * @param $where_condition 查询条件
     * @return array|mixed
     */
    public function getUserTotal($where_condition){
        $data=$this->getTotalBy($where_condition, self::TABLE_NAME);
        return $data?$data:false;
    }

    /**
     * @purpose 根据条件获取一条订单信息
     * @param $where_condition 查询条件
     * @return bool|mixed
     */
    public function getOneUser($where_condition){
        $data=$this->getOne($where_condition, self::TABLE_NAME);
        return $data?$data:false;
    }

    /**
     * @purpose 根据主键获取一条订单信息
     * @param $id 编号
     * @return bool|mixed
     */
    public function getOneById($id){
        $where_condition=array(self::PRIMARY_KEY => "=".$id);
        $data=$this->getOne($where_condition, self::TABLE_NAME);
        return $data?$data:false;
    }

    public function saveBatch($data){
        return $this->save($data, self::TABLE_NAME);
    }

}