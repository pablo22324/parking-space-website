<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    </head>
    <style>
        form input[type="submit"] {
    padding: 10px 20px;
    background-color: #dc3545;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
}

form input[type="submit"]:hover {
    background-color: #c82333;
}
    </style>
    <body class="container mt-5">
        <?php
            if (!empty($_POST['id_klienta'])) {
                $conn = mysqli_connect('127.0.0.1', 'konsultant', 'pass', 'garaz_baza');
                if (!$conn) {
                    die("Błąd połączenia: " . mysqli_connect_error());
                }
                $id = $_POST['id_klienta'];
                $query = "SELECT * FROM klienci WHERE id_klienta=?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            } else {
                echo "<script>alert('Błąd - brak ID'); window.location.href='konsultant.php';</script>";
                exit();
            }
        ?>
        <div class="container mt-5">
            <form action="edit.php" method="post">
                <div class="mb-3">
                    <label for="imie" class="form-label">Imię:</label>
                    <input type="text" class="form-control" name="imie" value="<?php echo htmlspecialchars($row['imie']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="nazwisko" class="form-label">Nazwisko:</label>
                    <input type="text" class="form-control" name="nazwisko" value="<?php echo htmlspecialchars($row['nazwisko']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="numer_telefonu" class="form-label">Telefon:</label>
                    <input type="text" class="form-control" name="numer_telefonu" value="<?php echo htmlspecialchars($row['numer_telefonu']); ?>" required>
                </div>
                <input type="hidden" name="id_klienta" value="<?php echo $id; ?>">
                <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
            </form>
        </div>
    </body>
</html>