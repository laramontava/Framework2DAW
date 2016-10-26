<?php
    $_SESSION['result_avatar'] = array();
    $_SESSION['module'] = "";
    session_start();
    
    require_once('view/inc/header.html');
    require_once('view/inc/navbar.php');
    
    if (PRODUCTION) { //we are in production
        ini_set('display_errors', '1');
        ini_set('error_reporting', E_ERROR | E_WARNING | E_NOTICE); //error_reporting(E_ALL) ;
    } else {
        ini_set('display_errors', '0');
        ini_set('error_reporting', '0'); //error_reporting(0); 
    }
    
    include 'utils/utils.inc.php';
    
    if (!isset($_GET['module'])) {
		require_once("modules/main/controller/controller_main.class.php");
    } else	if ( (isset($_GET['module'])) && (!isset($_GET['view'])) ){
		require_once("modules/".$_GET['module']."/controller/controller_".$_GET['module'].".class.php");
	}
	            
	if ( (isset($_GET['module'])) && (isset($_GET['view'])) ) {
		require_once("modules/".$_GET['module']."/view/".$_GET['view'].".php");
	} 
	        
    
    require_once('view/inc/footer.html');
    