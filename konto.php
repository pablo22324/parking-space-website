<?php
ini_set('session.gc_maxlifetime', 86400);
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel użytkownika</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="styl.css" />
    <script
        src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"
    ></script>
    <style>
        body {
            background-color: #f4f4f4;
            color: #333;
            font-family: Arial, sans-serif;
        }

        .jumbotron {
            background-color: #343a40;
            color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        #pasek_powitalny {
            font-size: 1.5rem;
        }

        /* Stylowanie zakładek nawigacyjnych */
        .nav-tabs .nav-link {
            color: #bbb;
            background: #2a2a2a;
            border: none;
            border-radius: 10px 10px 0 0;
            transition: all 0.3s ease-in-out;
        }

        .nav-tabs .nav-link:hover,
        .nav-tabs .nav-link.active {
            background: #444;
            color: #fff;
        }

        /* Stylowanie sekcji iframe */
        iframe {
            width: 33.3%;
            height: 800px;
            border-radius: 10px;
            border: none;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .tab-pane.fade {
        height: max-content;
        bottom: 0px;
      }
      #kontener
      {
        height: 80vh;
      }
      .tab-pane.fade {
        height: 80vh;
      }
      header {
        height: 20vh;
      }
      main {
        height: 50vh;

      }
      .logout {
            display: flex;
            justify-content: center;
            background-color: #f44336;
            position: fixed;
            bottom: 0;
            width: 100%;
      }
        .logout:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
    <?php
    if (isset($_SESSION['user_id'])) {
        // Wczytywanie danych użytkownika
        include('kontowe.php');
        if ($data) {
            while ($row = mysqli_fetch_array($data)) {
                $imie = $row['imie'];
                $nazwisko = $row['nazwisko'];
            }
        }
    ?>
        <?php
    if (!empty($_POST['logout'])) {
        session_destroy();
        header('location: logowanie.php');
    }
    ?>
    <div id="kontener">
   
<header>
<div class="jumbotron text-center">
        <h3 id="pasek_powitalny"></h3>
        <?php
        echo "<script>
            document.getElementById('pasek_powitalny').innerHTML = 'Witaj, $imie $nazwisko! Miło Cię znowu widzieć.';
        </script>";
        ?>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Info</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Wynajem</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Usługi</a>
        </li>
    </ul>
    </header>
    <main>
    <div class="tab-content" id="myTabContent">
 
            <iframe src="info.php" class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" frameborder="0"></iframe>


            <iframe src="wynajem.php" class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" frameborder="0"></iframe>


            <iframe src="uslugi.php" class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab" frameborder="0"></iframe>

    </div>
    </main>
    </div>
    <div id="wylogowanie">
    <form method="post" class="logout">
        <input type="submit" name="logout" value="Wyloguj" class="logout">
    </form>
    </div>

<?php
    } else {
        header('location: logowanie.php');
    }
    ?>
</body>
</html>
