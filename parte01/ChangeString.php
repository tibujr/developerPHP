<?php 

echo  "CADENA SALIDA : ".build(utf8_decode( "ABC32DEF GHi42jklmNÑ OPqrS53TUVW XY23xzZ" ));

function build($cadena)
{
	echo "CADENA ENTRADA : ".$cadena."<br>";

	$abcMinusculaArr = array_map("utf8_decode", [0=>"a",1=>"b",2=>"c",3=>"d",4=>"e",5=>"f",6=>"g",7=>"h",8=>"i",9=>"j",10=>"k",11=>"l",12=>"m",13=>"n",14=>"ñ",15=>"o",16=>"p",17=>"q",18=>"r",19=>"s",20=>"t",21=>"u",22=>"v",23=>"w",24=>"x",25=>"y",26=>"z"]);
	$abcMayusculaArr = array_map("utf8_decode", [0=>"A",1=>"B",2=>"C",3=>"D",4=>"E",5=>"F",6=>"G",7=>"H",8=>"I",9=>"J",10=>"K",11=>"L",12=>"M",13=>"N",14=>"Ñ",15=>"O",16=>"P",17=>"Q",18=>"R",19=>"S",20=>"T",21=>"U",22=>"V",23=>"W",24=>"X",25=>"Y",26=>"Z"]);

	$nuevaCadena = "";
	for ( $i = 0; $i < strlen($cadena); $i++) 
	{ 
		if( in_array($cadena[$i], $abcMinusculaArr) )
		{
			$pos = array_search($cadena[$i], $abcMinusculaArr)+1;
			$nuevaCadena .= "<b>".( ( isset($abcMinusculaArr[$pos]) ) ? $abcMinusculaArr[$pos] : $abcMinusculaArr[0] )."</b>";
		}
		else if( in_array($cadena[$i], $abcMayusculaArr) ){
			$pos = array_search($cadena[$i], $abcMayusculaArr)+1;
			$nuevaCadena .= "<b>".( ( isset($abcMayusculaArr[$pos]) ) ? $abcMayusculaArr[$pos] : $abcMayusculaArr[0] )."</b>";
		}
		else{
			$nuevaCadena .= $cadena[$i];
		}
	}
	return $nuevaCadena ;
}

?>
