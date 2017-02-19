<?php

/*
 * PTGamesPT
 * Copyright (C) 2012 -2017
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
 * You should read the GNU General Public License, see <http://www.gnu.org/licenses/>.
 * 
 * PTGamesPT
 * @author PTGamesPT Team <geral@ptgames.pt>
 * @AbstractGamePage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  18/fev/2017 21:31:51
 */

/**
 * Description of AbstractGamePage
 *
 * @author author PTGamesPT Team <geral@ptgames.pt>
 */
abstract class AbstractGamePage {

    function display($page, $title = '', $metatags = '', $AdminPage = false) {
        global $link, $game_config, $debug, $user, $planetrow;

        $DisplayPage = $this->StdUserHeader($title, $metatags);
        $DisplayPage .= ShowTopNavigationBar($user, $planetrow);
        $DisplayPage .= $this->ShowLeftMenu();
        $DisplayPage .= "<center>\n" . $page . "\n</center>\n";
        // Affichage du Debug si necessaire
        if (isset($user['authlevel']) && in_array($user['authlevel'], array(LEVEL_ADMIN, LEVEL_OPERATOR))) {
            if ($game_config['debug'] == 1) {
                $debug->echo_log();
            }
        }

        $DisplayPage .= $this->StdFooter();
        if (isset($link)) {
            mysqli_close($link);
        }

        echo $DisplayPage;

        die();
    }

    function StdUserHeader($title = '', $metatags = '') {
        global $langInfos;

        $parse = $langInfos;
        $parse['title'] = $title;
        if (defined('LOGIN')) {
            $parse['dpath'] = "skins/xnova/";
            $parse['-style-'] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/styles.css\">\n";
            $parse['-style-'] .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/about.css\">\n";
        } else {
            $parse['dpath'] = DEFAULT_SKINPATH;
            $parse['-style-'] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . DEFAULT_SKINPATH . "/default.css\" />";
            $parse['-style-'] .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . DEFAULT_SKINPATH . "/formate.css\" />";
        }

        $parse['-meta-'] = ($metatags) ? $metatags : "";
        $parse['-body-'] = "<body>"; //  class=\"style\" topmargin=\"0\" leftmargin=\"0\" marginwidth=\"0\" marginheight=\"0\">";
        return parsetemplate(gettemplate('Index/simple_header'), $parse);
    }

    function AdminUserHeader($title = '', $metatags = '') {
        global $dpath, $langInfos;

        $parse = $langInfos;
        $parse['dpath'] = $dpath;
        $parse['title'] = $title;
        $parse['-meta-'] = ($metatags) ? $metatags : "";
        $parse['-body-'] = "<body>"; //  class=\"style\" topmargin=\"0\" leftmargin=\"0\" marginwidth=\"0\" marginheight=\"0\">";
        return parsetemplate(gettemplate('Admin/simple_header'), $parse);
    }

    static function ShowLeftMenu() {
        global $lang, $user, $dpath, $game_config;

        includeLang('leftmenu');
        $parse = $lang;
        $parse['lm_tx_serv'] = $game_config['resource_multiplier'];
        $parse['lm_tx_game'] = $game_config['game_speed'] / 2500;
        $parse['lm_tx_fleet'] = $game_config['fleet_speed'] / 2500;
        $parse['lm_tx_queue'] = MAX_FLEET_OR_DEFS_PER_ROW;
        $parse['server_info'] = parsetemplate(gettemplate('Game/serv_infos'), $parse);
        $parse['XNovaRelease'] = VERSION;
        $parse['dpath'] = $dpath;
        $parse['forum_url'] = $game_config['forum_url'];
        $parse['mf'] = "_self";
        $rank = doquery("SELECT `total_rank` FROM {{table}} WHERE `stat_code` = '1' AND `stat_type` = '1' AND `id_owner` = '" . $user['id'] . "';", 'statpoints', true);
        $parse['user_rank'] = $rank['total_rank'];
        if ($user['authlevel'] > 0) {
            $parse['ADMIN_LINK'] = "
		<tr>
			<td colspan=\"2\"><div><a href=\"admin.php?page=overview\"><font color=\"lime\">" . $lang['user_level'][$user['authlevel']] . "</font></a></div></td>
		</tr>";
        } else {
            $parse['ADMIN_LINK'] = "";
        }
        //Lien suppl�mentaire d�termin� dans le panel admin
        if ($game_config['link_enable'] == 1) {
            $parse['added_link'] = "
		<tr>
			<td colspan=\"2\"><div><a href=\"" . $game_config['link_url'] . "\" target=\"_blank\">" . stripslashes($game_config['link_name']) . "</a></div></td>
		</tr>";
        } else {
            $parse['added_link'] = "";
        }
        //Maintenant on v�rifie si les annonces sont activ�es ou non
        if ($game_config['enable_announces'] == 1) {
            $parse['announce_link'] = "
		<tr>
			<td colspan=\"2\"><div><a href=\"game.php?page=annonce\" target=\"_self\">Annonces</a></div></td>
		</tr>";
        } else {
            $parse['announce_link'] = "";
        }
        //Maintenant le marchand
        if ($game_config['enable_marchand'] == 1) {
            $parse['marchand_link'] = "
			<td colspan=\"2\"><div><a href=\"game.php?page=marchand\" target=\"_self\">Marchand</a></div></td>";
        } else {
            $parse['marchand_link'] = "";
        }
        //Maintenant les notes
        if ($game_config['enable_notes'] == 1) {
            $parse['notes_link'] = "
		<tr>
			<td colspan=\"2\"><div><a href=\"#\" onClick=\"f('game.php?page=notes', '');\" accesskey=\"c\">Notes</a></div></td>
		</tr>";
        } else {
            $parse['notes_link'] = "";
        }
        $parse['servername'] = $game_config['game_name'];
        return parsetemplate(gettemplate('Game/left_menu'), $parse);
    }

    function StdFooter() {
        global $parse;
        return parsetemplate(gettemplate('Index/overall_footer'), $parse);
    }

}
