<?php

try {
    $dbname='utnback';

    $user='root';
    $password='';
    
    $dsn = "mysql:host=localhost;dbname=$dbname";

    $dbh = new PDO($dsn, $user, $password);

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e){

    echo $e->getMessage();

} 

$consulta= $dbh->prepare("SELECT * FROM alumno");

$consulta->execute();

$alumnos = $consulta->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Alumnos UTN</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <img src="./media/logo-utn.png" alt="UTN-LOGO" id="logo">

    <h1>Alumnos de la UTN</h1>

    <a href="./acciones/insertar.php" class="btn btn-success">Insertar Alumno</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Foto</th>
                <th scope="col">Curso</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($alumnos as $i=> $alumno){?>
            <tr>
                <th scope="row"><?= $i+1 ?></td>
                <td><?= $alumno['nombre']?></td>
                <td><?= $alumno['email']?></td>
                <td><?= $alumno['foto']?></td>
                <td><?= $alumno['curso']?></td>
                <td>
                    <button class="btn btn-warning">Editar</button>
                    <button class="btn btn-danger">Eliminar</button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
            
    </table>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>