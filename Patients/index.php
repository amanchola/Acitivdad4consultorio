<?php
include('../config/config.php');
include('Patient.php');
$p = new Patient();

$allPatients = $p->getAll();

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $remove = $p->remove($_GET['id']);
    if ($remove) {
        header('location: index.php');
        }else {
            $msj = "<div class='alert alert-danger' rol='alert' > Error al eliminar la agenda. </div> ";
            }
}

?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <title>Lista de pacientes</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   </head>

<body>
<?php include("../menu.php")?> 
<div class="container">
    <h2 class="text-center mt-5"> Agenda pacientes</h2>

    <div class="row">
        <?php
        while($patient = mysqli_fetch_object($allPatients)) {
            $input = $patient->sessionDate;
            echo "<div class='col-6' >";
            echo " <div class='border border-info p-2'> ";
            echo "<h5>
            <img src'".ROOT."/images/$patient->image' width='50' height='50' />
            $patient->firstName $patient->lastName
            </h5>";
            echo " <p> <b>Fecha:</b> ".date("D", strtotime($input)) . " " . date("d-M-Y H:i", strtotime($input)). "</p>";
            echo "<p> <b>Telefono:</b>  $patient->phone   </p>";
            echo " <div class='text-center' ><a class='btn btn-success ' href='edit.php?id=$patient->id' >Modificar </a> - <a class='btn btn-danger 'href='index.php?id=$patient->id' > Eliminar <a/> </div>";
            echo "</div>";
            echo "</div>";

     }
?>
    </div>
</div>
</body>
</html>


