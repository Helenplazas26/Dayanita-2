<div class="mt-5">
    <h4 class="display-4"> Actualizar Producto </h4>
</div>
    <?php
        foreach ($productos as $pro){
    ?>
    <form action="<?php echo getUrl("Productos","Productos","postUpdate"); ?>" method="post" enctype='multipart/form-data'><!-- /../../ es para devolverse en la ruta de las carpetas-->
    <br>
        <div class="row mt-5">
            <input type="hidden" name="codigoProduc" value="<?php echo $pro['codigoProduc']?>" class="form-control">
            <br>
            
            <br>
            <input type="hidden" name="iniCan" value="<?php echo $pro['cantidad']?>" class="form-control">
            <br>

            <div class="form-group col-md-4">
                <label for="">Nombre</label>
                <input type="text" name="nombre" value="<?php echo $pro['nombre']?>" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label for="">Cantidad</label>
                <input type="number" name="cantidad" placeholder="Ingrese las nuevas cantidades" class="form-control"value='<?php echo $pro['cantidad'] ?>'>
            </div>
            <div class="form-group col-md-4">
                <label for="">Detalle Producto</label>
                <input type="text" name="detalle" placeholder="Ingrese el nuevo detalle" class="form-control"value='<?php echo $pro['detalleProduc']?>'>
            </div>
            
            <div class="col-md-4">
                <label for="id_categoria">Categoria</label>
                <select name="id_categoria" id="" class="form-control">
                    <option value="">Seleccione...</option>
                    <?php
                        foreach($categorias as $cat){
                            if($cat['codigoCate'] === $pro['id_categoria']){
                                $selected = "selected";
                            }else{
                                $selected = "";
                            }
                            echo "<option value='".$cat['codigoCate']."' $selected>".$cat['nombreCate']."</option>";
                        }
                    ?>
                </select>
            </div>
            
        </div>
        <div class="row mt-5">
            <div class="form-group col-md-6">
                <label for="">Precio</label>
                <input type="number" name="precio" value="<?php echo $pro['precio']?>" class="form-control">
                
            </div>
            <div class="form-group col-md-6">
                <label for="" class="d-block">Imagen</label>
                <img src="<?php echo $pro['imagenProducto'] ?>" id="imagen" width="150px">
                <input type="hidden" name="rutaImagen" value='<?php echo $pro['imagenProducto'] ?>'>
                <button type="button" class="btn btn-primary" id="cambiarImagen">Cambiar imagen</button>
                <div id="nuevaImagen">
                    
                </div> 
            </div>
        </div>
        <button class= " btn btn-outline-info mt-5  btn-lg" type="submit">Guardar Cambios</button>
    </form>
    
    <?php
        }
    ?>
    <a href='<?php echo getUrl('Productos','Productos','getProductos') ?>'>
        <button class= " btn btn-outline-warning mt-5  btn-lg">Volver</button>
    </a>
</div>
</body>
</html>