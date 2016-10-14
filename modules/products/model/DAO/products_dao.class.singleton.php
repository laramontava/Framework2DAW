<?php
class userDAO {

    static $_instance;

    private function __construct() {
        
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    public function create_user_DAO($db, $arrArgument) {
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
        
        $sql = "INSERT INTO products (id, name, description, condition1,"
                . " datepicker1, datepicker2, price, stock, category,horror,thriller,adventure,drama, avatar"
                . " ) VALUES ('$id', '$name', '$description', '$condition', '$datepicker1', "
                . " '$datepicker2', '$price', '$stock', '$category', '$horror', '$thriller', '$adventure', '$drama', '$avatar')";
        return $db->ejecutar($sql);
        }

    }


