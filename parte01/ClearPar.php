<?php 

echo "CADENA SALIDA : ".build("((())))()((())((()()");

function build($cadena)
{
	echo "CADENA ENTRADA : ".$cadena."</br>";
	$nuevaCadena = "";
	for ($i=0; $i < substr_count($cadena, '()'); $i++) { 
		$nuevaCadena .= "()";
	}
	return $nuevaCadena;
}

?>