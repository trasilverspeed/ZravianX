<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       ZravianX                                                    ##
##  Version:       2011.12.06                                                  ##
##  Filename:      install/include/multihunter.php                             ##
##  Edited by:     ZZJHONS                                                     ##
##  License:       Creative Commons BY-NC-SA 3.0                               ##
##  Copyright:     ZravianX (c) 2011 - All rights reserved                     ##
##  URLs:          http://zravianx.zzjhons.com                                 ##
##  Source code:   http://www.github.com/ZZJHONS/ZravianX                      ##
##                                                                             ##
#################################################################################

include 'adata.php';
include '../../GameEngine/Database.php';
include '../../GameEngine/config.php';
include '../../GameEngine/Lang/'.LANG.'.php';
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);
if(isset($_POST['mhpw'])){
	$password = $_POST['mhpw'];
	mysql_query("UPDATE ".TB_PREFIX."users SET password = '".md5($password)."' WHERE username = 'Multihunter'");
	$wid = $admin->getWref(0, 0);
	$uid = 0;
	$status = $database->getVillageState($wid);
	if($status == 0){
		$database->setFieldTaken($wid);
		$database->addVillage($wid, $uid, 'Multihunter', '0');
		$database->addResourceFields($wid, $database->getVillageType($wid));
		$database->addUnits($wid);
		$database->addTech($wid);
		$database->addABTech($wid);
	}
}
header('Location: ../index.php?s=5');
?>