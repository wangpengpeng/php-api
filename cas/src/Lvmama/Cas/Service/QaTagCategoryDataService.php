<?php
namespace Lvmama\Cas\Service;

use Lvmama\Common\Utils\UCommon;
use Phalcon\Db\AdapterInterface;
use Phalcon\DiInterface;
use Lvmama\Cas\Service\DataServiceBase;
use Lvmama\Common\Utils\Misc;

/**
 * 问答标签分类表
 *
 * @author win.shenxiang
 *        
 */
class QaTagCategoryDataService extends DataServiceBase {
	
	const TABLE_NAME = 'qa_tag_category';//对应数据库表
	
	const BEANSTALK_TUBE = '';
	
	const BEANSTALK_TRIP_MSG = '';

	const PV_REAL = 2;
	
	const LIKE_INIT = 3;
	/**
	 * 获取
	 * 
	 */
	public function get($id) {
	    $sql = 'SELECT * FROM ' . self::TABLE_NAME . ' WHERE id = ' . $id;
	    $result = $this->getAdapter()->query($sql);
	    $result->setFetchMode(\PDO::FETCH_ASSOC);
		return $result->fetch();
	}
	public function getIdByName($name){
		$sql = 'SELECT id FROM ' . self::TABLE_NAME . ' WHERE name = :name AND status = 1';
		$dbh = $this->getAdapter();
		$sth = $dbh->prepare($sql);
		$sth->bindValue(':name', $name, \PDO::PARAM_STR);
		$sth->setFetchMode(\PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetch();
	}
	public function getRsBySql($sql,$one = false){
		$redis_key = RedisDataService::REDIS_QA_CATE . md5($sql) . ':' . ($one ? 1 : 0);
		$rs = json_decode($this->redis->get($redis_key),true);
		if(!is_array($rs)){
			$result = $this->getAdapter()->query($sql);
			$result->setFetchMode(\PDO::FETCH_ASSOC);
			$rs = $one ? $result->fetch() : $result->fetchAll();
			$this->redis->setex($redis_key,rand(28800,86400),json_encode($rs));
		}
		return $rs;
	}
	/**
	 * 添加
	 * 
	 */
	public function insert($data) {
	    if($id = $this->getAdapter()->insert(self::TABLE_NAME, array_values($data), array_keys($data)) ){
	        return $id;
	    }
	}
	
	/**
	 * 更新
	 * 
	 */
	public function update($id, $data) {
	    $whereCondition = 'id = ' . $id;
	    if($id = $this->getAdapter()->update(self::TABLE_NAME, array_keys($data), array_values($data), $whereCondition) ) {
	        return $id;
	    }
	}
}