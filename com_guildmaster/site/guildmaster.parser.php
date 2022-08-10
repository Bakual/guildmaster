<?php
defined('_JEXEC') or die('Restricted access');

// file://c:\temp\guild_roster.xml
// file://c:\temp\guild_roster_new.xml
// file://c:\temp\guild_roster.html

require_once('guild.guildmaster.class.php');
require_once('toon.guildmaster.class.php');

// Function: update_all()
// Contacts SOE, parsed all available data and updates DB
function update_all(& $error, $config, $database, $force_update= null) {
	$guild= new GuildMasterGuild($database);
	$guild->load($config->guild_id);
	if (strtotime($guild->Last_Updated) > (time() - $config->cache_time) AND ($force_update == null) AND $guild->Last_Updated) {
		return;
	}

	$parsed_guild= parse_guild($error, $config);
	if (is_array($parsed_guild)) {
		$guild->bind($parsed_guild);
	}

	// First get all toons from the new XML feed,
	if ($config->roster_url_xml) {
		$parsed_roster= parse_roster2_xml($error, $config);
	}

	// secondly try to get the old XML data to extract quests completed and the last name
	if ($config->roster_url) {
		$parsed_roster_old= parse_roster_xml($error, $config);
	}

	if (is_array($parsed_roster)) {
		// save toons
		$lookup_rank= array ();
		for ($i= 1; $i < 9; $i++) {
			$lookup_rank[$config-> {
				'guild_rank_' . $i }
			]= $i;
		}

		$max_points= 0;
		$toons= $parsed_guild[toons];

		# Now do some calculations
		foreach ($parsed_roster as & $line) {
			$line[Rank_Value]= $lookup_rank[$line[Rank]];

			// Add values from guild roster to each toon from XML
			// foreach ($toons as $k => $v) { echo $k." - ".$v; }
			//			if ($toons[$line[Name]]) {
			//				$line[toon_id]= $toons[$line[Name]][toon_id];
			//				$line[Race]= $toons[$line[Name]][Race];
			//				$line[lastonline]= $toons[$line[Name]][lastonline];
			//			}

			// Now that we got the toon_id, add quests and lastname from old xml roster
			if ($parsed_roster_old[$line[toon_id]]) {
				$line[Quests]= $parsed_roster_old[$line[toon_id]][Quests];
				$line[Last_name]= $parsed_roster_old[$line[toon_id]][Last_name];
				$line[Points]= $parsed_roster_old[$line[toon_id]][Points];
			}

			// These comes up to Status point earned per day in the guild
			$time_alive= time() - strtotime($line[Joined]);
			if ($time_alive) {
				$line[Points_time]= ($line[Points] * 86400) / $time_alive;
			}

			// Get best guild contributor
			if ($line[Points] > $max_points) {
				$max_points= $line[Points];
				$guild->most_points= $line[Name];
			}
		}
	}

	// Store guild
	if (!$guild->store()) {
		$error[]= "Could not store guild information.";
	}

	// Store toons
	foreach ($parsed_roster as $tmp_toon) {
		$toon= new GuildMasterToon($database);

		// Check for player already exists in table
		$toon->bind($tmp_toon);
		if (!$toon->toon_id || !$toon->store()) {
			$error[]= "Could not store toon " . $toon->name . " (ID:" . $toon->toon_id . ")!";
		}
	}

	return;
}

// *************** XML PARSER ***************

// Roster Parser old
function parse_roster_xml(& $error, & $config) {
	// Fetch and parse the xml_roster, placing the result in $parsed_data_array

	$url= $config->roster_url;
	if (preg_match("/^http/", $url)) {
		$url .= "?guildId=" . $config->guild_id;
	}

	$parsed_data= array ();
	if ($raw_data= file_get_contents($url)) {
		// Create the parser.
		$doc= new DOMDocument();
		if (!$doc->loadXML($raw_data)) {
			$error[]= "Could not create XML parser. Check your PHP installation for XML support.";
			return;
		}

		$doc->preserveWhiteSpace= false;
		// echo $doc->saveXML();
		$xpath= new DOMXPath($doc);

		// $server = $xpath->query("/guild/server");

		$members= $xpath->query("/guild/roster/member");

		foreach ($members as $member) {
			$temp_toon= array ();
			foreach ($member->childNodes as $attribute) {
				$data= trim($attribute->nodeValue);
				if ($data) {
					// echo trim($attribute->nodeName) . "=" . $data . "<br/>";
					switch (trim($attribute->nodeName)) {
						case 'link' :
							$id= explode('=', $data);
							$temp_toon['toon_id']= intval($id[1]);
							break;
						case 'name' :
							$temp_toon['Name']= $data;
							break;
						case 'lastname' :
							$temp_toon['Last_name']= $data;
							break;
						case 'rank' :
							$temp_toon['Rank']= $data;
							break;
						case 'characterclass' :
							foreach ($attribute->childNodes as $class_detail) {
								switch (trim($class_detail->nodeName)) {
									case 'name' :
										$temp_toon['Adv_Class']= trim($class_detail->nodeValue);
										break;
									case 'level' :
										$temp_toon['Adv_Level']= trim($class_detail->nodeValue);
										break;
								}
							}
							break;
						case 'artisanclass' :
							foreach ($attribute->childNodes as $class_detail) {
								switch (trim($class_detail->nodeName)) {
									case 'name' :
										$temp_toon['Art_Class']= trim($class_detail->nodeValue);
										break;
									case 'level' :
										$temp_toon['Art_Level']= trim($class_detail->nodeValue);
										break;
								}
							}
							break;
						case 'joindate' :
							$temp_toon['Joined']= date('Y-m-d H:i:s', strtotime($data));
							break;
						case 'questscompleted' :
							$temp_toon['Quests']= preg_replace('/,/', '', $data);
							break;
						case 'killvsdeathratio' :
							$temp_toon['KvD']= $data;
							break;
						case 'guildstatus' :
							$temp_toon['Points']= preg_replace('/,/', '', $data);
							break;
						case 'lastonline' :
							$temp_toon['lastonline']= date('Y-m-d H:i:s', strtotime($data));
							break;
						case 'highestmeleehit' :
							$temp_toon['highestmeleehit']= $data;
							break;
						case 'highestmagichit' :
							$temp_toon['highestmagichit']= $data;
							break;
					}
				}
			}
			if ($temp_toon['toon_id']) {
				$parsed_data[$temp_toon['toon_id']]= $temp_toon;
			}
		}

		// Destory parser.
	} else { // Unable to read the URL as presented
		$error[]= "Unable to read XML data. Try refreshing this page or visiting directly.<br> <a href=\"$url\">$url</a>";
		return;
	}
	return $parsed_data;
}

// Roster Parser new
function parse_roster2_xml(& $error, & $config) {
	// Fetch and parse the xml_roster, placing the result in $parsed_data_array

	$url= $config->roster_url_xml;
	if (preg_match("/^http/", $url)) {
		$url .= "?guildId=" . $config->guild_id;
	}

	$parsed_data= array ();
	if ($raw_data= file_get_contents($url)) {
		// SOE outputs XML with HTML Encoding within a <pre> block, so we have to get rid of it and
		// transform the HTML encoded XML back to native XML before feeding the parser
		// $raw_data = preg_replace('/<\/?[code|pre][^>]*>/i', '', $raw_data);

		// requires PHP5
		$raw_data= trim(htmlspecialchars_decode($raw_data));

		// Create the parser.
		$doc= new DOMDocument();
		if (!$doc->loadXML($raw_data)) {
			$error[]= "Could not create XML parser. Check your PHP installation for XML support.";
			return;
		}

		$doc->preserveWhiteSpace= false;
		// echo $doc->saveXML();
		$xpath= new DOMXPath($doc);

		$members= $xpath->query("/guild/members/member");
		foreach ($members as $member) {
			$temp_toon= array ();
			foreach ($member->childNodes as $attribute) {
				$data= trim($attribute->nodeValue);
				if ($data) {
					// echo trim($attribute->nodeName) . "=" . $data . "<br/>";
					switch (trim($attribute->nodeName)) {
						case 'id' :
							$temp_toon['toon_id']= $data;
							break;
						case 'name' :
							$temp_toon['Name']= $data;
							break;
//						case 'prefixTitle' :
//							$temp_toon['PrefixTitle']= $data;
//							break;
						case 'guildRank' :
							$temp_toon['Rank']= $data;
							break;
						case 'class' :
							$temp_toon['Adv_Class']= trim(preg_replace('/\(.*\)/', '', $data));
							break;
						case 'level' :
							$temp_toon['Adv_Level']= $data;
							break;
						case 'artisanClass' :
							$temp_toon['Art_Class']= trim(preg_replace('/\(.*\)/', '', $data));
							break;
						case 'artisanLevel' :
							$temp_toon['Art_Level']= $data;
							break;
						case 'secondaryTradeskillClass' :
							if ($data == "none") {
								$data= "";
							}
							$temp_toon['Art2_Class']= $data;
							break;
						case 'secondaryTradeskillLevel' :
							if ($data == "N/A") {
								$data= null;
							}
							$temp_toon['Art2_Level']= $data;
							break;
//						case 'dateJoined' :
//							$temp_toon['Joined']= date('Y-m-d H:i:s', strtotime($data));
//							break;
//						case 'guildStatus' :
//							$temp_toon['Points']= preg_replace('/,/', '', $data);
//							break;
//						case 'lastonline' :
//							$temp_toon['lastonline']= date('Y-m-d H:i:s', strtotime($data));
//							break;
//						case 'memberNumber' :
//							$temp_toon['memberNumber']= $data;
//							break;
					}
				}
			}
			if ($temp_toon['toon_id']) {
				$parsed_data[$temp_toon['toon_id']]= $temp_toon;
			}
			elseif ($temp_toon['memberNumber']) {
				// $temp_toon['toon_id'] = $temp_toon['memberNumber'];
				$parsed_data[$temp_toon['memberNumber']]= $temp_toon;
			}
		}

		// Destory parser.
	} else { // Unable to read the URL as presented
		$error[]= "Unable to read XML data. Try refreshing this page or visiting directly.<br> <a href=\"$url\">$url</a>";
		return;
	}
	return $parsed_data;
}

// Guild Parser
function parse_guild(& $error, & $config) {
	// Fetch and parse the guild homepage, placing the result in $parsed_guild_array

	$url= $config->guild_url;
	if (preg_match("/^http/", $url)) {
		$url .= "?guildId=" . $config->guild_id;
	}

	if ($raw_data= file_get_contents($url)) {
		// Verify that the guild name is found on the webpage
		if (!($guild_name_loc= strpos($raw_data, $config->guild_name))) {
			$error[]= "Unable to find guild name " . $config->guild_name . " on the Sony website.<br> Please check <a href=\"$url\">$url</a>";
			return;
		}
		// Collect all table rows containing guild information
		$data= array ();
		$parsed_data= array ();

		$parsed_data['guild_id']= $config->guild_id;

		$matches= array ();
		$toons= array ();

		// Server_id not any more :(
		/*
		if (preg_match('/<span(?:(?:\s+[^>]*)*)>Server:<\/span>\s*<a\s+.*?serverId=(\d+)[^>]*>(.*?)<\/a>/', $raw_data, $matches)) {
			$parsed_data['server_id'] = $matches[1];
			echo $matches[1];
		}
		*/

		// First get toon names, toon_id and last_played
		// preg_match_all('/characterId=(\d+)[^>]*>(.*?)<\/a>.*?<img alt="(.*?)"[^>]*race_icons[^>]*>.*?<nobr>(\w+ \d{1,2}, \d{4})<\/nobr>/s', $raw_data, $matches, PREG_SET_ORDER);
		//		foreach ($matches as $match) {
		//			// echo "Toon ID:" . $match[1] . " - Name: " . $match[2] . " - Race: ".$match[3]." - Last played: " . $match[4] . "\n";
		//			$toons[$match[2]]= array (
		//				"toon_id" => $match[1],
		//				"Race" => $match[3],
		//				"lastonline" => date('Y-m-d H:i:s', strtotime($match[4]))
		//			);
		//		}

		// Get the rest

		// Leaderboard
		// Strip HTML out of the returned string.
		$raw_data= strip_tags($raw_data);
		$raw_data= preg_replace('/&nbsp;/', ' ', $raw_data);
		$raw_data= preg_replace('/\s+/', ' ', $raw_data);

		$cols= array (
			'Unique Members' => 'unique_members',
			'Average Member Level' => 'avg_level',
			'Guild Summary' => 'guild_name',
			'Server' => 'server_name',
			'Date Formed' => 'created',
			'Members' => 'members',
			'Guild Level' => 'level',
			'Guild Status' => 'points',
			'Items Discovered - Global' => 'item_disc_world',
			'Items Discovered - Server' => 'item_disc_server',
			'Average Quests Completed' => 'avg_quests',
			'Total Rares Harvested' => 'rares',
			'Total PvP Kills' => 'pvp_kills',
			'Total NPC Kills' => 'npc_kills',
			'Total Arena Kills' => 'arena_kills',
			'Average PvP Kills' => 'avg_pvp_kills',
			'Average NPC Kills' => 'avg_npc_kills',
			'Average Arena Kills' => 'avg_arena_kills',
			'Total Items Crafted' => 'items_crafted',
			'Total Deaths' => 'deaths',
			'Deaths Per Member' => 'deaths_per_member',
			'Kills vs. Deaths Ratio' => 'kvd',

	//				'Latest Item Discovered' => 'most_recent_item',
	//				'Kills vs Deaths Ratio Rank' => 'kvd_rank',
	//				'Most Item Discoveries' => 'most_disc_server',
	//				'Most Item Discoveries (Game-Wide)' => 'most_disc_world',
	//				'Most NPC Kills' => 'most_killed_npcs',
	//				'Best Kills vs Deaths Ratio' => 'best_kvd',
	//				'Most Quests Completed' => 'most_quests',
	//				'Highest Guild Status Contributor' => 'most_points',
	//				'Most Recent Member to Level' => 'last_lvlup',
	//				'Most Recent Member to Die' => 'last_die',
	//				'Fighters' => 'fighters',
	//				'Priests' => 'priests',
	//				'Mages' => 'mages',
	//				'Scouts' => 'scouts',
		);

		// echo $raw_data . "\n\n\n";

		foreach ($cols as $k => $v) {
			switch ($v) {
				case "most_recent_item" :
					$expr= '/' . preg_quote($k) . '\s+(.*?)\sAverage\sQuests/';
					break;
				case "created" :
					$expr= '/' . preg_quote($k) . '\s+(\w+ \d{1,2}, \d{4})/';
					break;
				case "points" :
				case "deaths" :
				case "npc_kills" :
				case "avg_npc_kills" :
				case "pvp_kills" :
				case "avg_pvp_kills" :
				case "items_crafted" :
				case "rares" :
					$expr= '/' . preg_quote($k) . '\s+([\d,]+)/';
					break;
				case "deaths_per_member" :
				case "kvd" :
					$expr= '/' . preg_quote($k) . '\s+([\d\.]+)/';
					break;
				default :
					$expr= '/' . preg_quote($k) . '\s+([\w\/]+)/';
					break;
			}

			if (preg_match($expr, $raw_data, $matches)) {
				if ($matches[1] == "N/A") {
					$matches[1]= null;
				}
				$parsed_data[$v]= $matches[1];
				// echo $v . " = " . $matches[1] . "\n";
			}
		}
		$parsed_data['created']= date('Y-m-d H:i:s', strtotime($parsed_data['created']));

		foreach ($parsed_data as $k => $v) {
			$parsed_data[$k]= preg_replace('/,/', '', $v);
			// echo "\n" . $k . " = " . $parsed_data[$k];
		}

		// $parsed_data[toons]= $toons;
	} else { // Unable to read the URL as presented
		$error[]= "Unable to contact the guild page. Try Refreshing this page or visiting directly.<br><a href=\"$url\">$url</a>";
		return;
	}

	return $parsed_data;
}
?>