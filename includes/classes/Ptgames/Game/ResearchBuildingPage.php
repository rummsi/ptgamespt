<?php
/**
 * This file is part of XNova:Legacies
 *
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @see http://www.xnova-ng.org/
 *
 * Copyright (c) 2009-Present, XNova Support Team <http://www.xnova-ng.org>
 * All rights reserved.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *                                --> NOTICE <--
 *  This file is part of the core development branch, changing its contents will
 * make you unable to use the automatic updates manager. Please refer to the
 * documentation for further information about customizing XNova.
 *
 */
/*
function ResearchBuildingPage (&$planetrow, $user, $IsWorking['OnWork'], $IsWorking['WorkOn'])
{
	global $lang, $resource, $reslist, $dpath, $game_config, $_GET;
*/

	includeLang('buildings');

	// Mise a jour de la liste de construction si necessaire
	UpdatePlanetBatimentQueueList ( $planetrow, $user );
	$IsWorking = HandleTechnologieBuild ( $planetrow, $user );
	$NoResearchMessage = "";
	$bContinue         = true;
	// Deja est qu'il y a un laboratoire sur la planete ???
	if ($planetrow[$resource[31]] == 0) {
		message($lang['no_laboratory'], $lang['Research']);
	}
	// Ensuite ... Est ce que la labo est en cours d'upgrade ?
	if (!CheckLabSettingsInQueue ( $planetrow )) {
		$NoResearchMessage = $lang['labo_on_update'];
		$bContinue         = false;
	}

	// Boucle d'interpretation des eventuelles commandes
	if (isset($_GET['cmd'])) {
		$TheCommand = $_GET['cmd'];
		$Techno     = $_GET['tech'];
		if ( is_numeric($Techno) ) {
			if ( in_array($Techno, $reslist['tech']) ) {
				// Bon quand on arrive ici ... On sait deja qu'on a une technologie valide
				if ( is_array ($IsWorking['WorkOn']) ) {
					$WorkingPlanet = $IsWorking['WorkOn'];
				} else {
					$WorkingPlanet = $planetrow;
				}
				switch($TheCommand){
					case 'cancel':
						if ($IsWorking['WorkOn']['b_tech_id'] == $Techno) {
							$costs                        = GetBuildingPrice($user, $WorkingPlanet, $Techno);
							$WorkingPlanet['metal']      += $costs['metal'];
							$WorkingPlanet['crystal']    += $costs['crystal'];
							$WorkingPlanet['deuterium']  += $costs['deuterium'];
							$WorkingPlanet['b_tech_id']   = 0;
							$WorkingPlanet["b_tech"]      = 0;
							$user['b_tech_planet'] = 0;
							$UpdateData                   = true;
							$IsWorking['OnWork']                   = false;
						}
						break;
					case 'search':
						if ( IsTechnologieAccessible($user, $WorkingPlanet, $Techno) &&
							 IsElementBuyable($user, $WorkingPlanet, $Techno) ) {
							$costs                        = GetBuildingPrice($user, $WorkingPlanet, $Techno);
							$WorkingPlanet['metal']      -= $costs['metal'];
							$WorkingPlanet['crystal']    -= $costs['crystal'];
							$WorkingPlanet['deuterium']  -= $costs['deuterium'];
							$WorkingPlanet["b_tech_id"]   = $Techno;
							$WorkingPlanet["b_tech"]      = time() + GetBuildingTime($user, $WorkingPlanet, $Techno);
							$user["b_tech_planet"] = $WorkingPlanet["id"];
							$UpdateData                   = true;
							$IsWorking['OnWork']                   = true;
						}
						break;
				}
				if ($UpdateData == true) {
					$QryUpdatePlanet  = "UPDATE {{table}} SET ";
					$QryUpdatePlanet .= "`b_tech_id` = '".   $WorkingPlanet['b_tech_id']   ."', ";
					$QryUpdatePlanet .= "`b_tech` = '".      $WorkingPlanet['b_tech']      ."', ";
					$QryUpdatePlanet .= "`metal` = '".       $WorkingPlanet['metal']       ."', ";
					$QryUpdatePlanet .= "`crystal` = '".     $WorkingPlanet['crystal']     ."', ";
					$QryUpdatePlanet .= "`deuterium` = '".   $WorkingPlanet['deuterium']   ."' ";
					$QryUpdatePlanet .= "WHERE ";
					$QryUpdatePlanet .= "`id` = '".          $WorkingPlanet['id']          ."';";
					doquery( $QryUpdatePlanet, 'planets');

					$QryUpdateUser  = "UPDATE {{table}} SET ";
					$QryUpdateUser .= "`b_tech_planet` = '". $user['b_tech_planet'] ."' ";
					$QryUpdateUser .= "WHERE ";
					$QryUpdateUser .= "`id` = '".            $user['id']            ."';";
					doquery( $QryUpdateUser, 'users');
				}
				if ( is_array ($IsWorking['WorkOn']) ) {
					$IsWorking['WorkOn']     = $WorkingPlanet;
				} else {
					$planetrow = $WorkingPlanet;
					if ($TheCommand == 'search') {
						$IsWorking['WorkOn'] = $planetrow;
					}
				}
			}
		} else {
			$bContinue = false;
		}
	}

	$TechRowTPL = gettemplate('Game/buildings_research_row');
	$TechScrTPL = gettemplate('Game/buildings_research_script');

	foreach($lang['tech'] as $Tech => $TechName) {
		if ($Tech > 105 && $Tech <= 199) {
			if ( IsTechnologieAccessible($user, $planetrow, $Tech)) {
				$RowParse                = $lang;
				$RowParse['dpath']       = $dpath;
				$RowParse['tech_id']     = $Tech;
				$building_level          = $user[$resource[$Tech]];
				$RowParse['tech_level']  = ($building_level == 0) ? "" : "( ". $lang['level']. " ".$building_level." )";
				$RowParse['tech_name']   = $TechName;
				$RowParse['tech_descr']  = $lang['res']['descriptions'][$Tech];
				$RowParse['tech_price']  = GetElementPrice($user, $planetrow, $Tech);
				$SearchTime              = GetBuildingTime($user, $planetrow, $Tech);
				$RowParse['search_time'] = ShowBuildTime($SearchTime);
				$RowParse['tech_restp']  = $lang['Rest_ress'] ." ". GetRestPrice ($user, $planetrow, $Tech, true);
				$CanBeDone               = IsElementBuyable($user, $planetrow, $Tech);

				// Arbre de decision de ce que l'on met dans la derniere case de la ligne
				if (!$IsWorking['OnWork']) {
					$LevelToDo = 1 + $user[$resource[$Tech]];
					if ($CanBeDone) {
						if (!CheckLabSettingsInQueue ( $planetrow )) {
							// Le laboratoire est cours de construction ou d'evolution
							// Et dans la config du systeme, on ne permet pas la recherche pendant
							// que le labo est en construction ou evolution !
							if ($LevelToDo == 1) {
								$TechnoLink  = "<font color=#FF0000>". $lang['Rechercher'] ."</font>";
							} else {
								$TechnoLink  = "<font color=#FF0000>". $lang['Rechercher'] ."<br>".$lang['level']." ".$LevelToDo."</font>";
							}
						} else {
							$TechnoLink  = "<a href=\"game.php?page=ResearchBuildingPage&cmd=search&tech=".$Tech."\">";
							if ($LevelToDo == 1) {
								$TechnoLink .= "<font color=#00FF00>". $lang['Rechercher'] ."</font>";
							} else {
								$TechnoLink .= "<font color=#00FF00>". $lang['Rechercher'] ."<br>".$lang['level']." ".$LevelToDo."</font>";
							}
							$TechnoLink  .= "</a>";
						}
					} else {
						if ($LevelToDo == 1) {
							$TechnoLink  = "<font color=#FF0000>". $lang['Rechercher'] ."</font>";
						} else {
							$TechnoLink  = "<font color=#FF0000>". $lang['Rechercher'] ."<br>".$lang['level']." ".$LevelToDo."</font>";
						}
					}

				} else {
					// Y a une construction en cours
					if ($IsWorking['WorkOn']["b_tech_id"] == $Tech) {
						// C'est le technologie en cours de recherche
						$bloc       = $lang;
						if ($IsWorking['WorkOn']['id'] != $planetrow['id']) {
							// Ca se passe sur une autre planete
							$bloc['tech_time']  = $IsWorking['WorkOn']["b_tech"] - time();
							$bloc['tech_name']  = $lang['on'] ."<br>". $IsWorking['WorkOn']["name"];
							$bloc['tech_home']  = $IsWorking['WorkOn']["id"];
							$bloc['tech_id']    = $IsWorking['WorkOn']["b_tech_id"];
						} else {
							// Ca se passe sur la planete actuelle
							$bloc['tech_time']  = $planetrow["b_tech"] - time();
							$bloc['tech_name']  = "";
							$bloc['tech_home']  = $planetrow["id"];
							$bloc['tech_id']    = $planetrow["b_tech_id"];
						}
						$TechnoLink  = parsetemplate($TechScrTPL, $bloc);
					} else {
						// Technologie pas en cours recherche
						$TechnoLink  = "<center>-</center>";
					}
				}
				$RowParse['tech_link']  = $TechnoLink;
				$TechnoList            .= parsetemplate($TechRowTPL, $RowParse);
			}
		}
	}

	$PageParse                = $lang;
	$PageParse['noresearch']  = $NoResearchMessage;
	$PageParse['technolist']  = $TechnoList;
	$Page                    .= parsetemplate(gettemplate('Game/buildings_research'), $PageParse);

	Game::display( $Page, $lang['Research'] );
//}

// History revision
// 1.0 - Release initiale / modularisation / Reecriture / Commentaire / Mise en forme
// 1.1 - BUG affichage de la techno en cours
// 1.2 - Restructuration modification pour permettre d'annuller proprement une techno en cours
?>