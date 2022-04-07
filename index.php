<?php
require 'config.php';

$pdostatement = $pdo->prepare("SELECT * from papers ORDER BY id DESC");
$pdostatement->execute();
$result = $pdostatement->fetchAll();

// if($result){
//     print "<pre>";
//     print_r($result);
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Past Paper List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <div class="card">
        <div class="card-body">
            <h2>Past Paper List</h2>
            <a type="button" href="add.php" class="btn btn-success">Insert New Paper</a></br></br>
            <form action="">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><Noframes></Noframes></th>
                            <th>Paper ID</th>
                            <th>Year</th>
                            <th>Type</th>
                            <th>Zone</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if($result){
                            foreach ($result as $value) {
                            ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $value['paperid'] ?></td>
                                    <td><?php echo $value['year']?></td>
                                    <td><?php echo $value['papertype']?></td>
                                    <td><?php echo $value['examzone']?></td>
                                    <td><?php echo $value['description']?></td>
                                    <td>
                                        <!-- <a type="button" href="#" class="btn btn-primary">Download</a> -->
                                        <a  type="button" href="download.php?file=<?php echo $value['uploadfile']?>" class="btn btn-primary">Open</a>
                                        <a tpype="button" href="edit.php?id=<?php echo $value['id']?>" class="btn btn-secondary">Edit</a>
                                        <a type="button" href="delete.php?id=<?php echo $value['id']?>" class="btn btn-warning">Delete</a>
                                    </td>
                                </tr>
                            <?php
                            $i++;
                            }
                    }
                    ?>
                    </tbody>
                </table>

            </form>
        </div>
    </div>
    
</body>
</html>