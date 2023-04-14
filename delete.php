<?php
session_start();
require_once "../config.php";

if(isset($_GET["id"])){
    $id = $_GET["id"];
    /*$sql1 = "SELECT * FROM `nhan_vien`";
    $result1 = mysqli_query($conn, $sql1); 
    $row1 = mysqli_fetch_array($result1);
    $manv = $row1['MaNV'];*/
    echo $id;
    $sql = "DELETE FROM `nhan_vien` WHERE `MaNV` = $id";
    $result = mysqli_query($conn, $sql );
    echo $sql;
    header("location: employ_info.php");

}
?>