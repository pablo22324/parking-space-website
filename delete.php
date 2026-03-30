<?php
if (!empty($_POST['id_klienta'])) {
    $conn = mysqli_connect('127.0.0.1', 'konsultant', 'pass', 'garaz_baza');

    if (!$conn) {
        die("Błąd połączenia: " . mysqli_connect_error());
    }

    $id = $_POST['id_klienta'];
    $query = "DELETE FROM klienci WHERE id_klienta = ?";
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Rekord został usunięty');</script>";
    } else {
        echo "<script>alert('Nie udało się usunąć danych');</script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header("Location: konsultant.php");
    exit();
} else {
    echo "<script>alert('Brak ID klienta');</script>";
    header("Location: konsultant.php");
    exit();
}
