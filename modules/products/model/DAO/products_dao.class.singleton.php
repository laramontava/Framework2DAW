<?php
class productsDAO {

    static $_instance;
    
    private function __construct() {
        
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    public function create_products_DAO($db, $arrArgument) {
        $id = $arrArgument['id'];
        $name = $arrArgument['name'];
        $description = $arrArgument['description'];
        $condition = $arrArgument['condition'];
        $datepicker1 = $arrArgument['datepicker1'];
        $datepicker2 = $arrArgument['datepicker2'];
        $price = $arrArgument['price'];
        $stock = $arrArgument['stock'];
        $category = $arrArgument['category'];
        $avatar = $arrArgument['avatar'];
        
        $horror = 0;
        $thriller = 0;
        $adventure = 0;
        $drama = 0;
        
        foreach ($category as $indice) {
            if ($indice === 'Informatica')
                $horror = 1;
            if ($indice === 'Deporte')
                $thriller = 1;
            if ($indice === 'Ropa')
                $adventure = 1;
            if ($indice === 'Música')
                $drama = 1;
        }
        $sql = "INSERT INTO products (id, name, description, condition1, datepicker1, datepicker2, price, stock, category, horror, thriller, adventure, drama, avatar) VALUES ('". $id
        ."', '". $name ."', '". $description ."', '". $condition ."' , '". $datepicker1 ."', '". $datepicker2
        ."', '". $price ."', '". $stock ."','". $category ."', '". $horror ."' ,'". $thriller ."', '". $adventure ."', '". $drama ."', '". $avatar ."')";
        return $db->ejecutar($sql);
     
        }
        public function obtain_paises_DAO($url) {
            $ch = curl_init();
            curl_setopt ($ch, CURLOPT_URL, $url);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $file_contents = curl_exec($ch);
            curl_close($ch);
            
            return ($file_contents) ? $file_contents : FALSE;
        }
        
        public function obtain_provincias_DAO() {
            $json = array();
		    $tmp = array();

    		$provincias = simplexml_load_file("../../../resources/provinciasypoblaciones.xml");
    		$result = $provincias->xpath("/lista/provincia/nombre | /lista/provincia/@id");
    		for ($i=0; $i<count($result); $i+=2) {
    			$e=$i+1;
    			$provincia=$result[$e];
    				
    			$tmp = array(
    				'id' => (string) $result[$i], 'nombre' => (string) $provincia	
    			);
    			array_push($json, $tmp);
    		}
            return $json;
        }
        
        public function obtain_poblaciones_DAO($arrArgument) {
            $json = array();
		    $tmp = array();
        
            $filter = (string)$arrArgument;
    	    $xml = simplexml_load_file('../../../resources/provinciasypoblaciones.xml');
		    $result = $xml->xpath("/lista/provincia[@id='$filter']/localidades");
		
        	for ($i=0; $i<count($result[0]); $i++) {
        		$tmp = array(
        			'poblacion' => (string) $result[0]->localidad[$i]	
        		);
        		array_push($json, $tmp);
        	}
            return $json;
        }
    }


