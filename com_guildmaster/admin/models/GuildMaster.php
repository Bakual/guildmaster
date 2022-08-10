<?php


//no direct access
defined('_JEXEC') or die();

jimport('joomla.application.component.model');

class GuildMasterModelGuildMaster extends JModel {
	var $_data;

	/**
	 * Creates a query string for retrieval of data from the database.
	 * @access private
	 * @return string the query string for the database operation
	*/
	function _buildQuery() {
		$query= 'SELECT * FROM #__guild_master_conf WHERE id=1';

		return $query;
	} //end _buildQuery

	/**
	 * Returns an array of forum items from the database.
	 * @return array an array of forum objects
	*/
	function load() {
		//only perform the operation if we not already done so
		if (empty ($this->_data)) {
			$query= $this->_buildQuery();
			$this->_data= $this->_getList($query);
		}

		return $this->_data;
	} //end load

	function store($data) {
		$row = $this->getTable('GuildMaster');
		$row->id=1;

		if (!$row->bind($data)) {
			$this->setError($row->getError());
			return false;
		}

		// var_dump(get_object_vars($row));

		if (!$row->store()) {
			$this->setError($row->getError());
			return false;
		}
		return true;
	}
}
?>
