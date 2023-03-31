<?php
include('includes/header.php');
include('includes/navbar.php');

require_once("baglan.php");



?>
<div class="container-fluid shadow mt-5 ml-5 mb-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="myFile">

                        </div>
                        <button type="submit" class="btn btn-outline-danger">Yükle</button>
    



                </form>
            </div>
        </div>

    </div>

</div>