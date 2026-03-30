<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Tło całej strony */
.tab-pane.fade
{
    height: 800px;
}
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    line-height: 1.6;
    padding: 20px;
}

/* Nagłówek */
h2 {
    text-align: center;
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}

/* Formularz zapytania SQL */
form {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

input[type="text"] {
    padding: 10px;
    font-size: 16px;
    width: 60%;
    margin-right: 10px;
    border: 2px solid #ccc;
    border-radius: 4px;
}

button[type="submit"] {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

/* Sekcja błędów */
p {
    text-align: center;
    color: #ff0000;
    font-size: 14px;
}

/* Tabela wyników */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd;
    font-size: 16px;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f1f1;
}

/* Przyciski wylogowania */
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
ini_set('session.gc_maxlifetime', 86400);
session_start();
if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'admin') {
   


$conn = mysqli_connect('127.0.0.1', 'admin', 'pass5', 'garaz_baza');
if (!$conn) {
    die("Błąd połączenia: " . mysqli_connect_error());
}

$result = null;
$error = "";
$query = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['query'])) {
    $query = trim($_POST['query']);
    $result = mysqli_query($conn, $query);

    if (!$result) {
        $error = "Błąd: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Admin SQL</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Panel admina</h2>
    <div style="text-align: center;">
    <img src="uklad.png" alt="">
    </div>
    <form method="post">
        <input type="text" name="query" required value="<?= htmlspecialchars($query) ?>">
        <button type="submit" class="contact-form">Wykonaj</button>
    </form>

    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <h3>Wyniki zapytania:</h3>
        <table>
            <tr>
                <?php while ($field = mysqli_fetch_field($result)) echo "<th>{$field->name}</th>"; ?>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <?php foreach ($row as $value) echo "<td>" . htmlspecialchars($value) . "</td>"; ?>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php elseif ($result && str_starts_with(strtoupper($query), "SELECT")): ?>
        <p>Brak wyników.</p>
    <?php elseif ($result): ?>
        <p>Zapytanie wykonane pomyślnie.</p>
    <?php endif; ?>
    <form  method="post">
        <input type="submit" name="logout" value="wyloguj">
    </form>
    <?php
    if(!empty($_POST['logout']))
    {
        session_destroy();
        header('location: logowanie.php');
    }
}
    ?>
</body>
</html>