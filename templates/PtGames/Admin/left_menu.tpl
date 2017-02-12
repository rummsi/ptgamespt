<div id='leftmenu'>
<script language="JavaScript">
function f(target_url,win_name) {
  var new_win = window.open(target_url,win_name,'resizable=yes,scrollbars=yes,menubar=no,toolbar=no,width=550,height=280,top=0,left=0');
  new_win.focus();
}
parent.frames['Hauptframe'].location.replace("admin.php?page=overview");
</script>
<body  class="style" topmargin="0" leftmargin="0" marginwidth="0" marginheight="0">
<center>
<div id='menu'>
<br>
<table width="130" cellspacing="0" cellpadding="0">
<tr>
	<td style="border-top: 1px #545454 solid"><div><center>{servername}<br>(<a href="admin.php?page=changelog" target={mf}><font color=red>{XNovaRelease}</font></a>)<center></div></td>
</tr><tr>
	<td background="{dpath}img/bg1.gif"><center>{admin}</center></td>
</tr><tr>
	<td><div><a href="admin.php?page=overview" accesskey="v" target="{mf}">{adm_over}</a></div></td>
</tr><tr>
	<td><div><a href="admin.php?page=settings" accesskey="e" target="{mf}">{adm_conf}</a></div></td>
</tr><tr>
	<td><div><a href="admin.php?page=XNovaResetUnivers" accesskey="e" target="{mf}">{adm_reset}</a></div></td>
</tr><tr>
	<td background="{dpath}img/bg1.gif"><center>{player}</center></td>
</tr><tr>
	<td><div><a href="admin.php?page=userlist" accesskey="a" target="{mf}">{adm_plrlst}</a></div></td>
</tr><tr>
    <td><div><a href="admin.php?page=multi" accesskey="a" target="{mf}">{adm_multi}</a></div></td>
</tr><tr>
	<td><div><a href="admin.php?page=paneladmina" accesskey="k" target="{mf}">{adm_plrsch}</a></div></td>
</tr><tr>
	<td><div><a href="admin.php?page=QueryExecute" accesskey="k" target="{mf}">{qry}</a></div></td>
</tr><tr>
	<td><div><a href="admin.php?page=variables" accesskey="k" target="_blank">PhpInfo</a></div></td>
</tr><tr>
	<td><div><a href="admin.php?page=add_money" accesskey="k" target="{mf}">{adm_addres}</a></div></td>
</tr><tr>
	<td style="background-color:#FFFFFF" height="1px"></td>
</tr><tr>
	<td><div><a href="admin.php?page=planetlist" accesskey="1" target="{mf}">{adm_pltlst}</a></div></td>
</tr><tr>
	<td><div><a href="admin.php?page=activeplanet" accesskey="k" target="{mf}">{adm_actplt}</a></div></td>
</tr><tr>
	<td style="background-color:#FFFFFF" height="1px"></td>
</tr><tr>
	<td><div><a href="admin.php?page=moonlist" accesskey="k" target="{mf}">{adm_moonlst}</a></div></td>
</tr><tr>
	<td><div><a href="admin.php?page=declare_list" accesskey="k" target="{mf}">{multis_declared}</a></div></td>
</tr><tr>
	<td><div><a href="admin.php?page=add_moon" accesskey="k" target="{mf}">{adm_addmoon}</a></div></td>
</tr><tr>
	<td style="background-color:#FFFFFF" height="1px"></td>
</tr><tr>
	<td><div><a href="admin.php?page=ShowFlyingFleets" accesskey="k" target="{mf}">{adm_fleet}</a></div></td>
</tr><tr>
	<td style="background-color:#FFFFFF" height="1px"></td>
</tr><tr>
	<td><div><a href="admin.php?page=banned" accesskey="k" target="{mf}">{adm_ban}</a></div></td>
</tr><tr>
	<td><div><a href="admin.php?page=md5changepass" accesskey="k" target="{mf}">{change_pass}</a></div></td>
</tr><tr>
	<td><div><a href="admin.php?page=unbanned" accesskey="k" target="{mf}">{adm_unban}</a></div></td>
</tr><tr>
	<td background="{dpath}img/bg1.gif"><center>{tool}</center></td>
</tr><tr>
	<td><div><a href="admin.php?page=chat" accesskey="p" target="{mf}">{adm_chat}</a></div></td>
</tr><tr>
	<td><div><a href="admin.php?page=statbuilder" accesskey="p" target="{mf}">{adm_updpt}</a></div></td>
</tr><tr>
	<td><div><a href="admin.php?page=messagelist" accesskey="k" target="{mf}">{adm_msg}</a></div></td>
</tr><tr>
	<td><div><a href="admin.php?page=md5enc" accesskey="p" target="{mf}">{adm_md5}</a></div></td>
</tr><tr>
	<td><div><a href="admin.php?page=ElementQueueFixer" accesskey="p" target="{mf}">{adm_build}</a></div></td>
</tr><tr>
	<td style="background-color:#FFFFFF" height="1px"></td>
</tr><tr>
	<td><div><a href="admin.php?page=errors" accesskey="e" target="{mf}">{adm_error}</a></div></td>
</tr><tr>
	<td><div><a href="http://www.xnova-ng.org/forum/index.php" accesskey="3" target="{mf}">{adm_help}</a></div></td>
</tr><tr>
	<td><div><a href="game.php?page=overview" accesskey="i" target="_top" style="color:red">{adm_back}</a></div></td>
</tr><tr>
	<td background="{dpath}img/bg1.gif"><center>{infog}</center></td>
</tr>
</table>
</div>
</center>
</body>
</div>