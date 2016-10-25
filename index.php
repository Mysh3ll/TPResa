<?php
session_start();
require 'Autoloader.php';
Autoloader::register();
?>
<?php include 'Assets/includes/header.php'; ?>

<!-- Page Content -->
<div class="container">

    <hr>
    <hr>

    <div class="row">
        <div class="col-sm-6">
            <a href="indexBack.php"><img class="img-circle img-responsive img-center admin" alt=""></a>
            <h2>Accès administrateur</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa ducimus earum esse illo itaque nobis officiis provident sequi? Aperiam aspernatur dignissimos dolorem eos, magni nulla placeat quae quasi unde voluptatem!</p>
        </div>
        <div class="col-sm-6">
            <a href="indexFront.php"><img class="img-circle img-responsive img-center user" alt=""></a>
            <h2>Accès utilisateur</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam asperiores at corporis cumque dignissimos dolorum ex laudantium nobis nulla obcaecati, placeat qui quisquam ratione tempora tempore voluptate voluptates voluptatibus voluptatum.</p>
        </div>
    </div>
    <!-- /.row -->

    <hr>
    <hr>

<?php include 'Assets/includes/footer.php'; ?>