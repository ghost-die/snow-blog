<?php


namespace App\Traits;


use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


trait HasResourceActions
{
	
	protected $validate = [];
	
	
	protected $validateMessage = [];
	
	
	
	
	
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
//		return $this->destroy($id);
	}
	
	/**
	 * Prepare input data for insert.
	 *
	 * @param $inserts
	 *
	 * @return array
	 */
	protected function prepareInsert($inserts): array
	{
//		if ($this->isHasOneRelation($inserts)) {
//			$inserts = Arr::dot($inserts);
//		}
//
//		foreach ($inserts as $column => $value) {
//			if (($field = $this->getFieldByColumn($column)) === null) {
//				unset($inserts[$column]);
//				continue;
//			}
//
//			$inserts[$column] = $field->prepare($value);
//		}
//
//		$prepared = [];
//
//		foreach ($inserts as $key => $value) {
//			Arr::set($prepared, $key, $value);
//		}
//
//		return $prepared;
	}
	
	/**
	 * @param Request $request
	 * @return array
	 */
	public function validationMessages(Request $request)
	{
		return $request->validate($this->validate,$this->validateMessage);
		
	}
}