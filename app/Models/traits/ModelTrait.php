<?php


namespace App\Models\traits;

use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;



trait ModelTrait
{
	
	public $error = '';
	/**
	 * 开启事务
	 */
	public function beginTrans ()
	{
		DB::beginTransaction ();
	}
	
	/**
	 * 提交事务
	 */
	public function commitTrans ()
	{
		DB::commit ();
	}
	
	/**
	 * 关闭事务
	 */
	public function rollbackTrans ()
	{
		Db::rollback ();
	}
	
	/**
	 * 根据结果提交滚回事务
	 *
	 * @param $res
	 */
	public function checkTrans ( $res )
	{
		if ( $res ) {
			$this->commitTrans ();
		}
		else {
			$this->rollbackTrans ();
		}
	}
	
	/**
	 * 添加一条数据
	 *
	 * @param $data
	 *
	 * @return object $model 数据对象
	 */
	public function set ( $data )
	{
		return $this->query ()->create ( $data );
	}
	
	/**
	 * 添加多条数据
	 *
	 * @param array $group
	 * @return mixed
	 */
	public function setAll ( array $group )
	{
		return $this->query ()->insert ( $group );
	}
	
	/**
	 * 修改一条数据
	 *
	 * @param $data
	 * @param $id
	 * @param $field
	 *
	 * @return bool $type 返回成功失败
	 */
	public function edit ( $data , $id , $field = NULL )
	{
		$model = new self;
		if ( ! $field )
			$field = $model->getKeyName ();
		return FALSE !== $model->where ( [ $field => $id ] )
				->update ( $data );
	}
	
	
	public function batchUpdate(array $update, $whenField = 'id', $whereField = 'id',$where = [])
	{
		$model = new self;
		
		if (!empty($where))
		{
			$model = $model->where($where);
		}
		$update = collect($update);
		// 判断需要更新的数据里包含有放入when中的字段和where的字段
		if ($update->pluck($whenField)->isEmpty() || $update->pluck($whereField)->isEmpty()) {
			throw new InvalidArgumentException('argument 1 don\'t have field ' . $whenField);
		}
		$when = [];
		// 拼装sql，相同字段根据不同条件更新不同数据
		foreach ($update->all() as $sets) {
			$whenValue = $sets[$whenField];
			foreach ($sets as $fieldName => $value) {
				if ($fieldName == $whenField) continue;
				if (is_null($value)) $value = 'null';
				$when[$fieldName][] = "when {$whenField} = '{$whenValue}' then '{$value}'";
			}
		}
		$build = $model->whereIn($whereField, $update->pluck($whereField));
		foreach ($when as $fieldName => &$item) {
			$item = DB::raw("case " . implode(' ', $item) . ' end ');
		}
		return $build->update($when);
	}
	
	/**
	 * 查询一条数据是否存在
	 *
	 * @param $map
	 *
	 * @return bool 是否存在
	 */
	public function be ( $map )
	{
		$model = ( new self );
		if ( ! is_array ( $map ) && empty( $field ) )
			$field = $model->getKeyName ();
		$map = ! is_array ( $map ) ? [ $field => $map ] : $map;
		$count =   $model->where ( $map )
			->count ();
		
		return $count > 0 ;
	}
	
	/**
	 * 删除一条数据
	 *
	 * @param $id
	 *
	 * @return bool $type 返回成功失败
	 */
	public function del ( $id )
	{
		return FALSE !== $this->destroy ( $id );
	}
	
	
	/**
	 * 获取去除html去除空格去除软回车,软换行,转换过后的字符串
	 *
	 * @param string $str
	 *
	 * @return string
	 */
	public function HtmlToMbStr ( $str )
	{
		return trim ( strip_tags ( str_replace ( [ "\n" , "\t" , "\r" , " " , "&nbsp;" ] , '' , htmlspecialchars_decode ( $str ) ) ) );
	}
	
	/**
	 * 截取中文指定字节
	 *
	 * @param string $str
	 * @param int    $utf8len
	 * @param string $chaet
	 * @param string $file
	 *
	 * @return string
	 */
	public function getSubstrUTf8 ( $str , $utf8len = 100 , $chaet = 'UTF-8' , $file = '....' )
	{
		if ( mb_strlen ( $str , $chaet ) > $utf8len ) {
			$str = mb_substr ( $str , 0 , $utf8len , $chaet ) . $file;
		}
		return $str;
	}
	
	/**
	 * 获取本季度 time
	 *
	 * @param int|string $time
	 * @param int        $ceil
	 *
	 * @return array
	 */
	public function getMonth ( $time = '' , $ceil = 0 )
	{
		if ( $ceil != 0 )
			$season = ceil ( date ( 'n' ) / 3 ) - $ceil;
		else
			$season = ceil ( date ( 'n' ) / 3 );
		$firstday = date ( 'Y-m-01' , mktime ( 0 , 0 , 0 , ( $season - 1 ) * 3 + 1 , 1 , date ( 'Y' ) ) );
		$lastday  = date ( 'Y-m-t' , mktime ( 0 , 0 , 0 , $season * 3 , 1 , date ( 'Y' ) ) );
		return [ $firstday , $lastday ];
	}
	
	/**
	 * 高精度 加法
	 *
	 * @param        $key
	 * @param        $incField
	 * @param        $inc
	 * @param string $keyField id的字段
	 * @param int    $acc      精度
	 *
	 * @return bool
	 */
	public function bcInc ( $key , $incField , $inc , $keyField = NULL , $acc = 2 )
	{
		if ( ! is_numeric ( $inc ) )
			return FALSE;
		$model = new self();
		if ( $keyField === NULL )
			$keyField = $model->getKeyName ();
		$result = $this->query ()->where ( $keyField , $key )
			->first ();
		if ( ! $result )
			return FALSE;
		$new = bcadd ( $result[ $incField ] , $inc , $acc );
		return FALSE !== $model->where ( $keyField , $key )
				->update ( [ $incField => $new ] );
	}
	
	
	/**
	 * 高精度 减法
	 *
	 * @param           $key
	 * @param string    $decField 相减的字段
	 * @param float|int $dec      减的值
	 * @param string    $keyField id的字段
	 * @param bool      $minus    是否可以为负数
	 * @param int       $acc      精度
	 *
	 * @return bool
	 */
	public function bcDec ( $key , $decField , $dec , $keyField = NULL , $minus = FALSE , $acc = 2 )
	{
		if ( ! is_numeric ( $dec ) )
			return FALSE;
		$model = new self();
		if ( $keyField === NULL )
			$keyField = $model->getKeyName ();
		$result = $this->query ()->where ( $keyField , $key )
			->first ();
		if ( ! $result )
			return FALSE;
		if ( ! $minus && $result[ $decField ] < $dec )
			return FALSE;
		$new = bcsub ( $result[ $decField ] , $dec , $acc );
		return FALSE !== $model->where ( $keyField , $key )
				->update ( [ $decField => $new ] );
	}
	
	/**
	 * @return string
	 */
	public function getError () : string
	{
		return $this->error;
	}
	
	/**
	 * @param string $error
	 */
	public function setError ( string $error )
	{
		$this->error = $error;
	}
	
	/**
	 * @param null $model
	 *
	 * @return ModelTrait|null
	 */
	protected function getSelfModel ( $model = NULL )
	{
		return $model == NULL ? ( new self() ) : $model;
	}
	
}