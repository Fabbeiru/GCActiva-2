<?php

include_once ("data_access.class.php");

$id = $_GET['id'];

$SQL = "DELETE FROM usuarios WHERE usuarios.id = $id";
DB::execute_sql($SQL);

header("Location:perfil.php");