<?php


/*
 * Created on Apr 26, 2006
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

// defined('_JEXEC') or die('Restricted access');

// global $mainframe;
// $database = $mainframe->getDBO();
// $database->set(_debug, 1);

// Array storing heritage quest data.
$alt_quests = array ('GLS' => array ('quest_name' => 'The Return of the Light', 'quest_url' => 'http://eq2.ogaming.com/db/quests/TheReturnoftheLight.php', 'req_level' => 17, 'req_starter' => TRUE, 'reward' => 'Greater Lightstone', 'reward_url' => 'http://eq2.ogaming.com/db/items/GreaterLightstone.php'), 'LJB' => array ('quest_name' => 'The Journey is Half the Fun', 'quest_url' => 'http://eq2.ogaming.com/db/quests/TheJourneyisHalftheFun.php', 'req_level' => 5, 'req_starter' => FALSE, 'reward' => 'Legendary Journeyman\'s Boots', 'reward_url' => 'http://eq2.ogaming.com/db/items/LegendaryJourneymansBoots(MA).php'), 'DWB' => array ('quest_name' => 'These Boots Were Made For...', 'quest_url' => 'http://eq2.ogaming.com/db/quests/TheseBootsWereMadeFor....php', 'req_level' => 20, 'req_starter' => FALSE, 'reward' => 'Dwarven Work Boots', 'reward_url' => 'http://eq2.ogaming.com/db/items/DwarvenWorkBoots(Medium).php'), 'SBH' => array ('quest_name' => 'Dragoon K\'Naae of the Thexians', 'quest_url' => 'http://eq2.ogaming.com/db/quests/DragoonKNaaeoftheThexians.php', 'req_level' => 24, 'req_starter' => FALSE, 'reward' => 'Shiny Brass Halberd', 'reward_url' => 'http://eq2.ogaming.com/db/items/ShinyBrassHalberd.php'), 'FBE' => array ('quest_name' => 'Hadden\'s Earring', 'quest_url' => 'http://eq2.ogaming.com/db/quests/HaddensEarring.php', 'req_level' => 25, 'req_starter' => FALSE, 'reward' => 'Fishbone Earring', 'reward_url' => 'http://eq2.ogaming.com/db/items/FishboneEarring.php'), 'GBS' => array ('quest_name' => 'A Strange Black Rock', 'quest_url' => 'http://eq2.ogaming.com/db/quests/AStrangeBlackRock.php', 'req_level' => 25, 'req_starter' => TRUE, 'reward' => 'Glowing Black Stone', 'reward_url' => 'http://eq2.ogaming.com/db/items/GlowingBlackStone.php'), 'PGT' => array ('quest_name' => 'An Axe from The Past', 'quest_url' => 'http://eq2.ogaming.com/db/quests/AnAxefromThePast.php', 'req_level' => 25, 'req_starter' => FALSE, 'reward' => 'Polished Granite Tomahawk', 'reward_url' => 'http://eq2.ogaming.com/db/items/PolishedGraniteTomahawk.php'), 'MS' => array ('quest_name' => 'Stiletto\'s Orders Intercepted', 'quest_url' => 'http://eq2.ogaming.com/db/quests/StilettosOrdersIntercepted.php', 'req_level' => 28, 'req_starter' => TRUE, 'reward' => 'Manastone', 'reward_url' => 'http://eq2.ogaming.com/db/items/Manastone.php'), 'SBS' => array ('quest_name' => 'Training is a Shield', 'quest_url' => 'http://eq2.ogaming.com/db/quests/TrainingisaShield.php', 'req_level' => 30, 'req_starter' => FALSE, 'reward' => 'Shiny Brass Shield', 'reward_url' => 'http://eq2.ogaming.com/db/items/ShinyBrassShield.php'), 'GB' => array ('quest_name' => 'Restoring Ghoulbane', 'quest_url' => 'http://eq2.ogaming.com/db/quests/RestoringGhoulbane.php', 'req_level' => 30, 'req_starter' => FALSE, 'reward' => 'Ghoulbane', 'reward_url' => 'http://eq2.ogaming.com/db/items/Ghoulbane.php'), 'GoTD' => array ('quest_name' => 'A Missing Mask', 'quest_url' => 'http://eq2.ogaming.com/db/quests/AMissingMask.php', 'req_level' => 31, 'req_starter' => FALSE, 'reward' => 'Guise of the Deceiver', 'reward_url' => 'http://eq2.ogaming.com/db/items/GuiseoftheDeceiver.php'), 'EEB' => array ('quest_name' => 'Foomby\'s Stolen Goods', 'quest_url' => 'http://eq2.ogaming.com/db/quests/FoombysStolenGoods.php', 'req_level' => 32, 'req_starter' => FALSE, 'reward' => 'Bag of Sewn Evil Eye', 'reward_url' => 'http://eq2.ogaming.com/db/items/BagofSewnEvilEye.php'), 'SSY' => array ('quest_name' => 'Rescue of the Green Hoods', 'quest_url' => 'http://eq2.ogaming.com/db/quests/TheRescueoftheGreenHoods.php', 'req_level' => 32, 'req_starter' => FALSE, 'reward' => 'Short Sword of the Ykesha', 'reward_url' => 'http://eq2.ogaming.com/db/items/ShortSwordoftheYkesha.php'), 'SBD' => array ('quest_name' => 'The Reaching Blade of the Assassin', 'quest_url' => 'http://eq2.ogaming.com/db/quests/TheReachingBladeoftheAssassin.php', 'req_level' => 35, 'req_starter' => FALSE, 'reward' => 'Serrated Bone Dirk', 'reward_url' => 'http://eq2.ogaming.com/db/items/SerratedBoneDirk.php'), 'SoM' => array ('quest_name' => 'The Stein of Moggok: It Can Be Rebuilt', 'quest_url' => 'http://eq2.ogaming.com/db/quests/TheSteinofMoggokItCanBeRebuilt.php', 'req_level' => 35, 'req_starter' => FALSE, 'reward' => 'The Stein of Moggok', 'reward_url' => 'http://eq2.ogaming.com/db/items/SteinofMoggok.php'), 'CKT' => array ('quest_name' => 'The Lost Legend of Lavastorm', 'quest_url' => 'http://eq2.ogaming.com/db/quests/TheLostLegendofLavastorm.php', 'req_level' => 36, 'req_starter' => FALSE, 'reward' => 'Crown of King Tranix', 'reward_url' => 'http://eq2.ogaming.com/db/items/CrownofKingTranix.php'), 'HC' => array ('quest_name' => 'By Hook or By...', 'quest_url' => 'http://eq2.ogaming.com/db/quests/ByHookorBy....php', 'req_level' => 40, 'req_starter' => FALSE, 'reward' => 'Hierophant\'s Crook', 'reward_url' => 'http://eq2.ogaming.com/db/items/HeirophantsCrook.php'), 'FBSS' => array ('quest_name' => 'The Teaching of Yoru', 'quest_url' => 'http://eq2.ogaming.com/db/quests/TheTeachingsofYoru.php', 'req_level' => 40, 'req_starter' => FALSE, 'reward' => 'Flowing Black Silk Sash', 'reward_url' => 'http://eq2.ogaming.com/db/items/FlowingBlackSilkSash.php'), 'TME' => array ('quest_name' => 'An Eye for Power', 'quest_url' => 'http://eq2.ogaming.com/db/quests/AnEyeforPower.php', 'req_level' => 40, 'req_starter' => FALSE, 'reward' => 'Tobrin\'s Mystical Eyepatch', 'reward_url' => 'http://eq2.ogaming.com/db/items/TobrinsMysticalEyepatch.php'), 'BBC' => array ('quest_name' => 'The Bone Bladed Claymore', 'quest_url' => 'http://eq2.ogaming.com/db/quests/TheBoneBladedClaymore.php', 'req_level' => 40, 'req_starter' => FALSE, 'reward' => 'Bone Bladed Claymore', 'reward_url' => 'http://eq2.ogaming.com/db/items/BoneBladedClaymore.php'), 'GEB' => array ('quest_name' => 'Saving Soles', 'quest_url' => 'http://eq2.ogaming.com/db/quests/SavingSoles.php', 'req_level' => 40, 'req_starter' => FALSE, 'reward' => 'Golden Efreeti Boots', 'reward_url' => 'http://eq2.ogaming.com/db/items/GoldenEfreetiBoots.php'), 'SM' => array ('quest_name' => 'The Screaming Mace', 'quest_url' => 'http://eq2.ogaming.com/db/quests/TheScreamingMace.php', 'req_level' => 40, 'req_starter' => TRUE, 'reward' => 'Screaming Mace', 'reward_url' => 'http://eq2.ogaming.com/db/items/ScreamingMace.php'), 'SoR' => array ('quest_name' => 'An Ancient Desert Power', 'quest_url' => 'http://eq2.ogaming.com/db/quests/AnAncientDesertPower.php', 'req_level' => 50, 'req_starter' => TRUE, 'reward' => 'Scepter of Rahotep', 'reward_url' => 'http://eq2.ogaming.com/db/items/ScepterofRahotep.php'));
$alt_quests['TB'] = array ('reward_url' => 'http://eq2.ogaming.com/db/items/BagoftheTinkerers.php', 'quest_url' => 'http://eq2.ogaming.com/db/quests/TheWonderousInventionsofaCrazedGnome.php');
$alt_quests['BCG'] = array ('reward_url' => 'http://eq2.ogaming.com/db/items/BoneClaspedGirdle.php', 'quest_url' => 'http://eq2.ogaming.com/db/quests/DracoMortuusVosLiberatio.php');
$alt_quests['WS'] = array ('reward_url' => 'http://eq2.ogaming.com/db/items/TheWurmslayer.php', 'quest_url' => 'http://eq2.ogaming.com/db/quests/AThornofOld.php');

$quests = array ();
$steps = array ();
$step_id = 1;

$url = "edittoon.php.htm";
if ($raw_data = file_get_contents($url)) {
	$data = array ();
	$parsed_data = array ();

	preg_match_all('/<tr[^>]*>\s*(.*?)\s*<\/tr>/is', $raw_data, $data);

	$data[1] = preg_grep('/select/', $data[1]);

	$heri_id = 1;
	$step_id=338;
	// Now we got each quest
	foreach ($data[1] as $cell) {
		$quest = array ();

		preg_match('/<b>(.*?)<\/b>(.*?)<a href=\"(.*?)\" target(.*?)title=\"(.*?)\".*?alt(.*?)<b>(.*?)<\/b>/is', $cell, $temp);
		$quest['name'] = $temp[1];
		$quest['level'] = $temp[7];
		$quest['reward'] = $temp[5];
		$quest['quest_url'] = $temp[3];

		// Search alternate data
		foreach ($alt_quests as $name_short => $q) {
			if ($q['quest_url'] == $quest['quest_url']) {
				// echo $name_short, $q['reward_url'];
				$quest['name_short'] = $name_short;
				$quest['reward_url'] = $q['reward_url'];
			}
		}

		// echo "Quest ID".$heri_id." - ".$quest['name']." (".$quest['level'].")\n";
		// echo "Reward: ".$quest['reward']." URL: ".$quest['quest_url']."\n";

		preg_match_all('/<option[^>]*>(.*?)<\/option>/is', $cell, $temp_steps);
		foreach ($temp_steps[1] as $step) {
			if ($step) {
				$steps[$step_id] = array ('heri_id' => $heri_id, 'name' => $step);
				$step_id ++;
				// echo "    ".$step_id." ".$step."\n";
			}
		}
		$quests[$heri_id] = $quest;
		$heri_id ++;
	}

}

echo "
DROP TABLE IF EXISTS `#__guild_master_conf`;
DROP TABLE IF EXISTS `#__guild_master_heri_quests`;
DROP TABLE IF EXISTS `#__guild_master_heri_steps`;
DROP TABLE IF EXISTS `#__guild_master_toons`;
DROP TABLE IF EXISTS `#__guild_master_guild`;
CREATE TABLE `#__guild_master_toons` (
						`Name` VARCHAR( 255 ) NOT NULL ,
						`last_name` VARCHAR( 255 ),
						`Rank` VARCHAR(20) NOT NULL default 'Initiate',
						`Rank_Value` INT NOT NULL ,
						`Adv_Level` TINYINT NOT NULL ,
						`Art_Level` TINYINT NOT NULL ,
						`Adv_Class` ENUM( 'Assassin', 'Bard', 'Berserker', 'Brawler', 'Brigand', 'Bruiser', 'Cleric', 'Coercer', 'Conjuror', 'Crusader', 'Defiler', 'Dirge', 'Druid', 'Enchanter', 'Fighter', 'Fury', 'Guardian', 'Illusionist', 'Inquisitor', 'Mage', 'Monk', 'Mystic', 'Necromancer', 'Paladin', 'Predator', 'Priest', 'Ranger', 'Rogue', 'Scout', 'Shadow Knight', 'Shaman', 'Sorceror ', 'Summoner', 'Swashbuckler', 'Templar', 'Troubador ', 'Warden', 'Warlock ', 'Warrior', 'Wizard ' ) NOT NULL ,
						`Art_Class` ENUM( 'Alchemist', 'Armorer', 'Artisan', 'Carpenter', 'Craftsman', 'Jeweler', 'Outfitter', 'Provisioner', 'Sage', 'Scholar', 'Tailor', 'Weaponsmith', 'Woodworker' ) NOT NULL ,
						`Joined` DATETIME NOT NULL ,
						`Points` INT NOT NULL ,
						`Points_time` FLOAT, 
						`toon_id` INT NOT NULL ,
						`Quests` INT NOT NULL ,
						`KvD` FLOAT NOT NULL ,
						`lastonline` DATETIME,
						`highestmeleehit` INT,
						`highestmagichit` INT,
						`Last_Updated` TIMESTAMP ,
						PRIMARY KEY ( `toon_id` ));
CREATE TABLE `#__guild_master_conf` (
						`id` INT NOT NULL AUTO_INCREMENT,
						`guild_name` VARCHAR( 255 ) NOT NULL ,
						`guild_id` INT NOT NULL ,
						`guild_rank_1` VARCHAR( 255 ) ,
						`guild_rank_2` VARCHAR( 255 ) ,
						`guild_rank_3` VARCHAR( 255 ) ,
						`guild_rank_4` VARCHAR( 255 ) ,
						`guild_rank_5` VARCHAR( 255 ) ,
						`guild_rank_6` VARCHAR( 255 ) ,
						`guild_rank_7` VARCHAR( 255 ) ,
						`guild_rank_8` VARCHAR( 255 ) ,
						`show_updated` BOOL NOT NULL ,
						`guild_info` BOOL NOT NULL ,
						`popup` BOOL NOT NULL ,
						`roster_url` VARCHAR( 255 ),
						`roster_url_xml` VARCHAR( 255 ),
						`guild_url` VARCHAR( 255 ),
						`cache_time` INT NOT NULL ,
						PRIMARY KEY ( `id` ));		

CREATE TABLE `#__guild_master_guild` (
						`guild_id` INT NOT NULL ,
						`guild_name` VARCHAR( 255 ),
						`server_name` VARCHAR( 255 ),
						`server_id` INT,
						`created` DATETIME NOT NULL ,
						`created_rank` INT NOT NULL ,
						`members` INT NOT NULL ,
						`item_disc_world` INT NOT NULL ,
						`item_disc_server` INT NOT NULL ,
						`kvd` FLOAT NOT NULL ,
						`kvd_rank` INT NOT NULL ,
						`level` TINYINT NOT NULL ,
						`points` INT NOT NULL ,
						`most_disc_server` VARCHAR( 255 ),
						`most_disc_world` VARCHAR( 255 ),
						`most_killed_npcs` VARCHAR( 255 ),
						`best_kvd` VARCHAR( 255 ),
						`most_quests` VARCHAR( 255 ),
						`most_points` VARCHAR( 255 ),
						`last_lvlup` VARCHAR( 255 ),
						`last_die` VARCHAR( 255 ),
						`most_recent_item` VARCHAR( 255 ),
						`fighters` INT ,
						`priests` INT ,
						`mages` INT ,
						`scouts` INT ,
						`Last_Updated` TIMESTAMP ,
						PRIMARY KEY ( `guild_id` ));		

CREATE TABLE IF NOT EXISTS `#__guild_master_user` (
						`toon_id` INT NOT NULL,
						`user_id` INT NOT NULL,
						PRIMARY KEY ( `toon_id` ));		

CREATE TABLE `#__guild_master_heri_quests` (
						`heri_id` INT NOT NULL,
						`name_short` VARCHAR( 255 ) NOT NULL,
						`name` VARCHAR( 255 ),
						`url` VARCHAR( 255 ),
						`reward` VARCHAR( 255 ),
						`reward_url` VARCHAR( 255 ),
						`level` INT,
						`need_starter` BOOL,
						PRIMARY KEY ( `heri_id` ));		

CREATE TABLE `#__guild_master_heri_steps` (
						`step_id` INT NOT NULL,
						`heri_id` INT NOT NULL,
						`name` VARCHAR( 255 ),
						PRIMARY KEY ( `step_id` ));		
CREATE TABLE IF NOT EXISTS `#__guild_master_heri_map` (
						`step_id` INT NOT NULL,
						`toon_id` INT NOT NULL,
						PRIMARY KEY ( `step_id` , `toon_id` ));

INSERT INTO `#__guild_master_conf` (guild_name, guild_id, guild_rank_1, guild_rank_2, guild_rank_3, guild_rank_4, guild_rank_5, guild_rank_6, guild_rank_7, guild_rank_8, show_updated, popup, roster_url, roster_url_xml, guild_url, cache_time,guild_info) values ('Atrocitas', 1699210, 'Gruender', 'Botschafter', 'Sekraeter', 'Berater', 'Veteran', 'Mitglied', 'Anwaerter', 'Frischling', 1, 1, 'http://eq2players.station.sony.com/en/guild_roster.vm','http://eq2players.station.sony.com/en/guild_roster_xml.vm','http://eq2players.station.sony.com/en/guild.vm',86400,0);
\n";

// Insert quests
foreach ($quests as $heri_id => $q) {
	$vals = array ($heri_id, $q[name_short], $q[name], $q[quest_url], $q[reward], $q[reward_url], $q[level], $q[req_starter]);
	foreach ($vals as & $k) {
		if (is_null($k)) {
			$k = "";
		}
		$k = "'".addslashes($k)."'";
	}
	$values = implode(',', $vals);
	$sql = "INSERT INTO #__guild_master_heri_quests (heri_id,name_short,name,url,reward,reward_url,level,need_starter) VALUES (".$values.");";
	echo $sql."\n";
	// $database->setQuery($sql);
	// $database->query();
	// echo $database->stderr();
}

// Insert quest steps
foreach ($steps as $step_id => $step) {
	$steps[$step_id] = array ('heri_id' => $heri_id, 'name' => $step);

	$vals = array ($step_id, $step['heri_id'], $step['name']);
	foreach ($vals as & $k) {
		if (is_null($k)) {
			$k = "";
		}
		$k = "'".addslashes($k)."'";
	}
	$values = implode(',', $vals);
	$sql = "INSERT INTO #__guild_master_heri_steps (step_id,heri_id,name) VALUES (".$values.");";
	echo $sql."\n";
	// $database->setQuery($sql);
	// $database->query();
	// echo $database->stderr();
}
?>











