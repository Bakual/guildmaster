<?php
defined('_JEXEC') or die('Restricted access');

// jimport('joomla.database.table');

class Guild extends JTable {
	// var $id = NULL;
	var $guild_id = NULL;
	var $guild_name = "";
	var $server_name = "";
	var $server_id = NULL;
	var $created = NULL;
	var $avg_level = NULL;
	var $avg_quests = NULL;
	var $members = NULL;
	var $unique_members = NULL;
	var $most_recent_item = "";
	var $level = NULL;
	var $points = NULL;
	var $item_disc_world = NULL;
	var $item_disc_server = NULL;
	var $rares = NULL;
	var $pvp_kills = NULL;
	var $npc_kills = NULL;
	var $arena_kills = NULL;
	var $avg_pvp_kills = NULL;
	var $avg_npc_kills = NULL;
	var $avg_arena_kills = NULL;
	var $items_crafted = NULL;
	var $deaths = NULL;
	var $deaths_per_member = NULL;
	var $kvd = NULL;

	var $most_points = "";

	//	var $kvd_rank = NULL;
	//	var $most_disc_server = "";
	//	var $most_disc_world = "";
	//	var $most_killed_npcs = "";
	//	var $best_kvd = "";
	//	var $most_quests = "";
	//	var $last_lvlup = "";
	//	var $last_die = "";
	//	var $fighters = NULL;
	//	var $priests = NULL;
	//	var $mages = NULL;
	//	var $scouts = NULL;

	var $Last_Updated = NULL;

	function __construct(& $db) {
		parent :: __construct('#__guild_master_guild', 'guild_id', $db);
	}

	function exists($id = NULL) {
		if (!$id) {
			$k = $this->_tbl_key;
			$id = $this->$k;
			if (!$id) {
				return false;
			}
		}

		$sql = "SELECT $this->_tbl_key FROM $this->_tbl WHERE $this->_tbl_key=$id";
		$this->_db->setQuery($sql);
		$this->_db->query();
		return $this->_db->getAffectedRows();
	}

	function store($updateNulls = false) {
		$this->Last_Updated = NULL;
		$k = $this->_tbl_key;
		if ($this->exists()) {
			$ret = $this->_db->updateObject($this->_tbl, $this, $this->_tbl_key, $updateNulls);
		} else {
			$ret = $this->_db->insertObject($this->_tbl, $this, $this->_tbl_key);
		}
		if (!$ret) {
			$this->_error = strtolower(get_class($this)) . "::store failed <br />" . $this->_db->getErrorMsg();
			return false;
		} else {
			return true;
		}
	}

}
?>