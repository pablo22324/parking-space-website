<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Globalne ustawienia */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    color: #333;
}

header {
    background-color: #007bff;
    color: white;
    padding: 20px;
    text-align: center;
}

header h1 {
    margin: 0;
    font-size: 36px;
}

h2 {
    color: #007bff;
    font-size: 24px;
    text-align: center;
    margin-top: 20px;
}

footer {
    background-color: #343a40;
    color: white;
    text-align: center;
    padding: 10px;
    position: fixed;
    width: 100%;
    bottom: 0;
}

ul {
    list-style: none;
    padding: 0;
    margin: 20px auto;
    max-width: 600px;
    background-color: white;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

ul li {
    margin: 10px 0;
}

input[type="checkbox"] {
    margin-left: 10px;
}

button {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    cursor: pointer;
    margin-top: 20px;
    display: block;
    width: 100%;
    max-width: 200px;
    margin-left: auto;
    margin-right: auto;
    border-radius: 5px;
}

button:hover {
    background-color: #218838;
}

#cena {
    font-size: 18px;
    font-weight: bold;
    text-align: center;
    margin-top: 20px;
}
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
    </style>
</head>
<body>
    

<?php
session_start();
include('config.php');


?>
<form  method="get">
    <input type="submit" value="odśwież jak nie widzisz swojego wynajmu">
</form>
<form method="post">
<ul  id="uslugi">
</ul>
<ul id="miejsca" >

</ul>
<button type="submit" name="wyslanie">złóż zamówienie</button>
</form>
<div id="cena"></div>
<!-- showing current rents -->
<?php
$query='SELECT * FROM `wynajem` WHERE wynajem.id_klienta=? and current_timestamp() 
BETWEEN wynajem.data_rozpoczecia and wynajem.data_zakonczenia';
$stmt=mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($stmt,'s',$_SESSION['user_id']);
mysqli_stmt_execute($stmt);
$data=mysqli_stmt_get_result($stmt);
if($data)
{
    while($row=mysqli_fetch_array($data))
    {
        $numer=$row['numer_miejsca'];
        echo 
        "<script>
           
         o = document.createElement('li');
            o.value = '".$numer."';
            o.innerHTML = '".$numer."' + ' <input type=\"checkbox\" name=\"miejsca_wybrane[]\" value=\"".$numer."\" onchange=\"updatePrice();\" />';
        
            document.getElementById('miejsca').appendChild(o);
        </script>";
    }

}
 ?>
<!-- showing services -->

<?php
$query='select * from uslugi';
$data=mysqli_query($conn,$query);
if($data)
{
    while($row=mysqli_fetch_array($data))
    {
        $id=$row['id_uslugi'];
        $nazwa=$row['nazwa_uslugi'];
        $cena=$row['cena_uslugi'];
echo 
"<script>
 o = document.createElement('li');
    o.id = '".$id."';
    o.value = '".$nazwa."';
    o.innerHTML = '".$nazwa."' + ' <input type=\"checkbox\" name=\"uslugi_wybrane[]\" value=\"".$cena."@".$id."\" onchange=\"updatePrice();\" />'
    document.getElementById('uslugi').appendChild(o);
</script>";
        ?>
        <script>

        function updatePrice() {
        let zaznaczone_uslugi = document.querySelectorAll(' input[name=\"uslugi_wybrane[]\"]:checked'); 
        let total = 0; 
        let zaznaczone_miejsca = document.querySelectorAll(' input[name=\"miejsca_wybrane[]\"]:checked');

        zaznaczone_uslugi.forEach(function(checkbox) {
            total += parseFloat(checkbox.value);         });
            total *=zaznaczone_miejsca.length;


        document.getElementById('cena').innerHTML = 'Suma: ' + total.toFixed(2) + ' PLN'; 
    }
    
        </script>
        <?php

    }
}

        if($_SERVER['REQUEST_METHOD'] == 'POST')
{
        foreach($_POST['miejsca_wybrane'] as $mw)
    {

        foreach($_POST['uslugi_wybrane']as $el)
        {
            $elementy_uslugi = explode("@",$el);
           $m = count($_POST['miejsca_wybrane'])*count($_POST['uslugi_wybrane']);
           $cp='(?,?),';
            $query="insert into zakupione_uslugi (id_uslugi, numer_miejsca) values (?,?) ";
            $stmt=mysqli_prepare($conn,$query);
            mysqli_stmt_bind_param($stmt,'ii',$elementy_uslugi[1],$mw);
            $result=mysqli_stmt_execute($stmt);

            
        }

    }
    if($result)
    {
        echo 'uslugi zostały zamówione';
    }
}
?>
</body>
</html>