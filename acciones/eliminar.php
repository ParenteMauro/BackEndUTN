<?php
try {
    $dbname = 'utnback';
    $user = 'root';
    $password = '';
    $dsn = "mysql:host=localhost;dbname=$dbname";
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo $e->getMessage();
} 

$consulta = $dbh->prepare("DELETE FROM `alumno` WHERE id = :id");

$consulta->bindValue(':id',$_POST['id']); 

$consulta->execute(); 

header("Location: ../index.php");

?>
