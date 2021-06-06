<?php 

include('adatbazis.php');
include('hitelesites.php');

session_start();

hitelesites_szukseges();
$nev = hitelesitett_info($ab, "nev");

$lista = lekerdezes($ab, "SELECT * FROM `feladvanyok` WHERE `id`=:jatekid",
    [
        ":jatekid" =>  $_GET["jatekid"],
    ]
);

?>


<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafilogika-<?=$_GET["jatekid"]?></title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        kep = `<?= $lista[0]["feladvany"] ?>`
    </script>
    <script src="scripts.js"></script>    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="jatek.css">

</head>
<body>
    <header>
        <h1>
            Grafilogika feladvány: <?=$_GET["jatekid"]?>
        </h1>
    </header>
    <div class="log">
        <span class="bejlabel">Bejelentkezve:</span> 
        <span class="bejnev"><?= $nev ?></span>
        <a href="kijelentkezes.php">Kijelentkezés</a>
    </div>
    <main>

    </main>
</body>
</html>