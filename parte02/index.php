<?php 

require 'vendor/autoload.php';

$app = new Slim\App();

$app->get('/', function () use ($app) {
	$data = file_get_contents("employees.json");
	$empleados = json_decode($data, true);
	$str = "<table border='1'><tr style='text-align:center;'><td><b>name</b></td><td><b>email</b></td><td><b>position</b></td><td><b>salary</b></td></tr>";
	for ($i=0; $i < count($empleados); $i++) { 
		$str .= "<tr><td style='padding:10px'>".$empleados[$i]['name']."</td>";
		$str .= "<td style='padding:10px'>".$empleados[$i]['email']."</td>";
		$str .= "<td style='padding:10px'>".$empleados[$i]['position']."</td>";
		$str .= "<td style='padding:10px'>".$empleados[$i]['salary']."</td></tr>";
	}
	$str .= "<tr><td colspan='4' style='padding:10px; text-align:center;'>";
	$str .= "<form action='buscar' method='post'>";
	$str .= " <input type='hidden' name='_METHOD' value='POST' > ";
	$str .= " <label> Email </label> ";
	$str .= " <input type='text' name='email' > ";
	$str .= " <input type='submit' value='Buscar' > ";
	$str .= "</form></td></tr>";
	$str .= "</table>";

   	echo $str;
});

$app->post('/buscar', function ($request, $response, $args) {
	$email = $request->getParam('email');
	$data = file_get_contents("employees.json");
	$empleados = json_decode($data, true);
	
	$str = "<table border='1'><tr style='text-align:center;'><td><b>name</b></td><td><b>email</b></td><td><b>phone</b></td><td><b>address</b></td><td><b>position</b></td><td><b>salary</b></td><td><b>skills</b></td></tr>";
	for ($i=0; $i < count($empleados); $i++) { 
		if( $email == $empleados[$i]['email'])
		{
			$skills = $empleados[$i]['skills'];
			$str .= "<tr><td style='padding:10px'>".$empleados[$i]['name']."</td>";
			$str .= "<td style='padding:10px'>".$empleados[$i]['email']."</td>";
			$str .= "<td style='padding:10px'>".$empleados[$i]['phone']."</td>";
			$str .= "<td style='padding:10px'>".$empleados[$i]['address']."</td>";
			$str .= "<td style='padding:10px'>".$empleados[$i]['position']."</td>";
			$str .= "<td style='padding:10px'>".$empleados[$i]['salary']."</td>";
			$str .= "<td style='padding:10px'>";
			for ($j=0; $j < count($skills); $j++) { 
				$str .= $skills[$j]['skill'].", ";
			}
			$str .= "</td></tr>";
		}
	}
	$str .= "</table>";
	echo $str;
});

$app->post('/buscarSalario', function ($request, $response, $args) {
	$salarioMin = floatval( $request->getParam('salarioMin') );
	$salarioMax = floatval( $request->getParam('salarioMax') );
	$data = file_get_contents("employees.json");
	$empleados = json_decode($data, true);
	$nEmpleado = array();
	for ($i=0; $i < count($empleados); $i++) {
		$salario = str_replace(",", "", substr($empleados[$i]['salary'], 1, -1) );
		if($salario >= $salarioMin && $salario <= $salarioMax){
			array_push($nEmpleado, $empleados[$i]);
		}
	}

	echo json_encode($nEmpleado);
	
	/*header('Content-type: text/xml'); 
	$app->response->headers['Content-Type'] = 'application/xml';

    foreach($nEmpleado as $index => $post) {
    	echo '<empleado>';
        if(is_array($post)) {
            foreach($post as $key => $value) {
                echo '<',$key,'>';
                if(is_array($value)) {
                    foreach($value as $tag => $val) {
                    	if(is_array($val)){
                    		foreach($val as $isk => $sk) {
                    			echo '<',$isk,'>', $sk ,'</',$isk,'>';
                    		}
                    	}
                    }
                }else {
	            	echo $value ,'</',$key,'>';
	            }
            }
            echo '</empleado>';
        }
    }*/
});

$app->run();