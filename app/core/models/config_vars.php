<?php
class ArkConfigVars extends Model {
	function view_name() {
		echo $this->tableName;
	}
	function addConfigVar($var_name, $var_value) {
		$this->create ( array (
				'var_name' => 'test1',
				'var_value' => 'test_value1',
				'd_tag' => 1 
		) );
		$this->save ();
	}
	function getConfigVar($var_name) {
		$this->Where ( 'var_name', '=', $var_name )->andWhere ( 'd_tag', '=', '0' );
		return $this->findOne ();
	}
	function delConfigVar($var_name) {
		$this->Where ( 'var_name', '=', $var_name )->andWhere ( 'd_tag', '=', '0' );
		$this->findOne ();
		$this->d_tag = 1;
		$this->save ();
	}
}