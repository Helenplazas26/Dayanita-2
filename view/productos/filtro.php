<?php foreach ($filtro as $produc) { ?>
      <div class="col-md-4 mb-4">
          <form action="<?php echo getUrl("Productos", "Productos", "productos"); ?>" method="post" enctype="multipart/form-data">
              <div class="card h-100" style="width: 18rem;">
                  <input type="hidden" name="codigoProduc" value="<?php echo $produc['codigoProduc']; ?>" class="form-control">
                  <img src="<?php echo $produc['imagenProducto']; ?>" id="imagen" width="40%" class="card-img-top">
                  <div class="card-body">
                      <h5 class="card-title"><?php echo $produc['nombre']; ?></h5>
                      <p class="card-text">Precio: <?php echo $produc['precio']; ?></p>
                      <p class="card-text">Categoría: <?php echo $produc['nombreCate']; ?></p>
                      <button class="btn btn-outline-warning mt-3 btn-lg" type="submit">Ver Detalle</button>
                  </div>
              </div>
          </form>
      </div>
  <?php } ?>