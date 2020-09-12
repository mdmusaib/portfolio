<?php
    $key=$_GET['key'];
    $array = array();
    $con=mysqli_connect("localhost","root","","live_search");
    $query=mysqli_query($con, "select * from product where name LIKE '%{$key}%'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row;
    }
    echo json_encode($array);
    mysqli_close($con);
?>
