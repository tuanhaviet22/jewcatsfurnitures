<?php
    class file{
        public function uploadFile($f_obj, $f_url, $arr_ext, $maxsize){
            $error = array();
            $isUpload = 1;
            
            $f_ext = $this -> getExtention($f_obj['name']);
            
            if(!in_array($f_ext, $arr_ext)){
                $isUpload = 0;
                $error[] = "101";
            }
            if($f_obj['size'] > $maxsize){
                $isUpload = 0;
                $error[] = "102";
            }
            if($isUpload == 1){
                move_uploaded_file($f_obj['tmp_name'], $f_url.$f_obj['name']);
            }
            
            return implode(',', $error);
        }
        
        protected function getExtention($f_name){
            $txt = "";
            for($i = strlen($f_name)-1; $i >= 0; $i--){
                if($f_name[$i] == '.') break;
                else $txt = $f_name[$i].$txt;
            }
            return strtolower($txt);
        }
    }
    

