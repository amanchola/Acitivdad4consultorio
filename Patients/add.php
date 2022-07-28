<?php
include("../config/config.php");
include("patient.php");

if(isset($_POST) && !empty($_POST)){
    $patient = new Patient();

    if ($_FILES["image"]["name"] !==""){
        $_POST["image"] = saveImage($_FILES);
    }

    $save = $patient->save($_POST);
    if($save){
        $error = '<div class="alert alert-success" role="alert">Paciente creado correctamente</div>';
    }else{
        $error = '<div class="alert alert-danger" role="alert">Error al crear un paciente </div>';
}
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Crear paciente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<?php include("../menu.php")?>
<div class="container">
<?php
if (isset($error)) {
    echo $error;
} 
?>
<h2 class="text-center mb-5" > Creación de agenda </h2>
<form method="POST" enctype="multipart/form-data">
    <div class="row mb-2">
        <div class="col">
            <input type="text" name="firstName" id="firstName" placeholder="Nombre paciente" require class="form-control" />
            </div>
        <div class="col">
            <input type="text" name="lastName" id="lastName" placeholder="Apellido paciente" require class="form-control" />
            </div>
    </div>

    <div class="row mb-2">
        <div class="col">
        <input type="email" name="email" id="email" placeholder="Email paciente" require class="form-control" />  
        </div>
        <div class="col">
            <input type="number" name="phone" id="phone" placeholder="Número celular paciente" require class="form-control" />
            </div>
    </div>
    
    <div class="row mb-2">
        <div class="col">
        <b>Debes separar los intereses con una coma </b>
        <textarea name="diseases" id="diseases" placeholder="Interes 1, interes 2, ..." require class="form-control">  </textarea>
            
        </div> 
    </div>

    <div class="row mb-2">
        <div class="col"> 
        <input type="datetime-local" name="sessionDate" id="sessionDate" require class="form-control" />
</div>
<div class="col"> 
<input type="text" name="duration" id="duration" placeholder="Duración de la sesión" require class="form-control" />
</div>
</div>

<div class="row mb-2">
<div class="col"> 
<input type="file" name="image" id="image" class="form-control" />
</div>
</div>

<button class="btn btn-success"> Registrar </button>
</form>
</div>
</body>

</html>