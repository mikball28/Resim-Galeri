<?php
include('includes/header.php');
include('includes/navbar.php');

require_once("baglan.php");
?>



<div class="col-xl-11 mx-auto mt-2  items-align-center">
    <div class="row mt-5">




    </div>
    <div class="card o-hidden border-5 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="row ml-4 mt-5 mr-5 ">
                        <div class="col-xl-6">
                            <div class="alert alert-warning  mr-5 mt-3 mb-4">
                                <div class="alert-message text-warning"><i class="bi bi-info-circle-fill"></i><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                    </svg><span class="ml-1">Girilecek etiket kelimeleri birer boşluk arası olacak şekilde giriniz !</span></div>
                            </div>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <label for="" class="text-bold"> Etiket</label>
                                <input type="text" class="form-control" name="ticket">
                        </div>




                    </div>
                    <button type="submit" class="btn btn-primary  ml-5 mt-4">
                        <i class="fas fa-search ml-2 mr-2"></i> Filtrele
                    </button>
                    </form>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        $ticket = $_POST['ticket'];

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
        $db = new database();
        $toplamTQuery = $db->getColumn("SELECT COUNT(imageDate) FROM images  WHERE MATCH(imageTicket) AGAINST('$ticket' IN BOOLEAN MODE) ") ?>
        <div class="col-xl-3 mx-auto mb-2 ">
            <div class="shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto mr-4 ">
                            </i><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                class="bi bi-images" viewBox="0 0 16 16">
                                <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                <path
                                    d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z" />
                            </svg>
                        </div>
                        <div class="col mr-2">
                            <div class="h5 mb-2 font-weight-bold text-gray-800">

                                <div class="text-danger">
                                    <?php echo $toplamTQuery; ?>
                                </div>

                            </div>
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                Filtrelenen Fotoğraf
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <?php
            $db = new database();
            $query = $db->getRows("SELECT * FROM images WHERE MATCH(imageTicket) AGAINST('$ticket' IN BOOLEAN MODE) ORDER BY imageDate DESC");
            foreach ($query as $items) {
                ?>
                <div class="col-xl-4 mx-auto mb-4 ">
                    <div class="shadow h-100 py-1">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto mr-4 ">

                                </div>
                                <div class="col mr-2">
                                    <div class="h5 mb-2 font-weight-bold text-gray-800">

                                        <div class="text-dark mt-4">
                                            <img src="<?php echo $items->imagePath; ?>" width="385px" height="385px"
                                                alt="ARGALI22" class=" rounded-circle mr-2"><br>

                                        </div>
                                        <div
                                            class="text-xs font-weight-bold text-danger text-center text-uppercase mt-5 shadow py-2">
                                            <?php echo $items->imageID; ?> · <?php echo $items->imageDate; ?> · <?php echo $items->imageTicket; ?>
                                        </div>

                                    </div>
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>


    <?php } ?>
    







    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>