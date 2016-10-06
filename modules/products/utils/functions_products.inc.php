<?php
    function val_formproduct($product){
        $error = array();
        $valido = true;
    //    echo json_encode($valido);
    //    exit;
        $filtro = array(
            'id' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array('regexp' => '/^[1-9]{8}$/')
                ),
            'name' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array('regexp' => '/^[A-Z,a-z]{2,30}$/')
                ),
            'description' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array('regexp' => '/^[A-Z,a-z 1-9]{2,300}$/')
                ),
            'datepicker1' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array('regexp' => '/^(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d$/')
                ),
            'datepicker2' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array('regexp' => '/^(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d$/')
                ),
            'price' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array('regexp' => '/^[1-9]{1,10}$/')
                ),
            'stock' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array('regexp' => '/^[1-9]{1,10}$/')
                )
            );
        
        $resultado = filter_var_array($product, $filtro);
        
        $resultado['category'] = $product['category'];
        $resultado['condition'] = $product['condition'];
        $resultado['datepicker1'] = $product['datepicker1'];
        $resultado['datepicker2'] = $product['datepicker2'];
        
/*        if($resultado['datepicker1'] && $resultado['datepicker2']){
            $val = validate_date($_POST['datepicker1'], $_POST['datepicker2']);
            if(!$val){
                $error['datepicker2'] = 'Error datepicker2';
                $valido = false;
            }
        }*/
        
        if(count($resultado['category']) <= 1){
            $error['category']='You have to choose 2 categories';
            $valido = false;
        }
        
        if($resultado != null && $resultado){
            if(!$resultado['id']){
                $error['id']='ID must be 8 numbers';
                $valido = false;
            }
            
            if(!$resultado['name']){
                $error['name']='Name must be 2 to 30 letters';
                $valido = false;
            }
            
            if(!$resultado['description']){
                $error['description']='Description must be 2 to 300 characters';
                $valido = false;
            }
            
            if(!$resultado['price']){
                $error['price']='Rate have format 000.00';
                $valido = false;
            }
            
            if(!$resultado['stock']){
                $error['stock']='Stock has only absolute numbers';
                $valido = false;
            }
        }else{
            $valido = false;
        };
        
        
        return $return = array('resultado' => $valido, 'error' => $error, 'datos' => $resultado);
        
    }
    
/*    function validate_date($firstdates, $seconddates){
        $firstdate = date("d/m/Y", strtotime($firstdates));
        $seconddate = date("d/m/Y", strtotime($seconddates));
        
        list($day_f, $month_f, $year_f) = split('/', $firstdate);
        list($day_s, $month_s, $year_s) = split('/', $seconddate);
        
        $datefirst = new DateTime($year_f . '/' . $month_f . '/' . $day_f);
        $datesecond = new DateTime($year_s . '/' . $month_s . '/' . $day_s);
        if($datesecond<$datefirst){
            return false;
        }else{
            return true;
        }
        
    }   */
    //index.php, header.php (titulo cambia), menu.php, utils/upload.php
    //modulo -> functionsusers.inc.php, create_users.php, 
    // result_users.php, list_users.js, users.js, controller_users.class.php
    