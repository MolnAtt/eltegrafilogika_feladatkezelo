<?php 

include('adatbazis.php');
include('hitelesites.php');

function ellenoriz($abp, $email, $jelszo){
    $felhasznalok = lekerdezes($abp, "SELECT * FROM `felhasznalok` WHERE `email` = :email",
        [ 
            ":email" => $email,
        ]
    );
    return (1 === count($felhasznalok) and password_verify($jelszo, $felhasznalok[0]["jelszo"])) ? $felhasznalok[0] : false;
}

session_start();

$hibak = [];

if (count($_POST) > 0) {
    $email = $_POST["email"];
    $jelszo = $_POST["pwd"];

    $felhasznalok = ellenoriz($ab, $email, $jelszo);

    if ($felhasznalok === false) { $hibak[] = "hibás adatok!"; }

//    var_dump($hibak);
    if (count($hibak) === 0) {
        beleptet($felhasznalok[0]);
        header('Location: index.php');
        exit();
    }
}

?>

<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <header><h1>Bejelentkezés</h1></header>
    <main>
        <form class="grid-container" method="POST">
            <label for="user">e-mail cím:</label><input type="text" name="email" id="email">
            <label for="pwd">Jelszó:</label><input type="password" name="pwd" id="pwd">
            <button type="submit">Bejelentkezés</button>
            <?php if (count($_POST) > 0):?>
                <?php if (count($hibak) === 0 ):?>
                    <a href="index.php">Sikeres bejelentkezés</a>
                <?php else:?>
                    <a href="regisztracio.php">Hibás e-mail cím vagy jelszó!</a>
                <?php endif ?>
            <?php else:?>
                <a href="regisztracio.php">Nincs még fiókom...</a>
            <?php endif ?>
        </form>
    </main>
</body>
</html>
