<?php
$title = 'Purpless - Edit user';
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
                  <form style="width: 100% !important;" method="POST" action="">
                    <div class="card">
    <div class="card-body">
      <h2>Edit /User username/</h2>

            <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <i class="tim-icons icon-shape-star"></i>
           </div>      
         </div>
        <input type="text" class="form-control" placeholder="Id">
      </div>

      <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <i class="tim-icons icon-single-02"></i>
           </div>      
         </div>
        <input type="text" class="form-control" placeholder="Username">
      </div>

                  <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <i class="tim-icons icon-email-85"></i>
           </div>      
         </div>
        <input type="text" class="form-control" placeholder="Email">
      </div>

            <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <i class="tim-icons icon-minimal-down"></i>
           </div>      
         </div>
        <input type="text" class="form-control" placeholder="Invited by">
      </div>

                  <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <i class="tim-icons icon-single-copy-04"></i>
           </div>      
         </div>
        <input type="text" class="form-control" placeholder="Description">
      </div>

                  <div class="form-group">
        <select class="form-control" id="exampleFormControlSelect1">
          <option selected="">Current role: Admin</option>
          <option>Admin</option>
          <option>Vip</option>
          <option>Premium</option>
          <option>User</option>
        </select>
      </div>

      <a href="#"><button type="submit" class="btn btn-primary">Confirm</button></a>
      <a href="#"><button type="submit" class="btn btn-warning">Cancel</button></a>
    </div>
  </div>
                  </form>
                  


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