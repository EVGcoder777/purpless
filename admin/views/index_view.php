<?php
$title = 'Purpless - Admin panel';
ob_start();
?>
<div class="wrapper">
    <div class="sidebar">

        <div class="sidebar-wrapper">
            <ul class="nav">
                <li>
                    <a href="../index.php?a=dashboard">
                        <i class="tim-icons icon-spaceship"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="">
                    <a href="../index.php?a=mstory">
                        <i class="tim-icons icon-bag-16"></i>
                        <p>Market history</p>
                    </a>
                </li>

                <li class="">
                    <a href="../index.php?a=generator">
                        <i class="tim-icons icon-app"></i>
                        <p>Generator</p>
                    </a>
                </li>

                <li>
                    <a href="../index.php?a=profile">
                        <i class="tim-icons icon-single-02"></i>
                        <p>Profile</p>
                    </a>
                </li>
                

                <li class="active">
                    <a href="../admin/index.php?a=main">
                        <i class="tim-icons icon-atom"></i>
                        <p>Admin Panel</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
              <a class="navbar-brand" href="javascript:void(0)"><font color="#cf50dd">Purple</font>ss</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
              <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="photo">
                    <img src="../../assets/img/anime3.png" alt="M">
                  </div>
                  <b class="caret d-none d-lg-block d-xl-block"></b>
                  <p class="d-lg-none">
                    Log out
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                    <li style="color: #9A9A9C" class="nav-link">Balance: <?= userBalance($_SESSION['id']) . '$' ?></li>
                    <li class="nav-link"><form method="POST" action=""><button class="btn btn-primary animation-on-hover" name="purple-logout" type="submit">Log out</button></form></li>
                </ul>
              </li>
              <li class="separator d-lg-none"></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Navbar -->
      <div class="content">
          <div class="row">
              <div class="col-lg-4">
                  <div class="card card-chart">
                      <div class="card-header">
                          <h5 class="card-category">Total items sold</h5>
                          <h3 class="card-title"><i class="tim-icons icon-money-coins text-primary"></i> <?= $items ?></h3>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="card card-chart">
                      <div class="card-header">
                          <h5 class="card-category">Total users (Neweset user: <?= $users['b'] ?>)</h5>
                          <h3 class="card-title"><i class="tim-icons icon-single-02 text-primary"></i> <?= $users['a'] ?></h3>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="card card-chart">
                      <div class="card-header">
                          <h5 class="card-category">PC$ Generated in total</h5>
                          <h3 class="card-title"><i class="tim-icons icon-coins text-primary"></i> <?= $money ?></h3>
                      </div>
                  </div>
              </div>
          </div>
        <div class="row">
          <div class="col-12">
            <div class="card card-chart">
              <div class="card-header ">
                <div class="row">
                  <div class="col-sm-6 text-left">
                    <h2 class="card-title">Marketplace control</h2>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <table id="table_id" class="display">
    <thead>
        <tr>
          <th>Id</th>
            <th>Title</th>
            <th>Username</th>
            <th>Added</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
          <td>1</td>
            <td>GameSense Old forum source</td>
            <td>Admin</td>
            <td>12/07/2020 15:15:15</td>
            <td><a href="?del_prod=99"><button type="button" class="btn btn-danger"> <i class="tim-icons icon-simple-remove"></i> Delete</button></a><a href="?a=edititem&id=99"><button type="button" class="btn btn-warning"><i class="tim-icons icon-pencil"></i> Edit</button></a></td>
        </tr>
        <tr>
          <td>1</td>
            <td>GS</td>
            <td>ezfezfzfezf</td>
            <td>12/07/2020 15:15:15</td>
            <td><a href="?del_prod=99"><button type="button" class="btn btn-danger"> <i class="tim-icons icon-simple-remove"></i> Delete</button></a><a href="?a=edititem&id=99"><button type="button" class="btn btn-warning"><i class="tim-icons icon-pencil"></i> Edit</button></a></td>
        </tr>
    </tbody>
</table>
              </div>
            </div>
          </div>
        </div>

<!--News table-->
                <div class="row">
          <div class="col-12">
            <div class="card card-chart">
              <div class="card-header ">
                <div class="row">
                  <div class="col-sm-6 text-left">
                    <h2 class="card-title">News control</h2>
                    <a href="#"><button type="button" class="btn btn-warning"><i class="tim-icons icon-simple-add"></i> Add News</button></a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <table id="table_id2" class="display">
    <thead>
        <tr>
          <th>Id</th>
            <th>Title</th>
            <th>Username</th>
            <th>Added</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
          <td>1</td>
            <td>GameSense Old forum source</td>
            <td>Admin</td>
            <td>12/07/2020 15:15:15</td>
            <td><a href="?del_news=5"><button type="button" class="btn btn-danger"> <i class="tim-icons icon-simple-remove"></i> Delete</button></a><a href="?a=editnw&id=4"><button type="button" class="btn btn-warning"><i class="tim-icons icon-pencil"></i> Edit</button></a></td>
        </tr>
        <tr>
          <td>1</td>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
            <td>Row 1 Data 2</td>
            <td><a href="?del_news=5"><button type="button" class="btn btn-danger"> <i class="tim-icons icon-simple-remove"></i> Delete</button></a><a href="?a=editnw&id=4"><button type="button" class="btn btn-warning"><i class="tim-icons icon-pencil"></i> Edit</button></a></td>
        </tr>
    </tbody>
</table>
              </div>
            </div>
          </div>
        </div>

                        <div class="row">
          <div class="col-12">
            <div class="card card-chart">
              <div class="card-header ">
                <div class="row">
                  <div class="col-sm-6 text-left">
                    <h2 class="card-title">Users list</h2>
                    <a href="#"><button type="button" class="btn btn-warning"><i class="tim-icons icon-simple-add"></i> Add User</button></a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <table id="table_id3" class="display">
    <thead>
        <tr>
          <th>Id</th>
            <th>Username</th>
            <th>Invited by</th>
            <th>Last Visit</th>
            <th>Last IP</th>
            <th>Reg IP</th>
            <th>RegDate</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
          <td>1</td>
            <td>Myasnik</td>
            <td>System</td>
            <td>12/07/2020 15:15:15</td>
            <td>127.0.0.1</td>
            <td>127.0.0.1</td>
            <td>12/07/2020 15:15:15</td>
            <td><a href="?del_user=1"><button type="button" class="btn btn-danger"> <i class="tim-icons icon-simple-remove"></i> Delete</button></a><a href="?a=edituser&id=1"><button type="button" class="btn btn-warning"><i class="tim-icons icon-pencil"></i> Edit</button></a></td>
        </tr>
        <tr>
          <td>1</td>
            <td>TKX</td>
            <td>System</td>
            <td>12/07/2020 15:15:15</td>
            <td>127.0.0.1</td>
            <td>127.0.0.1</td>
            <td>12/07/2020 15:15:15</td>
            <td><a href="?del_user=1"><button type="button" class="btn btn-danger"> <i class="tim-icons icon-simple-remove"></i> Delete</button></a><a href="?a=edituser&id=1"><button type="button" class="btn btn-warning"><i class="tim-icons icon-pencil"></i> Edit</button></a></td>
        </tr>
    </tbody>
</table>
              </div>
            </div>
          </div>
        </div>


                                <div class="row">
          <div class="col-12">
            <div class="card card-chart">
              <div class="card-header ">
                <div class="row">
                  <div class="col-sm-6 text-left">
                    <h2 class="card-title">Logs</h2>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <table id="table_id4" class="display">
    <thead>
        <tr>
          <th>Id</th>
            <th>Username</th>
            <th>Description</th>
            <th>IP</th>
            <th>DateTime</th>
        </tr>
    </thead>
    <tbody>
        <tr>
          <td>1</td>
            <td>Myasnik</td>
            <td>System</td>
            <td>12/07/2020 15:15:15</td>
            <td>127.0.0.1</td>
        </tr>
        <tr>
          <td>1</td>
            <td>TKX</td>
            <td>System</td>
            <td>12/07/2020 15:15:15</td>
            <td>127.0.0.1</td>
        </tr>
    </tbody>
</table>
              </div>
            </div>
          </div>
        </div>

      </div>
      <footer class="footer">
        <div class="container-fluid">
          <ul class="nav">
            <li class="nav-item">
              <a href="" class="nav-link">
                Discord
              </a>
          </ul>
        </div>
      </footer>
    </div>
  </div>
<?php
$content = ob_get_clean();
require('admin_template.php');
?>