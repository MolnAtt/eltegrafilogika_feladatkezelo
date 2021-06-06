<?php 
    include('hitelesites.php');
    session_start();
    kijelentkeztet();
    header('Location: login.php')
?>