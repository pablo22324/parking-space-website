<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

    /* Stylowanie całej strony */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f7fc;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
    }

    /* Kontener na formularz płatności i informacje */
    .form-container {
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        box-sizing: border-box;
    }

    /* Nagłówki */
    .form-container h3 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    /* Stylowanie dla wyświetlania kwoty zadłużenia */
    #kwota {
        font-size: 24px;
        color: #e74c3c;
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
    }

    /* Pola formularza */
    input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        background-color: #f9f9f9;
        transition: border-color 0.3s ease;
    }

    input[type="number"]:focus {
        border-color: #007bff;
        outline: none;
    }

    /* Przycisk */
    input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    /* Komunikaty o błędach i potwierdzeniach */
    .message {
        text-align: center;
        color: green;
        font-size: 16px;
        margin-top: 20px;
    }

    .message-error {
        color: red;
        font-size: 16px;
        text-align: center;
        margin-top: 20px;
    }
    *
    {
        text-align: center;
    }
</style>

    </style>
</head>
<body>
    


<?php
    session_start();

        include('config.php');
        function dlug($conn)
        {
    $query='select  * from saldo_klientow where id_klienta=? ';
    $stmt=mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,'i',$_SESSION['user_id']);
    mysqli_stmt_execute($stmt);
    $data=mysqli_stmt_get_result($stmt);
    while($row=mysqli_fetch_assoc($data))
    {
        echo "<script> document.getElementById('kwota').innerHTML=\"".$row['dlug']."\"</script>";
    }
}

?>
<div>
<form method="post">
    <h3>oplac naleznosc</h3>
    <div id="kwota"></div> 
    <div id="info"></div>
    <?PHP
     dlug($conn);
    
    ?>
    <input type="number" name="platnosc" id="">
    <input type="submit" value="zaplac naleznosc">
</form>
<form method="post"> <br>
        <input type="submit" value="odśwież jak nie widzisz należności" name="odswiezanie">
    </form>
    </div>
<?php
    if(!empty($_POST['platnosc']))
    {
        $query='INSERT INTO platnosci (id_klienta,data_wplaty,kwota_platnosci) VALUES
(?,current_date(),?);';
    $stmt=mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,'ii',$_SESSION['user_id'],$_POST['platnosc']);
    $result=mysqli_stmt_execute($stmt);
if($result)
{
    echo '<script>document.getElementById(\'info\').innerHTML=\'platność wykonana\'</script>';
    dlug($conn);
}
    }
?>

</body>
</html>