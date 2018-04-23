<?php

namespace Lvmama\Cas\Service;

use Phalcon\Db\AdapterInterface;
use Phalcon\DiInterface;
use Lvmama\Cas\Service\DataServiceBase;
use Lvmama\Common\Utils\Misc;

/**
 * 消息 服务类
 *
 * @author mac.zhao
 *        
 */
class MsgDataService extends DataServiceBase {
	
	const TABLE_NAME = 'msg_private_pm';//对应数据库表
	
	/**
	 * 获取
	 * 
	 */
	public function get($id) {
	    $sql = 'SELECT * FROM ' . self::TABLE_NAME . ' WHERE trip_id = ' . $id;
	    $result = $this->getAdapter()->query($sql);
	    $result->setFetchMode(\PDO::FETCH_ASSOC);
		return $result->fetch();
	}
	
	/**
	 * 添加
	 * 
	 */
	public function insert($data) {
	    if($id = $this->getAdapter()->insert(self::TABLE_NAME, array_values($data), array_keys($data)) ){
// 	        $this->findOneBy(array('id'=>$id), self::TABLE_NAME, null, true);
// 	        return array('error'=>0, 'result'=>$id);
	    }
	    
		$result = array('error'=>0, 'result'=>$id);
		return $result;
	}
	
	/**
	 * 更新
	 * 
	 */
	public function update($id, $data) {
	    $whereCondition = 'trip_id = ' . $id;
	    if($id = $this->getAdapter()->update(self::TABLE_NAME, array_keys($data), array_values($data), $whereCondition) ) {
	    }
	}
}