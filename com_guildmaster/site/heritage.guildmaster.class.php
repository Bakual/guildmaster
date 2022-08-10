<?php
defined('_JEXEC') or die('Restricted access');

jimport('joomla.database.table');

class GuildMasterHeritage extends JTable {
	// var $id = null;
	var $name_short = "";
	var $name = "";
	var $url = "";
	var $reward = "";
	var $reward_url = "";
	var $level = NULL;
	var $need_starter = null;

	function __construct(& $db) {
		parent :: __construct('#__guild_master_heri_quests', 'heri_id', $db);
	}

	// Class method: get_all()
	// What it does:  Reads the contents of the database into an array, which it returns
	function get_all(& $db, $offset = 0, $limit = 0) {
		$quests = array ();

		if (! $limit) {
			$limit=255;
		}
		if (! $offset) {
			$offset=0;
		}
		$offset_sql .= " LIMIT ".$limit;
		$offset_sql .= " OFFSET ".$offset;

		// Fetch all of the data from the database
		$query = "SELECT heri_id FROM #__guild_master_heri_quests ORDER BY `level` ASC, `heri_id` ASC".$offset_sql.";";
		//echo $query;
		$db->setQuery($query);
		$all = $db->loadResultArray();

		if (! count($all)) {
			return null;
		}

		// Create quest objects
		foreach ($all as $heri_id) {
			$quest = new GuildMasterHeritage($db);
			$quest->load((int) $heri_id);
			$quests[] = $quest;
		}
		return $quests;
	}

	function get_nr_quests(& $db) {
		$query = "SELECT heri_id FROM #__guild_master_heri_quests;";
		$db->setQuery($query);
		$db->query();
		return $db->getAffectedRows();
	}

	function update_step_for_toon($toon_id, $new_step_id) {
		$heri_id = $this->heri_id;
		$sql = "DELETE FROM #__guild_master_heri_map WHERE step_id IN (SELECT step_id FROM #__guild_master_heri_steps WHERE heri_id=".$heri_id.") AND toon_id=".$toon_id.";";
		$this->_db->setQuery($sql);
		$this->_db->query();

		if ($new_step_id == 0) {
			return;
		} else {
			$sql = "INSERT INTO #__guild_master_heri_map (step_id, toon_id) VALUES (".$new_step_id.",".$toon_id.");";
			// echo $sql;
			$this->_db->setQuery($sql);
			$this->_db->query();
		}
		return;
	}

	function get_toons_for_step(& $db, $step_id) {
		$sql = "SELECT #__guild_master_toons.Name FROM #__guild_master_toons, #__guild_master_heri_map WHERE #__guild_master_heri_map.step_id=".$step_id." AND #__guild_master_heri_map.toon_id=#__guild_master_toons.toon_id;";
		// echo $sql;
		$db->setQuery($sql);
		$db->query();
		return $db->loadResultArray();
	}

	function step_for_toon($toon_id) {
		$sql = "SELECT #__guild_master_heri_steps.step_id ,#__guild_master_heri_steps.name FROM #__guild_master_heri_steps, #__guild_master_heri_map WHERE #__guild_master_heri_map.step_id=#__guild_master_heri_steps.step_id AND #__guild_master_heri_map.toon_id=".$toon_id." AND #__guild_master_heri_steps.heri_id=".$this->heri_id.";";
		// echo $sql;
		$this->_db->setQuery($sql);
		$this->_db->query();
		return $this->_db->loadRow();
	}

	function get_all_steps() {
		$sql = "SELECT step_id, name FROM #__guild_master_heri_steps WHERE #__guild_master_heri_steps.heri_id=".$this->heri_id." ORDER BY `step_id` ASC;";
		// echo $sql;
		$this->_db->setQuery($sql);
		$this->_db->query();
		return $this->_db->loadObjectList();
	}

	function exists($id = NULL) {
		if (!$id) {
			$k = $this->_tbl_key;
			$id = $this-> $k;
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
		$this->Last_Updated = null;
		$k = $this->_tbl_key;
		global $migrate;
		if ($this->exists() && !$migrate) {
			$ret = $this->_db->updateObject($this->_tbl, $this, $this->_tbl_key, $updateNulls);
		} else {
			$ret = $this->_db->insertObject($this->_tbl, $this, $this->_tbl_key);
		}
		if (!$ret) {
			$this->_error = strtolower(get_class($this))."::store failed <br />".$this->_db->getErrorMsg();
			return false;
		} else {
			return true;
		}
	}

}
?>