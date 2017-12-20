<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EvalPHP
 *
 * @author Triophore-2
 */
class EvalPHP {
    //put your code here
    function evaluate($path)
    {
        ob_start();
        include "template.phtml";
        $out1 = ob_get_clean();
    }
}
