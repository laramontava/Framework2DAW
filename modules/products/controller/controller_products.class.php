<?php
  
	//include('modules/products/utils/functions_products.inc.php');
	include ($_SERVER['DOCUMENT_ROOT'] . "/Framework/utils/upload.php");
	session_start();

	if ((isset($_POST['alta_products_json']))){
	    alta_products();
	}

	function alta_products(){
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
	}


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

