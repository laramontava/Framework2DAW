<div id="list_prod" class="row text-center pad-row">
            <section id="home" class="head-main-img">

               <div class="container">
           <div class="row text-center pad-row" >
            <div class="col-md-12">
              <h1>  LIST PRODUCTS  </h1>
                </div>
               </div>
            </div>

       </section>
    <!--/.HEADING END -->

<section >
    <div class="container">
        <div id="list_prod" class="row text-center pad-row">
            <?php
            if (isset($arrData) && !empty($arrData)) {
                foreach ($arrData as $product) {
                    //echo $productos['id'] . " " . $productos['nombre'] . "</br>";
                    //echo $productos['descripcion'] . " " . $productos['precio'] . "</br>";
                    ?>
                    <div class="col-md-4 col-sm-4">
                    <a id="prod" href="index.php?module=products&idProduct=<?php echo $product['id'] ?>" >
                        <img class="avatar" src=<?php echo $product['avatar'] ?> alt="product" >
                        <p><?php echo $product['name'] ?></p>
                        <p id="p2"><?php echo $product['price'] ?>€</p>
                    </a>
                  </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>