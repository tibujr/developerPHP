<?php 

echo "ARREGLO SALIDA : ".json_encode(build( [2, 4, 9] ));

function build($numeroArr)
{
	echo "ARREGLO ENTRADA : ".json_encode($numeroArr)."<br>";
	$numeroArrRet = [];
	if(min($numeroArr) > 0)
	{
		for ($i = min($numeroArr); $i <= max($numeroArr); $i++) { 
			array_push($numeroArrRet, $i);
		}
	}
	return $numeroArrRet;
}

?>