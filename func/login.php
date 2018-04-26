<?php
error_reporting(0);
session_start();
include 'db.php';
$con = new mysqli($host,$user,$password,$db);
if ($con->connect_errno)
{
    echo '
      <script>
        Metro.notify.create("No hay coneccion con la base de datos", "DATABASE", {cls: "alert"});
      </script>';
    exit();
}
@mysqli_query($con, "SET NAMES 'utf8'");
if ($_POST['username'] == null || $_POST['password'] == null)
{
  echo '
    <script>
      Metro.notify.create("Complete todos los campos", "Imcompleto", {cls: "warning"});
    </script>';
}
else
{
    $user = mysqli_real_escape_string($con, $_POST['username']);
    $pass = mysqli_real_escape_string($con, md5($_POST['password']));
    $consulta = mysqli_query($con, "SELECT * FROM users WHERE username = '$user' AND password = '$pass'");
    if (mysqli_num_rows($consulta) > 0)
    {
            while($row = mysqli_fetch_array($consulta))
            {
              $_SESSION['usuario'] = $row[0];
              $_SESSION['usuario_name'] = $row[3];
              $_SESSION['add_titular'] = $row[4];
              $_SESSION['edit_titular'] = $row[5];
              $_SESSION['delete_titular'] = $row[6];
              $_SESSION['add_vehicle'] = $row[7];
              $_SESSION['edit_vehicle'] = $row[8];
              $_SESSION['delete_vehicle'] = $row[9];
              $_SESSION['add_adicional'] = $row[10];
              $_SESSION['edit_adicional'] = $row[11];
              $_SESSION['delete_adicional'] = $row[12];
              $_SESSION['crud_users'] = $row[13];
              $_SESSION['gen_reports'] = $row[14];
              $_SESSION['delete_logs'] = $row[15];
            }
            echo '<script>location.href = "manager.php"</script>';
    }
    else
    {
      echo '<script>location.href = "?error=true"</script>';
    }
}
?>
