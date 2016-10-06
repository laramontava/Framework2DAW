<?php
  
	//include('modules/products/utils/functions_products.inc.php');
	include ($_SERVER['DOCUMENT_ROOT'] . "/Framework/utils/upload.php");
	include ($_SERVER['DOCUMENT_ROOT'] . "/Framework/modules/products/utils/functions_products.inc.php");
	session_start();

	if ((isset($_POST['alta_products_json']))){
		//echo json_encode("Hola");
		//echo json_encode($_POST['alta_products_json']);
		//exit;
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
	           /* 'last_name' => ucfirst($result['datos']['last_name']),
	            'birth_date' => $result['datos']['birth_date'],
	            'title_date' => $result['datos']['title_date'],
	            'address' => $result['datos']['address'],
	            'user' => $result['datos']['user'],
	            'pass' => $result['datos']['pass'],
	            'email' => $result['datos']['email'],
	            'en_lvl' => strtoupper($result['datos']['en_lvl']),
	            'interests' => $result['datos']['interests'],*/
	            'avatar' => $result_avatar['datos']
	        );
			
	        $mensaje = "User has been successfully registered";
	
	        //redirigir a otra p�gina con los datos de $arrArgument y $mensaje
	        $_SESSION['product'] = $arrArgument;
	        $_SESSION['msje'] = $mensaje;
	        $callback = "index.php?module=products&view=results_products";
			
	        $jsondata["success"] = true;
	        $jsondata["redirect"] = $callback;
	        echo json_encode($jsondata);
	        
	    } else {
	        //$error = $result['error'];
	        //$error_avatar = $result_avatar['error'];
	        $jsondata["success"] = false;
	        $jsondata["error"] = $result['error'];
	        $jsondata["error_avatar"] = $result_avatar['error'];
	
	        $jsondata["success1"] = false;
	        if ($result_avatar['resultado']) {
	            $jsondata["success1"] = true;
	            $jsondata["img_avatar"] = $result_avatar['datos'];
	        }
	        header('HTTP/1.0 400 Bad error');
	        
	    }
	    //echo json_encode($jsondata["success"]);
	    //exit;
	}

/*	function alta_products(){
	   // $jsondata = array();
	   // $productJSON = json_decode($_POST["alta_products_json"], true);

	   $jsondata["success"] = true;
	   $jsondata["response"] = true;

	  	echo("php ------------");
	    echo json_encode("Hola mundo");
	  //  console_log($productJSON);
	  //  $result = validate_product($productJSON);

	  //  echo json_encode($jsondata);
	  //  exit;
	}*/


      ///////////////////  UPLOAD  ///////////////////
			if((isset($_GET["upload"])) && ($_GET["upload"] == true)){
			   
			    $result_avatar = upload_files();
			    
				echo json_encode($result_avatar);
        		exit;
			}

      ///////////////////  DELETE  ///////////////////
      if ((isset($_GET["delete"])) && ($_GET["delete"] == true)) {
            $result = remove_files();
			
        	echo json_encode($result);
        	exit;
           
      }

