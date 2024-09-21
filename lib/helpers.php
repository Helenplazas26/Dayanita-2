<?php
    //redirigir 
    function redirect($url){
        echo "<script type='text/javascript'>"
        ."window.location.href='$url'"
        ."</script>";
    }

    //para saber que esta llegando por metodo post
    function dd($var){
        // permite acomodar la cosas en forma vertical
        echo "<pre>";
        die(print_r($var));
    }
  
    function getUrl($modulo,$controlador,$funcion,$parametros=false,$pagina=false){

        if ($pagina==false) {
            $pagina="index";
        }

        $url="$pagina.php?modulo=$modulo&controlador=$controlador&funcion=$funcion";
        //para sacar el id,desestructurar todo el arreglo
        // para recorrer arreglos asociativos 
        if ($parametros != false) {
            foreach ($parametros as $key => $valor) {
                $url.="&$key=$valor";
            }
        }
        return $url;
    }

    // organiza las variables y valida su existencia
    function resolve() {
        $modulo=ucwords($_GET['modulo']);
        $controlador=ucwords($_GET['controlador']);
        $funcion=ucwords($_GET['funcion']);

        if (is_dir("../controller/$modulo")) {
            //valida si el modulo - carpeta existe
            if (file_exists("../controller/$modulo/".$controlador."Controller.php")) {
                //valida si el archivo existe
                include_once "../controller/$modulo/".$controlador."Controller.php";
                $nombreClase=$controlador."Controller";
                $objClase= new $nombreClase();
                if (method_exists($objClase,$funcion)) {
                    $objClase->$funcion();
                }
                else{
                    echo"La funcion especificada no existe";
                }
            }
            else{
                echo"El controlador especificado no existe";
            }
        }
        else{
            echo"El modulo especificado no existe";
        }
    }
?>