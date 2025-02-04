<?php 
require '../config/function.php';


if(isset($_POST['saveUser']))
{
    $name = validate($_POST['username']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $role = validate($_POST['role']);

    if($name != '' || $email != '' || $password !='')
    {
        $query = "INSERT INTO users (username,email,password,role) 
                VALUES ('$name','$email','$password','$role')";
        $result = mysqli_query($conn, $query);

        if($result){
            redirect('users.php','User/Admin Added Successfully');
        }
        else{
            redirect('users-create.php','Something Went Wrong');
        }
    }
    else
    {
        redirect('users-create.php','please fill all the input fields');
    }
}

if(isset($_POST['updateUser']))
{
    $name = validate($_POST['username']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $role = validate($_POST['role']);

    $userId = validate($_POST['userId']);

    $user = getById('users',$userId);
    if($user['status'] != 200){
        redirect('users-edit.php?id='.$userId,'No such id found');
    }

    if($name != '' || $email != '' || $password !='')
    {
        $query = "UPDATE users SET 
                username = '$name' ,
                email = '$email',
                password = '$password',
                role = '$role'
                WHERE id = '$userId' ";

        $result = mysqli_query($conn, $query);

        if($result){
            redirect('users-edit.php?id='.$userId,'User/Admin Updated Successfully');
        }
        else{
            redirect('users-create.php','Something Went Wrong');
        }
    }
    else
    {
        redirect('users-create.php','please fill all the input fields');
    }
}

if(isset($_POST['saveSetting']))
{
    $email1=validate($_POST['email1']);
    $phone1=validate($_POST['phone1']);
    $address=validate($_POST['address']);

    $settingId=validate($_POST['settingId']);

    if($settingId=='insert')
    {
        $query="INSERT INTO settings (email1,phone1,address)
                VALUES ('$email1','$phone1','$address')";
        $result=mysqli_query($conn,$query);
    }

    if(is_numeric($settingId))
    {
        $query="UPDATE settings SET 
                email1='$email1',
                phone1='$phone1',
                address='$address'
                WHERE id='$settingId'
                ";
        $result=mysqli_query($conn,$query);
    }

    if($result){
        redirect('settings.php','Settings Saved');
    }else{
        redirect('settings.php','Something Went Wrong');
    }

}

// ADD CATEGORY
if(isset($_POST['saveCategory']))
{
    $category_name = validate($_POST['category_name']);

    if(!empty($category_name))
    {
        $query = "INSERT INTO categories (name) VALUES ('$category_name')";
        $result = mysqli_query($conn, $query);

        if($result){
            redirect('categories.php', 'Category Added Successfully');
        } else {
            redirect('categories-create.php', 'Something Went Wrong');
        }
    }
    else
    {
        redirect('categories-create.php', 'Please enter a category name');
    }
}

// ADD PRODUCT
if(isset($_POST['saveProduct']))
{
    $category_id = validate($_POST['category_id']);
    $name = validate($_POST['product_name']);
    $description = validate($_POST['product_description']);
    $price = validate($_POST['product_price']);
    $image = $_FILES['product_image']['name'];

    if(!empty($category_id) && !empty($name) && !empty($description) && !empty($price) && !empty($image))
    {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);

        $query = "INSERT INTO products (category_id, name, description, price, image) 
                  VALUES ('$category_id', '$name', '$description', '$price', '$image')";
        $result = mysqli_query($conn, $query);

        if($result){
            redirect('products.php', 'Product Added Successfully');
        } else {
            redirect('products-create.php', 'Something Went Wrong');
        }
    }
    else
    {
        redirect('products-create.php', 'Please fill all fields');
    }
}


?>