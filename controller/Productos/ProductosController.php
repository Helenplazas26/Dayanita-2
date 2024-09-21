<?php
    include_once "../modelo/Productos/ProductosModel.php";
    session_start();

    class ProductosController{
        //ver productos
        public function getProductos() {
            $obj=new ProductosModel();
            $sql="SELECT P.codigoProduc,P.nombre,P.precio,P.cantidad,P.detalleProduc,C.nombreCate, P.imagenProducto FROM producto P JOIN categoria C ON C.codigoCate=P.id_categoria ORDER BY P.codigoProduc";
            $producto= $obj->consultar($sql);
            include_once "../view/productos/consult.php";
        }

        public function getCreate(){
            $obj= new ProductosModel();
            $sql= "SELECT * FROM categoria WHERE id_estado=1";
            $categorias= $obj->consultar($sql);
            include_once "../view/Productos/create.php";
        }

     

        public function postCreate(){
            $obj= new ProductosModel();
            //dd($_POST);
            $nombre= $_POST['nombreP'];
            $precio= $_POST['precio'];
            $cantidad= $_POST['cantidad'];
            $id_categoria=$_POST['codigoCate'];
            $detalle_producto=$_POST['detalleProduc'];

            if (empty($nombre)) {
                echo "El nombre es obligatorio";
                return;
            }

            $imagen =$_FILES['imagen']['name'];

            $ruta="img/$imagen";
            
            move_uploaded_file($_FILES['imagen']['tmp_name'],$ruta);

            $id= $obj->autoincremente("producto","codigoProduc");
            
            $sql="INSERT INTO producto VALUES($id,'$nombre',$precio,$cantidad, $detalle_producto,$id_categoria,'$ruta',1)";
            $ejecutar = $obj->insertar($sql);

            if ($ejecutar){
                redirect(getUrl("Productos","Productos","getProductos"));
            }else{
                echo"No se pudo insertar el producto";
            }
        }
        public function productos(){
            $obj= new ProductosModel();
            $idProduc=$_POST['codigoProduc'];
            $sql="SELECT P.codigoProduc,P.nombre,P.precio,P.cantidad,P.detalleProduc,C.nombreCate,P.imagenProducto FROM producto P JOIN categoria C ON C.codigoCate=P.id_categoria WHERE codigoProduc=$idProduc";
            $productos= $obj->consultar($sql);
            include_once "../view/productos/verDetalle.php";
        }
        public function getUpdate(){
            $obj= new ProductosModel();
            $id= $_GET['id'];
            $sql="SELECT * FROM PRODUCTO WHERE codigoProduc=$id";
            $productos= $obj->consultar($sql);

            $sql="SELECT * FROM categoria";
            $categorias = $obj->consultar($sql);
            
            include_once "../view/productos/update.php";
        }
        
        public function postUpdate(){
            $obj= new ProductosModel();

            if(isset($_POST['imagenVieja']) && $_FILES['imagenProduc']['name']!=""){
                $ruta_imagen_vieja = $_POST['imagenVieja'];
                $imagen = explode("/",$ruta_imagen_vieja);
                
                if($imagen[1] != "not-found.jpg"){
                    unlink($ruta_imagen_vieja);
                }
            }
            $nombre= $_POST['nombre'];
            $precio= $_POST['precio'];
            $cantidad= $_POST['cantidad'];
            $detalle_producto=$_POST['detalle'];
            $id_categoria=$_POST['id_categoria'];
            $codigoProduc=$_POST['codigoProduc'];


            if(isset($_FILES['imagenProduc'])){
                
                $imagen=$_FILES['imagenProduc']['name'];
                if($_FILES['imagenProduc']['name']==""){
                    $imagen="not-found.jpg";
                }
                $ruta="img/$imagen";

                move_uploaded_file($_FILES['imagenProduc']['tmp_name'],$ruta);

            }else if(isset($_POST['rutaImagen']) && $_POST['rutaImagen']=="img/"){
                $ruta="img/not-found.jpg";
            }else{
                $ruta =$_POST['rutaImagen'];
            }

            $sql = "UPDATE producto SET nombre='$nombre', precio=$precio, cantidad=$cantidad,id_categoria=$id_categoria, imagenProducto='$ruta', detalleProduc='$detalle_producto' WHERE codigoProduc = $codigoProduc";
            $ejecutar = $obj->editar($sql);
            if($ejecutar){
                redirect(getUrl("Productos","Productos","getProductos"));
            }else {
                echo "No se pudo actualizar el producto";
            }

        }

        public function getDelete(){
            $obj= new ProductosModel();
            $id=$_GET['id'];
            
            $sql= "SELECT P.*, C.nombreCate FROM PRODUCTO P, categoria C WHERE P.codigoProduc=$id AND P.id_categoria=C.codigoCate";
    
            $productos= $obj->consultar($sql);
    
            include_once '../view/productos/delete.php';
        }
        public function postDelete(){
            $obj= new ProductosModel();
            $id= $_POST['idProducto'];
    
            $sql="DELETE FROM PRODUCTO WHERE codigoProduc= $id";
            $ejecutar= $obj->eliminar($sql);
    
            if($ejecutar){
                
                redirect(getUrl("Productos","Productos","getProductos"));
            }else{
                echo "No se pudo eliminar el producto";
            
            }
    
            }

            public function filtro(){
                $obj= new ProductosModel();
                $buscar = $_POST['buscar'];
                $sql="SELECT P.codigoProduc,P.nombre,P.precio,P.cantidad,C.nombreCate, P.imagenProducto FROM producto P JOIN categoria C ON C.codigoCate=P.id_categoria WHERE P.nombre LIKE '%$buscar%' OR C.nombreCate LIKE '%$buscar%'";
                $filtro= $obj->consultar($sql);
                include_once '../view/productos/filtro.php';
            }
            public function AgregarCarrito(){
                $obj= new ProductosModel();
                $codProduc=$_GET['id'];
                $salida="";
                $encontrado=false;

                $sql= "SELECT * FROM PRODUCTO where  codigoProduc=$codProduc";

                $producto= $obj->consultar($sql);
                //si no existe un carrito lo crea
                if(!isset($_SESSION['carrito'])){

                    foreach($producto as $produc){ 
                        $_SESSION['carrito'][0]['id']= $produc['codigoProduc'];
                        $_SESSION['carrito'][0]['nombreProduc']= $produc['nombre'];
                        $_SESSION['carrito'][0]['precio']= $produc['precio'];
                        $_SESSION['carrito'][0]['cantidad']= 1;
                        $_SESSION['carrito'][0]['cate']= $produc['id_categoria'];
                        $_SESSION['carrito'][0]['imagenProducto']= $produc['imagenProducto'];
                        $_SESSION['carrito'][0]['id_estado']= $produc['id_estado'];
                        $_SESSION['carrito'][0]['detalle']= $produc['detalleProduc']; 
                        $indice ++;
                        $salida="SE AGREGO EL PRODUCTO ";
                    }
                    
                    //session_destroy();
                   
                }else if (isset($_SESSION['carrito'])){
                    $indice=count($_SESSION['carrito']);
                    $cont = 0;
                    foreach($_SESSION['carrito'] as &$num){
                        if($num['id']==$codProduc){
                            $encontrado=true;
                            $_SESSION['cantidadExistente']= $num['cantidad'];
                            $_SESSION['nombre']= $num['nombreProduc'];
                            $ind= $cont;

                        }
                        $cont++;
                    }
                
                    if ($encontrado==false) {
                        foreach($producto as $produc){ 
                            $_SESSION['carrito'][$indice]['id']= $produc['codigoProduc'];
                            $_SESSION['carrito'][$indice]['nombreProduc']= $produc['nombre'];
                            $_SESSION['carrito'][$indice]['precio']= $produc['precio'];
                            $_SESSION['carrito'][$indice]['cantidad']= 1;
                            $_SESSION['carrito'][$indice]['cate']= $produc['id_categoria'];
                            $_SESSION['carrito'][$indice]['imagenProducto']= $produc['imagenProducto'];
                            $_SESSION['carrito'][$indice]['id_estado']= $produc['id_estado'];
                            $_SESSION['carrito'][$indice]['detalle']= $produc['detalleProduc']; 
                            $indice ++;
                            $salida="SE AGREGO EL PRODUCTO ";
                        }
                    }else{
                        $_SESSION['carrito'][$ind]['cantidad']++; 
                        $salida="SE AGREGO OTRA CANTIDAD DEL PRODUCTO ";

                    }
                    echo $salida;
                    
                        ?><a href='<?php echo getUrl('Productos','Productos','getProductos') ?>'>
                            <button class= " btn btn-outline-warning mt-5  btn-lg">Volver</button>
                              </a>
                        <?php 
                    //unset($_SESSION['carrito']);
                    dd($_SESSION['carrito']);  
            }
        }
}
                
                  
            

    
        
    
?>