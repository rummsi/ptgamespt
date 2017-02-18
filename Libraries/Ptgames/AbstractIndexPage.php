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
 * @AbstractIndexPage.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  18/fev/2017 20:12:21
 */

/**
 * Description of AbstractIndexPage
 *
 * @author author PTGamesPT Team <geral@ptgames.pt>
 */
abstract class AbstractIndexPage {

    function display($page, $title = '', $metatags = '') {
        global $link;

        $DisplayPage = $this->StdUserHeader($title, $metatags);
        $DisplayPage .= "<center>\n" . $page . "\n</center>\n";
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

    function StdFooter() {
        global $parse;
        return parsetemplate(gettemplate('Index/overall_footer'), $parse);
    }

}
