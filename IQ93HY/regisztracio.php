<?php

include('adatbazis.php');

function letezik($ab, $email) { 
    return 0 < count(lekerdezes($ab, "SELECT * FROM `felhasznalok` WHERE `email` = :email",
            [ 
                ":email" => $email,
            ]
        ));
}
function regisztral($ab, $email, $jelszo, $nev) { 
    return 1 === vegrehajtas($ab, "INSERT INTO felhasznalok(`email`, `jelszo`, `nev`) VALUES (:email,:hess,:nev)",
        [ 
            ":email" => $email,
            ":hess" => password_hash($jelszo, PASSWORD_DEFAULT),
            ":nev" => $nev,
        ] 
    ); 
}

$hibak = [];

if (count($_POST) > 0) {
    // beolvasás
    $email = $_POST["email"];
    $nev = $_POST["user"];
    $jelszo = $_POST["pwd"];

    //feldolgozás
    if (letezik($ab, $email)) { $hibak[] = "Már létező felhasználónév!"; }

    // var_dump($hibak);

    /**/
    if (count($hibak) === 0) {
        regisztral($ab, $email, $jelszo,$nev);
        header('Location: index.php');
        exit();
    }
    /**/ 
}
?>

<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <header><h1>Regisztráció</h1></header>
    <main>
        <form class="grid-container" method="POST">
        <label for="user">Név:</label><input type="text" name="user" id="user">
            <label for="user">e-mail cím:</label><input type="text" name="email" id="email">
            <label for="pwd">Jelszó:</label><input type="password" name="pwd" id="pwd">
            <button type="submit">Regisztráció</button>
            <?php if (count($_POST) > 0):?>
                <?php if (count($hibak) === 0 ):?>
                    <a href="index.php">Sikeres regisztráció</a>
                <?php else:?>
                    <a href="regisztracio.php">Ez az e-mail cím foglalt.</a>
                <?php endif ?>
            <?php endif ?>
        </form>
    </main>
    
</body>
</html>