<?php
defined('_JEXEC') or die('Restricted access');

jimport('joomla.database.table');

class GuildMasterToon extends JTable {
	// var $id = null;
	var $Name= "";
	var $Last_name= "";
	var $PrefixTitle= "";
	var $Rank= "";
	var $Race= "";
	var $Rank_Value= null;
	var $Adv_Level= null;
	var $Art_Level= null;
	var $Art2_Level= null;
	var $Adv_Class= "";
	var $Art_Class= "";
	var $Art2_Class= "";
	var $Joined= null;
	var $Points= null;
	var $Points_time= null;
	var $toon_id= null;
	var $Quests= null;
	var $KvD= null;
	var $lastonline= null;
	var $highestmeleehit= null;
	var $highestmagichit= null;
	var $memberNumber= null;
	var $Last_Updated= null;

	function __construct(& $db) {
		parent :: __construct('#__guild_master_toons', 'toon_id', $db);
	}

	// Class method: get_all()
	// What it does:  Reads the contents of the database into an array, which it returns
	function get_all(& $db, $order_col, $orderd, $toffset, $tlimit, $hide_time) {
		// Fetch all of the data from the database
		$_ascdesc= "DESC";
		if ($orderd) {
			$_ascdesc= "ASC";
		}

		if (!$order_col) {
			$order_sql= "";
			$order_col= "";
		} else {
			$order_sql= "ORDER BY `" . $order_col . "` " . $_ascdesc;
			$order_col= "," . $order_col;
		}

		if (!$tlimit) {
			$tlimit= 255;
		}
		if (!$toffset) {
			$toffset= 0;
		}
		$offset_sql .= " LIMIT " . $tlimit;
		$offset_sql .= " OFFSET " . $toffset;

		$toons= array ();

		// $query = "SELECT name,rank,rank_value,adv_level,art_level,adv_class,art_class,joined,points,points_time,#__guild_master_toons.toon_id,quests,kvd,lastonline,highestmeleehit,highestmagichit,last_updated,user_id FROM #__guild_master_toons LEFT JOIN #__guild_master_user ON #__guild_master_toons.toon_id=#__guild_master_user.toon_id ORDER BY `".$order."` ".$_ascdesc.";";
		$query= "SELECT toon_id" . $order_col . " FROM #__guild_master_toons " . $order_sql . $offset_sql . ";";
		// echo $query;
		$db->setQuery($query);
		$all= $db->loadResultArray();

		// Create toon objects
		foreach ($all as $toon_id) {
			$toon= new GuildMasterToon($db);
			$toon->load((int) $toon_id);
			if (! $hide_time || (strtotime($toon->lastonline) > (time() - $hide_time * 86400))) {
				// echo "LastOn:" . $toon->lastonline;
				// echo "HideDate:" . time() + $hide_time;
				$toons[]= $toon;
			}
		}
		return $toons;
	}

	function claim($user_id) {
		if (is_null($user_id)) {
			return null;
		}
		$k= $this->_tbl_key;
		$toon_id= $this-> $k;

		if ($this->get_user_id()) {
			$sql= "UPDATE #__guild_master_user SET user_id=$user_id WHERE toon_id=$toon_id;";
		} else {
			$sql= "INSERT INTO #__guild_master_user (user_id, toon_id) VALUES($user_id, $toon_id);";
		}
		$this->_db->setQuery($sql);
		$this->_db->query();
		return null;
	}

	function release() {
		$k= $this->_tbl_key;
		$toon_id= $this-> $k;

		$sql= "DELETE FROM #__guild_master_user WHERE toon_id=$toon_id;";
		$this->_db->setQuery($sql);
		$this->_db->query();
		return null;
	}

	function get_user_id() {
		$k= $this->_tbl_key;
		$toon_id= $this-> $k;

		$sql= "SELECT user_id FROM #__guild_master_user WHERE toon_id=$toon_id;";
		$this->_db->setQuery($sql);
		$this->_db->query();

		$temp= $this->_db->loadRow();
		return $temp[0];
	}

	function exists($id= NULL) {
		if (!$id) {
			$k= $this->_tbl_key;
			$id= $this-> $k;
			if (!$id) {
				return false;
			}
		}
		$sql= "SELECT $this->_tbl_key FROM $this->_tbl WHERE $this->_tbl_key=$id";
		$this->_db->setQuery($sql);
		$this->_db->query();
		return $this->_db->getAffectedRows();
	}

	function store($updateNulls= false) {
		$this->Last_Updated= null;
		$k= $this->_tbl_key;
		global $migrate;
		if ($this->exists() && !$migrate) {
			$ret= $this->_db->updateObject($this->_tbl, $this, $this->_tbl_key, $updateNulls);
		} else {
			$ret= $this->_db->insertObject($this->_tbl, $this, $this->_tbl_key);
		}
		if (!$ret) {
			$this->_error= strtolower(get_class($this)) . "::store failed <br />" . $this->_db->getErrorMsg();
			return false;
		} else {
			return true;
		}
	}

}
?>