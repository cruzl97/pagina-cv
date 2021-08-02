<?php
$recaptcha = $_POST['g-recaptcha-response'];
$asunto = $_POST['asunto'];
$nombre = $_POST['Nombre'];
$correo = $_POST['email'];
$mensaje = $_POST['mensaje'];

if ($asunto == "" || $nombre == "" || $correo == "" || $mensaje == "") {
  header('Location:valDa.html');
}else {

  if ($recaptcha != '') {
    $secret = "6Lc_wFkaAAAAAOuAODkeHYTA_RYFvamyttQx2Frz";
    $ip = $_SERVER['REMOTE_ADDR'];
    $var = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$recaptcha&remoteip=$ip");
    $array = json_decode($var, true);
    if ($array['success']) {

      $to = "cruz.luis114@gmail.com";
      $subject = $_POST['asunto'];
      $headers = "From: Luis.CV@gmail.com";
      $message = "Este mensaje fue enviado por: " . $_POST['Nombre'] . "\r\n" . "correo de contacto: " . $_POST['email'] . "\r\n" . "Mensaje : \r\n" . $_POST['mensaje'];
      mail($to, $subject, $message, $headers);
      header('Location:inicio.html');

    }else {
      header('Location:valRe.html');

    }
  }else {
    header('Location:valRe.html');
  }
}


 ?>
