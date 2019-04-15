<?php
	if($_SESSION['ROLE'] <= 3) {
        $xtp = new XTemplate("{$baseUrl}/admin/views/products/edit.html");
        $id = $_GET['id'];
        
        //get old data
        $sql = "SELECT * FROM tbl_products WHERE id = '{$id}'";
        $old_data = $db->fetchOne($sql);
        $xtp->assign("oldName", $old_data['pro_name']);
        $xtp->assign("oldQuantity", $old_data['pro_quantity']);
        $xtp->assign("oldPrice", $old_data['pro_price']);
        $xtp->assign("oldDescription", $old_data['pro_description']);

        // show brand
        $sql = "SELECT id, brd_name FROM tbl_brands WHERE 1";
        $arr = $db->fetchAll($sql);
        $xtp->assign("selectBrand", $db->getSelector($arr, "selectBrand", $old_data['brd_id']));

        // show category
        $sql = "SELECT id, cat_name FROM tbl_categories WHERE 1";
        $arr = $db->fetchAll($sql);
        $xtp->assign("selectCategory", $db->getSelector($arr, "selectCategory", $old_data['cat_id']));

		if($_POST) {
			// get new data
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

            $sql = "SELECT pro_name FROM tbl_products 
                    WHERE (pro_name = '{$name}' 
                    OR pro_img = '{$fname}') 
                    AND id != '{$id}'";
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
                unlink("./images/products/{$old_data['pro_img']}");
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
                if($_FILES['txtFileLocation']['name'] != "") {
                    $arr = array(
                        "pro_name" => $name, 
                        "pro_img" => $fname,
                        "pro_price" => $price,
                        "pro_quantity" => $quantity,
                        "brd_id" => $brand,
                        "cat_id" => $category,
                        "pro_description" => $description
                    );
                }
                else {
                    $arr = array(
                        "pro_name" => $name, 
                        "pro_price" => $price,
                        "pro_quantity" => $quantity,
                        "brd_id" => $brand,
                        "cat_id" => $category,
                        "pro_description" => $description
                    );
                }
				$db->updateTbl("tbl_products", $arr, "id = '{$id}'");
				$msg = "Successful!";
            }
            
            // reload
            header("Location: ?m=products&a=list");
		}

		if($_POST) $xtp->assign("msg", $msg);
		$xtp->assign("baseUrl", $baseUrl);
		$xtp->parse("EDIT");
		$content = $xtp->text("EDIT");
	}
	else {
		$content =  "You are not competent!";
	}