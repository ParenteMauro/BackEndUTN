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
  if(count($_POST) > 0){

  $consulta = $dbh->prepare("UPDATE alumno
  SET nombre=:nombre,email=:email,foto=:foto,curso=:curso 
  WHERE id=:id");

  $consulta->bindValue(':nombre', $_POST['nombre']);
  $consulta->bindValue(':email', $_POST['email']);
  $consulta->bindValue(':foto', addslashes(file_get_contents($_FILES['foto']['tmp_name'])));
  $consulta->bindValue(':curso', $_POST['curso']);
  $consulta->bindValue(':id', $_POST['id']);

  $consulta->execute();
  header("Location:../index.php");
}
    else{

  $consulta = $dbh->prepare("SELECT * FROM alumno WHERE id=:id");
  
  $consulta->bindValue(':id', $_GET['id']);
  
  $consulta->execute();
  $alumno = $consulta->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Actualizar Alumno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Actualizar Alumno</h1>

    <a href="../index.php" class=" btn btn-success btn-lg">Volver</a>

    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value=<?=$alumno['id']?>>

        <div>
            <label for="nombre" class="form-label">Nombre: </label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?=$alumno['nombre']?>">
        </div>
        <div class=" mb-3">
            <label for="email" class="form-label">email: </label>
            <input type="text" class="form-control" id="email" name="email" value="<?=$alumno['email']?>">
        </div>

        <img style="width: 80px" src="data:image/jpg;base64,<?= base64_encode($alumno['foto'])?>"  alt="foto de: <?=$alumno["nombre"]?>">
        <br>
            <label for="foto" class="form-label">Cambiar Foto: </label>
            <input type="File" class="form-control" id="foto" name="foto">
        </div>
        <div class="mb-3 ">
            <label for="curso" class="form-label">Curso: </label>
            <input type="text" class="form-control" id="curso" name="curso"
                value=<?=$alumno['curso']?>>
        </div>
        <button type="submit" class="btn btn-primary">Editar Producto</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>