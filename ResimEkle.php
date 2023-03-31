<?php
include('includes/header.php');
include('includes/navbar.php');

require_once("baglan.php");
?>



<div class="col-xl-11 mx-auto mt-2  items-align-center">

    <div class="card o-hidden border-5 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="row ml-4 mt-5 mr-5 ">

                        <div class="col-xl-6">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
                                enctype="multipart/form-data">
                                <label for="" class="text-bold">Dosya</label>
                                <input type="file" class="form-control mb-3" name="file">

                                <label for="" class="text-bold">Tarih</label>
                                <input type="date" class="form-control mb-3" name="date">

                                <label for="" class="text-bold"> Etiket</label>
                                <input type="text" class="form-control mb-3" name="etiket">


                        </div>

                    </div>
                    <button type="submit" class="btn btn-danger  ml-5 mt-4">
                        <i class="fa fa-plus"></i> Ekle
                    </button>
                    </form>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        if (empty($_POST["file"]) && empty($_POST["date"]) && empty($_POST["etiket"])) {
                            echo ('<div class="alert alert-danger ml-4 mr-4 mt-3">Bütün alanlar zorunludur! Lütfen zorunlu alanları doldurunuz!</div>');
                            

                        } else {
                            echo ('<div class="alert alert-success ml-4 mr-4 mt-3">Veriler başarılı bir şekilde eklenmiştir!</div>');
                            




                            $file_name = $_FILES['file']['name'];
                            $file_temp = $_FILES['file']['tmp_name'];
                            $file_size = $_FILES['file']['size'];
                            $file_type = $_FILES['file']['type'];

                            $location = "uploads/" . $file_name;

                            move_uploaded_file($file_temp, $location);

                            $date = $_POST['date'];
                            $ticket = $_POST['etiket'];


                            $db = new database();
                            $query = $db->Insert("INSERT INTO images SET
                                    imagePath=?,
                                    imageDate=?,
                                    imageTicket=?", array($location, $date, $ticket));

                        }
                        
                    }
                    ?>



                    <?php $cnt = 3;
                    if ($cnt == 1) { ?>
                        <div class="alert alert-success ml-5 mr-5 mt-3 mb-4">
                            <div class="alert-message text-success">Veriler Başarıyla Eklendi!</div>
                        </div>
                    <?php }
                    if ($cnt == 2) { ?>
                        <div class="alert alert-danger ml-5 mr-5 mt-3 mb-4">
                            <div class="alert-message text-danger">Lütfen Formdan boş kutucuk bırakmayınız?</div>
                        </div>
                    <?php } ?>

                    <div class=" ml-5 mt-5 mr-5 text-danger text-center">

                    </div>


                </div>
            </div>
        </div>
    </div>












    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>