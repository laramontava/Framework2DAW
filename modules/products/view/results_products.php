       <section id="home" class="head-main-img">
         
               <div class="container">
           <div class="row text-center pad-row" >
            <div class="col-md-12">
              <h1>  RESULTS PRODUCTS  </h1>
                </div>
               </div>
            </div>   
           
       </section>
    <!--/.HEADING END-->
    <!--
    <div class="<?php $_SESSION['typemsage']?>">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         Correct
    </div>-->
<?php
$product = $_SESSION['product'];
debug($product);

foreach ($product as $indice => $valor){
			if($indice == 'category'){
				echo "Category:<br>";
				$category = $product["category"];
				foreach ($category as $indice => $valor) 
					echo "$indice: $valor<br>";
			}else{
				echo "$indice: $valor<br>";
			}
		}
	