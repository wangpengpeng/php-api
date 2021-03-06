<?php

namespace Lvmama\Cas\Service;

use Phalcon\Db\AdapterInterface;
use Phalcon\DiInterface;
use Lvmama\Cas\Service\DataServiceBase;
use Lvmama\Common\Utils\Misc;

/**
 * 大目的地关键词信息 服务类
 *
 * @author flash.guo
 *
 */
class SeoDestKeywordDataService extends DataServiceBase {

    const TABLE_NAME = 'seo_dest_keyword';//对应数据库表
    const PRIMARY_KEY = 'keyword_id'; //对应主键，如果有
    const PV_REAL = 2;
    const LIKE_INIT = 3;

    /**
     * 添加大目的地关键词信息
     * @param $data 添加数据
     * @return bool|mixed
     */
    public function insert($data) {
        return $this->getAdapter()->insert(self::TABLE_NAME, array_values($data), array_keys($data));
    }

    /**
     * 更新大目的地关键词信息
     * @param $id 编号
     * @param $data 更新数据
     * @return bool|mixed
     */
    public function update($id, $data) {
        $whereCondition = 'keyword_id = ' . $id;
        return $this->getAdapter()->update(self::TABLE_NAME, array_keys($data), array_values($data), $whereCondition);
    }

    /**
     * 删除大目的地关键词信息
     * @param $id 编号
     * @param $data 更新数据
     * @return bool|mixed
     */
    public function delete($id) {
        $whereCondition = 'keyword_id = ' . $id;
        return $this->getAdapter()->delete(self::TABLE_NAME, $whereCondition);
    }

    /**
     * @purpose 根据条件获取大目的地关键词信息
     * @param $where_condition 查询条件
     * @param $limit 查询条数
     * @param $columns 查询字段
     * @param $order 排序
     * @return array|mixed
     */
    public function getKeywordList($where_condition, $limit = NULL, $columns = NULL, $order = NULL){
        $data=$this->getList($where_condition, self::TABLE_NAME, $limit, $columns, $order);
        return $data?$data:false;
    }

    /**
     * @purpose 根据条件获取大目的地关键词信息总数
     * @param $where_condition 查询条件
     * @return array|mixed
     */
    public function getKeywordTotal($where_condition){
        $data=$this->getTotalBy($where_condition, self::TABLE_NAME);
        return $data?$data:false;
    }

    /**
     * @purpose 根据条件获取一条大目的地关键词信息
     * @param $where_condition 查询条件
     * @return bool|mixed
     */
    public function getOneKeyword($where_condition){
        $data=$this->getOne($where_condition, self::TABLE_NAME);
        return $data?$data:false;
    }

    /**
     * @purpose 根据主键获取一条大目的地关键词信息
     * @param $id 编号
     * @return bool|mixed
     */
    public function getOneById($id){
        $where_condition=array('keyword_id'=>"=".$id);
        $data=$this->getOne($where_condition, self::TABLE_NAME);
        return $data?$data:false;
    }
    
    /**
     * @purpose 根据名称获取一条大目的地关键词信息
     * @param $name 名称
     * @return bool|mixed
     */
    public function getOneByName($name){
        if(!$name) return false;
        $where_condition=array('keyword_name'=>"='".$name."'");
        $base_data=$this->getOne($where_condition, self::TABLE_NAME);
        return $base_data?$base_data:false;
    }
}