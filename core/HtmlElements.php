<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HtmlElements
 *
 * @author Triophore-2
 */
class HtmlElements {
    function get_tag($tag,$cont)
    {
        $tags = explode(',', $tag);
        $attr = null;
        foreach ($tags as $value) {
            if($value != $tags[0])
            {
            $attr = $attr.$value;
            }
        }
        return  $el = "<$tags[0] $attr>$cont</$tags[0]>";
    }
}
