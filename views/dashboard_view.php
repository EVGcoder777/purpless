<?php
$title = 'Purpless - Main page';
ob_start();
?>
<div class="wrapper">
    <div class="sidebar">

        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="active">
                    <a href="./index.php?a=dashboard">
                        <i class="tim-icons icon-spaceship"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="">
                    <a href="./index.php?a=mstory">
                        <i class="tim-icons icon-bag-16"></i>
                        <p>Market history</p>
                    </a>
                </li>

                <li class="">
                    <a href="./index.php?a=generator">
                        <i class="tim-icons icon-app"></i>
                        <p>Generator</p>
                    </a>
                </li>

                <li>
                    <a href="./index.php?a=profile&uid=<?= $_SESSION['id'] ?>">
                        <i class="tim-icons icon-single-02"></i>
                        <p>Profile</p>
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
              <a class="navbar-brand" href="index.php"><font color="#cf50dd">Purple</font>ss</a>
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
                      <img src="<?= 'avatars/' . getUserAvatar() ?>" alt="M">
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
          <?php if (isset($error)) { ?>
              <div style="background-color: #c44dd3;" class="alert alert-primary" role="alert">
                  <?= $error ?>
              </div>
          <?php } elseif (isset($success)) { ?>
              <div style="background-color: #c44dd3;" class="alert alert-primary" role="alert">
                  <?= $success ?>
              </div>
          <?php } ?>
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
                <h3 class="card-title"><i class="tim-icons icon-single-02 text-primary"></i> <a style="color: white; font-weight: 100;" href="index.php?a=users"><?= $users['a'] ?></a></h3>
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
                    <h5 class="card-category">Main</h5>
                    <h2 class="card-title">Marketplace</h2>
                  </div>
                </div>
              </div>
              <a style="margin-left: 5px;" href="index.php?a=citem"><button class="btn btn-primary animation-on-hover" type="button"><i class="tim-icons icon-pin"></i> Create item</button></a>
              <div class="card-body">

                <table id="table_id" class="display">
    <thead>
        <tr>
            <th>Title</th>
            <th>Username</th>
            <th>Added</th>
            <th>Buy</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($itm = $market->fetch()) { ?>
        <tr>
            <td><?= $itm['title'] ?></td>
            <td><?= getUsernameById($itm['seller']) ?></td>
            <td><?= $itm['added'] ?></td>
            <td><form method="POST" action=""><button name="buy-item" value="<?= $itm['id'] ?>" class="btn btn-primary animation-on-hover" type="submit"><i class="tim-icons icon-cart"></i> <?= $itm['price'] ?> PC$</button></form></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card card-tasks">
              <div class="card-header ">
                <h6 class="title d-inline">News</h6>
                <div class="dropdown">
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#pablo">Action</a>
                    <a class="dropdown-item" href="#pablo">Another action</a>
                    <a class="dropdown-item" href="#pablo">Something else</a>
                  </div>
                </div>
              </div>
              <div class="card-body ">
                <div class="table-full-width table-responsive">
                  <table class="table">
                    <tbody>
                    <?php while ($fetch = $news->fetch()) { ?>
                      <tr>
                        <td>
                          <p class="title">Update <?= $fetch['post_time'] ?></p>
                          <p class="text-muted">- <?= $fetch['text'] ?></p>
                        </td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

          <div class="col-12">
              <div class="card card-chart">
                  <div class="card-header">
                      <h1 class="card-category">Users online:</h1>
                      <h4 class="card-title"><?php while($data = $online->fetch()) { ?>
                            <a href="index.php?a=profile&uid=<?= $data['user_id'] ?>"><?= $data['username'] ?></a>
                          <?php } ?></h4>
                  </div>
              </div>
          </div>

      </div>
      <footer class="footer">
        <div class="container-fluid">
          <ul class="nav">
            <li class="nav-item">
              <a target="_blank" href="https://discord.gg/tNYVY45" class="nav-link">
                  <img width="30" src="img/discord.webp">
              </a>
          </ul>
        </div>
      </footer>
    </div>
  </div>
<?php
$content = ob_get_clean();
require('dash_template.php');
?>