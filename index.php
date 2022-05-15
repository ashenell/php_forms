<?php 
session_start();
include 'mysqli.php'; 
include 'function.php';
if(isset($_GET['sid']) and is_numeric($_GET['sid'])){
    $id = $_GET['sid'];
    $sql = 'DELETE FROM simple_small WHERE id ='.$id;
    if($kl->dbQuery($sql)){
        header('Location: index.php');
    } else {
        ?>
        <p class="text-danger fw-bold">Something went wrong deleting data from table</p>
        
        <?php
    }
}
if(isset($_GET['birth'])){ #Sort by company
    $_SESSION['what'] = 'birth';
    if($_GET['birth'] == 'a'){
        $_SESSION['order'] = 'ASC';

    } else {
        $_SESSION['order'] = 'DESC';
    }


}
?>
<?php
$sql = 'SELECT SUM(salary), AVG(height) FROM simple_small;';
$resu1= $kl->dbGetArray($sql);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/all.min.css">
    
    
    <title>Form content</title>
</head>
<body>
    <div class="container">
        <div class="row mb-2 mt-2">
            <a href="create.php" class="btn btn-success col-1">Create</a>
            <a href="cards.php" class="btn btn-success col-1 mx-2">Cards view</a>
        </div>
        <div class="row mb-2 mt-2">
            
        </div>
        <!-- Tabel content -->
        <div class="row">
            <?php
            $sql = 'SELECT * FROM simple_small';
            $res = $kl->dbGetArray($sql);

            if($res !== false){
                ?>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Jrk</th>
                            <th>Name</th>
                            <th>Birth</th>
                            <th>Salary</th>
                            <th>Height <a href="?height=a">a </a> <a href="?height=z">z</a></th>
                            <th>Added</th>
                            <th>Edit/del</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $salary_total = 0;
                        $height_total = 0;
                        foreach($res as $key=>$val){
                            $salary_total += $val['salary'];
                            $height_total += $val['height'];
                            ?>
                            <tr>
                                <td><?php echo $val['id'];?></td>
                                <td><?php echo ($key+1); ?>.</td>
                                <td><?php echo $val['name']; ?></td>
                                <td><?php echo $kl->dbDateToEstDate($val['birth']); ?></td>
                                <td class="text-end"><?php echo $val['salary']; ?></td>
                                <td class="text-end"><?php echo number_format($val['height'],2,',', '.'); ?></td>
                                <td class="text-end"><?php echo $kl->dbDateToEstDateClock($val['added']); ?></td>
                                <td class="text-center">
                                    <a href="update.php?sid=<?php echo $val['id']; ?>"><i class="fa-solid fa-pen "></i></i></a>
                                    <a href="index.php?sid=<?php echo $val['id'];?>" onclick="return confirm('Do you want to delete data permanently?')"><i class="fa-solid fa-trash-can"></i></a>
                                </td>
                            
                            </tr>
                        


                            <?php
                        }
                    
                        ?>
                                 
                    </tbody>
                    <tfoot>

                        <tr>
                            <td colspan="4"></td>
                            <td class="text-end"><?php echo $salary_total ?></td>
                            <td class="text-end"><?php echo number_format($height_total / count($res), 3, ',','') ?></td>
                            <td colspan="3"></td>
                        </tr>

                    </tfoot>
                </table>

                <?php
            }
            ?>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/js/fontawesome.min.js"></script>
</body>
</html>