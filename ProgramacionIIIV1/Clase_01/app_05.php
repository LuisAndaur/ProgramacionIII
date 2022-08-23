<?php
    $num = 43;
    $dec = intval($num / 10);
    $uni = $num % 10;

    switch ($dec) {
        case 2:
            $cadena1 = "Veinti";
            break;

        case 3:
            $cadena1 = "Treinta";
            break;

        case 4:
            $cadena1 = "Cuarenta";
            break;
        
        case 5:
            $cadena1 = "Cincuenta";
            break;
            
        case 6:
            $cadena1 = "Sesenta";
            break;
    }

    switch ($uni) {
        case 0:
            if($dec == 2){
                $cadena1 = "Veinte";                
            }
            $cadena2 = "";
            break;
        
        case 1:
            $cadena2 = "uno";
            if($dec>2 && $dec<6){
                $cadena2 = " y uno";                
            }
            break;

        case 2:
            $cadena2 = "dos";
            if($dec>2 && $dec<6){
                $cadena2 = " y dos";                
            }
            break;

        case 3:
            $cadena2 = "tres";
            if($dec>2 && $dec<6){
                $cadena2 = " y tres";                
            }
            break;
        
        case 4:
            $cadena2 = "cuatro";
            if($dec>2 && $dec<6){
                $cadena2 = " y cuatro";                
            }
            break;

        case 5:
            $cadena2 = "cinco";
            if($dec>2 && $dec<6){
                $cadena2 = " y cinco";                
            }
            break;

        case 6:
            $cadena2 = "seis";
            if($dec>2 && $dec<6){
                $cadena2 = " y seis";                
            }
            break;
    
        case 7:
            $cadena2 = "siete";
            if($dec>2 && $dec<6){
                $cadena2 = " y siete";                
            }
            break;

        case 8:
            $cadena2 = "ocho";
            if($dec>2 && $dec<6){
                $cadena2 = " y ocho";                
            }
            break;

        case 9:
            $cadena2 = "nueve";
            if($dec>2 && $dec<6){
                $cadena2 = " y nueve";                
            }
            break;
    }

    echo $cadena1 . $cadena2;

?>