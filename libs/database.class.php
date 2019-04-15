<?php
	class database extends PDO {
		protected $_db;

		public function __construct($dsn, $usn, $pwd) {
			try {
				$this->_db = new PDO($dsn, $usn, $pwd);
			}
			catch(PDOException $e) {
				echo "No connection to Database".$e->getMessage();
			}
		}

		public function fetchAll($sql){
            $stmt = $this->_db->prepare($sql);
            $stmt->execute();
            $rs = $stmt->fetchAll();
            return $rs;
        }
        
        public function fetchOne($sql){
            $stmt = $this->_db->prepare($sql);
            $stmt->execute();
            $rs = $stmt->fetchAll();
            foreach($rs as $rs_v) return $rs_v;
        }

        public function insertOneRecord($tbl, $arr) {
        	$keys_arr = implode(",", array_keys($arr));
        	$values = array_values($arr);

        	foreach ($values as $v) {
        		$values_arr[] = "'".$v."'";
        	}
        	$values_arr = implode(",", $values_arr);

        	$sql = "INSERT {$tbl} ({$keys_arr}) VALUES ({$values_arr})";
        	$stmt = $this->_db->prepare($sql);
            $stmt->execute();
        }

        public function delRecord($tbl, $condition){
            $sql = "DELETE FROM {$tbl} WHERE {$condition}"; 
            $stmt = $this->_db->prepare($sql);
            $stmt ->execute();
        }

		public function updateTbl($tbl, $arr, $condition) {
			$keys_arr = array_keys($arr);
        	$values = array_values($arr);

        	foreach ($values as $v) {
        		$values_arr[] = "'".$v."'";
			}
			
			$txt = "";
			for($i = 0; $i < count($keys_arr) - 1; $i++){
                $txt .= "{$keys_arr[$i]} = {$values_arr[$i]},";
            }
			$txt .= "{$keys_arr[count($keys_arr) - 1]} = {$values_arr[count($keys_arr) - 1]}";
			
			$sql = "UPDATE {$tbl} SET {$txt} WHERE {$condition}";
            $stmt = $this->_db->prepare($sql);
            $stmt->execute();
		}

		public function getSelector($arr, $slt_name, $forcus_val){
			// arr_v: 0 => value, 1 => title
            $txt = "<select name='{$slt_name}' class='form-control'><option value='-1'>-- oOo --</option>";
            foreach($arr as $arr_v){
                if($arr_v[0] == $forcus_val)
                    $txt .= "<option value='{$arr_v[0]}' selected>{$arr_v[1]}</option>";
                else $txt .= "<option value='{$arr_v[0]}'>{$arr_v[1]}</option>";
			}
			$txt .= "</select>";
            return $txt;
        }
	}