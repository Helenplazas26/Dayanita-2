<style>
    /* Estilo para que las imágenes se ajusten sin recortarse */
    .card-img-top {
        object-fit: contain;  
        height: 200px;        
        width: 100%;         
        background-color: #f8f9fa;  
    }

   
    .card {
        min-height: 400px;  
    }
</style>
<body>
<div class="container">
    <h1>Productos</h1>
    <div>
        <input type="text" name="filtro" id="filtro" placeholder="Buscar..." data-url="<?= getUrl('Productos', 'Productos', 'filtro', false, 'ajax'); ?>"><br><br>
    </div>
                <div class="row" id="test">
                    <?php foreach ($producto as $produc) { ?>
                
                        <div class="col-md-4 mb-4">
                            <form action="<?php echo getUrl("Productos", "Productos", "productos"); ?>" method="post" enctype="multipart/form-data">
                                <div class="card h-100" style="width: 18rem;">
                                    <input type="hidden" name="codigoProduc" value="<?php echo $produc['codigoProduc']; ?>" class="form-control">
                                    <img src="<?php echo $produc['imagenProducto']; ?>" id="imagen" width="40%" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $produc['nombre']; ?></h5>
                                        <p class="card-text">Precio: <?php echo $produc['precio']; ?></p>
                                        <p class="card-text">Categoría: <?php echo $produc['nombreCate']; ?></p>
                                        <div class="mt-2 mr-5">
                                            <a class="btn btn-outline-dark" href='<?php echo getUrl('Productos','Productos','getUpdate',array("id"=>$produc['codigoProduc']))  ?>'>
                                                Editar
                                            </a>
                                            <a class="btn btn-outline-dark" href='<?php echo getUrl('Productos','Productos','getDelete',array("id"=>$produc['codigoProduc'])) ?>'>
                                                Eliminar
                                            </a>
                                        </div >
                                        <div class="mt-2">
                                            <button class="btn btn-outline-dark" type="submit">Ver Detalle</button>
                                        </div > 
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </div>
    <a href='../web/index.php'>
        <button class="btn btn-outline-danger mt-2 btn-lg">Editar</button>
    </a>
</div>
