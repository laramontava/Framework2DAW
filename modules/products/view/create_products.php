<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css">

<script type="text/javascript" src="modules/products/view/js/controller_products.js" ></script>
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
    <br>
    <form id="form_products" name="form_products">
        <fieldset class="fieldform">
          <div class="form-group">
            <label for="id" class="name_input">Product ID:</label>
            <input class="form-control" name="id" placeholder="Introduce product ID" type="text" id="id" value="">
            <div id="e_id"></div>
          </div>

          <div class="form-group">
            <label for="name" class="name_input">Product name:</label>
            <input class="form-control" name="name" placeholder="Introduce product name" type="text" id="name" value="">
            <div id="e_name"></div>
          </div>

          <div class="form-group">
            <label for="description" class="name_input">Description:</label>
            <textarea class="form-control" name="description" placeholder="Introduce product description" type="text" id="description"
            value=""></textarea>
            <div id="e_description"></div>
          </div>

          <div class="form-group">
            <label for="condition" class="name_input">Condition</label>
            <div class="select_style">
              <select name="condition" id="condition">
                  <option value="New">New</option>
                  <option value="Used">Second hand</option>
              </select>
            </div>
          </div>

          <div class="form-group">
              <label for="date1" class="name_input">Date:</label>
              <input class="form-control" id="datepicker1" type="text" name="datepicker1" placeholder="Introduce date" value = "">
              <div id="e_datepicker1"></div>
          </div>

          <div class="form-group">
              <label for="date2" class="name_input">Refund date:</label>
              <input class="form-control" id="datepicker2" type="text" name="datepicker2" placeholder="Introduce refund date" value = "">
              <div id="e_datepicker2"></div>
          </div>

          <div class="form-group">
            <label for="price" class="name_input">Rate:</label>
            <input class="form-control" name="price" placeholder="Introduce product rate" type="text" id="price" value="">
            <div id="e_price"></div>
          </div>

          <div class="form-group">
            <label for="stock" class="name_input">Stock:</label>
            <input class="form-control" name="stock" placeholder="How many products do you have?" type="text" id="stock" value="">
            <div id="e_stock"></div>
          </div>

          <div class="form-group">
            <label for="category" class="name_input">Category:</label><br>
            <div>
              <input type="checkbox" name="category[]" class="messageCheckbox" value="Informatica"> <label>Informática</label> <br>
            </div>
            <div>
					    <input type="checkbox" name="category[]" class="messageCheckbox" value="Deporte"> <label>Deporte</label> <br>
					  </div>
					  <div>
					    <input type="checkbox" name="category[]" class="messageCheckbox" value="Ropa"> <label>Ropa</label> <br>
					  </div>
					  <div>
					    <input type="checkbox" name="category[]" class="messageCheckbox" value="Música"> <label>Música</label> <br>
					  </div>
					  <div id="e_category"></div>
          </div>
          <div class="form-group">
            <p>
        			<label for="pais">Pais</label>
        			<select id="pais">
        			</select>
        			<span id="e_pais" class="styerror"></span>
        		</p>
        		<p>
        			<label for="provincia">Provincia</label>
        			<select id="provincia">
        			</select>
        			<span id="e_provincia" class="styerror"></span>
        		</p>
        		<p>
        			<label for="poblacion">Poblacion</label>
        			<select id="poblacion">
        			</select>
        			<span id="e_poblacion" class="styerror"></span>
        		</p>
          </div>
        
          <div class="form-group" id="progress">
            <div id="bar"></div>
            <div id="percent">0%</div >
          </div>

          <div class="msg"></div><br/>
          <div id="dropzone" class="dropzone"></div><br/>

          <div class="form-group">
            <button type="button" id="submit_products" name="submit_products" class="button">Enviar</button>
          </div>

          </fieldset>
        </form>
