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
	include('top.php');
# Access to the module
    if (!empty($user) and $user['admin'] != 1) {
    	$access = false;
	} else {		$access = true;	}

	$dj = Dj::create();
	$dj->handler();
?>
	<div class="body">
	<br>
	<div class="title">Список DJ</div>
	<div class="border">
		<table border="0" cellspacing="0" cellpadding="0" width="97%" class="table1">
			<tr>
				<td width="2%"></td>
				<td width="33%">Пользователь</td>
				<td width="30%">Права</td>
				<td width="30%">Время</td>
				<td width="5%">Удалить</td>
			</tr>
			<tr>
				<td bgcolor=#F5F4F7>
					<img src="images/user_admin.png" width="16" height="16" border="0">
				</td>
				<td bgcolor=#F5F4F7>
					<?=USER?>
				</td>
				<td bgcolor=#F5F4F7>Главный администратор</td>
				<td bgcolor=#F5F4F7></td>
				<td bgcolor=#F5F4F7>
					<img src="images/delete.gif" width="16" height="16" border="0" title="Главного администратора удалить нельзя">
				</td>
			</tr>
<?php
		$i = 1;
    	foreach ($dj->getDjList() as $line) {
    		$color = ($i!=1) ? 'bgcolor=#F5F4F7' : '';
?>
			<tr>
       			<td <?=$color?>>
<?php
		if ($line['admin'] == 1) {
?>
       				<img src="images/user_admin.png" width="16" height="16" border="0">
<?php
		} else {
?>
					<img src="images/user.png" width="16" height="16" border="0">
<?php
		}
?>
       			</td>
        		<td <?=$color?>>
        			<?=$line['dj']?>
        		</td>
				<td <?=$color?>>
<?php
		if ($line['admin'] == 1) {
?>
       				Администратор
<?php
		} else {
?>
					DJ
<?php
		}
?>
				</td>
				<td <?=$color?>>
					<?=$line['description']?>
				</td>
				<td <?=$color?>>
<?php
		if ($access) {
?>
					<a href="?del=<?=$line['id']?>">
						<img src="images/delete2.gif" width="16" height="16" border="0" title="Удалить">
					</a>
<?php
		} else {
?>
					<img src="images/delete.gif" width="16" height="16" border="0" title="Нет прав">
<?php
		}
?>
				</td>
			</tr>
<?php
			if ($i == 1) {				$i = 0;
			} else {				$i = $i+1;
			}
		}
 ?>
		</table>
	</div>
	<br><br>
	<div class="title">Добавление нового DJ</div>
	<div class="border">
<?php
# Access to the module
    if (!empty($user) and $user['admin'] != 1) {
    	$security->denied();
	}
?>
		<form method="post" action="">
			<table border="0" cellspacing="0" cellpadding="0" width="97%" class="table1">
				<tr>
					<td width="13%" align="left">Логин</td>
					<td width="13%" align="left">Пароль</td>
					<td width="13%" align="left">Права</td>
					<td width="13%" align="left">Время</td>
					<td></td>
				</tr>
				<tr>
					<td align="left"><input width="80%" name="dj" type="text" value=""></td>
					<td align="left"><input width="80%" name="djpass" type="text" value=""></td>
					<td align="left"><select width="80%" size="1" name="admin"><option value="0">DJ</option><option value="1">Администратор</option></select></td>
					<td align="left"><input width="80%" name="djdescription" type="text" value=""></td><td></td>
				</tr>
				<tr>
					<td align="left"><input class="button" name="djadd" type="submit" value="Добавить"></td>
					<td colspan="5"><div class="podpis"><?=$dj->getError() ? "<font color='red'>".$dj->getError()."</font>&nbsp;&nbsp;&nbsp;&nbsp;" : ''?>DJ имеет доступ к модулям "Статистика" и частично к "Ваши DJ" (только просмотр списка DJ) и "Статус" (для переключения в прямой эфир и обратно, без возможности выключить радио совсем), Администратор - имеет доступ ко всем модулям.</div></td>
				</tr>
			</table>
		</form>
	</div>
	<br><br>
	</div>
<?php
    include('tpl/footer.tpl');
?>	