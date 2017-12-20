<?php
function getsidebarcontrolmenu()
{
    $datas = "<aside class='control-sidebar control-sidebar-dark'>
    <ul class='nav nav-tabs nav-justified control-sidebar-tabs'>
      <li class='active'><a href='#control-sidebar-home-tab' data-toggle='tab'><i class='fa fa-home'></i></a></li>
      <li><a href='#control-sidebar-settings-tab' data-toggle='tab'><i class='fa fa-gears'></i></a></li>
    </ul>
    <div class='tab-content'>
      <div class='tab-pane active' id='control-sidebar-home-tab'>
        <h3 class='control-sidebar-heading'>Recent Activity</h3>
        <ul class='control-sidebar-menu'>
          <li>
            <a href='javascript::;'>
              <i class='menu-icon fa fa-birthday-cake bg-red'></i>
              <div class='menu-info'>
                <h4 class='control-sidebar-subheading'>Langdon's Birthday</h4>
                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <h3 class='control-sidebar-heading'>Tasks Progress</h3>
        <ul class='control-sidebar-menu'>
          <li>
            <a href='javascript::;'>
              <h4 class='control-sidebar-subheading'>
                Custom Template Design
                <span class='pull-right-container'>
                  <span class='label label-danger pull-right'>70%</span>
                </span>
              </h4>
              <div class='progress progress-xxs'>
                <div class='progress-bar progress-bar-danger' style='width: 70%'></div>
              </div>
            </a>
          </li>
        </ul>
      </div>
      <div class='tab-pane' id='control-sidebar-stats-tab'>Stats Tab Content</div>
      <div class='tab-pane' id='control-sidebar-settings-tab'>
        <form method='post'>
          <h3 class='control-sidebar-heading'>General Settings</h3>
          <div class='form-group'>
            <label class='control-sidebar-subheading'>
              Report panel usage 
              <input type='checkbox' class='pull-right' checked>
            </label>
              
          </div>
        </form>
      </div>
    </div>
  </aside>
  <div class='control-sidebar-bg'></div>";
    return $datas;
}


function getmainsidebarmenu($data ,$image)
{
    
    $datas = "<aside class='main-sidebar '>

    <!-- sidebar: style can be found in sidebar.less -->
    <section class='sidebar'>

      <!-- Sidebar user panel (optional) -->
      <div class='user-panel'>
        <div class='pull-left image'>
          <!--img src='dist/img/user2-160x160.jpg' class='img-circle' alt='User Image'-->
          $image
          </br>
        </div>
        <div class='pull-left info'>
          <p>".$data['name']."</p>
          <!-- Status -->
          <a href='#' ><i class='fa fa-circle text-success'></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <!--form action='#' method='get' class='sidebar-form'>
        <div class='input-group'>
          <input type='text' name='q' class='form-control' placeholder='Search...'>
              <span class='input-group-btn'>
                <button type='submit' name='search' id='search-btn' class='btn btn-flat'><i class='fa fa-search'></i>
                </button>
              </span>
        </div>
      </form-->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class='sidebar-menu'>
        <li class='header'>MENU</li>
        <!--div id='side-menus-items'>
            
        </div-->
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>";
    return $datas;
}
