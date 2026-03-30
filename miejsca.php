<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styl.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" 
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" 
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
/* Stylowanie całej strony */
body {
    background-color: #f4f4f9;
    font-family: 'Arial', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    margin: 0;
    min-height: 100vh;
}

/* Przyciski pięter */
button {
    padding: 10px 20px;
    margin: 10px;
    font-size: 16px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

/* Tabela z miejscami */
table {
    margin-top: 30px;
    border-collapse: collapse;
    width: 100%;
    max-width: 800px;
    border: 1px solid #ddd;
}

table th, table td {
    padding: 15px;
    text-align: center;
    border: 1px solid #ddd;
    font-size: 14px;
}

table th {
    background-color: #007bff;
    color: white;
    text-transform: uppercase;
}

/* Tabela z wynajmami */
table tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tr:nth-child(odd) {
    background-color: #ffffff;
}

/* Komórki tabeli z numerami miejsc */
td {
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

td:hover {
    transform: scale(1.05);
}

.droga {
    background-color: #333;
}

/* Zajęte miejsca */
td[id][style*="background-color: red"] {
    background-color: #ff5733;
}

/* Wolne miejsca */
td[id][style*="background-color: green"] {
    background-color: #28a745;
}

/* Wyróżnienie tabeli przy wyborze piętra */
#tabela_miejsc {
    margin-top: 20px;
    width: 100%;
}

/* Marginesy przycisków i tabeli */
button {
    margin-bottom: 20px;
}

h3 {
    font-size: 24px;
    color: #333;
    margin-bottom: 30px;
}

/* Dodajemy cienie dla tabeli */
table, th, td {
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Styl dla komórek "droga" */
.droga {
    cursor: not-allowed;
}
    </style>
</head>
<body>
    

    <script >zajete=[]; wolne=[];</script>
    <?php
    include('config.php');
    if($conn)
    {
        $query = 'SELECT numer_miejsca FROM `zajete_miejsca` WHERE 1';
    $data=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($data))
    {
    echo '   <script>    zajete.push('.$row['numer_miejsca'].');</script> ';
    }
    $query = 'SELECT numer_miejsca FROM `wolne_miejsca` WHERE 1';
    $data=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($data))
    {
    echo '   <script>    wolne.push('.$row['numer_miejsca'].');</script> ';
    }


    $query='select  * from wynajem where current_timestamp() between data_rozpoczecia and data_zakonczenia';
    $data=mysqli_query($conn,$query);
?>
<div>
    
    <button onclick="zmiana('pietro_p')">Piętro 1</button>
    <button onclick="zmiana('pietro_d')">Piętro 2</button>
    <button onclick="zmiana('pietro_t')">Piętro 3</button>
    </div>
    <table id="tabela_miejsc">
        <tbody id="tabela_body"></tbody>
    </table>
            <script>
            const pietra = {
        pietro_p: [
            [1, 2, 3, 4, "droga"],
            ["droga", "droga", "droga", "droga","droga"],
            [5, 6, 7, 8,"droga"],
            [9, 10, 11, 12,"droga"],
            ["droga", "droga", "droga", "droga","droga"],
            [13, 14, 15, 16,"droga"]
        ],
        pietro_d: [
            [101, 102, 103, 104, "droga",],
            ["droga", "droga", "droga", "droga","droga"],
            [105, 106, 107, 108,"droga"],
            [109, 110, 111, 112,"droga"],
            ["droga", "droga", "droga", "droga","droga"],
            [113, 114, 115, 116,"droga"]
        ],
        pietro_t: [
            [201, 202, 203, 204, "droga"],
            ["droga", "droga", "droga", "droga","droga"],
            [205, 206, 207, 208,"droga"],
            [209, 210, 211, 212,"droga"],
            ["droga", "droga", "droga", "droga","droga"],
            [213, 214, 215, 216,"droga"]
        ]
    };
    

    
            zmiana('pietro_p'); 
    
            function zmiana(pietro) {
        const tabelaBody = document.getElementById('tabela_body');
        tabelaBody.innerHTML = ""; 
    
        let miejsc = pietra[pietro];
        i=0;
        miejsc.forEach(rzad => {
            let row = document.createElement("tr");
            if(i==0 || i==2 || i==3 || i==5)
        {
            row.className="rzad_miejsca";
        }
            i++
    
            rzad.forEach(miejsce => {
                let cell = document.createElement("td");
    
                if (miejsce === "droga") {
                    cell.classList.add("droga");
                    cell.style.backgroundColor = "black";
                } else {
                    cell.textContent = miejsce;
                    cell.id = miejsce;
    
                    if (zajete.includes(miejsce)) {
                        cell.style.backgroundColor = "red";
                    } else if (wolne.includes(miejsce)) {
                        cell.style.backgroundColor = "green";
                    }
                }
    
                row.appendChild(cell);
            });
    
            tabelaBody.appendChild(row);
        });
    }
    
    </script>
    <table>
    <?php
    while($row=mysqli_fetch_assoc($data))
    {
        echo "<tr>"
        ."<td>".$row['data_rozpoczecia']."</td><td>".$row['data_zakonczenia']."</td><td>".$row['numer_miejsca'].
        "</td></tr>";
    }


    
}
    
    ?>
    </table>
    </body>
    </html>