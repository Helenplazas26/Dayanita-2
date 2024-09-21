
<body>
    <div class="container">
        <h1>Detalle Producto</h1>
            <tbody>
                <div  class="row">
                        <?php
                            foreach ($productos as $produc) {?>
                            <div class="col-md-12">
                            
                                <input type="hidden" name="codigoProduc" value="<?php echo $pro['codigoProduc']?>" class="form-control">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div style="width: 100%;">
                                            <img src="<?php echo $produc['imagenProducto']; ?>" id="imagen" width="100%" class="card-img-top">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 name="nombre" class="card-title"><?php echo $produc['nombre']; ?></h5>
                                            <p class="card-text">Precio: <?php echo $produc['precio']; ?></p>
                                            <p class="card-text">Categoría: <?php echo $produc['nombreCate']; ?></p>
                                            <p class="card-text">Descripcion: <?php echo $produc['detalleProduc']; ?></p>
                                            <a class="btn btn-outline-dark" href='<?php echo getUrl('Productos','Productos','AgregarCarrito',array("id"=>$produc['codigoProduc']))  ?>'>
                                               Agregar  🛒
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                        ?>
                        <a href='<?php echo getUrl('Productos','Productos','getProductos') ?>'>
                            <button class= " btn btn-outline-warning mt-5  btn-lg">Volver</button>
                        </a>
                        
                </div>
            </tbody>
    </div>
    </html>
