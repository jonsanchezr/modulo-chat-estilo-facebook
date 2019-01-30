<?
/*
* @+================================================================+
* @¦ Modulo Chat Estilo Facebook MUCore v1.0.8                      ¦
* @¦ Credits: Thejonyx - https://www.facebook.com/RoboticGames      ¦
* @¦ Credits: Thejonyx - https://jonsanchezr.github.io/cv/          ¦
* @+================================================================+
*/
	$get_config = simplexml_load_file('../engine/config_mods/chatmufb_settings.xml');
    if (isset($_POST['settings'])) {
		$f1 = new_config_xml('../engine/config_mods/chatmufb_settings', 'f1', $_POST['f1']);
        $f2 = new_config_xml('../engine/config_mods/chatmufb_settings', 'f2', $_POST['f2']);
        $f3 = new_config_xml('../engine/config_mods/chatmufb_settings', 'f3', $_POST['f3']);
		$f4 = new_config_xml('../engine/config_mods/chatmufb_settings', 'f4', $_POST['f4']);
        echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=chatmufb_manager'); 
    
	} else {
        
            if (isset($_POST['module_active'])) {
                $save_status = new_config_xml('../engine/config_mods/chatmufb_settings', 'active', safe_input($_POST['module_active'], ''));
            }
            $get_config = simplexml_load_file('../engine/config_mods/chatmufb_settings.xml');
            echo '<form action="" name="settings" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Configurar Chat Estilo Facebook con MYSQL</td>
</tr>
<tr>';
            if ($get_config->active == '1') {
                echo '<td align="left" class="panel_buttons" style="background: #0C0;"><b>Chat is active.</b></td>
<td align="right" class="panel_buttons" style="background: #0C0;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Chat Off"><input type="hidden" name="module_active" value="0">';
                   
            } elseif ($get_config->active == '0') {
                echo '<td align="left" class="panel_buttons" style="background: #C00;"><b>Chat is inactive.</b></td>
<td align="right" class="panel_buttons" style="background: #C00;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Chat On"><input type="hidden" name="module_active" value="1">';
            }
            echo '</td>
</tr>
</table>
</form>';
            
            echo '<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Instalar base de datos para el chat MYSQL</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Host de la Base de Datos</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Si tienes el servidor de la base de datos en local.<br>Solo coloca localhost.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" size="30" maxlength="50" value="' . $get_config->f1 . '" name="f1"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Nombre de la Base de Datos</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Nombre que tiene la Base de Datos.<br>ejemplo: muchat</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" size="30" maxlength="50" value="' . $get_config->f2 . '" name="f2"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Nombre de usuario</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Nombre del usuario asignado a la Base de Datos.<br>ejemplo use por defecto: root.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" size="30" maxlength="50" value="' . $get_config->f3 . '" name="f3"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">Clave de la Base de Datos</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Clave del usuario asignado a la Base de Datos.<br>el user root por defecto no tiene clave.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" size="30" maxlength="50" value="' . $get_config->f4 . '" name="f4"><br>
</td>
</tr>

<tr>
<td align="right" class="panel_buttons" colspan="2">
<input type="hidden" name="settings">
<input type="submit" value="Save"></td>
</tr>
</table>
</form>';
	
echo '<form action="modules/chatmufbdb_manager.php" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Comprobar instalacion de la Base de Datos</td>
</tr>';

		if(trim($get_config->f4)==""){
		$password="";
		}else{
			$password= trim($get_config->f4);
		}
	  	$link = mysql_connect(trim($get_config->f1), trim($get_config->f3), $password);
    	if (!$link) {
				echo '<tr>
<td align="center" class="panel_title_sub" colspan="2">No se pudo conectar a la Base de Datos</td>
					 </tr>';
		}else{
				echo '<tr>
<td align="center" class="panel_title_sub" colspan="2">Connectado a la Base de Datos</td>
					 </tr>';
				echo '<br>';
		}
		
		
		$bd_seleccionada = mysql_select_db(trim($get_config->f2));
		if (!$bd_seleccionada) {
    	echo '<td align="center" class="panel_text_alt1" width="45%" valign="top">No se pudo conectar a la base de datos.</td>';
		}else{
		echo '<td align="center" class="panel_text_alt1" width="45%" valign="top">Se a conectado a la base de datos</td>';
		}
		mysql_close($link);

if (!$bd_seleccionada) {}
else{
		echo '<tr>
	<td align="center" class="panel_buttons" colspan="2">
	<input type="hidden" name="f5">
	<input type="submit" value="Instalar"></td>
		</tr>';
	
	}
	echo '</table>
</form>';

    }
/*
* @+================================================================+
* @¦ Modulo Chat Estilo Facebook MUCore v1.0.8                      ¦
* @¦ Credits: Thejonyx - https://www.facebook.com/RoboticGames      ¦
* @¦ Credits: Thejonyx - https://jonsanchezr.github.io/cv/          ¦
* @+================================================================+
*/
?> 