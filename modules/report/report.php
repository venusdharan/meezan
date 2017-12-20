<?php
if(session_id() == ""){    session_start();}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../theme/content.php';
include_once '../theme/infobox.php';
include_once '../theme/rowmaker.php';





$home = new content("Report Wizard","Welcome ".$_SESSION['username']);
//$total_members = getinfobox("bg-green", "fa fa-users", "Total Members", "$total", false, "0", '<a href="#" style="color:white;" class="menu_link" data-sub-path="members" data-path="table">View More</a>');
//$total_auctions = getinfobox("bg-aqua", "fa fa-gavel", "Total Auction", "6", false, "0", "Running ok!");
//$total_functions = getinfobox("bg-yellow", "fa fa-bullhorn", "Total Functions", "6", false, "0", "Running ok!");
//$total_income = getinfobox("bg-red", "fa fa-university", "Total Income", "6", false, "0", "Running ok!");
//$panel_array = array();
//array_push($panel_array, '');
//array_push($panel_array, '<a href="?hsns=hsh#tesh/now" target="_blank" class="btn btn-success">Total Admin Members Report</a>');
//array_push($panel_array, '<a href="/triophore/report/members_order_cat.php" target="_blank" class="btn btn-success">Total  Members Report Ordered By Category</a>');
//array_push($panel_array, '<a href="/triophore/report/members_order_ward.php" target="_blank" class="btn btn-success">Total  Members Report Ordered BY Ward</a>');//<button class='btn btn-lg' id='home_btn'>click</button>
//$row = createrows($panel_array, 4, "col-lg-3");
///triophore/report/admin.php
$box = '
    <div class="box box-success ">
  <div class="box-header with-border">
    <h3 class="box-title">Members Report Generation Section</h3>
    <!--div class="box-tools pull-right">
<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
    </div-->
  
  </div>

  <div class="box-body">
       <div class="col-sm-12">
        <!--a href="/triophore/report/members_order_cat.php"  target="_blank" class="btn btn-success el-link">Total  Members Report Ordered By Category</a></br></br-->
        <a href="/triophore/report/members.php" target="_blank" class="btn btn-success el-link">Mazjid Members Report</a>
        <a href="/triophore/report/members_order_cat.php" target="_blank" class="btn btn-success el-link">Members Report Ordered By Category</a>
        <a href="/triophore/report/members_order_ward.php" target="_blank" class="btn btn-success el-link">Members Report Ordered By Ward</a>
        <a href="/triophore/report/token.php" target="_blank" class="btn btn-success el-link">House Info Report</a>
         <a href="/triophore/report/token.php" target="_blank" class="btn btn-success el-link">Generate Token</a>
        
        </div>
  </div>
 
  <div class="box-footer">
     <div class="col-sm-12">
      
     </div>
  </div>

</div>';
$maparr = array();

array_push($maparr, $box);
$row_map = createrows($maparr, 1, "col-lg-12");

$row1 = array();

$box1 = "
          <!-- Horizontal Form -->
          <div class='box box-info'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Account Report</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class='form-horizontal'>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='start_date' class='col-sm-6 control-label'>Start Date</label>

                  <div class='col-sm-6'>
                    <input class='' id='start_date'  type='date'>
                  </div>
                </div>
                <div class='form-group'>
                  <label for='stop_date' class='col-sm-6 control-label'>Stop Date</label>

                  <div class='col-sm-6'>
                    <input class='' id='stop_date'  type='date'>
                  </div>
                </div>
                <div class='form-group'>
                  <div class='col-sm-offset-2 col-sm-10'>
                    <label for='sel1'>Sort Operations:</label>
                        <select class='form-control' id='sel1'>
                          <option value='0'>Detailed Report</option>
                        <option value='1'>Aggregate of Income And Expense Types</option>
                        </select>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class='box-footer'>
                <button  class='btn btn-default'>Generate Report</button>
               
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          
        "
        ;


$box_year = "
          <!-- Horizontal Form -->
          <div class='box box-info'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Yearly Account Report</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class='form-horizontal'>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='start_date' class='col-sm-6 control-label'>Start Date</label>

                  <div class='col-sm-6'>
                     <input type='number' min='1970' max='2099' step='1' value='2016' />
                  </div>
                </div>
                </br></br>
                <div class='form-group'>
                  <div class='col-sm-offset-2 col-sm-10'>
                    <label for='sel1'>Sort Operations:</label>
                        <select class='form-control' id='sel1'>
                        <option value='0'>Detailed Report</option>
                        <option value='1'>Aggregate of Income And Expense Types</option>
                        <!--option>B+</option>
                        <option>B-</option>
                        <option>O+</option>
                        <option>O-</option>
                        <option>AB+</option>
                        <option>AB-</option-->
                        </select>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class='box-footer'>
                <button  class='btn btn-default'>Generate Report</button>
               
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          
        "
        ;


        array_push($row1, $box1);

        array_push($row1, $box_year);
        
        array_push($row1, $box_year);
        
        $row2 =  createrows($row1, 3, "col-lg-4");

echo  $home->getContent($row_map.$row2) ;
