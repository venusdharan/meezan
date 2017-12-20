<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of content
 *
 * @author Triophore-2
 */
class content {
    var $title;
    var $des;
    function __construct($title,$des) {
        $this->des = $des;
        $this->title = $title;
        
    }
    function  getContent($cont)
    {
        $cot = "<section class='content-header'>
      <h1>
        $this->title
        <small>$this->des</small>
      </h1>
      <!--ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Level</a></li>
        <li class='active'>Here</li>
      </ol-->
    </section>

    <!-- Main content -->
    <section class='content'>

        $cont

    </section>";
        return $cot;
    }
}
