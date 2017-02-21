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
 * @AbstractAdminPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  19/fev/2017 15:07:50
 */

/**
 * Description of AbstractAdminPage
 *
 * @author author PTGamesPT Team <geral@ptgames.pt>
 */
abstract class AbstractAdminPage {

    function display($page, $title = '', $metatags = '') {
        global $link, $game_config, $debug, $user, $planetrow;

        $DisplayPage = $this->AdminUserHeader($title, $metatags);
        $DisplayPage .= ShowTopNavigationBar($user, $planetrow);
        $DisplayPage .= $this->ShowAdminMenu();
        $DisplayPage .= "<center>\n" . $page . "\n</center>\n";
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

    function AdminUserHeader($title = '', $metatags = '') {
        global $langInfos, $dpath;

        $parse = $langInfos;
        $parse['title'] = $title;
        $parse['dpath'] = DEFAULT_SKINPATH;
        $parse['-style-'] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . DEFAULT_SKINPATH . "/default.css\" />";
        $parse['-style-'] .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . DEFAULT_SKINPATH . "/formate.css\" />";
        $parse['-meta-'] = ($metatags) ? $metatags : "";
        $parse['-body-'] = "<body>";
        return parsetemplate(gettemplate('Admin/simple_header'), $parse);
    }

    function ShowAdminMenu() {
        global $lang, $user, $game_config, $dpath;

        includeLang('leftmenu');
        if (in_array($user['authlevel'], array(LEVEL_ADMIN, LEVEL_OPERATOR, LEVEL_MODERATOR))) {
            $parse = $lang;
            $parse['mf'] = "_self";
            $parse['dpath'] = $dpath;
            $parse['XNovaRelease'] = VERSION;
            $parse['servername'] = $game_config['game_name'];
            return parsetemplate(gettemplate('Admin/left_menu'), $parse);
        } else {
            $this->message($lang['sys_noalloaw'], $lang['sys_noaccess']);
        }
    }

    function StdFooter() {
        global $parse;
        return parsetemplate(gettemplate('overall_footer'), $parse);
    }

    function message($mes, $title = 'Error', $dest = "", $time = "3", $color = 'orange') {
        $parse['color'] = $color;
        $parse['title'] = $title;
        $parse['mes'] = $mes;

        $page = parsetemplate(gettemplate('Admin/message_body'), $parse);

        $this->display($page, $title, false, (($dest != "") ? "<meta http-equiv=\"refresh\" content=\"$time;URL={$dest}\">" : ""), true);
    }

    function AdminMessage($mes, $title = 'Error', $dest = '', $time = '3', $color = 'red') {
        $parse['color'] = $color;
        $parse['title'] = $title;
        $parse['mes'] = $mes;

        $page = parsetemplate(gettemplate('Admin/message_body'), $parse);

        $this->display($page, $title, false, (($dest != "") ? "<meta http-equiv=\"refresh\" content=\"$time;URL={$dest}\">" : ""), true);
    }

}
