<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj dane</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h2, h3 {
            text-align: center;
            color: #444;
        }

        #dane, #zmiana_hasla {
            background-color: #fff;
            padding: 7px;
            margin: 2.5px 0;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"],
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover,
        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .info {
            font-size: 14px;
            color: #666;
            text-align: center;
        }

        .warning {
            color: red;
            text-align: center;
            font-size: 16px;
            margin-top: 20px;
        }

        .btn-logout {
            display: flex;
            justify-content: center;
        }

        .btn-logout button {
            background-color: #f44336;
        }

        .btn-logout button:hover {
            background-color: #e53935;
        }

        .btn-refresh {
            text-align: center;
        }

        .btn-refresh button {
            background-color: #2196F3;
        }

        .btn-refresh button:hover {
            background-color: #1976D2;
        }
    </style>
</head>
<body>

<?php
session_start();
include('config.php');
$query = 'SELECT * FROM klienci WHERE klienci.id_klienta=?';

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $_SESSION['user_id']);
mysqli_stmt_execute($stmt);
$data = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($data)) {
?>
<div id="dane">
    <form method="post">
        <div>
        <label for="imie">Imię</label>
        <input type="text" name="imie" id="imie" value="<?php echo htmlspecialchars($row['imie']); ?>" > <br>
        </div>
        <div>
        <label for="nazwisko">Nazwisko</label>
        <input type="text" name="nazwisko" id="nazwisko" value="<?php echo htmlspecialchars($row['nazwisko']); ?>" > <br>
</div><div>
        <label for="numer_telefonu">Numer telefonu</label>
        <input type="text" name="telefon" id="numer_telefonu" value="<?php echo htmlspecialchars($row['numer_telefonu']); ?>" > <br>
</div><div>
        <label for="mail">E-mail</label>
        <input type="email" name="mail" id="mail" value="<?php echo htmlspecialchars($row['email']); ?>" > <br> 
</div><div>
        <label for="haslo">Hasło</label>
        <input type="password" name="haslo" id="haslo" required>
      </div>  <div class="info">Aby zatwierdzić zmiany, należy wpisać hasło.</div>
        <input type="submit" value="Zatwierdź zmiany">
        <div class="info">UWAGA: Nie czyść pól, aby wysłać zmiany.</div>
    </form>

    <div class="btn-refresh">
        <form method="get">
            <button type="submit">Odśwież, aby zobaczyć nowe dane</button>
        </form>
    </div>

<?php
if (!empty($_POST['haslo'])) {
    $query = "SELECT * FROM klienci WHERE klienci.haslo=? and klienci.id_klienta=? ";
    $haslo = sha1(htmlspecialchars(trim($_POST['haslo'])));
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'si', $haslo,$_SESSION['user_id']);
    mysqli_stmt_execute($stmt);
    $data = mysqli_stmt_get_result($stmt);
    
    if ($data) {
        if ($row = mysqli_fetch_assoc($data)) {
            $name = htmlspecialchars(trim($_POST["imie"]));
            $email = htmlspecialchars(trim($_POST["nazwisko"]));
            $phone = htmlspecialchars(trim($_POST["telefon"]));
            $mail = htmlspecialchars(trim($_POST["mail"]));

            $query = "UPDATE klienci SET
                imie= ? ,
                nazwisko= ? ,
                numer_telefonu= ? ,
                email = ? 
                WHERE id_klienta = ? ";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $phone, $mail, $_SESSION['user_id']);
            $result = mysqli_stmt_execute($stmt);
            
            if ($result) {
                echo "<p class='info'>Zmodyfikowano rekord w bazie.</p>";
            } else {
                echo "<p class='warning'>Błąd modyfikacji rekordu w bazie.</p>";
            }
        } else {
            echo "<p class='warning'>Hasło jest nieprawidłowe.</p>";
        }
    }
}
?>
</div>

<div id="zmiana_hasla">
    <h3>Zmiana hasła</h3>
    <form method="post">
        <input type="password" name="stare" placeholder="Stare hasło" required>
        <input type="password" name="nowe" placeholder="Nowe hasło" required>
        <input type="submit" value="Zmień hasło">
    </form>

<?php
if(!empty($_POST['stare']))
{
    $query=  "SELECT * FROM klienci WHERE klienci.haslo=? and klienci.id_klienta=?";
    $haslo=sha1(htmlspecialchars(trim($_POST['stare'])));
    $nowe=sha1(htmlspecialchars(trim($_POST['nowe'])));
    $stmt=mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,'si',$haslo,$_SESSION['user_id']);
    mysqli_stmt_execute($stmt);
    $data=mysqli_stmt_get_result($stmt);
    $cyferka=0;
    if($data)
    {
       if($row=mysqli_fetch_assoc($data))
       {
         if( $row['haslo']==$haslo)
         {
            mysqli_free_result($data);
            $query='update klienci set haslo = ? where id_klienta=?';
            $stmt=mysqli_prepare($conn,$query);
            mysqli_stmt_bind_param($stmt,'si',$nowe,$_SESSION['user_id']);
            mysqli_stmt_execute($stmt);
            $data=mysqli_stmt_get_result($stmt);
            echo 'hasło zostało zmienione';
            exit();
         }

        }
        else
        {
           echo 'stare hasło jest niepoprawne';
        }
    }
}
?>
</div>


<?php
}
?>

</body>
</html>
