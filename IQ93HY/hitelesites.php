<?php
    // session_start();
    function azonositott_e() { return isset($_SESSION["felhasznalo"]); }
    function kijelentkeztet() { unset($_SESSION["felhasznalo"]); }
    function beleptet($felhasznalo) { $_SESSION["felhasznalo"] = $felhasznalo; }
    function hitelesites_szukseges(){ if (!azonositott_e()) {header('Location: login.php');exit(); } }

    function hitelesitett_info($ab, $adat){
            $szuret = lekerdezes($ab, 'SELECT `nev` FROM `felhasznalok` WHERE `id` = :sessionid',
            [
            ":sessionid" => $_SESSION["felhasznalo"],
            ]    
        );
        return $szuret[0][$adat];
    }
?>