<?php
ini_set('session.gc_maxlifetime', 86400);
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzanie Klientami</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
</head>
<body>
    <?php
    if(isset($_SESSION['konsultant']) && $_SESSION['konsultant'] === 'konsultant') {
        $conn = mysqli_connect('127.0.0.1', 'konsultant', 'pass', 'garaz_baza');
        if (!$conn) {
            die("Błąd połączenia: " . mysqli_connect_error());
        }
        
        $query = 'SELECT * FROM klienci';
        $result = mysqli_query($conn, $query);
        
    ?>
        <?php
    if(!empty($_POST['logout']))
    {
        session_destroy();
        header('location: logowanie.php');
    }
    ?>
    <div class="container mt-5">
        <h2>Lista Klientów</h2>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Akcje</th>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id_klienta'];
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['imie']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nazwisko']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['numer_telefonu']) . "</td>";
                    echo "<td>";
                    echo "<form action='modify.php' method='POST' class='d-inline'>";
                    echo "<input type='hidden' name='id_klienta' value='$id'>";
                    echo "<button type='submit' class='btn btn-primary btn-sm'>Edytuj</button>";
                    echo "</form> ";
                    echo "<form action='delete.php' method='POST' class='d-inline' onsubmit=\"return confirm('Czy na pewno chcesz usunąć tego klienta?')\">";
                    echo "<input type='hidden' name='id_klienta' value='$id'>";
                    echo "<button type='submit' class='btn btn-danger btn-sm'>Usuń</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <form  method="post">
        <input type="submit" name="logout" value="wyloguj">
    </form>

    <?php
    
        mysqli_close($conn);
    } else {
        echo "<p class='text-danger'>Nie masz uprawnień do przeglądania tej strony.</p>";
    }
    ?>
</body>
</html>