<?php
/**
 * @package     GuildMaster
 * @subpackage  Component.Site
 * @author      Thomas Hunziker <admin@bakual.net>
 * @copyright   © 2022 - Thomas Hunziker, original idea by Stefan Reimer
 * @license     http://www.gnu.org/licenses/gpl.html
 **/

defined('_JEXEC') or die();

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;

$app    = Factory::getApplication();
$jinput = $app->input;
$config = $app->getParams();

require_once(JPATH_COMPONENT . '/guildmaster.parser.php');
require_once(JPATH_COMPONENT . '/guild.guildmaster.class.php');
require_once(JPATH_COMPONENT . '/toon.guildmaster.class.php');
require_once(JPATH_COMPONENT . '/heritage.guildmaster.class.php');
require_once(JPATH_BASE . '/administrator/components/com_guildmaster/guildmaster.class.php');

$doc = Factory::getDocument();

// Load languages and merge with fallbacks
$jlang = Factory::getLanguage();
$jlang->load('com_guildmaster', JPATH_COMPONENT, 'en-GB', true);
$jlang->load('com_guildmaster', JPATH_COMPONENT, null, true);


if (!$config->guild_id)
{
	$app->enqueueMessage('Guild ID not set.<br>Please check configuration.');

	return;
}

$controller = BaseController::getInstance('Guildmaster');
$controller->execute($jinput->get('task'));
$controller->redirect();

$force_update   = $jinput->get('force_update');
$disable_hiding = $jinput->get('disable_hiding');
$task           = $jinput->get('task');
$todo           = $jinput->get('todo');

$Itemid              = $jinput->getInt('Itemid');
$config->index       = 'index.php?option=com_guildmaster&Itemid=' . $Itemid;
$config->images_path = 'media/com_guildmaster/';

update_all($error, $config, $database, $force_update);

switch ($task)
{
	case "claim" :
		claim_toon($database, $config, $user, $session);
		break;
	case "release" :
		release_toon($database, $config, $user, $session);
		break;
	case "heritage" :
		display_heritage($database, $config, $user, $session, $disable_hiding);
		break;
	case "edit_heri" :
		edit_heritage($database, $config, $user, $session);
		break;
	case "save_heri" :
		if (strtolower($todo) == "save")
		{
			save_heritage($database, $config, $user, $session);
		}
		else
		{
			$mainframe->redirect($config->index . '&task=heritage', "");
		}
		break;
	case "compare_heri" :
		compare_heritage($database, $config, $user, $session);
		break;
	default :
		display_roster($database, $config, $user, $session, $disable_hiding);
}

return;

// ******************************** save heritage quests *****************************
function compare_heritage(&$database, &$config, $user, $session)
{
	$heri_id = (int) JRequest:: getVar('heri_id');

	$quest = new GuildMasterHeritage($database);
	$quest->load($heri_id);

	if (!$quest->name)
	{
		$error[] = "Quests not found !";
		error_message($error);

		return;
	}

	echo '<table class="contentpane">';
	echo '<tr>';
	echo '<tr><th colspan="2" align="center">' . $quest->name_short . ' - ' . $quest->name . '</th>';
	echo '</tr>';

	// Row Headers
	echo '<tr class="sectiontableheader">';
	echo '<th>Step</th>';
	echo '<th>Toons</th>';
	echo '</tr>';

	$steps  = $quest->get_all_steps();
	$toggle = 1; // Display Rows of data
	foreach ($steps as $step)
	{
		echo '<tr class="sectiontableentry$toggle">';
		if ($toggle == 1)
		{
			$toggle = 2;
		}
		else
		{
			$toggle = 1;
		}

		echo '<td>' . $step->name . '</td>';
		$toons = GuildMasterHeritage:: get_toons_for_step($database, $step->step_id);
		if (!$toons)
		{
			$toons = array();
		}
		echo '<td>' . implode(',', $toons) . '</td></tr>';
	}

	echo '</tr>';
	echo '<tr><td colspan="2">';
	echo '<a href="' . $config->index . '&task="heritage">Back</a>';
	echo '</td></tr>';
	echo '</table>';

	return;
}

// ******************************** save heritage quests *****************************
function save_heritage(&$database, &$config, $user, $session)
{
	global $mainframe;
	$user_id = $user->get('id');
	$toon_id = (int) JRequest:: getVar('toon_id');

	$toon = new GuildMasterToon($database);
	$toon->load($toon_id);

	if (check_toon($toon, $user, 1))
	{
		return;
	}

	$quests = GuildMasterHeritage:: get_all($database);

	// Check to see if the data was returned
	if (is_null($quests))
	{
		$error[] = "No quests found to display.";
		error_message($error);

		return;
	}

	foreach ($quests as $quest)
	{
		// search new value
		foreach ($_POST as $key => $var)
		{
			// echo $key."=".$var."<br/>";
			if (preg_match("/^quest_" . $quest->heri_id . "$/", $key))
			{
				echo 'Quest ' . $quest->heri_id . ' set to ' . $var;
				$quest->update_step_for_toon($toon_id, (int) $var);
			}
		}

	}

	$mainframe->redirect($config->index . '&task=heritage', 'Heritage quests for ' . $toon->Name . ' updated !');

	return;
}

// ******************************** edit heritage quests *****************************
function edit_heritage(&$database, &$config, $user, $session)
{
	$user_id = $user->get('id');
	$toon_id = (int) JRequest:: getVar('toon_id');
	$qoffset = JRequest:: getVar('qoffset', null);
	if (!is_null($qoffset))
	{
		$session->set('qoffset', $qoffset);
	}
	$qoffset = $session->get('qoffset', 0);
	$qlimit  = (int) JRequest:: getVar('qlimit', 16);

	$toon = new GuildMasterToon($database);
	$toon->load($toon_id);

	if (check_toon($toon, $user, 1))
	{
		return;
	}

	$quests    = GuildMasterHeritage:: get_all($database, $qoffset, $qlimit);
	$nr_quests = GuildMasterHeritage:: get_nr_quests($database);

	// Check to see if the data was returned
	if (is_null($quests))
	{
		$error[] = "No quests found to display.";
		error_message($error);

		return;
	}

	echo '<form enctype="multipart/form-data" task="' . $config->index . '" method="post" name="edit_heri">';
	echo '<table class="contentpane">';
	echo '<tr>';
	echo '<tr><th colspan="3" align="center">Heritage Quests for ' . $toon->Name . '</th>';
	echo '</tr>';

	echo '<tr class="sectiontableheader">';
	echo '<th>&nbsp;</th>';
	echo '<th>Quest</th>';
	echo '<th>Current Step</th>';
	echo '</tr>';

	$toggle = 1; // Display Rows of data
	foreach ($quests as $quest)
	{
		echo '<tr class="sectiontableentry$toggle">';
		if ($toggle == 1)
		{
			$toggle = 2;
		}
		else
		{
			$toggle = 1;
		}

		echo '<td><a href="' . $quest->reward_url . '"><image src="' . $config->images_path . 'quests/' . $quest->name_short . '.jpg"/></a></td>';
		echo '<td><a href="' . $quest->url . '">' . $quest->name_short . '</a> - ' . $quest->name . ' (' . $quest->level . ')</td>';

		$all_steps = $quest->get_all_steps();
		$step      = $quest->step_for_toon($toon->toon_id);
		echo '<td>';
		echo '<select name="quest_' . $quest->heri_id . '" class="inputbox" style="width:18em">>';
		echo '<option value="0">  </option>';
		foreach ($all_steps as $pos_step)
		{
			echo '<option value="' . $pos_step->step_id . '"';
			if ($pos_step->step_id == $step[0])
			{
				echo ' selected="selected"';
			}
			echo '>' . $pos_step->name . '</option>';
		}
		echo '</select>';
		echo '</td>';

		echo '</tr>';
	}

	echo '<tr><td colspan="3" align="center">';
	echo '<input class="button" type="submit" name="todo" value="Cancel" />';
	echo '&nbsp;&nbsp;&nbsp;';
	echo '<input class="button" type="submit" name="todo" value="Save" />';
	echo '<input type="hidden" name="toon_id" value="' . $toon_id . '" />';
	echo '<input type="hidden" name="task" value="save_heri" />';
	echo '</td></tr>';
	echo '</table>';
	echo '</form>';

	show_pager($qoffset, $qlimit, $nr_quests, $config->index . '&task=edit_heri&toon_id=' . $toon_id);

	return;
}

// ******************************** Release toon *****************************
function release_toon(&$database, &$config, $user, $session)
{
	global $mainframe;
	$user_id = $user->get('id');
	$toon_id = (int) JRequest:: getVar('toon_id');

	$toon = new GuildMasterToon($database);
	$toon->load($toon_id);

	if (check_toon($toon, $user, 1))
	{
		return;
	}

	$toon->release();

	$mainframe->redirect($config->index, $toon->Name . " is free again !");

	return;
}

// ******************************** Claim toon *****************************
function claim_toon(&$database, &$config, $user, $session)
{
	global $mainframe;
	$user_id = $user->get('id');
	$toon_id = (int) JRequest:: getVar('toon_id');

	$toon = new GuildMasterToon($database);
	$toon->load($toon_id);

	if (check_toon($toon, $user, 0))
	{
		return;
	}

	$toon->claim($user_id);

	$mainframe->redirect($config->index, $toon->Name . " is now yours !");
}

// ******************************** Display Code *****************************
function display_roster(&$database, &$config, $user, $session, $disable_hiding = null)
{
	$order   = JRequest:: getVar('order', 'S');
	$orderd  = (int) JRequest:: getVar('orderd', 0);
	$toffset = (int) JRequest:: getVar('toffset', 0);
	$tlimit  = (int) JRequest:: getVar('tlimit', 50);
	$user_id = $user->get('id');

	($disable_hiding) ? $hide_time = 0 : $hide_time = $config->hide_time;

	// $roster_columns = array ('N' => array ('name', 'Name', 'left'), 'R' => array ('rank_value', 'Rank', 'left'), 'AC' => array ('Adv_Class', 'Adventure', 'left'), 'AL' => array ('Adv_Level', 'Lvl', 'left'), 'CC' => array ('Art_Class', 'Artisan', 'left'), 'CL' => array ('Art_Level', 'Lvl', 'left'), 'S' => array ('Points', 'Status', 'right'), 'ST' => array ('Points_time', 'Stat/d', 'right'), 'Q' => array ('Quests', 'Quests', 'right'), 'K' => array ('KvD', 'KvD', 'right'), 'LON' => array ('lastonline', 'Last on', 'right'));

	// Remove Last Online for the public :)
//	if ($user_id) {
//		$roster_columns = array ('R' => array ('rank_value', 'Rank', 'left'), 'N' => array ('name', 'Name', 'left'), 'RA' => array ('Race', 'Race', 'left'), 'AL' => array ('Adv_Level', 'Lvl', 'right'), 'AC' => array ('Adv_Class', 'Adventure', 'left'), 'CL' => array ('Art_Level', 'Lvl', 'right'), 'CC' => array ('Art_Class', 'Artisan', 'left'), 'S' => array ('Points', 'Status', 'right'), 'ST' => array ('Points_time', 'Stat/d', 'right'), 'Q' => array ('Quests', 'Quests', 'right'), 'LON' => array ('lastonline', 'Last on', 'right'));
//	} else {
//		$roster_columns = array ('R' => array ('rank_value', 'Rank', 'left'), 'N' => array ('name', 'Name', 'left'), 'RA' => array ('Race', 'Race', 'left'), 'AL' => array ('Adv_Level', 'Lvl', 'right'), 'AC' => array ('Adv_Class', 'Adventure', 'left'), 'CL' => array ('Art_Level', 'Lvl', 'right'), 'CC' => array ('Art_Class', 'Artisan', 'left'), 'S' => array ('Points', 'Status', 'right'), 'ST' => array ('Points_time', 'Stat/d', 'right'), 'Q' => array ('Quests', 'Quests', 'right'));
//	}
	$roster_columns = array('R' => array('rank_value', 'Rank', 'left'), 'N' => array('name', 'Name', 'left'), 'AL' => array('Adv_Level', 'Lvl', 'right'), 'AC' => array('Adv_Class', 'Adventure', 'left'), 'CL' => array('Art_Level', 'Lvl', 'right'), 'CC' => array('Art_Class', 'Artisan', 'left'), 'CL2' => array('Art2_Level', 'Lvl', 'right'), 'CC2' => array('Art2_Class', 'Artisan', 'left'), 'S' => array('Points', 'Status', 'right'), 'Q' => array('Quests', 'Quests', 'right'));

	$db_order = $roster_columns[$order][0];
	if (!$db_order)
	{
		$db_order = 'Points';
	}

	// reload guild from DB
	$guild = new GuildMasterGuild($database);
	$guild->load($config->guild_id);

	$toons = GuildMasterToon:: get_all($database, $db_order, $orderd, $toffset, $tlimit, $hide_time);

	// Check to see if the data was returned
	if (is_null($toons))
	{
		$error[] = "No data found to display.";
		error_message($error);

		return;
	}

	// Default colspan for the top row
	$colspan = count($roster_columns) + 1;
	echo '<table class="contentpane">';

	if ($config->guild_info)
	{
		echo '<tr class="contentheading"><th colspan="' . $colspan . '" align="center">';
		echo $guild->guild_name;
		echo '</th></tr>';
		echo '<tr><td colspan="' . $colspan . '" align="center">';
		echo 'Members: ' . $guild->members . '&nbsp;&nbsp;&nbsp;';
		echo 'Level: ' . $guild->level . '&nbsp;&nbsp;&nbsp;';
		echo 'Status: ' . $guild->points . '&nbsp;&nbsp;&nbsp;';
		echo 'Server: ' . $guild->server_name;
		echo '</td></tr>';
		echo '<tr><td colspan="' . $colspan . '" align="center">';
		echo '&nbsp;';
		echo '</td></tr>';
	}

	// Row Headers
	echo '<tr class="sectiontableheader">';
	echo '<th>&nbsp;</th>';
	foreach ($roster_columns as $key => $col)
	{
		echo '<th align="' . $col[2] . '" nowrap';
		if ($order == $key)
		{ // If same col clicked second time flip order
			if ($orderd)
			{
				$_orderd = 0;
			}
			else
			{
				$_orderd = 1;
			}
			echo ' class="highlight"';
		}
		else
		{
			$_orderd = 0;
		}
		echo '>&nbsp;<a href="' . $config->index . '&order=' . $key . '&orderd=' . $_orderd . '">' . $col[1] . '</a>&nbsp;</th>';
	}
	echo '</tr>';
	if ($config->popup)
	{
		$target = ' target="_blank"';
	}
	else
	{
		$target = "";
	}

	$toggle = 1; // Display Rows of data
	foreach ($toons as $toon)
	{
		echo '<tr class="sectiontableentry' . $toggle . '">';
		if ($toggle == 1)
		{
			$toggle = 2;
		}
		else
		{
			$toggle = 1;
		}
		// task cell if logged in
		echo '<td align="center">';
		if ($user_id)
		{
			// toon is free
			$toon->user_id = $toon->get_user_id();
			if (is_null($toon->user_id))
			{
				//claim toon
				echo '<a href="' . $config->index . '&task=claim&toon_id=' . $toon->toon_id . '">C</a>';
			}
			elseif ($toon->user_id == $user_id || $user->get('usertype') == "Super Administrator")
			{
				//release toon
				echo '<a href="' . $config->index . '&task=release&toon_id=' . $toon->toon_id . '">R</a>';
			}
		}
		echo '</td>';

		// Rank
		if ($config->use_images)
		{
			echo '<td align="left"><image src="' . $config->images_path . 'ranks/rank' . $toon->Rank_Value . '.png" alt="' . $toon->Rank . '" title="' . $toon->Rank . '"/></td>';
		}
		else
		{
			echo '<td align="left">&nbsp;' . $toon->Rank . '&nbsp;</td>';
		}

		// Name
		$toon_name = $toon->Name;
		if ($config->show_lastnames)
		{
			$toon_name .= ' ' . $toon->Last_name;
		}
		if ($config->show_prefixtitles)
		{
			$toon_name = $toon->PrefixTitle . ' ' . $toon_name;
		}
		echo '<td align="left">&nbsp;<a href="http://eq2players.station.sony.com/en/pplayer.vm?characterId=' . $toon->toon_id . '" ' . $target . '>' . $toon_name . '</a>&nbsp;</td>';

		// Race
//		if ($config->use_images) {
//			echo '<td align="left"><image src="'.$config->images_path.'races/'.strtolower(preg_replace('/\s+/','',$toon->Race)).'.gif" alt="'.$toon->Race.'" title="'.$toon->Race.'"/></td>';
//		} else {
//			echo '<td align="left">'.$toon->Race.'</td>';
//		}

		// Adventurer
		echo '<td align="right">&nbsp;' . $toon->Adv_Level . '&nbsp;</td>';
		if ($config->use_images)
		{
			echo '<td align="left"><image src="' . $config->images_path . 'adventurer/' . strtolower(preg_replace('/\s+/', '', $toon->Adv_Class)) . '.gif" alt="' . $toon->Adv_Class . '" title="' . $toon->Adv_Class . '"/></td>';
		}
		else
		{
			echo '<td align="left">&nbsp;' . $toon->Adv_Class . '&nbsp;</td>';
		}

		// Artisan
		if (!$toon->Art_Class)
		{
			$toon->Art_Class = "Unskilled";
		}
		echo '<td align="right">&nbsp;' . $toon->Art_Level . '&nbsp;</td>';
		if ($config->use_images)
		{
			echo '<td align="left"><image src="' . $config->images_path . 'tradeskill/' . strtolower(preg_replace('/\s+/', '', $toon->Art_Class)) . '.gif" alt="' . $toon->Art_Class . '" title="' . $toon->Art_Class . '"/></td>';
		}
		else
		{
			echo '<td align="left">&nbsp;' . $toon->Art_Class . '&nbsp;</td>';
		}

		// Secondary Tradeskill
		echo '<td align="right">&nbsp;' . $toon->Art2_Level . '&nbsp;</td>';
		echo '<td align="left">&nbsp;' . substr($toon->Art2_Class, 0, 4) . '&nbsp;</td>';

		// Status Points
		echo '<td align="right">&nbsp;' . $toon->Points . '&nbsp;</td>';
//		echo '<td align="right">&nbsp;'.sprintf("%.0f", $toon->Points_time).'&nbsp;</td>';

		// Quests
		echo '<td align="right">&nbsp;' . $toon->Quests . '&nbsp;</td>';
		// echo '<td align="right">&nbsp;'.sprintf("%.0f", $toon->KvD).'&nbsp;</td>';

		// Last online
//		if ($user_id) {
//			echo '<td align="right">&nbsp;'.date("j.M", strtotime($toon->lastonline)).'&nbsp;</td>';
//		}
		echo '</tr>';
	}

	if ($config->show_updated)
	{
		echo '<tr class="small"><td colspan="' . $colspan . '" align="center">';
		echo 'Last Updated: ' . $guild->Last_Updated;
		echo '</td></tr>';
	}

	echo '</table>';

	return;
}

// ******************************** Display Code *****************************
function display_heritage(&$database, &$config, $user, $session, $disable_hiding = null)
{
	$user_id = $user->get('id');
	$qoffset = JRequest:: getVar('qoffset', null);
	if (!is_null($qoffset))
	{
		$session->set('qoffset', $qoffset);
	}
	$qoffset = $session->get('qoffset', 0);
	$qlimit  = (int) JRequest:: getVar('qlimit', 16);
	$toffset = (int) JRequest:: getVar('toffset', 0);
	$tlimit  = (int) JRequest:: getVar('tlimit', 50);
	($disable_hiding) ? $hide_time = 0 : $hide_time = $config->hide_time;

	$quests    = GuildMasterHeritage:: get_all($database, $qoffset, $qlimit);
	$nr_quests = GuildMasterHeritage:: get_nr_quests($database);

	// Check to see if the data was returned
	if (is_null($quests))
	{
		$error[] = "No quests found to display.";
		error_message($error);

		return;
	}

	echo '<table class="contentpane">';

	// Row Headers
	echo '<tr class="sectiontableheader">';
	echo '<th>&nbsp;</th>';
	echo '<th>Reward</th>';
	foreach ($quests as $quest)
	{
		echo '<th align="center"><a href="' . $quest->reward_url . '"><image src="' . $config->images_path . 'quests/' . $quest->name_short . '.jpg"/></a></th>';
	}
	echo '</tr>';

	echo '<tr class="sectiontableheader">';
	echo '<th>&nbsp;</th>';
	echo '<th>Quest<br/>Level</th>';
	foreach ($quests as $quest)
	{
		echo '<th align="center"><a href="' . $quest->url . '">' . $quest->name_short . '</a><br/>' . $quest->level . '</th>';
	}
	echo '</tr>';

	echo '<tr class="sectiontableheader">';
	echo '<th>Player</th>';
	echo '<th>Compare</th>';
	foreach ($quests as $quest)
	{
		echo '<th align="center"><a href="' . $config->index . '&task=compare_heri&heri_id=' . $quest->heri_id . '">[<b>?</b>]</a></th>';
	}
	echo '</tr>';

	$toggle = 1; // Display Rows of data
	$toons  = GuildMasterToon:: get_all($database, 'Points', 0, $toffset, $tlimit, $hide_time);

	// Check to see if the data was returned
	if (!is_null($toons))
	{
		foreach ($toons as $toon)
		{
			echo '<tr class="sectiontableentry' . $toggle . '">';
			if ($toggle == 1)
			{
				$toggle = 2;
			}
			else
			{
				$toggle = 1;
			}
			echo '<td>' . $toon->Name . '</td>';

			// If logged in, get toon<->user mapping
			if ($user_id)
			{
				$toon->user_id = $toon->get_user_id();
			}

			if (is_null($toon->user_id) || $toon->user_id != $user_id)
			{
				echo '<td>&nbsp;</td>';
			}
			else
			{
				// edit button
				echo '<td><a href="' . $config->index . '&task=edit_heri&toon_id=' . $toon->toon_id . '">Edit</a></td>';
			}

			foreach ($quests as $quest)
			{
				$step = $quest->step_for_toon($toon->toon_id);
				if (!$step)
				{
					echo '<td>&nbsp;</td>';
				}
				else
				{
					if ($step[1] == "COMPLETED!")
					{
						$image = "finished.png";
					}
					else
					{
						$image = "progress.png";
					}
					echo '<td align="center"><image src="' . $config->images_path . 'quests/' . $image . '"/></td>';
				}
			}

			echo '</tr>';
		}
	}

	echo '</table>';

	show_pager($qoffset, $qlimit, $nr_quests, $config->index . '&task=heritage');

	return;
}

function show_pager($qoffset, $qlimit, $nr_quests, $next_url)
{
	echo '<table width="100%"><tr>';
	echo '<td width="50%" align="left">';
	if ($qoffset)
	{
		$new_qoffset = $qoffset - $qlimit;
		if ($new_qoffset < 0)
		{
			$new_qoffset = 0;
		}
		echo '<a href="' . $next_url . '&qoffset=' . $new_qoffset . '">Previous</a>';
	}
	echo '</td>';
	echo '<td width="50%" align="right">';
	if ($nr_quests > $qoffset + $qlimit)
	{
		$new_qoffset = $qoffset + $qlimit;
		echo '<a href="' . $next_url . '&qoffset=' . $new_qoffset . '">Next</a>';
	}
	echo '</td>';
	echo '</tr></table>';
}

// Function: error_message($message)
// What it does:  Displays an error message
// Variables:
//     $message - Error Message to display
function error_message($message)
{
	echo '<div class="error">Guild Master Error<p/>';
	echo implode('<br/>', $message) . '<p/>';
	echo 'If problem persists, check for latest updates on <a href="http://www.startux.de">www.startux.de</a>';
	echo '</div>';

	return;
}

function check_toon(&$toon, &$user, $must_own = 1)
{
	$user_id = $user->get('id');
	if (is_null($user_id))
	{
		$error[] = "Please log in to manage a toon!";
		error_message($error);

		return true;
	}

	if (!$toon->Name)
	{
		$error[] = "Toon ( " . $toon->toon_id . " ) not found !";
		error_message($error);

		return true;
	}

	if ($must_own)
	{
		if (($toon->get_user_id() != $user_id) && ($user->get('usertype') != "Super Administrator"))
		{
			$error[] = $toon->Name . " is not owned by you!";
			error_message($error);

			return true;
		}
	}
	else
	{
		if (!is_null($toon->get_user_id()))
		{
			$error[] = $toon->Name . " is owned by " . $user->get('name') . " !<br/> Toon must be released first.";
			error_message($error);

			return;
		}
	}

	return null;
}

?>