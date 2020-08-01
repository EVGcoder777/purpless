<?php
$title = 'Purpless - Generator';
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

                <li class="active">
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
                                    <img src="../assets/img/anime3.png" alt="M">
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-category">Purpless Generator <font color="#f0f8ff">(<?= $attempts ?>)</font></h5>
                        </div>
                        <div class="card-body">
                            <?php if (isset($error)) { ?>
                                <div style="background-color: #c44dd3;" class="alert alert-primary" role="alert">
                                    <?= $error ?>
                                </div>
                            <?php } elseif (isset($success)) { ?>
                                <div style="" class="alert alert-success" role="alert">
                                    <?= $success ?>
                                </div>
                            <?php } ?>
                            <form method="POST" action="">
                                <div class="card" style="width: 20rem;">
                                    <img class="card-img-top" src="img/csgo.png" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">CS:GO Account <font color="#f0f8ff">(<?= $stock['csgo'] ?>)</font></h4>
                                        <p class="card-text">By using this generator you will get a 2 lvl, matchmaking ready CS:GO account.</p>
                                        <button type="submit" name="generate-btn" class="btn btn-primary" value="1">Generate</button>
                                    </div>
                                </div>
                            </form>
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
                                    <h5 class="card-category">Generator</h5>
                                    <h2 class="card-title">Your generations</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <table id="table_id" class="display">
                                <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Content</th>
                                    <th>Generated</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php while ($data = $story->fetch()) { ?>
                                <tr>
                                    <td><?= $data['type_name'] ?></td>
                                    <td><?= $data['content'] ?></td>
                                    <td><?= $data['generation_time'] ?></td>
                                </tr>
                                <?php } ?>
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