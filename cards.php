<?php 
include "mysqli.php";
include 'function.php';
if(isset($_GET['sid']) and is_numeric($_GET['sid'])){
    $id = $_GET['sid'];
    $sql = 'DELETE FROM simple_small WHERE id ='.$id;
    if($kl->dbQuery($sql)){
        header('Location: cards.php');
    } else {
        ?>
        <p class="text-danger fw-bold">Something went wrong deleting data from table</p>
        
        <?php
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Last project</title>
</head>
    <body>

        <div class="container-fluid">
        <div class="row mb-2 mt-2">
            <a href="index.php" class="btn btn-success col-1 mx-2">Back to home</a>
        </div>
            <div class="row row-cols-auto mx-auto">
            <?php
            $sql = "SELECT * FROM simple_small";
            $res = $kl->dbGetArray($sql);
            if ($res !== false) {
            ?>
                <?php foreach ($res as $key => $val) {?>
             
                <div class="card border-dark mb-4 mt-2 g-0 ml-2"  style="max-width: 12.5rem;" >
                    <div class="card-header text-center bg-secondary">
                        <?php echo $val["name"]; ?>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <td class="card-text">Birth: </td>
                                <td class="card-text text-start"> 
                                    <?php echo $kl->dbDateToEstDate($val["birth"]); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="card-text">Salary:</td>
                                <td class="card-text text-start">
                                    <?php echo $val["salary"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="card-text text-end">Height:</td>
                                <td class="card-text text-end"> 
                                    <?php echo $val["height"]; ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>   
                    </div> 
                    <div class="card-footer row g-0 row-cols-2 bg-secondary">
                        <div class="col">
                            <div class="text-start ">
                            <a href="cards.php?sid=<?php echo $val['id'];?>" onclick="return confirm('Do you want to delete data permanently?')"><i class="btn btn-danger">Delete</i></a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-end text-danger">
                                <p><?php echo $kl->dbDateToEstDateClock($val["added"]); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                } 
            }
                ?> 
            </div>
        </div>

                        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>