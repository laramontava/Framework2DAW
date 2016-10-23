<section >
    <div class="container">
        <div id="list_prod" class="row text-center pad-row">
            <section id="home" class="head-main-img">

               <div class="container">
           <div class="row text-center pad-row" >
            <div class="col-md-12">
              <h1>  CREATE PRODUCTS  </h1>
                </div>
               </div>
            </div>

       </section>
    <!--/.HEADING END -->
            
            <?php
            if (isset($arrData) && !empty($arrData)) {
                foreach ($arrData as $product) {
                    ?>
                    <a id="prod" href="index.php?module=products&idProduct=<?php echo $product['id'] ?>" >
                        <img class="prodImg" src=<?php echo $product['avatar'] ?> alt="product" >
                        <p><?php echo $product['name'] ?></p>
                        <p id="p2"><?php echo $product['price'] ?>€</p>
                    </a>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>