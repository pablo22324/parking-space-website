<?php

include('config.php');
        $query='select * from klienci where klienci.id_klienta=?';
        $stmt=mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($stmt,'i',$_SESSION['user_id']);
    
        mysqli_stmt_execute($stmt);
        $data=mysqli_stmt_get_result($stmt);
        ?>