<?php
  
	include ($_SERVER['DOCUMENT_ROOT'] . "/Framework/utils/upload.php");
	include ($_SERVER['DOCUMENT_ROOT'] . "/Framework/modules/products/utils/functions_products.inc.php");
	include ($_SERVER['DOCUMENT_ROOT'] . "/Framework/utils/common.inc.php");
	session_start();

    ///////////////////  UPLOAD  ///////////////////
	if((isset($_GET["upload"])) && ($_GET["upload"] == true)){
			   
	    $result_avatar = upload_files();
	    $_SESSION['result_avatar'] = $result_avatar;
		echo json_encode($result_avatar);
    	//exit;
	}

	///////////////////  ALTA  ///////////////////
	if ((isset($_POST['alta_products_json']))){
	    alta_products();
	}

	function alta_products(){
		
		$jsondata = array();
	    $productJSON = json_decode($_POST["alta_products_json"], true);
		
	    $result = val_formproduct($productJSON);
	    
		
	    if (empty($_SESSION['result_avatar'])) {
	        $_SESSION['result_avatar'] = array('resultado' => true, 'error' => "", 'datos' => 'media/default-avatar.png');
	    }
		
	    $result_avatar = $_SESSION['result_avatar'];
		
	
	    if (($result['resultado']) && ($result_avatar['resultado'])) {
	    	
	        $arrArgument = array(
	        	'id' => ucfirst($result['datos']['id']),
	            'name' => ucfirst($result['datos']['name']),
	            'description' => ucfirst($result['datos']['description']),
	            'condition' => $result['datos']['condition'],
	            'datepicker1' => $result['datos']['datepicker1'],
	            'datepicker2' => $result['datos']['datepicker2'],
	            'price' => $result['datos']['price'],
	            'stock' => $result['datos']['stock'],
	            'category' => $result['datos']['category'],
	            'avatar' => $result_avatar['datos']
	        );
	        
	        
			/////////////////insert into BD////////////////////////
        $arrValue = false;
        $path_model = $_SERVER['DOCUMENT_ROOT'] . '/Framework/modules/products/model/model/';
        $arrValue = loadModel($path_model, "products_model", "create_user", $arrArgument);
        echo json_encode($arrValue);
        die();

/*        if ($arrValue)
            $mensaje = "Su registro se ha efectuado correctamente, para finalizar compruebe que ha recibido un correo de validacion y siga sus instrucciones";
        else
            $mensaje = "No se ha podido realizar su alta. Intentelo mas tarde";

        $_SESSION['user'] = $arrArgument;
        $_SESSION['msje'] = $mensaje;
        $callback = "index.php?module=users&view=results_users";

        $jsondata["success"] = true;
        $jsondata["redirect"] = $callback;
        echo json_encode($jsondata);*/
        //exit;
	
	        //redirigir a otra página con los datos de $arrArgument y $mensaje
	    /*    $_SESSION['product'] = $arrArgument;
	        $_SESSION['msje'] = $mensaje;
	        $callback = "index.php?module=products&view=results_products";
			
	        $jsondata["success"] = true;
	        $jsondata["redirect"] = $callback;
	        echo json_encode($jsondata);
	        */
	    } else {
	        $jsondata["success"] = false;
	        $jsondata["error"] = $result["error"];
	        $jsondata["error_avatar"] = $result_avatar['error'];        
	        $jsondata["success1"] = false;
	        if ($result_avatar['resultado']) {
	            $jsondata["success1"] = true;
	            $jsondata["img_avatar"] = $result_avatar['datos'];
	        }
	        echo json_encode($jsondata);
	       // header('HTTP/1.0 400 Bad error');
	        
	    }
	}


      ///////////////////  DELETE  ///////////////////
      if ((isset($_GET["delete"])) && ($_GET["delete"] == true)) {
            $result = remove_files();
			
        	echo json_encode($result);
        //	exit;
           
      }

	///////////////////  LOAD  ///////////////////
	if (isset($_GET["load"]) && $_GET["load"] == true) {
    	$jsondata = array();
    	if (isset($_SESSION['product'])) {
        	//echo debug($_SESSION['user']);
        	$jsondata["product"] = $_SESSION['product'];
    	}
    	if (isset($_SESSION['msje'])) {
        	//echo $_SESSION['msje'];
        	$jsondata["msje"] = $_SESSION['msje'];
    	}
    	$jsondata["avatar"] = $_SESSION['result_avatar'];
    	close_session();
    	echo json_encode($jsondata);
    	exit;
	}

	function close_session() {
    	unset($_SESSION['product']);
    	unset($_SESSION['msje']);
    	$_SESSION = array(); // Destruye todas las variables de la sesión
    	session_destroy(); // Destruye la sesión
	}
		
		
		
	if ((isset($_GET["load_data"])) && ($_GET["load_data"] == true)) {
    	$jsondata = array();

    if (isset($_SESSION['product'])) {
        $jsondata["product"] = $_SESSION['product'];
        echo json_encode($jsondata);
        exit;
    } else {
        $jsondata["product"] = "";
        echo json_encode($jsondata);
        exit;
    }
}