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
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
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
    <table>
        <thead>
            <th> data rozpoczęcia</th>
            <th> data zakończenia</th>
            <th>numer miejsca</th>
        </thead>
    <?php
    session_start();
    include('config.php');
    $query='select  * from wynajem where id_klienta=? and current_timestamp() between data_rozpoczecia and data_zakonczenia';
    $stmt=mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,'i',$_SESSION['user_id']);
    mysqli_stmt_execute($stmt);
    $data=mysqli_stmt_get_result($stmt);
    while($row=mysqli_fetch_assoc($data))
    {
        echo "<tr>"
        ."<td>".$row['data_rozpoczecia']."</td><td>".$row['data_zakonczenia']."</td><td>".$row['numer_miejsca'].
        "</td></tr>";
    }
    
    ?>
    </table>
    <form method="post">
        <input type="submit" value="odśwież jak nie widzisz miejsca" name="odswiezanie">
    </form>
</body>
</html>