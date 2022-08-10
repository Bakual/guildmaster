<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.database.table');

class TableGuildMaster extends JTable {
	var $id = null;
	var $guild_name = null;
	var $guild_id = null;
	var $guild_rank_1 = null;
	var $guild_rank_2 = null;
	var $guild_rank_3 = null;
	var $guild_rank_4 = null;
	var $guild_rank_5 = null;
	var $guild_rank_6 = null;
	var $guild_rank_7 = null;
	var $guild_rank_8 = null;
	var $show_updated = null;
	var $popup = null;
	var $use_images= null;
	var $show_lastnames = null;
	var $show_prefixtitles = null;
	var $roster_url = null;
	var $roster_url_xml = null;
	var $guild_url = null;
	var $toon_url = null;
	var $cache_time = null;
	var $hide_time = null;
	var $guild_info = null;

	function __construct(&$db) {
		parent::__construct('#__guild_master_conf', 'id', $db);
	}
}
?>