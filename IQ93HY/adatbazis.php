<?php
function kapcsolodas($kapcsolati_szoveg, $felhnev = '', $jelszo = '') {
  $pdo = new PDO($kapcsolati_szoveg, $felhnev, $jelszo);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $pdo;
}

function lekerdezes($kapcsolat, $sql, $parameterek = []) {
  $stmt = $kapcsolat->prepare($sql);
  $stmt->execute($parameterek);
  return $stmt->fetchAll();
}

function vegrehajtas($kapcsolat, $sql, $parameterek = []) {
  return $kapcsolat
    ->prepare($sql)
    ->execute($parameterek);
}

$ab = kapcsolodas('mysql:host=localhost;dbname=wf2lev_iq93hy;charset=utf8', 
  'iq93hy', 'iq93hy');