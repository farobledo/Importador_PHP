<?php
include "database.php";
include "class.upload.php";

if(isset($_FILES["name"])){
	$up = new Upload($_FILES["name"]);
	if($up->uploaded){
		$up->Process("./uploads/");
		if($up->processed){
            /// leer el archivo excel
            require_once 'PHPExcel/Classes/PHPExcel.php';
            $archivo = "uploads/".$up->file_dst_name;
            $inputFileType = PHPExcel_IOFactory::identify($archivo);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($archivo);
            $sheet = $objPHPExcel->getSheet(0); 
            $highestRow = $sheet->getHighestRow(); 
            $highestColumn = $sheet->getHighestColumn();
            $idparent = 0;
            $position =  0;
            $skill = 0;

            if ($position = $value * 0.40) {
                $position = $value * 0.40;
            }elseif ($position = $value * 0.40) {
                $position = $value * 0.40;

            }

            if ($skill = $value * 0.40) {
                $skill = $value * 0.40;
            }elseif ($skill = $value * 0.40) {
                $skill = $value * 0.40;

            }


            $arrays = array('#' => 'No', '%' => ' por ciento', '(' => '', ')' => '', '<' => '', '>' => '','&' => 'Y');

            for ($row = 2; $row <= $highestRow; $row++){ 
                $state = $sheet->getCell("A".$row)->getValue();
                $city = $sheet->getCell("B".$row)->getValue();
                $name = $sheet->getCell("C".$row)->getValue();
                $day = $sheet->getCell("D".$row)->getValue();
                $posture = $sheet->getCell("E".$row)->getValue();
                $value = $sheet->getCell("F".$row)->getValue();
                $content = $sheet->getCell("G".$row)->getValue();

                function validate($state, $city, $name, $day, $posture, $value, $content){
                    $error = array();
                    if($state == ""){
                        $error[] = "El campo departamento no puede estar vacio";
                    }else{
                        alert ("Este es el nombre del departamento. $state");
                    }

                    if($city == ""){
                        $error[] = "Hace falta el nombre de la ciudad";
                    }else{
                        alert ("Este es el nombre de la ciudad. $city");
                    }

                    if($name == ""){
                        $error[] = "El campo nombre no puede estar vacio";
                    }else{
                        alert ("Este es el nombre del candidato. $name");
                    }

                    if($day == ""){
                        $error[] = "Hace la fecha de ingreso";
                    }else{
                        alert ("Este es la fecha de ingreso. $day");
                    }

                    if($posture == ""){
                        $error[] = "Hace falta la postura";
                    }else{
                        alert ("Este es la postura. $posture");
                    }

                    if($value == ""){
                        $error[] = "Hace falta el valor";
                    }else{
                        alert ("Este es el valor. $value");
                    }

                    if($content == ""){
                        $error[] = "Hace falta el contenido";
                    }else{
                        alert ("Este es el contenido. $content");
                    }

                    return $error;
                }

                $error = validate($state, $city, $name, $day, $posture, $value, $content);

                if($error){
                    echo "<script>
                    alert('".$error[0]."');
                    window.location = './index.php';
                    </script>
                    ";
                    die();
                }


                if ($state == "Cundinamarca") {
                    $idparent = 138;
                }elseif ($state == "Antioquia") {
                    $idparent = 137;
                }elseif ($state == "valle") {
                    $idparent = 139;
                }

                foreach($arrays as $key => $value){
                    $name = replace_string($key, $value, $name);
                    $content = replace_string($key, $value, $content);
                }

                
                $curl = curl_init();

                curl_setopt_array($curl, array( CURLOPT_URL => 'http://rematealdia.com/Robotversion.1.0.2.php',

                CURLOPT_RETURNTRANSFER => true,

                CURLOPT_ENCODING => '',

                CURLOPT_MAXREDIRS => 10,

                CURLOPT_TIMEOUT => 0,

                CURLOPT_FOLLOWLOCATION => true,

                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

                CURLOPT_CUSTOMREQUEST => 'GET',

                CURLOPT_POSTFIELDS => array('idparent' => '138','name' => '2020-03-11 Local Calle 11 Sur No. 14','day' => '2020-03-11','value' => '$252.190.500','state' => 'Cundinamarca','city' => 'Bogotá','position' => '$176.533.350','posture' => '70%','skill' => '40%','content' => 'Local Calle 11 Sur No. 14. AVISO DE REMATE'),

                CURLOPT_HTTPHEADER => array( 'Content-Type: application/x-www-form-urlencoded'),

                ));

                $response = curl_exec($curl);

                curl_close($curl);

                echo $response;
               


                // $x_no = $sheet->getCell("A".$row)->getValue();
                // $x_name = $sheet->getCell("B".$row)->getValue();
                // $x_lastname = $sheet->getCell("C".$row)->getValue();
                // $x_address1 = $sheet->getCell("D".$row)->getValue();
                // $x_email = $sheet->getCell("E".$row)->getValue();
                // $x_phone1 = $sheet->getCell("F".$row)->getValue();

               // $sql = "insert into person (no, name, lastname, address1, email1, phone1, created_at) value ";
                //$sql .= " (\"$x_no\",\"$x_name\",\"$x_lastname\",\"$x_address1\",\"$x_email\",\"$x_phone1\", NOW())";
              // $con->query($sql);

            }
            
            function replace_string($search, $replace, $subject){
                return str_replace($search, $replace, $subject);
            }

    	unlink($archivo);
        }	

}
}
echo "<script>
window.location = './index.php';
</script>
";
?>