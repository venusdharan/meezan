<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function collapsiblebox($title,$content)
{
    $box = "<div class='box box-default'>
  <div class='box-header with-border'>
    <h3 class='box-title'>$title</h3>
    <div class='box-tools pull-right'>
      <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class='box-body'>
    $content
  </div><!-- /.box-body -->
</div><!-- /.box -->";
    return $box;
}

function removablebox($title,$content)
{
    $cont = "<div class='box box-default'>
  <div class='box-header with-border'>
    <h3 class='box-title'>$title</h3>
    <div class='box-tools pull-right'>
      <button class='btn btn-box-tool' data-widget='remove'><i class='fa fa-times'></i></button>
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class='box-body'>
    $content
  </div><!-- /.box-body -->
</div><!-- /.box -->";
    return $cont;
}

function expandablebox($title,$conetnt)
{
    $box = "<div class='box box-default collapsed-box'>
  <div class='box-header with-border'>
    <h3 class='box-title'>$title</h3>
    <div class='box-tools pull-right'>
      <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-plus'></i></button>
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class='box-body'>
    $content
  </div><!-- /.box-body -->
</div><!-- /.box -->";
    return $box;
}
