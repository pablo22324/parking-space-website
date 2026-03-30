<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    padding: 20px;
}

h2 {
    color: #333;
}

form {
    margin-top: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input, select {
    padding: 8px;
    margin: 10px 0;
    width: 200px;
}

button {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <?php
    session_start();
    include('config.php');
    
?>
<?php
    if(isset($_SESSION['user_id']))
    {
    ?>
    <script>document.getElementById("kontener").style.display = "none"</script>
    <?php
        ?>
        <div id="wynajmy">
        <form  method="post">
            <label for="meijsce">Numer miejsca</label>
            <select name="miejsce" id="miejsce" required >
            </select>
            <script src="skrypty.js">

            </script> 
                <label for="od">data rozpoczęcia wynajmu</label>
                <input type="date" name="od" id="od" required>
                <label for="do">data zakończenia wynajmu</label>
                <input type="date" name="do" id="do" required><br>
                <input type="submit" value="zakoncz">
            
<?php
if(!empty($_POST['miejsce']))
{
    $i=0;
$numer=htmlspecialchars(trim($_POST['miejsce']));
$od=htmlspecialchars(trim($_POST['od']));
$do=htmlspecialchars(trim($_POST['do']));
$query='SELECT * FROM wynajem 
WHERE numer_miejsca = "'.$numer.'"
AND (
    (data_rozpoczecia BETWEEN "'.$od.'" AND "'.$do.'") 
    OR (data_zakonczenia BETWEEN "'.$od.'" AND "'.$do.'")  
    OR (data_rozpoczecia <= "'.$od.'" AND data_zakonczenia >= "'.$do.'")
);';
$result=mysqli_query($conn,$query);
while($row=
mysqli_fetch_assoc($result))
{
    if(true)
    {
        echo '<br>to miejsce jest juz zajete albo bedzie zajete w tym okresie';
        ;
        $i=1;
    }
}
if($i!=1)
{
    echo '<br>miejsce zostało wynajęte';
    $query='insert into wynajem (data_rozpoczecia,data_zakonczenia,id_klienta,numer_miejsca) values (?,?,?,?)';
    $stmt=mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,'ssii',$od,$do,$_SESSION['user_id'],$numer);
    mysqli_stmt_execute($stmt);
}
}
?>
</form>
        </div>
        <div id="uslugi">
            <form action="uslugi.php" method="post">

            </form>
        </div>
        <div id="platnosci">
            <form action="platnosci.php">
            
            </form>
        </div>
        <?php

    }

    
?>
</body>
</html>