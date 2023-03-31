<?php
include('includes/header.php');
include('includes/navbar.php');

require_once("baglan.php");
$db = new database();
if (isset($_GET['sil'])) {
  $sil = $_GET['sil'];
  $delete = $db->Delete("DELETE FROM images WHERE imageID=?", array($sil));
}

$db = new database();
$page = empty($_GET["page"]) ? 1 : $_GET["page"];
$limit = 12;
$startlimit = ($page * $limit) - $limit;
$totalRecord = $db->getColumn("SELECT count(*) FROM images ");
$pageNumber = ceil($totalRecord / $limit);
?>



<div class="col-xl-11 mx-auto mt-2  items-align-center">
  <div class="row mt-5">

    <?php
    $db = new database();
    $toplamQuery = $db->getColumn("SELECT COUNT(imageDate) FROM images") ?>



  </div>

  <div class="card o-hidden bg-light border-5 shadow my-5">
    <div class="card-body p-0">
      <div class=" ml-5 mt-3 mb-3 mr-5 text-warning text-center">
        <i class="bi bi-images"></i><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
          class="bi bi-images" viewBox="0 0 16 16">
          <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
          <path
            d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z" />
        </svg><b class="ml-2">Toplam Fotoğraf <span class="badge badge-warning ml-2">
            <?php echo $toplamQuery; ?></b> </span>
      </div>
    </div>
  </div>



  <div class="row mt-5 ">
    <?php
    $db = new database();
    $query = $db->getRows("SELECT * FROM images ORDER BY imageID DESC LIMIT $startlimit,$limit");
    foreach ($query as $items) {
      ?>
      <div class="col-xl-4 mx-auto mb-4 ">
        <div class="shadow h-100 py-1">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col-auto mr-4 ">


              </div>
              <div class="col mr-2 text-center">
                <div class="h5 mb-2 font-weight-bold text-gray-800">

                  <div class="text-dark mt-4 bg-image hover-overlay ripple shadow-1-strong rounded"
                    data-mdb-ripple-color="light">
                    <img src="<?php echo $items->imagePath; ?>" class="w-100 mr-2" width="350px" height="350px"
                      alt="image"><br>
                    <a href="#!">
                      <div class="mask" style="background-color: hsla(0, 0%, 98%, 0.2)"></div>
                    </a>
                  </div>
                  <div class="text-xs font-weight-bold text-danger text-center text-uppercase mt-5 shadow py-2">
                    <?php echo $items->imageID; ?> · <?php echo $items->imageDate; ?> · <?php echo $items->imageTicket; ?>
                  </div>
                  <div class="mt-3">
                    <a href="?sil=<?= $items->imageID; ?>"
                      onclick="return confrim('Silinme işlemi gerçekleştirilsin mi?')" name="Agiris"
                      class="btn btn-outline-danger mt-1 ">
                      <i class="bi bi-trash3 "></i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-trash3 " viewBox="0 0 16 16">
                        <path
                          d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                      </svg></a>
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
  <div class="row justify-content-center">
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <?php
        if ($page > 1) {
          $newPage = $page - 1;
          echo '<li class="page-item"><a class="page-link" href="http://localhost/ResimGaleri/index.php?page=' . $newPage . '">Geri</a></li>';
        } else {
          echo '<li class="page-item"><a class="page-link disabled" href="javascript:void(0)">Geri</a></li>';
        }
        $record = 2;
        for ($i = $page - $record; $i <= $page + $record; $i++) {
          if ($i > 0 and $i <= $pageNumber) {
            echo '<li class="page-item"><a class="page-link" href="http://localhost/ResimGaleri/index.php?page=' . $i . '">' . $i . '</a></li>';
          }
        }

        if ($page != $pageNumber) {
          $newPage = $page + 1;
          echo '<li class="page-item"><a class="page-link" href="http://localhost/ResimGaleri/index.php?page=' . $newPage . '">İleri</a></li>';
        } else {
          echo '<li class="page-item"><a class="page-link disabled" href="javascript:void(0)">İleri</a></li>';
        }

        ?>

      </ul>
    </nav>
  </div>




  <?php
  include('includes/scripts.php');
  include('includes/footer.php');
  ?>