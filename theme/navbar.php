<?php
function getnavbar($data)
{
    $datas = "  <header class='main-header'>
    <a href='#'  data-sub-path='home' data-path='home' class='logo menu_link'>
      <span class='logo-mini'><b>M</b>&nbsp;&nbsp;E</span>
      <span class='logo-lg'><b>Meezan</b>ERP</span>
    </a>
    <nav class='navbar navbar-static-top' role='navigation'>
      <a href='#' class='sidebar-toggle' data-toggle='offcanvas' role='button'>
        <span class='sr-only'>Toggle navigation</span>
      </a>
      <div class='navbar-custom-menu'>
        <ul class='nav navbar-nav'>";
    foreach ($data as $value) {
      $datas = $datas.$value;  
    }    
    $end = "</ul>
        </div>
      </nav>
    </header>";
    $datas = $datas.$end;
    return $datas;
}

