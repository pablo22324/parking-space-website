<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rejestracja </title>
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

    /* Formularz */
    form {
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        box-sizing: border-box;
    }

    /* Nagłówki formularza */
    form h2 {
        text-align: center;
        color: #333;
    }

    /* Pola formularza */
    label {
        font-size: 14px;
        margin-bottom: 8px;
        display: block;
        color: #333;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        background-color: #f9f9f9;
        transition: border-color 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: #007bff;
        outline: none;
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

    /* Błędy rejestracji */
    .error-message {
        color: red;
        font-size: 14px;
        text-align: center;
        margin-top: 10px;
    }

    /* Przestrzeń wokół formularza */
    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        width: 100%;
        box-sizing: border-box;
    }

    /* Zewnętrzne linki */
    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    </style>
</head>
<body>
    <form  method="post">
    <label for="imie">imie</label>
    <input type="text" name="imie" id="imie" required> <br>
    <label for="nazwisko">nazwisko</label>
    <input type="text" name="nazwisko" id="nazwisko required"> <br>
    <label for="numer_telefonu">numer_telefonu</label>
    <input type="text" name="telefon" id="numer_telefonu" required> <br>
    <label for="mail">mail</label>
    <input type="email" name="mail" id="mail" required> <br> 
    <label for="haslo">haslo</label>
    <input type="password" name="haslo" id="haslo" required>
    <input type="submit" value="zarejestruj się">
    </form>
    <?php
    if(!empty($_POST['imie'])&&!empty($_POST['nazwisko'])
    &&!empty($_POST['telefon'])&&!empty($_POST['mail'])&&!empty($_POST['haslo']))
rejestracja();
   
    function rejestracja()
    {
//         $conn=mysqli_connect('spu.tkkom.local','pawel-nieweglowski_garaz_baza',
// 'pass','pawel-nieweglowski_garaz_baza');
$conn=mysqli_connect('127.0.0.1','root','','garaz_baza');
            if($conn)
    {
        $imie=htmlspecialchars(trim($_POST['imie']));
        $nazwisko=htmlspecialchars(trim($_POST['nazwisko']));
        $mail=htmlspecialchars(trim($_POST['mail']));
        $telefon=htmlspecialchars(trim($_POST['telefon']));
        $haslo=sha1(htmlspecialchars(trim($_POST['haslo'])));
        $konsultant_query="SELECT FLOOR(1 + RAND() * COUNT(id_pracownika)) as 'konsultant'
FROM konsultanci";
$result=mysqli_query($conn,$konsultant_query);
while($row = mysqli_fetch_assoc($result))
{
$konsultant= $row['konsultant']; 
}       
 $check = "SELECT * FROM klienci WHERE klienci.email='".$mail."' and klienci.haslo='".$haslo."'";
     $data= mysqli_query($conn,$check);
     if($data)
     {
        if (mysqli_num_rows($data) > 0) {
            echo 'Takie konto już istnieje';
            return;
        }
     
    
        else
        {
            $query=  "INSERT INTO klienci (imie, nazwisko, 
            email, numer_telefonu, haslo, id_pracownika) VALUES (?,?,?,?,?,?)";
         $stmt=mysqli_prepare($conn,$query);
       mysqli_stmt_bind_param($stmt, 'ssssss', $imie,$nazwisko,$mail,$telefon,$haslo,$konsultant);
       session_regenerate_id(true); 
            $check=mysqli_stmt_execute($stmt);
           $user_id  = mysqli_insert_id($conn);
            $_SESSION['user_id']=$user_id;
            setcookie(session_name(), session_id(), time() + 3600, "/", "", true, true);
         header('location: konto.php');
        //  setcookie("user_id", $user_id, time() + 604800,'/','', true,true);
         exit();
        }
        }
 }
    }
    ?>
    
</body>
</html>