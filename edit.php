<?php
    if (!empty($_POST['id_klienta']) && !empty($_POST['imie']) && !empty($_POST['nazwisko'])
    && !empty($_POST['email']) && !empty($_POST['numer_telefonu'])) {
        $conn = mysqli_connect('127.0.0.1', 'konsultant', 'pass', 'garaz_baza');
        if (!$conn) {
            die("Błąd połączenia: " . mysqli_connect_error());
        }
        

        $id = $_POST['id_klienta'];
        echo $id;
        $imie = htmlspecialchars(trim($_POST["imie"]));
        $nazwisko = htmlspecialchars(trim($_POST["nazwisko"]));
        $email = htmlspecialchars(trim($_POST["email"]));
        $phone = htmlspecialchars(trim($_POST["numer_telefonu"]));

        $query = "UPDATE klienci SET
                  imie = ?,
                  nazwisko = ?,
                  email = ?,
                  numer_telefonu = ?
                  WHERE id_klienta = ?";
        $stmt = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param($stmt, "sssss", $imie, 
        $nazwisko, $email, $phone, $id);
        
        $result = mysqli_stmt_execute($stmt);
        if ($result) {
            echo "Zmodyfikowano rekord w bazie";
        } else {
            echo "Błąd modyfikacji rekordu w bazie";
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: konsultant.php");
    }
?>