<?
/*
* @+================================================================+
* @¦ Modulo Chat Estilo Facebook MUCore v1.0.8                      ¦
* @¦ Credits: Thejonyx - https://www.facebook.com/RoboticGames      ¦
* @¦ Credits: Thejonyx - https://jonsanchezr.github.io/cv/          ¦
* @+================================================================+
*/
function notice_message_admin($notice, $redirect = 0, $error = 0, $url)
{
if ($url == null) {
$url_red = '';
} else {
$url_red = $url;
}
if ($error == 1) {
$title   = "Error";
$go_back = '<p><a href="javascript:history.go(-1);">Go Back</a></p>';
} else {
$title = "Success";
}
$return_msg = '<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
<tr>
<td align="center" style="padding-top: 20px; padding-bottom: 20px;"><p>' . $notice . '</p>' . $go_back . '
</td> 
</tr>
</table>';
if ($redirect == 1) {
$return_msg .= '<meta http-equiv="Refresh" content="1; URL=' . $url_red . '">';
}
return $return_msg;
}

	$get_config = simplexml_load_file('../../engine/config_mods/chatmufb_settings.xml');

		
		if(trim($get_config->f4)==""){
		$password="";
		}else{
			$password= trim($get_config->f4);
		}
			
			$filename = '../../engine/config_mods/chatmufb.sql';
			mysql_connect(trim($get_config->f1), trim($get_config->f3), $password);
			mysql_select_db(trim($get_config->f2));
			
			$templine = '';
			
			$lines = file($filename);
			foreach ($lines as $line)
			{
			  
				if (substr($line, 0, 2) == '--' || $line == '')
					continue;
			
				$templine .= $line;
			
				if (substr(trim($line), -1, 1) == ';')
				{
					mysql_query($templine);
			
					$templine = '';
				}
			}
			
        echo notice_message_admin('Settings successfully saved', 1, 0, ''); 
?> 