<?php
include('../config/config.php');
include('patient.php');
$p = new Patient();
$data = mysqli_fetch_object($p->getOne($_GET['id']));
$date = new DateTime($data->sessionDate);

if (isset($_POST) && !empty($_POST)){
    $_POST['image'] = $data->image;
    if ($_FILES['image']['name'] !== ''){
        $_POST['image'] = saveImage($_FILES);
    }
    $update = $p->update($_POST);
    if ($update){
        $error = '<div class="alert alert-success" role="alert">Paciente modificado correctamente</div>';
        }else{
        $error = '<div class="alert alert-danger" role="alert">Error al modificar un paciente</div>';
        }
}

?>
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8" />
<title>Modificar paciente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php include('menu2.php')?>
    <div class="container">
        <?php
        if (isset($error)){
            echo $error;
        }
        ?>
        <h2 class="text-center mb-5"> Modificar paciente </h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="row mb-2">
                <div class="col">
                    <input type="text" name="firstName" id="firstName" placeholder="Nombre paciente" require class="form-control" value="<?= $data->firstName ?>" />
                    <input type="hidden" name="id" id="id" value="<?= $data->id ?>" />
    </div>
    <div class="col">
    <input type="text" name="lastName" id="lastName" placeholder="Apellido paciente" require class="form-control" value="<?= $data->lastName ?>" />
    </div>
    </div>

    <div class="row mb-2">
        <div class="col">
        <input type="email" name="email" id="email" placeholder="Email paciente" require class="form-control" value="<?= $data->email ?>" />
        </div>
        <div class="col">
        <input type="number" name="phone" id="phone" placeholder="Número celular paciente" require class="form-control" value="<?= $data->phone ?>" />
    </div>
    </div>

    <div class="row mb-2">
        <div class="col">
        <b>Debes separar los intereses con una coma </b>
            <textarea name="diseases" id="diseases" placeholder="interes 1, interes 2, ..." require class="form-control"><?= $data->diseases ?></textarea>
           
    </div>
    </div>

    <div class="row mb-2">
        <div class="col">
        <input type="datetime-local" name="sessionDate" id="sessionDate" require class="form-control" value="<?= $date->format('Y-m-d\TH:i') ?>" />
    </div>
    <div class="col">
    <input type="text" name="duration" id="duration" placeholder="Duración de la sesión" require class="form-control" value="<?= $data->duration ?>" />
    </div>
    </div>
    <div class="row mb-2">
        <div class="col">
        <input type="file" name="image" id="image" class="form-control" />
    </div>
    </div>

    <button class="btn btn-success">Modificar</button>
    </form>
    </div>
    </body>

    </html>
    







        

