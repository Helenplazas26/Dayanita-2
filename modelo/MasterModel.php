<?php
    include_once "../lib/conf/connection.php";
    class MasterModel extends Connection{

        public function insertar($sql){ 
            $respuesta= mysqli_query($this->getConnect(),$sql);
            if(!$respuesta){
                echo mysqli_error($this->getConnect());
            }
            return $respuesta;
        }
        public function consultar($sql){ 
            $respuesta= mysqli_query($this->getConnect(),$sql);
            return $respuesta;
        }

        public function eliminar($sql){ 
            $respuesta= mysqli_query($this->getConnect(),$sql);
            return $respuesta;
        }

        public function editar($sql){ 
            $respuesta= mysqli_query($this->getConnect(),$sql);
            return $respuesta;
        }
        // en caso de que se borre alguno, cuando se quiera insertar otro nuevo, tome el valor desde el ultimo id que quedo y no salte a otro, ejemplo de lo que evita (1,2,3),(1,3)
        public function autoincremente($table,$file){ //el file seria el id
            $sql="SELECT MAX($file) FROM $table";
            $respuesta= mysqli_query($this->getConnect(),$sql);
            // lo convierte en un arrayList
            $contador= mysqli_fetch_row($respuesta);
            return $contador[0]+1;
        }

        // recoge el ultimo id que se ingreso 
        public function listId($table,$file){ //el file seria el id
            $sql="SELECT MAX($file) FROM $table";
            $respuesta= mysqli_query($this->getConnect(),$sql);
            $contador= mysqli_fetch_row($respuesta);
            return $contador[0];
        }
        
    }
    
?>