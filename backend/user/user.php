<?php

//open database by mysqli
$con = mysqli_connect("localhost", "root", "", "can302ass");
//�������� ����root ����� database��ʱ���
if (mysqli_connect_errno($con)) { 
    //�������ʧ�ܾ���ʾ��仰
    die("Connect to MySQL failed: " . mysqli_connect_error()); 
}

//a safe method to recieve post data
function mypost($str) { //�������ݵķ���
    $val = !empty($_POST[$str]) ? $_POST[$str] : '';
    return $val;

}       




//receive query parameters.�ֶ� ��ʱ���
$user_id = mypost('user_id');
$user_name = mypost('user_name');
$coupon_hold = mypost('coupon_hold');


//add the received data to database
if (isset($_POST['add'])) {
    $sql = "INSERT INTO `user` (`user_id`, `user_name`, `coupon_hold`) 
    VALUES ( '".$user_id."', '".$user_name."', '".$coupon_hold."')";
    //$sql = "INSERT INTO `aaa` (`aaa`) VALUES ('".$first."')";
    $query = mysqli_query($con,$sql);
    if (!$query) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
    }
//$query������
json_encode($query);
} 

//query the data from database
if (isset($_POST['search'])) {
    $sql = "select * from user where user_id LIKE '%".$user_id."%'" ;
    $query = mysqli_query($con,$sql);    
     json_encode($query);
} 
else {
    $sql = "select * from user";
    $query = mysqli_query($con,$sql);    
    json_encode($query);
}

//delete
if (isset($_POST['delete'])) {
    $sql = "Delete from user where user_id LIKE '%".$user_id."%'" ;
    $query1 = mysqli_query($con,$sql); 
    if($query1){
        echo "delete success";
    }else{
        echo "Error: " .mysqli_error($con);
    }
    $sql="select * from user";
    $query = mysqli_query($con,$sql); 
     json_encode($query);
}

//update
if(isset($_POST['update'])){
$sql = "update user set user_name='{$user_name}',coupon_hold='{$coupon_hold}' 
where user_id={$user_id}" ;
$query2 = mysqli_query($con,$sql); 
if($query2){
        echo "update success";
    }else{
        echo "Error: " .mysqli_error($con);
    }
    $sql="select * from user";
    $query = mysqli_query($con,$sql); 
     json_encode($query);
}

?>