<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body {
    background-color: #f4f4f4;
    font-family: Arial, sans-serif;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* Styl formularza */
form {
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    width: 300px;
    text-align: center;
}

/* Pola formularza */
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    border: 1px solid #ddd;
    box-sizing: border-box;
}

/* Przycisk logowania */
button {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Zmiana koloru przycisku po najechaniu */
button:hover {
    background-color: #0056b3;
}

/* Link do rejestracji */
a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* Styl dla przycisku rejestracji */
button a {
    display: inline-block;
    text-align: center;
    font-size: 16px;
    text-decoration: none;
    color: white;
}
  </style>
</head>
<body>
  

<?php
ini_set('session.gc_maxlifetime', 86400);
session_start();
?>
<form  method="post">
<input type="email" name="mail" id="" placeholder='example@serwer'>
<input type="password" name="haslo" id="">
<button type="submit">zaloguj</button>
</form>
<?php
if(!empty($_POST['haslo']))
{
include('config.php');

// logowania dla pracowników
if($conn)
{
    $mail=htmlspecialchars(trim($_POST['mail']));
    $haslo=sha1(htmlspecialchars(trim($_POST['haslo'])));
  // $query=  "SELECT * FROM klienci WHERE klienci.email='".$mail."' ".'AND klienci.haslo='."'".sha1($haslo)."'";
 $check_pracownika = explode("@",$mail);
 if( $check_pracownika[1]=='garazex.com')
 {
  $query=  "SELECT * FROM admini WHERE admini.haslo=? and admini.mail_pracowniczy=?";
  $stmt=mysqli_prepare($conn,$query);
  mysqli_stmt_bind_param($stmt,'ss',$haslo,$mail);
  mysqli_stmt_execute($stmt);
  $data=mysqli_stmt_get_result($stmt);
  $cyferka=0;
  if($data)
  {
     while($row=mysqli_fetch_assoc($data))
     {
       if( $row['haslo']==$haslo && $row['mail_pracowniczy']==$mail)
       {
         echo 'zalogowany';
         session_regenerate_id(true); 
         setcookie(session_name(), session_id(), time() + 3600, "/", "", true, true);
        $_SESSION['login']= true;
         $cyferka++;
         
 
         switch($row['stanowisko'])
         {
          case 'konsultant':
            $_SESSION['konsultant']='konsultant';
            header('location: konsultant.php');
            exit();
            break;
              case 'admin':
                $_SESSION['admin'] ='admin';

                header('location: admin.php');
                exit();
                break;
                default:
                echo 'oszukaniec';
                break;
         }
        }
      }
  if($cyferka!=1)
        {
          echo 'haslo niepoprawne albo nie masz konta.<br>
          załóż je tutaj'.'<a href="rejestracja.php"></a>';
  
  
        }
      
   }
  }
//  logowania dla klientów
 else
 {

 
 $query=  "SELECT * FROM klienci WHERE klienci.haslo= ? and klienci.email= ? ";
 $stmt=mysqli_prepare($conn,$query);
  mysqli_stmt_bind_param($stmt,'ss',$haslo,$mail);
  mysqli_stmt_execute($stmt);
  $data=mysqli_stmt_get_result($stmt);
 if($data)
 {
  $cyferka=0;
    while($row=mysqli_fetch_assoc($data))
    {
      if( $row['haslo']==$haslo && $row['email']==$mail)
      {
        session_regenerate_id(true); 
        $cyferka++;
        $_SESSION['user_id']=$row['id_klienta'];

        setcookie(session_name(), session_id(), time() + 3600, "/", "", true, true);
        header('location: konto.php');
        exit();
      }
    }
if($cyferka!=1)
      {
        echo 'haslo niepoprawne albo nie masz konta.<br>
        załóż je <a href="rejestracja.php">tutaj</a>';


      }
    
 }
}


}
}
?>
<br>
<a href="rejestracja.php"><button>zarejestruj się</button></a>
</body>
</html>