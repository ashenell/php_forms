<?php 
include 'mysqli.php'; 
include 'helper.php'; //date checker script
$error_text = ''; //Error message
$error_count = 0; // faults counter
$result = false; //no faults
if(isset($_POST['submit'])){
    #$kl->show($_POST);
    $name = trim($kl->getVar('name')); // $name = $_POST['name'];
    $birth = trim($kl->getVar('birth'));
    $salary = trim($kl->getVar('salary'));
    $height = trim($kl->getVar('height'));

    if(strlen($name) < 2) {
        $error_count++; //counter rises by 1
        $error_text = 'Requires more characters';
    }

    if(strlen($name) > 20){
        $error_count++;
        $error_text = 'To many characters try again';
    }

    if(!validateDate($birth)){
        $error_count++;
        $error_text = 'Wrong date';
    } else {
        if(isDateFuture($birth)){
            $error_count++;
            $error_text = "Birthdate is on future";
        }
    }

    if(empty($salary) or $salary < 0 or $salary > 99999){
        $salary = 0;
    }
    if($height < 0.6 or $height > 2.73){
        $error_count++;
        $error_text = 'Lenght is out of range';
    }
    if($error_count == 0){
        $sql = 'INSERT INTO simple_small SET name = '.$kl->dbFix($name).',birth = '.$kl->dbFix($birth).',salary = '.$kl->dbFix($salary).',height = '.$kl->dbFix($height).',added = NOW()';

        if($kl->dbQuery($sql)){
            $result = true;
            unset($_POST);
            header('Location: index.php');
        } else {
            $error_count++;
            $error_text = 'Not able to upload data';
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.13.1/jquery-ui.min.css">
    <title>Form content</title>
</head>
<body>
    <div class="container">
        <div class="row my-2">
            <!-- Form to add -->
            <div class="col-sm-12 col-lg-6 mx-auto">
                <h3>Add new person form</h3>
                <?php 
                if($error_count > 0){
                    ?>
                    <p class="text-danger fw-bold"><?php echo $error_text?></p>
                    <?php
                } else if($result) {
                    ?>
                    <p class="text-success fw-bold">Person added in to database</p>
                    <?php
                }
                ?>
                <form action="create.php" method="post">
                    <div class="mb-2">
                        <input type="text" name="name" value="<?php if(isset($_POST['name'])){echo $name;} ?>" id='name' onkeyup="charcountupdate(this.value)" placeholder="Enter name" class="form-control" required>
                        <span id="info">Maximum 20 characters</span>
                    </div>
                    <div class="mb-2">
                        <input type="text" id="birth" name="birth" value="<?php if(isset($_POST['birth'])){echo $birth;} ?>" placeholder="Eneter date of birth" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <input type="number" name="salary" value="<?php if(isset($_POST['salary'])){echo $salary;} ?>" placeholder="Enter salary number" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <input type="number" name="height" min="0.6" max="2.73" step="0.01" value="<?php if(isset($_POST['height'])){echo $height;} ?>" placeholder="Enter your height" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <input type="submit" name="submit" value="Add new person" class="form-control btn btn-primary">
                        </div>
                        <div class="col-6">
                            <a href="index.php" class="form-control btn btn-success">Back to home</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.13.1/jquery-ui.min.js"></script>
    <script src="js/datepicker-et.js"></script>
    <script src="js/helper.js"></script>
    <script>
    $( function() {
        $( "#birth" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '-100:+1',
        dateFormat: 'yy-mm-dd'
        });
    } );
    </script>
</body>
</html>