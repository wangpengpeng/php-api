<?php

namespace Lvmama\Cas\Service;

use Phalcon\Db\AdapterInterface;
use Phalcon\DiInterface;
use Lvmama\Cas\Service\DataServiceBase;
use Lvmama\Common\Utils\Misc;

/**
 * 模版专题 服务类
 * xnw
 */
class PpTempZt2DataDataService extends DataServiceBase {

    const TABLE_NAME = 'temp_zt2_data';//对应数据库表
    const PRIMARY_KEY = 'RECOMMEND_INFO_ID'; //对应主键，如果有
    const PV_REAL = 2;
    const LIKE_INIT = 3;

    /**
     * 添加
     * @param $data 添加数据
     * @return bool|mixed
     */
    public function insert($data) {
        return $this->getAdapter()->insert(self::TABLE_NAME, array_values($data), array_keys($data));
    }

    /**
     * 更新
     * @param $id 编号
     * @param $data 更新数据
     * @return bool|mixed
     */
    public function update($id, $data) {
        $where = self::PRIMARY_KEY.' = '. $id;
        return $this->getAdapter()->update(self::TABLE_NAME, array_keys($data), array_values($data), $where);
    }

    /**
     * 删除
     * @param $id 编号
     * @param $data 更新数据
     * @return bool|mixed
     */
    public function delete($id) {
        $where = self::PRIMARY_KEY.' = '. $id;
        return $this->getAdapter()->delete(self::TABLE_NAME, $where);
    }

    /**
     * @purpose 根据条件获取
     * @param $where 查询条件
     * @param $limit 查询条数
     * @param $columns 查询字段
     * @param $order 排序
     * @return array|mixed
     */
    public function getDataList($where, $limit = NULL, $columns = NULL, $order = NULL){
        $data=$this->getList($where, self::TABLE_NAME, $limit, $columns, $order);
        return $data?$data:false;
    }

    /**
     * @purpose 根据条件获取总数
     * @param $where 查询条件
     * @return array|mixed
     */
    public function getTotal($where){
        $data=$this->getTotalBy($where, self::TABLE_NAME);
        return $data?$data:false;
    }

    /**
     * @purpose 根据条件获取一条
     * @param $where 查询条件
     * @return bool|mixed
     */
    public function getDataOne($where){
        $data=$this->getOne($where, self::TABLE_NAME);
        return $data?$data:false;
    }


}