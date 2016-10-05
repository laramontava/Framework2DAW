<?php
    function redirect($url){
	    die('<script>top.location.href="'.$url .'";</script>');
	}
	

    function debug($array){
        echo "<pre>";
        print_r($array);
        echo "</pre><br>";
    }
    
    function console_log($data){
        echo '<script>';
        echo 'console.log('. json_encode($data).')';
        echo '</script>';
    }