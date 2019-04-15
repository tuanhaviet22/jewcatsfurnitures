<?php
	if($_SESSION['ROLE'] <= 3) {
        $xtp = new XTemplate("{$baseUrl}/admin/views/products/add.html");
        
        // show brand
        $sql = "SELECT id, brd_name FROM tbl_brands WHERE 1";
        $arr = $db->fetchAll($sql);
        $xtp->assign("selectBrand", $db->getSelector($arr, "selectBrand", -1));

        // show category
        $sql = "SELECT id, cat_name FROM tbl_categories WHERE 1";
        $arr = $db->fetchAll($sql);
        $xtp->assign("selectCategory", $db->getSelector($arr, "selectCategory", -1));

		if($_POST) {
			// get data
            $name = $_POST['txtName'];
            $price = $_POST['txtPrice'];
            $quantity = $_POST['txtQuantity'];
            $brand = $_POST['selectBrand'];
            $category = $_POST['selectCategory'];
            
            $fname = $_FILES['txtFileLocation']['name'];
            
            $description = $_POST['txtDescription'];

			//validate
            $flag = 1;
            $msg = "";

            if(strlen($name) == 0) {
                $flag = 0;
                $msg .= "invalid product name. ";
            }

            $sql = "SELECT pro_name FROM tbl_products WHERE pro_name = '{$name}' OR pro_img = '{$fname}'";
            $arr = $db->fetchAll($sql);
            if(count($arr) > 0) {
                $flag = 0;
                $msg .= "product name or image exists. ";
            }

            if(!is_numeric($price)) {
                $flag = 0;
                $msg .= "invalid price. ";
            }

            if(!$valid->isNumber($quantity)) {
                $flag = 0;
                $msg .= "invalid quantity. ";
            }

            if($brand == -1) {
                $flag = 0;
                $msg .= "choose 1 brand. ";
            }

            if($category == -1) {
                $flag = 0;
                $msg .= "choose 1 category. ";
            }

			// upload img to server
			if($_FILES['txtFileLocation']['name'] != "" & $flag != 0) {
				$arr_ext = array("jpg", "jpeg", "png", "gif");
				$maxsize = 4000000;
				$url = "./images/products/";
				$errors = $f->uploadFile($_FILES['txtFileLocation'], $url, $arr_ext, $maxsize);
				if(strlen($errors) > 0) {
                    $flag = 0;
                    $msg .= "file uploaded is greater than 4MB or has extension incorrect. ";
                } 
			}

			// send data to database
			if($flag != 0) {
                if($_FILES['txtFileLocation']['name'] != ""){
                    $arr = array(
                        "pro_name" => $name, 
                        "pro_img" => $fname,
                        "pro_price" => $price,
                        "pro_quantity" => $quantity,
                        "brd_id" => $brand,
                        "cat_id" => $category,
                        "pro_description" => $description,
                        "pro_status" => 1
                    );
                }
                else {
                    $arr = array(
                        "pro_name" => $name, 
                        "pro_price" => $price,
                        "pro_quantity" => $quantity,
                        "brd_id" => $brand,
                        "cat_id" => $category,
                        "pro_description" => $description,
                        "pro_status" => 1
                    );
                }
				$db->insertOneRecord("tbl_products", $arr);
				$msg = "Successful!";
			}
		}

		if($_POST) $xtp->assign("msg", $msg);
		$xtp->assign("baseUrl", $baseUrl);
		$xtp->parse("ADD");
		$content = $xtp->text("ADD");
	}
	else {
		$content =  "You are not competent!";
	}