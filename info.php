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
    <style>
        body {
            background-color: #1a1a1a;
            color: #e0e0e0;
            font-family: Arial, sans-serif;
            padding: 0;
            margin: 0;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        /* Stylizowanie ramek iframe */
        iframe {
            width: 100%;
            border: none;
            height: 800px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(255, 255, 255, 0.1);
        }



        /* Kontener na dane */
        #dane-konto,
        #miejsca,
        #oplaty {
            margin: 20px 0;
            background-color: #333;
            padding: 5px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }
        /* Formularz i przycisk wylogowania */
        #wylogowanie {
            text-align: center;
            margin-top: 20px;
        }

        #wylogowanie input[type="submit"] {
            background-color: #444;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        div
        {
            width: 33.3%;
        }
main
{
    display: flex;
}
#wylogowanie
{
    width: 100%;
}
        #wylogowanie input[type="submit"]:hover {
            background-color: #666;
        }
    </style>
</head>
<body>

<?php
ini_set('session.gc_maxlifetime', 86400);
session_start();
?>
<main>
<div id="dane-konto">
    <h2>Dane konta</h2>
    <iframe src="dane.php"></iframe>
</div>

<div id="miejsca">
    <h2>Wynajęte miejsca</h2>
    <iframe src="wynajete.php"></iframe>
</div>

<div id="oplaty">
    <h2>Saldo</h2>
    <iframe src="saldo.php"></iframe>
</div>

    </main>

</div>

</body>
</html>
