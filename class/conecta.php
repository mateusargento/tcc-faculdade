<?php
// Script para conectar com o banco de dados
$conecta= pg_connect("host=localhost dbname='' port= user='' password=''");

if ($conecta)
{
	
}
 
else 
{
	die("Houve falha na conexão!!");
}
?>