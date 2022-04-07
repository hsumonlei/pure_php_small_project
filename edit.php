<?php
require 'config.php';

if($_POST){
    $pid = $_POST['paperid'];
    $year = $_POST['year'];
    $type = $_POST['type'];
    $zone = $_POST['zone'];
    $desc = $_POST['description'];
    $id = $_POST['id'];

    // print"<pre>";
    // print($_FILES['uploadfile']);


    if($_FILES){
        $targetfile = 'files/'.($_FILES['uploadfile']['name']);
        $filename = $_FILES['uploadfile']['name'];

        $filetype = pathinfo($targetfile,PATHINFO_EXTENSION);
        
        if($filetype != 'pdf') {
            echo "<script>alert('The file must be pdf format');window.location.href='index.php';</script>";
        }else{
        $file_move = move_uploaded_file($_FILES['uploadfile']['tmp_name'], $targetfile);
        $pdostatement = $pdo->prepare("UPDATE papers set paperid='$pid',year='$year',papertype='$type',examzone='$zone',description='$desc',uploadfile='$filename' WHERE id=$id");
        $result = $pdostatement->execute();
        }
    }
    else {
        print "<pre>";
        print_r($_FILES['uploadfile']['name']);
        $pdostatement = $pdo->prepare("UPDATE papers set paperid='$pid',year='$year',papertype='$type',examzone='$zone',description='$desc',uploadfile='$filename' WHERE id=$id");
        $result = $pdostatement->execute();
    }    
    if($result){
        echo "<script>alert('record is updated');window.location.href='index.php';</script>";
    }



}else {

    $pdostatement = $pdo->prepare("SELECT * FROM papers WHERE id=".$_GET['id']);
    $pdostatement->execute();
    $result = $pdostatement->fetchAll();

// print "<pre>";
// print_r($result[0]['id']);

//print "<pre>";
//print_r($result[0]);

}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<body>
    <div class="car">
        <div class="card-body">
            <h2>Edit Paper</h2>
            <form  action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $result[0]['id']  ?>">
                <div class="form-group">
                    <label for="">Paper ID</label>
                    <input type="text" class="form-control" name="paperid" value="<?php echo $result[0]['paperid']?>">
                </div>
                <div class="form-group">
                    <label for="">Year</label>
                    <input type="text" class="form-control" name="year" value="<?php echo $result[0]['year']?>" >
                </div>
                <div class="form-group">
                    <label for="">Paper Type</label>
                    <input type="text" class="form-control" name="type" value="<?php echo $result[0]['papertype']?>" >
                </div>
                <div class="form-group">
                    <label for="">Zone</label>
                    <input type="text" class="form-control" name="zone" value="<?php echo $result[0]['examzone']?>" >
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control"  cols="30" rows="5"><?php echo $result[0]['description']?></textarea>
                </div>
                <div class="form-group">
                    <!-- <label for="">Old File</label>
                    <input type="text" value="files/<?php echo $result[0]['uploadfile'] ?>" style="pointer-events: none; "></br></br> -->
                    <label for="">Old File =></label>
                    <?php
                    $targetfile = 'files/'.($result[0]['uploadfile']);
                    
                     echo $targetfile;
                    ?>
                    <a type="file" href="<?php echo  $targetfile ?>"></a><br><br>
                    <input type="file" name="uploadfile" accept=".pdf" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="UPDATE">
                    <a type="button" class="btn btn-secondary" href="index.php">Back</a>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>
