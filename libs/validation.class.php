<?php
    class validation {
        public function isNumber($str) {
            $preg = '/^[0-9]+$/';
            return preg_match($preg, $str);
        }
      	public function isMail($str) {
            $preg = '/^[a-zA-Z]+\@[a-z0-9]+\.com?\.vn?$/';
            return preg_match($preg, $str);
        }  
        public function isText($str) {
            $preg = '/^[a-zA-Z ]+$/';
            return preg_match($preg, $str);
        }
    }
