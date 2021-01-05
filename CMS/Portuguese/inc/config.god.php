<?php

# PHP 
date_default_timezone_set('Europe/Paris'); # Time zone
ini_set('display_errors', 0);


# HASHS
define('PASSWORD_SALT', 'ChAnGEItFoRRaNdOm');
define('PASSWORD_SALT2', '2ChAnGEItFoRRaNdOm2');
define('PASSSTAFF_SALT', '3ChAnGEItFoRRaNdOm3');
define('PASSSTAFF_SALT2', '4ChAnGEItFoRRaNdOm4');
	  
# CMS
$Holo = array(
'panel'         =>     'housekeeping',
'htmllang'      =>     'fr-FR',
'name'          =>     'MawuCMS',
'debut_auto_dark'        =>     '21', # Start of night mode in hours(For automatic theme user)
'fin_auto_dark'          =>     '7', # End of night mode in hours(For automatic theme user)

// Links
'url'           =>     'http://localhost',
'client_url'    =>     'http://localhost/hotel',
'cameraurl'     =>     'http://localhost/swf/camera/',
'thumbsurl'     =>     'http://localhost/swf/camera/thumbnails/',
'avatar'        =>     'http://habbo.com.br/habbo-imaging/avatarimage?figure=',
'url_badges'    =>     'http://localhost/swf/c_images/album1584/',

// Registro
'mision'        =>     '',
'monedas'       =>     '10000',
'duckets'       =>     '5000',
'diamants'      =>     '10',
'gender'        =>     'M',
'look'          =>     'ch-215-82.hr-100-42.lg-270-1408.ha-1003-64.hd-180-1370',

// Social
'contactemail'  =>     'contactmail@your.server',
'facebook'      =>     '',
'twitter'       =>     '',
'discordinvl'   =>     '',
'discordwid'    =>     '',

// Segurança
'minrank'       =>     '5',
'maxrank'       =>     '10',
'minhkr'        =>     '6',
'recaptcha_on'  =>     'true',
'recaptcha'     =>     '');

# HOTEL
$_config['client'] = array(
'host' 				 				=> '127.0.0.1',
'port' 				 				=> '30000',
'client_starting' 		 		 	=> 'Patience '.$Holo['name'].' ! Chargement en cours...',
'client_starting_revolving' 		=> "Le temps n'est qu'une illusion.\/Chargement de l'univers...\/Comment cava aujourd'hui?\/Suivez le canard jaune.\/Chargement des citations de l'humanité...",
'external_variables' 			 	=> ''.$Holo['url'].'/swf/gamedata/external_variables.txt',
'external_variables_override' 		=> ''.$Holo['url'].'/swf/gamedata/override/external_override_variables.txt',
'external_flash_texts'  			=> ''.$Holo['url'].'/swf/gamedata/external_flash_texts.txt',
'external_flash_texts_override' 	=> ''.$Holo['url'].'/swf/gamedata/override/external_flash_override_texts.txt',
'productdata' 			 			=> ''.$Holo['url'].'/swf/gamedata/productdata.txt',
'furnidata' 			 			=> ''.$Holo['url'].'/swf/gamedata/furnidata.xml',	
'external_figurepartlist' 			=> ''.$Holo['url'].'/swf/gamedata/figuredata.xml',	
'avatareditor_promohabbos' 			=> ''.$Holo['url'].'/swf/gamedata/hotlooks.xml',	
'flash_client_url' 	 				=> ''.$Holo['url'].'/swf/gordon/PRODUCTION-202006192205-424220153/',
'habbo_swf' 		 				=> 'Habbo.swf');
	
?>