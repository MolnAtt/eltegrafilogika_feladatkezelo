<?php 
include('adatbazis.php');
include('hitelesites.php');
session_start();
hitelesites_szukseges();
$nev = hitelesitett_info($ab, "nev");


function regisztral($ab, $szelesseg, $magassag, $feladvany, $felhasznaloid) { 
    return 1 === vegrehajtas($ab, "INSERT INTO `feladvanyok`(`feladvany`, `felhasznalo_id`, `magassag`, `szelesseg`) VALUES (:feladvany, :felhasznaloid, :magassag, :szelesseg)",
        [ 
            ":feladvany" => $feladvany,
            ":felhasznaloid" => $felhasznaloid,
            ":magassag" => $magassag,
            ":szelesseg" => $szelesseg,
        ] 
    ); 
}
$hibak = [];

if (count($_POST) > 0) {
    // beolvasás
    $szelesseg = $_POST["szelesseg"];
    $magassag = $_POST["magassag"];
    $feladvany = $_POST["feladvany"];

    //feldolgozás
    $sortomb = explode("\n", $feladvany);

    /**/
    var_dump($sortomb);
    /**/

    if (count($sortomb) != $magassag ) {
        $hibak[] = "nem jó a magasság";
    } 
    else if ($szelesseg != strlen(trim($sortomb[0]))) {
    //if (0 < count(array_filter(sortomb), function ($sor){ return strlen($sor)!=$szelesseg; })) {
        $hibak[] = "nem jó a szélesség";
    } else if (count($hibak) === 0) {
        regisztral($ab, $szelesseg, $magassag, $feladvany, $_SESSION["felhasznalo"]); 
        header('Location: index.php');
        exit();
    } 
    
    else var_dump($hibak);
    /**/ 


}

?>

<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafilogika</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="ujfeladvany.css">
</head>
<body>
    <header>
        <h1>
            Új grafilogikai feladavány
        </h1>
    </header>
    <div class="log">
        <span class="bejlabel">Bejelentkezve:</span> 
        <span class="bejnev"><?= $nev ?></span>
        <a href="kijelentkezes.php">Kijelentkezés</a>
    </div>
    <main>

    <form action="" method="POST">
        <textarea name="feladvany" id="feladvany" rows="20" cols="50"></textarea>
        <div id="ujfeladvany-grid-container">
            <label for="szelesseg" id="szellabel">szélesség:</label>
            <input type="number" name="szelesseg" id="szelesseg">
            <label for="magassag" id="maglabel">magasság:</label>
            <input type="number" name="magassag" id="magassag">
            <p id="visszajelzes"></p>
            <button type="submit" id="kuldes">Küldés</button>
        </div>
    </form>

    </main>
</body>
</html>


</body>
</html>