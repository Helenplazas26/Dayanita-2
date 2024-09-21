<div class="mt-5">
    <h4 class="display-4"> Registrar Producto </h4>
</div>

<form action="<?php echo getUrl("Productos","Productos","postCreate"); ?>" method="post" enctype="multipart/form-data"  >

    <div class="row mt-3">
            <div class="form-group col-md-4">
                    <label for="">Nombre Producto</label>
                    <input type="text" name="nombreP" placeholder="ingrese el nombre del producto" autofocus class="form-control"> <br><br><!--autofocus sirve para reubicar el mouse en el campo-->
            </div>

            <div class="form-group col-md-4">
                <label for="">Precio</label>
                <input type="number" name="precio" placeholder="ingrese la descripcion" class="form-control">
            </div>
            <div class="form-group col-md-4">    
                <label for="">Cantidad</label>
                <input type="number" name="cantidad" placeholder="ingrese la cantidad del producto" class="form-control">
            </div>
            <div class="form-group col-md-4">    
                <label for="">Detalle</label>
                <input type="text" name="detalle" placeholder="ingrese el detalle del producto" class="form-control">
            </div>
    </div>
    <div class="row mt-3">     
        <div class="col-md-4">
            <label for="">Categoria</label>
            <select name="codigoCate" class="form-control">
                <option value="">Seleccione...</option>
                <?php
                    foreach($categorias as $cat){
                        echo "<option value='".$cat['codigoCate']."'>".$cat['nombreCate']." </option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group col-md-4">    
            <label for="">Imagen</label>
                <input type="file" name="imagen" >
            </div>
    </div>
        <input type="submit" value="registrar" class= "btn btn-outline-info mt-5">
</form>
    </div>
    <a href='../../inicio1.php'>
        <br><br>
        <button class= " btn btn-outline-danger mt-5  btn-lg" >Volver</button>
    </a>
</body>
</html>