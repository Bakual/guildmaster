<?php
	$url = "c:/temp/guild_roster.html";
    $config->guild_name="Atrocitas";
    $config->guild_id=1699210;

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
		preg_match_all('/characterId=(\d+)[^>]*>(.*?)<\/a>.*?<img alt="(.*?)"[^>]*race_icons[^>]*>.*?<nobr>(\w+ \d{1,2}, \d{4})<\/nobr>/s', $raw_data, $matches, PREG_SET_ORDER);
		foreach ($matches as $match) {
			echo "Toon ID:" . $match[1] . " - Name: " . $match[2] . " - Race: ".$match[3]." - Last played: " . $match[4] . "\n";
			$toons[$match[2]]= array (
				"toon_id" => $match[1],
				"Race" => $match[3],
				"lastonline" => date('Y-m-d H:i:s', strtotime($match[4]))
			);
		}

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
			echo "\n" . $k . " = " . $parsed_data[$k];
		}

		$parsed_data[toons]= $toons;
	} else { // Unable to read the URL as presented
		$error[]= "Unable to contact the guild page. Try Refreshing this page or visiting directly.<br><a href=\"$url\">$url</a>";
		return;
	}
?>