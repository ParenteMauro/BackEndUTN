<?php
if(count($_POST) > 0)
{

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

$consulta = $dbh->prepare("INSERT INTO `alumno`(`nombre`, `email`, `foto`, `curso`) VALUES (:nombre,:email,:foto,:curso)");


$consulta->bindValue(':nombre',$_POST['nombre']); 
$consulta->bindValue(':email',$_POST['email']); 
$consulta->bindValue(':foto',null); 
$consulta->bindValue(':curso',$_POST['curso']); 

$consulta->execute(); 

header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style.css">
    <title>Introducir nuevo Alumno</title>
</head>
<body>
    <h1>Introducir nuevo Alumno</h1>
    <a href="../index.php" class="btn btn-success">Volver</a>
     
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="text" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto:</label>
            <input type="file" class="form-control" id="foto" name="foto">
        </div>
        <div class="mb-3">
            <label for="curso" class="form-label">Curso que está tomando:</label>
            <input type="text" class="form-control"id="curso" name="curso">
        </div>
        <button type="submit" class="btn btn-primary mb-3">Enviar</button>   
     </form>
 
</body>
</html>