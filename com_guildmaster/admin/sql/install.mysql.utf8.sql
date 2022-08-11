DROP TABLE IF EXISTS `#__guildmaster_heri_quests`;
DROP TABLE IF EXISTS `#__guildmaster_heri_steps`;
DROP TABLE IF EXISTS `#__guildmaster_heri_map`;
DROP TABLE IF EXISTS `#__guildmaster_toons`;
DROP TABLE IF EXISTS `#__guildmaster_guild`;
DROP TABLE IF EXISTS `#__guildmaster_user`;

CREATE TABLE `#__guildmaster_toons`
(
	`id`              INT(10) NOT NULL AUTO_INCREMENT,
	`Name`            VARCHAR(255),
	`Last_name`       VARCHAR(255),
	`PrefixTitle`     VARCHAR(255),
	`Rank`            VARCHAR(20) default 'Initiate',
	`Race`            VARCHAR(255),
	`Rank_Value`      INT,
	`Adv_Level`       INT,
	`Art_Level`       INT,
	`Art2_Level`      INT,
	`Adv_Class`       ENUM ( 'Assassin', 'Bard', 'Berserker', 'Brawler', 'Brigand', 'Bruiser', 'Cleric', 'Coercer', 'Conjuror', 'Crusader', 'Defiler', 'Dirge', 'Druid', 'Enchanter', 'Fighter', 'Fury', 'Guardian', 'Illusionist', 'Inquisitor', 'Mage', 'Monk', 'Mystic', 'Necromancer', 'Paladin', 'Predator', 'Priest', 'Ranger', 'Rogue', 'Scout', 'Shadow Knight', 'Shaman', 'Sorceror ', 'Summoner', 'Swashbuckler', 'Templar', 'Troubador ', 'Warden', 'Warlock ', 'Warrior', 'Wizard ' ),
	`Art_Class`       ENUM ( 'Alchemist', 'Armorer', 'Artisan', 'Carpenter', 'Craftsman', 'Jeweler', 'Outfitter', 'Provisioner', 'Sage', 'Scholar', 'Tailor', 'Weaponsmith', 'Woodworker' ),
	`Art2_Class`      ENUM ( 'Transmuter', 'Tinkerer' ),
	`Joined`          DATETIME,
	`Points`          INT,
	`Points_time`     FLOAT,
	`toon_id`         INT,
	`Quests`          INT,
	`KvD`             FLOAT,
	`lastonline`      DATETIME,
	`highestmeleehit` INT,
	`highestmagichit` INT,
	`memberNumber`    INT,
	`Last_Updated`    TIMESTAMP,
	PRIMARY KEY (`id`)
);

CREATE TABLE `#__guildmaster_guild`
(
	`id`                INT(10) NOT NULL AUTO_INCREMENT,
	`guild_id`          INT,
	`guild_name`        VARCHAR(255),
	`server_name`       VARCHAR(255),
	`server_id`         INT,
	`created`           DATETIME,
	`avg_level`         INT,
	`avg_quests`        INT,
	`members`           INT,
	`unique_members`    INT,
	`most_recent_item`  VARCHAR(255),
	`level`             TINYINT,
	`points`            INT,
	`item_disc_world`   INT,
	`item_disc_server`  INT,
	`rares`             INT,
	`pvp_kills`         INT,
	`npc_kills`         INT,
	`arena_kills`       INT,
	`avg_pvp_kills`     INT,
	`avg_npc_kills`     INT,
	`avg_arena_kills`   INT,
	`items_crafted`     INT,
	`deaths`            INT,
	`deaths_per_member` FLOAT,
	`kvd`               FLOAT,

	`kvd_rank`          INT,
	`most_disc_server`  VARCHAR(255),
	`most_disc_world`   VARCHAR(255),
	`most_killed_npcs`  VARCHAR(255),
	`best_kvd`          VARCHAR(255),
	`most_quests`       VARCHAR(255),
	`most_points`       VARCHAR(255),
	`last_lvlup`        VARCHAR(255),
	`last_die`          VARCHAR(255),
	`fighters`          INT,
	`priests`           INT,
	`mages`             INT,
	`scouts`            INT,
	`Last_Updated`      TIMESTAMP,
	PRIMARY KEY (`id`)
);

CREATE TABLE `#__guildmaster_user`
(
	`toon_id` INT NOT NULL,
	`user_id` INT NOT NULL,
	PRIMARY KEY (`toon_id`)
);

CREATE TABLE `#__guildmaster_heri_quests`
(
	`heri_id`      INT NOT NULL,
	`name_short`   VARCHAR(255),
	`name`         VARCHAR(255),
	`url`          VARCHAR(255),
	`reward`       VARCHAR(255),
	`reward_url`   VARCHAR(255),
	`level`        INT,
	`need_starter` BOOL,
	PRIMARY KEY (`heri_id`)
);

CREATE TABLE `#__guildmaster_heri_steps`
(
	`step_id` INT NOT NULL,
	`heri_id` INT NOT NULL,
	`name`    VARCHAR(255),
	PRIMARY KEY (`step_id`)
);

CREATE TABLE `#__guildmaster_heri_map`
(
	`step_id` INT NOT NULL,
	`toon_id` INT NOT NULL,
	PRIMARY KEY (`step_id`, `toon_id`)
);

INSERT INTO #__guildmaster_heri_quests (`heri_id`, `name_short`, `name`, `url`, `reward`, `reward_url`, `level`,
	`need_starter`)
VALUES (1, 'GLS', 'The Return of the Light', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=433',
	'Greater Lightstone', 'http://eq2.allakhazam.com/db/item.html?eq2item=2672', 20, 0),
	(2, 'LJB', 'The Journey is Half the Fun', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=480',
	'Legendary Journeyman''s Boots', 'http://eq2.allakhazam.com/db/item.html?eq2item=2977', 50, 0),
	(3, 'DWB', 'These Boots Were Made for Walking', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=696',
	'Dwarven Work Boots', 'http://eq2.allakhazam.com/db/item.html?eq2item=2730', 25, 0),
	(4, 'SBH', 'Dragoon K''Naae of the Thexians', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=799',
	'Shiny Brass Halberd', 'http://eq2.allakhazam.com/db/item.html?eq2item=3013', 24, 0),
	(5, 'PGT', 'An Axe from the Past', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=884',
	'Polished Granite Tomhawk', 'http://eq2.allakhazam.com/db/item.html?eq2item=3425', 30, 0),
	(6, 'FBE', 'Hadden''s Earring', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=689', 'Fishbone Earring',
	'http://eq2.allakhazam.com/db/item.html?eq2item=3141', 25, 0),
	(7, 'GBS', 'A Strange Black Rock', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=872', 'Glowing Black Stone',
	'http://eq2.allakhazam.com/db/item.html?eq2item=3468', 25, 0),
	(8, 'MS', 'Stilletto''s Orders Intercepted', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=957', 'Manastone',
	'http://eq2.allakhazam.com/db/item.html?eq2item=3473', 28, 0),
	(9, 'GB', 'Restoring Ghoulbane', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=1046', 'Ghoulbane',
	'http://eq2.allakhazam.com/db/item.html?eq2item=3010', 30, 0),
	(10, 'SBS', 'Training is a Shield', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=705', 'Shiny Brass Shield',
	'http://eq2.allakhazam.com/db/item.html?eq2item=8567', 40, 0),
	(11, 'GoTD', 'A Missing Mask', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=1042', 'Guise of the Deceiver',
	'http://eq2.allakhazam.com/db/item.html?eq2item=8536', 35, 0),
	(12, 'EEB', 'Foomby''s Stolen Goods', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=870',
	'Bag of Sewn Evil Eye', 'http://eq2.allakhazam.com/db/item.html?eq2item=3404', 32, 0),
	(13, 'SSY', 'Rescue of the Greenhoods', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=953',
	'Short Sword of the Ykesha', 'http://eq2.allakhazam.com/db/item.html?eq2item=3472', 32, 0),
	(14, 'SoM', 'The Stein of Moggok - It Can Be Rebuilt', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=858',
	'Stein of Moggok', 'http://eq2.allakhazam.com/db/item.html?eq2item=3458', 35, 0),
	(15, 'SBD', 'The Reaching Blade of the Assassin', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=767',
	'Serrated Bone Dirk', 'http://eq2.allakhazam.com/db/item.html?eq2item=3106', 35, 0),
	(16, 'CKT', 'The Lost Legend of Lavastorm', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=1124',
	'Crown of King Tranix', 'http://eq2.allakhazam.com/db/item.html?eq2item=9121', 45, 0),
	(17, 'SM', 'Screaming Mace', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=1268', 'Screaming Mace',
	'http://eq2.allakhazam.com/db/item.html?eq2item=8884', 50, 0),
	(18, 'GEB', 'Saving Soles', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=1129', 'Golden Efreeti Boots',
	'http://eq2.allakhazam.com/db/item.html?eq2item=8963', 40, 0),
	(19, 'BBC', 'The Bone Bladed Claymore', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=1107',
	'Bone Bladed Claymore', 'http://eq2.allakhazam.com/db/item.html?eq2item=10345', 40, 0),
	(20, 'TME', 'An Eye for Power', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=890',
	'Tobrin''s Mystical Eyepatch', 'http://eq2.allakhazam.com/db/item.html?eq2item=3519', 45, 0),
	(21, 'FBSS', 'The Teachings of Yoru', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=864',
	'Flowing Black Silk Sash', 'http://eq2.allakhazam.com/db/item.html?eq2item=3206', 45, 0),
	(22, 'HC', 'By Hook of By...', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=834', 'Heirophant''s Crook',
	'http://eq2.allakhazam.com/db/item.html?eq2item=3140', 40, 0),
	(23, 'SoR', 'An Ancient Desert Power', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=2301',
	'Scepter of Rahotep', 'http://eq2.allakhazam.com/db/item.html?eq2item=13165', 50, 0),
	(24, 'BCG', 'Draco Mortuus Vos Liberatio', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=2747',
	'Bone-Clasped Girdle', 'http://eq2.allakhazam.com/db/item.html?eq2item=18846', 60, 0),
	(25, 'TB', 'The Wonderous Inventions Crazed Gnome', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=2729',
	'Bag of the Tinkerers', 'http://eq2.allakhazam.com/db/item.html?eq2item=18488', 65, 0),
	(26, 'WS', 'A Thorn of Old', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=2731', 'WurmSlayer',
	'http://eq2.allakhazam.com/db/item.html?eq2item=19048', 60, 0),
	(27, 'DRT', 'In Honor and Service', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=3142',
	'Dwarven Ringmail Tunic', 'http://eq2.allakhazam.com/db/item.html?eq2item=22882', 15, 0),
	(28, 'RotO', 'War and Wardrobe', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=3129', 'Robe of the Oracle',
	'http://eq2.allakhazam.com/db/item.html?eq2item=22867', 35, 0),
	(29, 'SotO', 'The Staff of the Observers', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=3121',
	'Staff of the Observers', 'http://eq2.allakhazam.com/db/item.html?eq2item=22883', 50, 0),
	(30, 'RC', 'Casualties of the War of the Fay', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=3118',
	'Rain Caller', 'http://eq2.allakhazam.com/db/item.html?eq2item=22896', 60, 0),
	(31, 'CMS', 'The Symbol in the Flesh', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=3458',
	'Crested Mistmoore Shield', 'http://eq2.allakhazam.com/db/item.html?eq2item=27028', 70, 0),
	(32, 'CoF', 'Cloak of Flames (Series)', 'http://eq2.allakhazam.com/db/quest.html?eq2quest=3352',
	'Cloak of Flames', 'http://eq2.allakhazam.com/db/item.html?eq2item=27014', 65, 0);

INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('1', '1', 'Talk to Cannix');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('2', '1', 'Touch Forgotten');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('3', '1', 'Touch Mourned');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('4', '1', 'Kill Rama\'nai');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('5','1','Kill Gaer');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('6','1','Kill Ogof');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('7','1','Ogof/Gaer');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('8','1','High Priest');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('9','1','BSV-General Drull');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('10','1','BSV SubQuest');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('11','1','Kill Cannix');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('12','1','Quest Turn-In');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('13','1','COMPLETED!');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('14','2','Antonica');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('15','2','Commonlands');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('16','2','Thundering Steppes');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('17','2','Nek Forest');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('18','2','Zek');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('19','2','Enchanted Lands');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('20','2','Feerrott');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('21','2','Quest Turn-In');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('22','2','COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('23','3','100 Wood/100 Ore');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('24','3','Miners/Excavaters');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('25','3','Caveroot');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('26','3','Bloodtalon');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('27','3','Caveroot/Bloodtalon');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('28','3','Caveroot/Miners');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('29','3','Bloodtalon/Miners');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('30','3','BB Beer Run');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('31','3','Kill Grandfather');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('32','3','Antelope/Firerock Giant');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('33','3','Antelop');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('34','3','Firerock Giant');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('35','3','Minty Turn-in');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('36','3','Waiting on Minty');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('37','3','Quest Turn-In');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('38','3','COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('39','4','60 Owlbear Meats');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('40','4','60 Undead Skin');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('41','4','Pond Run');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('42','4','Captain T\'Sanne');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('43', '4', 'Kill Assassins');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('44', '4', 'Quest Turn-In');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('45', '4', 'COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('46', '5', 'Lost Tarby');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('47', '5', 'Mining Granite');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('48', '5', 'Forge Axe');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('49', '5', '100 Skellies');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('50', '5', 'Skindancers');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('51', '5', 'Octogorgon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('52', '5', 'CoD Access');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('53', '5', 'Quest Turn-In');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('54', '5', 'COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('55', '6', 'Get Journal');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('56', '6', 'Nek Power Source');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('57', '6', 'CL Power Source');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('58', '6', 'NEK/CL Power Source');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('59', '6', 'TS Power Source');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('60', '6', 'TS/NEK Power Source');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('61', '6', 'TS/CL Power Source');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('62', '6', 'Kill Everling');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('63', '6', 'Castle Subquest');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('64', '6', 'Hrath V\'Tol');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('65','6','Captain Krieger');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('66','6','Quest Turn-In');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('67','6','COMPLETED!');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('68','7','TS Power Source');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('69','7','NEK Power Source');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('70','7','Both Power Sources');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('71','7','Brown Research Tome');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('72','7','Black Research Tome');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('73','7','Black/Brown Tomes');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('74','7','Need Palladium Torque');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('75','7','Tome of Life');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('76','7','Tome of Death');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('77','7','Tome of Life/Death');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('78','7','Kill Varsoon');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('79','7','CoI Access Quest');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('80','7','Kill Al\'Quylar');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('81', '7', 'Quest Turn-In');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('82', '7', 'COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('83', '8', 'Examine Orders');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('84', '8', 'CoD Access Quest');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('85', '8', 'Octogorgon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('86', '8', 'Examine Hand');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('87', '8', 'Captain Ulssissaris');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('88', '8', 'Examine RoV Book');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('89', '8', 'Weavemaster Esh\'Rax');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('90','8','Create Shroud of Manastone');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('91','8','CoI Access Quest');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('92','8','Kill Varsoon');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('93','8','COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('94','9','Dusty Blue Stone Quest');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('95','9','ToV Access');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('96','9','Retrieve Weakened');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('97','9','Torig');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('98','9','Spectre of Ire');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('99','9','The Creator');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('100','9','Torig/Ire');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('101','9','Torig/Creator');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('102','9','Torig/Creator/Ire');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('103','9','Creator/Ire');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('104','9','Cauldron Access Quest');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('105','9','Kill Everling');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('106','9','Castle Access Quest');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('107','9','COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('108','10','Trial 1');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('109','10','Trial 2');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('110','10','Trial 3');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('111','10','Trial 4');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('112','10','Trial 5');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('113','10','Trial 6');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('114','10','Turn-in Grozmag');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('115','10','Kill Fyst');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('116','10','COMPLETED!');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('117','11','Basement Billy');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('118','11','Gameroom Billy');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('119','11','Chapel Billy');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('120','11','Gameroom/Chapel Billy');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('121','11','Library Book');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('122','11','Courtyard Billy');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('123','11','Froglok Assassin');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('124','11','Library Scroll');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('125','11','Nyth Dolls');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('126','11','Fiendish Blood');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('127','11','Swine Lord');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('128','11','Nyth/Fiendish/Swine');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('129','11','Nyth/Fiendish');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('130','11','Nyth/Swine');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('131','11','Fiendish/Swine');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('132','11','Kill Everling');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('133','11','COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('134','12','Darkflight Faeries');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('135','12','Foomby Turn-in');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('136','12','Chomper');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('137','12','Bellendis Tempestcall');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('138','12','Lamias');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('139','12','Baz\'Tarog');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('140', '12', 'COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('141', '13', 'Operation Greenhood Quest');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('142', '13', 'Inspect Mine');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('143', '13', 'Sullon Centurians');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('144', '13', 'Tallon Raiders');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('145', '13', 'Vallon Grunts');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('146', '13', 'Sullon/Tallon/Vallon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('147', '13', 'Sullon/Tallon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('148', '13', 'Sullon/Vallon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('149', '13', 'Tallon/Vallon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('150', '13', 'Sentry Goorlux');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('151', '13', 'Infiltrator Stryjin');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('152', '13', 'Rescue Green Hood Women');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('153', '13', 'Kill Fyst');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('154', '13', 'COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('155', '14', 'Flerb');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('156', '14', 'Fug');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('157', '14', 'Hurd');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('158', '14', 'Prud');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('159', '14', 'Flerb/Fug/Hurd/Prud');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('160', '14', 'Flerb/Fug/Hurd');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('161', '14', 'Flerb/fug');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('162', '14', 'Fug/Hurd/Prud');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('163', '14', 'Fug/Hurd');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('164', '14', 'Hurd/Prud');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('165', '14', 'Fug/Prud');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('166', '14', 'Fug/Hurd/Prud');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('167', '14', 'Fug/Hurd');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('168', '14', 'Bartender Clurg');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('169', '14', 'RumDum Turn-In');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('170', '14', 'Craft the Stein');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('171', '14', 'COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('172', '15', 'Leelav Yekl Turn-In');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('173', '15', 'Kreglebop Yekl');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('174', '15', 'Lodo Bightn');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('175', '15', 'COB Assassins');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('176', '15', 'Windstalker Village Note');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('177', '15', 'TS Verishu');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('178', '15', 'Ethruia Aidora');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('179', '15', 'Logo Bigthn');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('180', '15', 'COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('181', '16', 'Tablet Shards');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('182', '16', 'Banners');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('183', '16', 'Words of Pure Magic Subquest');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('184', '16', 'Examine Banners');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('185', '16', 'Poem Pieces/Stanzas');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('186', '16', 'Bunglegreeder');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('187', '16', 'Rare Rocks');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('188', '16', 'Tomekeeper Sunto');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('189', '16', 'Dead Knight Bones');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('190', '16', 'Censor of Souls');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('191', '16', 'Speaker');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('192', '16', 'The Castigator');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('193', '16', 'Lord Crana');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('194', '16', 'Onyxlam');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('195', '16', 'Speaker/Castigator/Crana/Onyxlam');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('196', '16', 'Speaker/Castigator/Crana');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('197', '16', 'Speaker/Castigator');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('198', '16', 'Castigator/Crana/Onyxlam');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('199', '16', 'Castigator/Crana');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('200', '16', 'Crana/Onyxlam');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('201', '16', 'Castigator/Onyxlam');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('202', '16', 'Turn-In');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('203', '16', 'COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('204', '17', 'Lizardmen');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('205', '17', 'Kaxor/Hukulan/Tzugaax/Xilarga');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('206', '17', 'Kaxor/Hukulan/Tzugaax');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('207', '17', 'Kaxor/Hukulan');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('208', '17', 'Kaxor');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('209', '17', 'Hukulan/Tzugaax/Xilarga');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('210', '17', 'Hukulan/Tzugaax');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('211', '17', 'Hukulan');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('212', '17', 'Tzugaax/Xilarga');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('213', '17', 'Tzugaax');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('214', '17', 'Tzugaax/Kaxor');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('215', '17', 'Basin of Ba\'Kur');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('216','17','Thulian Terrorfiends');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('217','17','Keeper');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('218','17','COMPLETED!');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('219','18','Crawlers/Drakes');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('220','18','Crawlers');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('221','18','Drakes');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('222','18','Find smelly bait');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('223','18','The Big Squiggly');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('224','18','Tazgar the Efreeti');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('225','18','Fire Giants');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('226','18','Disable the Spires');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('227','18','The Magolemus');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('228','18','Reactivate Spires');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('229','18','Efreeti Lord Djarn');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('230','18','Tazgar Turn-In');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('231','18','COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('232','19','Opalla');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('233','19','Redak');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('234','19','Re-forge Hilt');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('235','19','Slay 1000 Beings');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('236','19','Gynok Moltar');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('237','19','Berik\'s Revenge Subquest');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('238', '19', 'COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('239', '20', 'Acquire Shards');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('240', '20', 'Bloodrage/Webclaw/Iceburn');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('241', '20', 'Bloodrage/Webclaw');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('242', '20', 'Bloodrage');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('243', '20', 'Webclaw/Iceburn');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('244', '20', 'Bloodrage/Iceburn');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('245', '20', 'Miragul\'s Meagerie');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('246','20','Shade of Tobrin');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('247','20','Examine Chest');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('248','20','Webclaw');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('249','20','Iceburn');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('250','20','COMPLETED!');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('251','21','Harvest Wood');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('252','21','Basil Grilled Deer');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('253','21','Beer Run');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('254','21','Highwaymen');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('255','21','Cythan');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('256','21','Cythan Ring Event');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('257','21','Sartar/Oodan/Borbin/Raster');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('258','21','Sartar/Oodan/Borbin');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('259','21','Sartar/Oodan');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('260','21','Sartar the Unrivaled');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('261','21','Oodan/Borbin/Raster');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('262','21','Oodan/Borbin');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('263','21','Oodan/Raster');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('264','21','Oodan the Tranquil');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('265','21','Borbin/Raster');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('266','21','Sartar/Borbin');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('267','21','Borbin the Prevailer');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('268','21','Brother Raster');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('269','21','Rastar/Sartar');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('270','21','Kill Cythan');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('271','21','Sartar/Borbin/Rastar');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('272','21','COMPLETED!');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('273','22','100 Nightbloods');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('274','22','Mysterious Drafling Subquest');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('275','22','JumJum Juice');
INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('276','22','Queens Chamber');
	INSERT INTO #__guildmaster_heri_steps (step_id,heri_id,name) VALUES ('277','22','Asajj An\'Duuth');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('278', '22', 'Deliver Vegetables');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('279', '22', 'Kill Rukir');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('280', '22', 'COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('281', '23', 'Desert Expert');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('282', '23', 'Harshaa');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('283', '23', 'Prophet of the Desert');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('284', '23', 'Planetologist');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('285', '23', 'Dry Wind Island Pirates');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('286', '23', 'Home City Library Run');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('287', '23', 'Rahotep Raid');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('288', '23', 'COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('289', '24', 'Speak to Sinephobis');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('290', '24', 'Learn Thulian');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('291', '24', 'Strengthened/draconic/bones');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('292', '24', 'Sheet/Lumber/Geode/Leather');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('293', '24', 'Sheet/Lumber/Geode');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('294', '24', 'Sheet/Lumber');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('295', '24', 'Sheet/Geode');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('296', '24', 'Sheet/Leather');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('297', '24', 'Geode/Lumber');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('298', '24', 'Geode/Lumber/Leather');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('299', '24', 'Geode/Leather');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('300', '24', 'Lumber/Leather');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('301', '24', 'Blue-Silver/Sheet');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('302', '24', 'Perfect/Osseus/Lumber');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('303', '24', 'Perfectly Cut/Purple Geode');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('304', '24', 'Strip of/Supple/Leather');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('305', '24', 'Forge Combine');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('306', '24', 'DoEllin');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('307', '24', 'Sinephobis Turn-In');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('308', '24', 'Spirit of DoEllin');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('309', '24', 'COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('310', '25', 'Rescue Gnome');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('311', '25', 'Learn Gnomish');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('312', '25', 'Piles of Goo');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('313', '25', 'Gimdimble Fizzwoddle Turn-In');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('314', '25', 'Core ground samples');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('315', '25', 'Soil Samples');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('316', '25', 'Dizzwangle');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('317', '25', 'Carapaces/Padding');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('318', '25', 'Vornerus drone');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('319', '25', 'Fetidthorn briar');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('320', '25', 'Retrieve/gnomes/tools');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('321', '25', 'Young dragon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('322', '25', 'COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('323', '26', 'Kill Azdalin');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('324', '26', 'Kill Glyton');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('325', '26', 'Kill Lord Xyfl');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('326', '26', 'Fuzzmin Turn-In');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('327', '26', 'Old Weaponsmith');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('328', '26', 'Rare oak-shaft');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('329', '26', 'Metal bar');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('330', '26', 'Harla Dar');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('331', '26', 'Lord Vyemm');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('332', '26', 'Sothis');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('333', '26', 'Harla/Vyemm/Sothis');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('334', '26', 'Harla/Vyemm');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('335', '26', 'Harla/Sothis');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('336', '26', 'Vyemm/Sothis');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('337', '26', 'COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('338', '27', 'War Memorial');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('339', '27', 'Dwarven/War/Artifacts');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('340', '27', 'Captain Irontoe');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('341', '27', 'Echo Echo Canyon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('342', '27', 'Orc Hill');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('343', '27', 'Three Crushbone/Orc Spies');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('344', '27', 'Tuning Discs');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('345', '27', 'Gong');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('346', '27', '3 Spys');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('347', '27', 'Shrool Dust');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('348', '27', '20 Fayflies');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('349', '27', 'Brook Patch/Toadstools');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('350', '27', 'Mushroom King');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('351', '27', 'Sprinkle Dust');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('352', '27', 'Kill WarSmiths');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('353', '27', 'sullon/vallon/derris/tallon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('354', '27', 'sullon/vallon/derris');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('355', '27', 'sullon/vallon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('356', '27', 'sullon/derris');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('357', '27', 'sullon/gullon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('358', '27', 'sullon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('359', '27', 'vallon/derris/tallon/gullon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('360', '27', 'vallon/derris/tallon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('361', '27', 'vallon/derris');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('362', '27', 'vallon/tallon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('363', '27', 'vallon/gullon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('364', '27', 'vallon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('365', '27', 'derris/tallon/gullon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('366', '27', 'derris/tallon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('367', '27', 'derris/gullon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('368', '27', 'derris');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('369', '27', 'tallon/gullon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('370', '27', 'gullon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('371', '27', 'Kill Expedition Leaders');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('372', '27', 'Expedition Leader');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('373', '27', 'Expedition Chef');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('374', '27', 'Expedition Weaponsmith');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('375', '27', 'Expedition Planner');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('376', '27', 'Leader/Chef/Weaponsmith');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('377', '27', 'Leader/Weaponsmith');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('378', '27', 'Leader/Planner');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('379', '27', 'Leader/weaponsmith/Planner');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('380', '27', 'Chef/Weaponsmith/Planner');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('381', '27', 'Chef/Planner');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('382', '27', 'Chef/Weaponsmith');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('383', '27', 'Planner/Weaponsmith');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('384', '27', 'Planner/Chef');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('385', '27', 'Dwarven ringmail plans');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('386', '27', 'Captain R.K. Irontoe');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('387', '27', 'COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('388', '28', 'Brooch');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('389', '28', 'Glavarius Marud');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('390', '28', 'fippy darkpaw');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('391', '28', 'Empty Crate Note');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('392', '28', 'Tessas Contingency plan');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('393', '28', 'Tessas Hidden Notes');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('394', '28', 'aquagoblins');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('395', '28', 'cleric hate helms');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('396', '28', 'Oracle NMare');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('397', '28', 'COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('398', '29', 'Vhizz Frugrin');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('399', '29', 'Lord Rulgax');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('400', '29', 'mana infused crystals');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('401', '29', 'oxidized mineral water');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('402', '29', 'mana infused stone');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('403', '29', 'Grikbar outcast');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('404', '29', 'Learn Serilian');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('405', '29', 'Pechpooka');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('406', '29', 'Pechmooka');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('407', '29', 'Pechyooka');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('408', '29', 'Pechpooka/Pechmooka/Pechyooka');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('409', '29', 'Pechpooka/Pechmooka');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('410', '29', 'Pechpooka/Pechyooka');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('411', '29', 'Pechmooka/Pechyooka');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('412', '29', 'King Grikbar');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('413', '29', 'COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('414', '30', 'Master Bowyer Mossberge');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('415', '30', 'wounded werewolf');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('416', '30', 'Captain Trueshot');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('417', '30', 'dwarven wire');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('418', '30', 'mirco servos');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('419', '30', 'Moonlight Wood');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('420', '30', 'Gold Fairy Dust');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('421', '30', 'King Klak Anon');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('422', '30', 'Sir Gearheart');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('423', '30', 'Master Bowyer Mossberge');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('424', '30', 'Fethinal');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('425', '30', 'Dragoon V Riv');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('426', '30', 'Dragoon K Get');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('427', '30', 'Dragoon Cpt. K Venx');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('428', '30', 'kill Captian Trueshot');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('429', '30', 'Huntmaster Viswin');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('430', '30', 'COMPLETED!');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('431', '31', 'Glyph Tatooed Flesh');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('432', '31', 'Tavish Dracinov');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('433', '31', 'Amares D Venhz');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('434', '31', '20 Chunks/Raw Meat');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('435', '31', '20 Congealed/Blood Drops');
INSERT INTO #__guildmaster_heri_steps (step_id, heri_id, name)
	VALUES ('436', '31', 'COMPLETED!');

