<?php
    $operador = "/";//cambiar operador
    $op1 = 10;
    $op2 = 2;

    switch ($operador) {
        case "+":
            echo $op1 + $op2;
            break;
        
        case "-":
            echo $op1 - $op2;
            break;
        
        case "*":
            echo $op1 * $op2;
            break;

        case "/":
            echo $op1 / $op2;
            break;
    }
?>