<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'] . "/Framework/utils/upload.php");
	include ($_SERVER['DOCUMENT_ROOT'] . "/Framework/modules/products/utils/functions_products.inc.php");
	include ($_SERVER['DOCUMENT_ROOT'] . "/Framework/utils/common.inc.php");
	
    ///////////////////  UPLOAD  ///////////////////
	if((isset($_GET["upload"])) && ($_GET["upload"] == true)){
			   
	    $result_avatar = upload_files();
	    $_SESSION['result_avatar'] = $result_avatar;
		//echo json_encode($result_avatar);
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
	            'pais' => strtoupper($result['datos']['pais']),
				'provincia' => strtoupper($result['datos']['provincia']),
				'poblacion' => strtoupper($result['datos']['poblacion']),
	            'avatar' => $result_avatar['datos']
	        );
	   
	        
			/////////////////insert into BD////////////////////////
        $arrValue = false;
         
        $path_model = $_SERVER['DOCUMENT_ROOT'] . '/Framework/modules/products/model/model/';
       
        $arrValue = loadModel($path_model, "products_model", "create_products", $arrArgument);
		
        if ($arrValue)	
            $mensaje = "The product has been saved.";
        else
            $mensaje = "An error occurred.";
            
		
        $_SESSION['product'] = $arrArgument;
        $_SESSION['msje'] = $mensaje;
        $callback = "index.php?module=products&view=results_products";

        $jsondata["success"] = true;
        $jsondata["redirect"] = $callback;
        echo json_encode($jsondata);
        
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
	    	header('HTTP/1.0 400 Bad error');
	    }
	}


      ///////////////////  DELETE  ///////////////////
      if ((isset($_GET["delete"])) && ($_GET["delete"] == true)) {
         //   $result = remove_files();
        //	echo json_encode($result);
        //	exit;
        $_SESSION['result_avatar'] = array();
    	$result = remove_files();
    	if ($result === true) {
        	echo json_encode(array("res" => true));
    	} else {
	        echo json_encode(array("res" => false));
    	}
           
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
		
		
	///////////////////  LOAD DATA  ///////////////////	
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

	/////////////////////////   LOAD PAIS   //////////////////////////
	if(  (isset($_GET["load_pais"])) && ($_GET["load_pais"] == true)  ){
		$json = array();
		
    	$url = 'http://www.oorsprong.org/websamples.countryinfo/CountryInfoService.wso/ListOfCountryNamesByName/JSON';
    	
		$path_model=$_SERVER['DOCUMENT_ROOT'].'/Framework/modules/products/model/model/';
		$json = loadModel($path_model, "products_model", "obtain_paises", $url);
		
		if($json){
			echo $json;
			exit;
		}else{
			$json = "error";
			echo $json;
			exit;
		}
	}
	
	/////////////////////////////////////////////////// load_provincias
	if(  (isset($_GET["load_provincias"])) && ($_GET["load_provincias"] == true)  ){
		$jsondata = array();
        $json = array();
	
		$path_model=$_SERVER['DOCUMENT_ROOT'].'/Framework/modules/products/model/model/';
		
		$json = loadModel($path_model, "products_model", "obtain_provincias");
		//echo json_encode($json);
		//exit;
		if($json){
			$jsondata["provincias"] = $json;
			echo json_encode($jsondata);
			exit;
		}else{
			$jsondata["provincias"] = "error";
			echo json_encode($jsondata);
			exit;
		}
	}
	
	/////////////////////////////////////////////////// load_poblaciones
	if(isset($_POST['idPoblac']) ){
	    $jsondata = array();
        $json = array();
	
		$path_model=$_SERVER['DOCUMENT_ROOT'].'/Framework/modules/products/model/model/';
		$json = loadModel($path_model, "products_model", "obtain_poblaciones", $_POST['idPoblac']);
	
		if($json){
			$jsondata["poblaciones"] = $json;
			echo json_encode($jsondata);
			exit;
		}else{
			$jsondata["poblaciones"] = "error";
			echo json_encode($jsondata);
			exit;
		}
	}