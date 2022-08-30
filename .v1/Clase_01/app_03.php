<?php
    $a = 1;
    $b = 5;
    $c = 1;

    if($a==$b || $a==$c || $b==$c){
        echo "No hay valor del medio";
    }

    if( ($a>$b && $b>$c) || ($c>$b && $b>$a) )
    {
        echo "El ".$b." es del medio";
    }
    else
    {
        if(($b>$a && $a>$c) || ($c>$a && $a>$b))
        {
            echo "El ".$a." es del medio";
        }
        else
        {
            if(($a>$c && $c>$b) || ($b>$c && $c>$a))
            {
                echo "El ".$c." es del medio";
            }
        }
    }

?>