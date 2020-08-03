<?php
$title = 'Purpless - Profile view';
ob_start();
?>
<div class="wrapper">
    <div class="sidebar">

        <div class="sidebar-wrapper">
            <ul class="nav">
                <li >
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

                <li class="active">
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
                    <img src="avatars/<?= $data['avatar'] ?>" alt="M">
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
          <?php } ?>
        <div class="row">
                    <div class="col-md-4">
            <div class="card card-user">
              <div class="card-body">
                <p class="card-text">
                  <div class="author">
                    <div class="block block-one"></div>
                    <div class="block block-two"></div>
                    <div class="block block-three"></div>
                    <div class="block block-four"></div>
                    <a>
                        <img class="avatar" src="avatars/<?= $data['avatar'] ?>" alt="User profile image">
                        <h5 class="title"><?= $data['username'] ?></h5>
                    </a>
                    <p class="description">
                      <?= getUsergroupById($data['usergroup']) ?>
                    </p>
                  </div>
                </p>
                <div class="card-description">
                  <?= $data['description'] ?><br><br>
                  Invited by <?= getUsernameById($data['invited_by']) ?><br>
                  PC$ Balance: <?= $data['money'] ?>
                </div>
              </div>
            </div>
          </div>
          <?php if ($_SESSION['id'] == $_GET['uid']) { ?>
              <div class="col-md-8">
                  <div class="card">
                      <div class="card-header">
                          <h5 class="title">Edit Profile</h5>
                      </div>
                      <div class="card-body">

                          <form method="POST" action="" enctype="multipart/form-data">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label>Username</label><small> (Soon a username change request system will be available)</small>
                                          <input disabled type="text" class="form-control" placeholder="Company" value="Armani">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-8">
                                      <div class="form-group">
                                          <label>Invite codes:</label><br>
                                          <?php while ($invs = $invites->fetch()) { ?>

                                              <span style="color: white"><?= $invs['code'] ?></span><br>
                                          <?php } ?>

                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-8">
                                      <div class="form-group">
                                          <label>Upload avatar:</label>
                                          <input type="file" name="avatar">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-8">
                                      <div class="form-group">
                                          <label>About Me</label>
                                          <textarea name="user-desc" rows="4" maxlength="100" cols="80" class="form-control" placeholder="Here can be your description"><?= $data['description'] ?></textarea>
                                      </div>
                                  </div>
                              </div>
                              <div class="card-footer">
                                  <button type="submit" name="profile-edit" class="btn btn-fill btn-primary">Save</button>
                              </div>
                      </div>

                      </form>
                  </div>
              </div>
          <?php } ?>
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