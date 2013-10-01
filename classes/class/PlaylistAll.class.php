<?php
# Radio Panel Alpha - is an OpenSource Radio Panel.
# Radio Panel Alpha will be base part of the complete Radio Streaming Administration tool (Open Radio Control Panel)
#
# Copyright (C) 2010-2013 by James Heinrich - http://www.getid3.org
# Copyright (C) 2010-2013 by Max S Alyohin - http://radiocms.ru
# Copyright (C) 2013 by OpenRCP - http://open-rcp.ru
#
#
# The contents of this file are subject to the Mozilla Public License
# Version 1.1 (the "License"); you may not use this file except in
# compliance with the License. You may obtain a copy of the License at
# http://www.mozilla.org/MPL/
#
# Software distributed under the License is distributed on an "AS IS"
# basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See the
# License for the specific language governing rights and limitations
# under the License.
#
# The Original Code is "RadioCMS".
#
# The Initial Developer of the Original Code is Max S Alyohin.
# Portions created by Initial Developer are Copyright (C) 2010-2013
# by Max S Alyohin. All Rights Reserved.
#
# Product contains getID3 project code are Copyright (C) 2010-2013 by
# James Heinrich. All Rights Reserved.
#
# Portions created by the OpenRCP Development Team (C) 2013 by
# Open Radio Control Panel. All Rights Reserved.
#
# The OpenRCP Home Page is:
#
#    http://open-rcp.ru
#
	class PlaylistAll {
	    
        public static function create() {
            return new self();
        }
        
		private function __construct() {
			$this->filter = Filter::create();
			$this->playlist = Playlist::create();
			$this->db = MySql::create();
			include($this->request->getRadioPath().'_system.php');
			$this->allowTime = $allow_time;

		public function handler() {
			$notice = array();
			$this->clean();
			$zakaz = $this->getZakaz();
			if ($zakaz) {
			return $notice;

		public function getSongList() {
			$letter = $this->getLetter();
			if (!empty($search)) {
			if (!empty($letter)) {
				return $this->getSongListWitchLetter();
			}

			return $this->getSongListWitchNoFilter();

		private function getSongListWitchNoFilter() {
			$ne_pokazivat = $this->playlist->getNePokazivat();
			$sortArray = $this->getSortArray();
			$this->vsegoPesen = $this->db->getCountRow($query);
			return $this->db->getLines($query." LIMIT ".$this->getStart().",".$this->getLimit());

		private function getSongListWitchLetter() {
			$ne_pokazivat = $this->playlist->getNePokazivat();
        	$sortArray = $this->getSortArray();
        	if ($letter == "0-9") {
        		$this->vsegoPesen = $this->db->getCountRow($query);
        		return $this->db->getLines($query." LIMIT ".$this->getStart().",".$this->getLimit());
                $this->vsegoPesen = $this->db->getCountRow($query);
                return $this->db->getLines($query." LIMIT ".$this->getStart().",".$this->getLimit());
		}

		private function getSongListWitchSearch() {
			$search = $this->getSearch();
			$sortArray = $this->getSortArray();
			$ne_pokazivat = $this->playlist->getNePokazivat();
			
			if ($this->request->hasGetVar('sort')) {
                $sort = "ORDER BY `".$sortArray['value']."` ".$sortArray['obr'];
            } else {
                $sort = "";
            }
			
			
			return $this->db->getLines($query." LIMIT ".$this->getStart().",".$this->getLimit());
		}

		public function getSortArray() {
			if ($this->request->hasGetVar('sort')) {
				$sort = array();
				$sortString = $this->request->getGetVar('sort');
				$sortString = str_replace('%21', '!', $sortString);
				if ($sortString[0] == "!"){
					$sort['obr'] = "DESC";
					$sort['value'] = substr($sortString, 1);
					$sort['string'] = $sortString;
				} else {
					$sort['obr'] = "ASC";
					$sort['value'] = $sortString;
					$sort['string'] = $sortString;
				}
			} else {
				$sort['obr'] = "DESC";
				$sort['value'] = "zakazano";
				$sort['string'] = "!zakazano";
			}
			
			$sort['value'] = addslashes($sort['value']);
			
			return $sort;
		}

		public function getVsegoPesen() {
			return $this->vsegoPesen;

		public function zakaz($zakaz) {
			$return = array();
			$now_play = $this->db->getColumn($query, 'now');
			$allow_zakaz = $this->db->getColumn($query, 'allow_zakaz');
			$on_air = $this->getStatus();

			if ( $allow_zakaz != 1 or $on_air == "2" or $on_air == "0" ) {
				if ($allow_zakaz != 1) {
				}
				if ($on_air == "2") {
				}
				if ($on_air == "0") {
				}
			} else {
				$proverka_realip = $this->request->getServerVar('REMOTE_ADDR');
				$proverka_gettime_now = date('U');
				$proverka_gettime = date('U')+900;

				$query = " SELECT * FROM `user_ip` WHERE `ip` = '$proverka_realip' and `nomer` >= 1 ";
				if ($this->db->getColumn($query, 'ip') == $proverka_realip) {
					$return[] = "Нельзя заказать более одной песни в течение 15 минут, пожалуйста подождите.";
				}

				// Запрос на проверку одинаковых песен
				$query = " SELECT * FROM `zakaz` WHERE `idsong` = $zakaz ";
				$odinakovie_pesni = $this->db->getColumn($query, 'idsong');
				if (($odinakovie_pesni != "") and ($odinakovie_pesni == $zakaz)) {
				}

				// Считаем количество заказов
				$query = " SELECT * FROM `zakaz`";
			    if ($this->db->getCountRow($query) >= LIMIT_ZAKAZOV) {
			        if ($this->getAllowTime() > date("U")) {
			    		$return[] = "Приём заявок завершён, пожалуйста попробуйте после ".$this->getPosle()." по Москве.";
			    	}

			    }

			    // Вытаскивает Артист - Титл
			    $query = " SELECT * FROM `songlist` WHERE `idsong` = $zakaz ";
				$proverka_full = $this->db->getColumn($query, 'artist')." - ".$this->db->getColumn($query, 'title');

			 	// Проверяем наличие в игравших
			 	$query = " SELECT * FROM `tracklist` WHERE `title` = '".addslashes($proverka_full)."'";

				if ($this->db->getColumn($query, 'title')) {
				}

				if (empty($return)) {
					// Добавляем заказ в массивы из songlist
					$query = " SELECT * FROM `songlist` WHERE `idsong` = $zakaz ";
					$line = $this->db->getLine($query);

				    $zakaz_track = $line['artist']." - ".$line['title'];
				    $query = "SELECT * FROM `zakaz`";
					$status_zakazov_imeetsa = $this->db->getCountRow($query)+1;

					// заносим заказ в zakaz
					$query = "INSERT INTO `last_zakaz` (`track` , `time` , `skolko`  , `ip` , `idsong`, `id` )
						VALUES (
							'".addslashes($zakaz_track)."',
							'$proverka_gettime_now',
							'$status_zakazov_imeetsa',
							'$proverka_realip',
							'".$line['idsong']."',
							'".$line['id']."'
						)";
					$this->db->queryNull($query);	
				
					$query = "SELECT * FROM `last_zakaz`";
					$status_zapisei = $this->db->getCountRow($query);
					$query = "DELETE FROM `last_zakaz` WHERE $status_zapisei>100 ORDER BY `time` LIMIT 2;";
					$this->db->queryNull($query);

					$query = "INSERT INTO `zakaz` (`idsong` ,`filename` , `artist` , `title` , `album` , `duration` )
						VALUES (
							'".$line['idsong']."',
							'".addslashes($line['filename'])."',
							'".addslashes($line['artist'])."',
							'".addslashes($line['title'])."',
							'".addslashes($line['album'])."',
							'".$line['duration']."'
						)";
					$this->db->queryNull($query);
					$return[] =  "Заказ принят и будет исполнен в течение 20 минут после ".$this->getPosle()." по Москве.";

					$query = " UPDATE `songlist` SET `zakazano` = `zakazano`+1 WHERE `filename` = '".addslashes($line['filename'])."' ";
					$this->db->queryNull($query);

					$query = " SELECT * FROM `user_ip` WHERE `ip` = '$proverka_realip' ";
					if (!$this->db->getLine($query)) {
						$query = "INSERT INTO `user_ip` (`ip` , `time` , `nomer` ) VALUES ( '$proverka_realip', '$proverka_gettime', '1' )";
						$this->db->queryNull($query);
					}
				}
			}

			return $return;

		public function getPosle() {
			if (date("U") > $this->getAllowTime()) {
				$posle =  date("H:i", date("U")+120);
			}
			return $posle;

		public function getAllowTime() {

		public function getStatus() {
			return $this->db->getColumn($query, 'value');

		private function getZakaz() {
			$zakaz = false;
				$zakaz_proverka = "zakaz_".$k."_x";
				$zakaz_nomer = "zakaz_".$k;
				if (!empty($_POST[$zakaz_proverka])) {
					$zakaz = intval($_POST[$zakaz_nomer]);
				}
			}
			return $zakaz;

		private function clean() {
			$query = "SELECT * FROM `user_ip`";
			foreach ($this->db->getLines($query) as $line) {
				if ($line['time'] < date('U')) {
					$query = " DELETE FROM `user_ip` WHERE `user_ip`.`id` = '".$line['id']."' LIMIT 1 ";
					$this->db->queryNull($query);
				}
			}

		public function setUrlStart($url) {

		public function getUrlStart() {
        	return "http://".$this->request->getServerVar('HTTP_HOST').$this->request->getServerVar('PHP_SELF');
		}

		public function getStart() {

		public function getLimit() {
			if ($this->request->hasGetVar('limit')) {
				return (int) $this->request->getGetVar('limit');
			} else {
				return 25;
			}
		}

		public function getSort() {
			if ($this->request->hasGetVar('sort')) {
			    $sortString = $this->request->getGetVar('sort');
			    $sortString = str_replace('%21', '!', $sortString);
				return $sortString;
			} else {
				return "!zakazano";
			}
		}

		public function getSearch() {
			if ($this->request->hasGetVar('search')) {
				$search = htmlspecialchars($search, ENT_QUOTES, "utf-8");

				if (TRANSLIT == "on") {
					$search = $this->filter->translit($search);
				}

				return $search;
			} else {
				return "";
			}
		}
        
        public function getSearchString() {
            if ($this->request->hasGetVar('search')) {
                return str_replace('"', '', $this->request->getGetVar('search'));
            } else {
                return "";
            } 
        }       

		public function getLetter() {
			if ($this->request->hasGetVar('letter')) {
				return addslashes($this->request->getGetVar('letter'));
			} else {
				return "";
			}
		}
?>