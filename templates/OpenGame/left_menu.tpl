<div id='leftmenu'>
<script language="JavaScript">
function f(target_url,win_name) {
  var new_win = window.open(target_url,win_name,'resizable=yes,scrollbars=yes,menubar=no,toolbar=no,width=550,height=280,top=0,left=0');
  new_win.focus();
}
</script>
<body  class="style" topmargin="0" leftmargin="0" marginwidth="0" marginheight="0">
<center>
<div id='menu'>
<br>
<table width="130" cellspacing="0" cellpadding="0">
<tr>
	<td colspan="2" style="border-top: 1px #545454 solid"><div><center>{servername}<br>(<a href="game.php?page=changelog" target={mf}><font color=red>{XNovaRelease}</font></a>)<center></div></td>
</tr><tr>
	<td colspan="2" background="{dpath}img/bg1.gif"><center>{devlp}</center></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=overview" accesskey="g" target="{mf}">{Overview}</a></div></td>
</tr><tr>

	<td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=buildings" accesskey="b" target="{mf}">{Buildings}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=buildings&mode=research" accesskey="r" target="{mf}">{Research}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=buildings&mode=fleet" accesskey="f" target="{mf}">{Shipyard}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=buildings&mode=defense" accesskey="d" target="{mf}">{Defense}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=officier" accesskey="o" target="{mf}">{Officiers}</a></div></td>
</tr><tr>
	{marchand_link}
</tr><tr>
	<td colspan="2" background="{dpath}img/bg1.gif"><center>{navig}</center></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=alliance" accesskey="a" target="{mf}">{Alliance}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=fleet" accesskey="t" target="{mf}">{Fleet}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=messages" accesskey="c" target="{mf}">{Messages}</a></div></td>
</tr><tr>

	<td colspan="2" background="{dpath}img/bg1.gif"><center>{observ}</center></td>
</tr><tr>
	<td colspan="2"><div><a href="galaxy.php?mode=0" accesskey="s" target="{mf}">{Galaxy}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="imperium.php" accesskey="i" target="{mf}">{Imperium}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="resources.php" accesskey="r" target="{mf}">{Resources}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="techtree.php" accesskey="g" target="{mf}">{Technology}</a></div></td>
</tr><tr>

	<td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr><tr>
	<td colspan="2"><div><a href="records.php" accesskey="3" target="{mf}">{Records}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="stat.php?range={user_rank}" accesskey="k" target="{mf}">{Statistics}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="search.php" accesskey="b" target="{mf}">{Search}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=banned" accesskey="3" target="{mf}">{blocked}</a></div></td>
</tr>{announce_link}<tr>


	<td colspan="2" background="{dpath}img/bg1.gif"><center>{commun}</center></td>
	</tr><tr>
	<td colspan="2"><div><a href="#" onClick="f('game.php?page=buddy', '');" accesskey="c">{Buddylist}</a></div></td>
</tr></tr>{notes_link}<tr><tr>
	<td colspan="2"><div><a href="chat.php" accesskey="a" target="{mf}">{Chat}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="{forum_url}" accesskey="1" target="{mf}">{Board}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=add_declare" accesskey="1" target="{mf}">{multi}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="rules.php"  accesskey="c" target="{mf}">{Rules}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="contact.php" accesskey="3" target="{mf}" >{Contact}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="options.php" accesskey="o" target="{mf}">{Options}</a></div></td>
</tr>
	{ADMIN_LINK}
<tr>
</tr>
	{added_link}
<tr>
	<td colspan="2"><div><a href="javascript:top.location.href='index.php?page=logout'" accesskey="s" style="color:red">{Logout}</a></div></td>
</tr><tr>
	<td colspan="2" background="{dpath}img/bg1.gif"><center>{infog}</center></td>
</tr>
	{server_info}
</table>
</div>
</center>
</body>
</div>