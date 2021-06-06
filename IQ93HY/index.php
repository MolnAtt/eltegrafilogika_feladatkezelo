<?php 

include('adatbazis.php');
include('hitelesites.php');

session_start();

hitelesites_szukseges();

$nev = hitelesitett_info($ab, "nev");

$lista = lekerdezes($ab, "SELECT szelesseg, magassag, nev, feladvanyok.id FROM feladvanyok INNER JOIN felhasznalok ON felhasznalo_id = felhasznalok.id");

?>



<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafilogika tartalomjegyzek</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <h1>
            Grafilogika-feladványok
        </h1>
    </header>
    <div class="log">
        <span class="bejlabel">Bejelentkezve:</span> 
        <span class="bejnev"><?= $nev ?></span>
        <a href="kijelentkezes.php">Kijelentkezés</a>
    </div>
    <main>
        <div class="fejlec" id="szel">Szélesség</div>
        <div class="fejlec" id="mag">Magasság</div>
        <div class="fejlec" id="nev">Készítő neve</div>

        <?php foreach ($lista as $adat): ?>
        <div class="szelesseg"><?= $adat["szelesseg"]?></div>
        <div class="magassag"><?= $adat["magassag"]?></div>
        <div class="keszito_neve"><?= $adat["nev"]?></div>
        <a href="jatek.php?jatekid=<?= $adat['id']?>"><button>Kipróbálom</button></a>
        <?php endforeach ?>

        <a class="ujfeladvanygomb" href="ujfeladvany.php"> <button> Új feladvány hozzáadása</button></a>
    </main>
</body>
</html>



