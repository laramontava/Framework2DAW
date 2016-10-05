<?php
    require_once('view/inc/header.html');
    include 'utils/utils.inc.php';
    session_start();
    ?>
    <div id="wrapper">
        <div id="header">
            <?php include('view/inc/navbar.php');?>
        </div>
        <div id="body">
            <?php if (!isset($_GET['module'])) {
		            require_once("modules/main/controller/controller_main.class.php");
                } else	if ( (isset($_GET['module'])) && (!isset($_GET['view'])) ){
		            require_once("modules/".$_GET['module']."/controller/controller_".$_GET['module'].".class.php");
	            }
	            
	            if ( (isset($_GET['module'])) && (isset($_GET['view'])) ) {
		            require_once("modules/".$_GET['module']."/view/".$_GET['view'].".php");
	            } 
	        ?>
        </div>
        <div id="footer">
            <?php require_once('view/inc/footer.html');?>
        </div>
    </div>