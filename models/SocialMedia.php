<?php
     class SocialMedia extends Conectar{


        public function get_socialMedia(){
            $social = parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM socialmedia";
            $sql=$social->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function get_socialMediaXid(){
            $social = parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM socialmedia WHERE socmed_id=?";
            $sql=$social->prepare($sql);
            $sql->binValue(1,$socmed_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function insert_socialMedia($socmed_icono,$socmed_url){
            $social = parent::conexion();
            parent::set_names();
            $sql="INSERT INTO socialmedia(socmed_id,socmed_icono,socmed_url,est)
                   VALUES(NULL,?,?,1)";
            $sql=$social->prepare($sql);
            $sql->binValue(1,$socmed_icono);
            $sql->binValue(2,$socmed_url);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } 
        
        public function update_socialMedia($socmed_id,$socmed_icono,$socmed_url){
            $social = parent::conexion();
            parent::set_names();
            $sql="UPDATE socialmedia 
                    SET
                        socmed_icono = ?
                        socmed_url = ?
                    WHERE
                        socmed_id = ?";
            $sql=$social->prepare($sql);
            $sql->binValue(1,$socmed_icono);
            $sql->binValue(1,$socmed_url);
            $sql->binValue(2,$socmed_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();

        }

        public function delete_socialMedia(){
            $social = parent::conexion();
            parent::set_names();
            $sql="UPDATE social_media
                    SET
                        est= 0
                    WHERE
                        socmed_id = ?";
            /* $sql = "DELETE FROM social_media WHERE socmed_id = ?"; */
            $sql=$social->prepare($sql);
            $sql->binValue(1,$socmed_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

     }