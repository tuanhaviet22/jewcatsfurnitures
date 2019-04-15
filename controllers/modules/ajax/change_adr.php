<?php   
	if($_POST){
        $usn = $_SESSION['CUSTOMERNAME'];
        $sql = "SELECT * FROM tbl_customers 
                WHERE cus_usn = '$usn'";
        $arr = $db -> fetchOne($sql);
        $id = $arr['id'];
        $adr = $_POST['txtadr'];

        if(strlen($adr) > 0){
            $arr1 = array(
                "cus_address" => $adr
            );
            $db -> updateTbl('tbl_customers',$arr1,"id = '{$id}'");
            echo json_encode('');	
        }else{
			echo json_encode('errors');			
        }        
	}	
	exit(0);