<?php
include('includes/header.php');
?>
<form action="download.php" method="POST">
    <input type="text" name="etiket" placeholder="etiket"><br>
    <button type="submit" class="btn btn-danger">İndir</button>
</form>
<?php
if ($_POST) {
    $etiket = $_POST["etiket"];

    ?>
    <?php
    require_once("baglan.php");

    $db = new database();
    $query = $db->getRows("SELECT * FROM images WHERE MATCH(imageTicket) AGAINST('$etiket' IN BOOLEAN MODE)");
    foreach ($query as $items) {
        
        $zip_file="./zip/all-images.zip";
        touch($zip_file);

        $zip = new ZipArchive;
        $this_zip = $zip->open($zip_file);

        if ($this_zip) {

         $file_with_path = "./" . $items->imagePath;
            $zip->addFile($file_with_path,$items->imagePath);
            
        }
        //if(file_exists($zip_file)){
            //$demo_name = "all-imagess.zip";
            //header('Content-Type: application/zip');
            //header('Content-Disposition: attachment; filename="'.$demo_name.'"');
            //readfile($zip_file);
          //  unlink($zip_file);
      // }


    }
    
}
?>