<?php
/**
 * Tis file is part of XNova:Legacies
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

class Planetlist extends AbstractAdminPage {

    function __construct() {
        $this->show();
    }

    function show() {
        global $lang, $user;

	if (in_array($user['authlevel'], array(LEVEL_ADMIN, LEVEL_OPERATOR))) {

		$parse = $lang;
		$query = doquery("SELECT * FROM {{table}} WHERE planet_type='1'", "planets");
		$i = 0;
                $parse['planetes'] = "";
		while ($u = mysqli_fetch_array($query, MYSQLI_NUM)) {
			$parse['planetes'] .= "<tr>"
			. "<td class=b><center><b>" . $u[0] . "</center></b></td>"
			. "<td class=b><center><b>" . $u[1] . "</center></b></td>"
			. "<td class=b><center><b>" . $u[4] . "</center></b></td>"
			. "<td class=b><center><b>" . $u[5] . "</center></b></td>"
			. "<td class=b><center><b>" . $u[6] . "</center></b></td>"
			. "</tr>";
			$i++;
		}

		if ($i == "1"){
			$parse['planetes'] .= "<tr><th class=b colspan=5>Il y a qu'une seule plan&egrave;te</th></tr>";
                }else{
			$parse['planetes'] .= "<tr><th class=b colspan=5>Il y a {$i} plan&egrave;tes</th></tr>";
                }
                    $this->display(parsetemplate(gettemplate('Admin/planetlist_body'), $parse), 'Planetlist', false, '', true);
	} else {
            $this->message($lang['sys_noalloaw'], $lang['sys_noaccess']);
	}
        
    }

}

// Created by e-Zobar. All rights reversed (C) XNova Team 2008
?>