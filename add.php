<?php
require 'config.php';

if(!empty($_POST)){
    $pid = $_POST['paperid'];
    $year = $_POST['year'];
    $type = $_POST['type'];
    $zone = $_POST['zone'];
    $desc = $_POST['description'];

    //print "<pre>";
    //print_r($_FILES);
    // exit();
    //$targetfile = 'C:/xampp/htdocs/igcse_pastpapers_php_project/files/'.($_FILES['uploadfile']['name']);
    $targetfile = 'files/'.($_FILES['uploadfile']['name']);


    //check file extension
    $fileType = pathinfo($targetfile,PATHINFO_EXTENSION);
    // print "<pre>";
    // print_r($fileType);

    if($fileType != 'pdf'){
        echo "<script>alert('The file must be pdf format');window.location.href('index.php');</script>";
    }else{
        $file_move = move_uploaded_file($_FILES['uploadfile']['tmp_name'], $targetfile);
       

        if($file_move){
            $pdostatement = $pdo->prepare("INSERT INTO papers(paperid,year,papertype,examzone,description,uploadfile) 
            VALUES(:paperid, :year, :type, :zone, :description, :uploadfile)");
            
            //bind
            $pdostatement->bindValue(':paperid', $pid);
            $pdostatement->bindValue(':year',$year);
            $pdostatement->bindValue(':type',$type);
            $pdostatement->bindValue(':zone',$zone);
            $pdostatement->bindValue(':description',$desc);
            $pdostatement->bindValue(':uploadfile',$_FILES['uploadfile']['name']);
            //$pdostatement->bindValue(':created_at',$created_at);

            //execute
            $result = $pdostatement->execute();

            if($result){
                echo "<script>alert('Successfully insert paper!');</script>";
            }
            
        }
    }

}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add paper</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <div class="car">
        <div class="card-body">
            <h2>Insert Paper</h2>
            <form  class="" action="add.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Paper ID</label>
                    <input type="text" class="form-control" name="paperid" required>
                </div>
                <div class="form-group">
                    <label for="">Year</label>
                    <input type="text" class="form-control" name="year" id="" required>
                </div>
                <div class="form-group">
                    <label for="">Paper Type</label>
                    <input type="text" class="form-control" name="type" id="" required>
                </div>
                <div class="form-group">
                    <label for="">Zone</label>
                    <input type="text" class="form-control" name="zone" id="" required>
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label for="">File</label>
                    <input type="file" name="uploadfile" value="" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Add">
                    <a type="button" class="btn btn-secondary" href="index.php">Back</a>
                </div>
            </form>
        </div>
    </div>

    
</body>
</html>
