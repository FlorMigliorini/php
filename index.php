<!DOCTYPE html>
<html>
<head>
    <title>PHP</title>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<?php require_once 'crud.php';?>

<?php if(isset($_SESSION['message'])): ?>
  

<div class="alert alert-<?=$_SESSION['msg_type']?>">

  <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
  ?>      
</div>
<?php endif ?>

<div class="container">
<?php 
    $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
    
    ?>
    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>ID</th>
                    <th>Birthday</th>
                 
                </tr>
            </thead>

    <?php
        while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['birthday']; ?></td>
                <td>
                    <a href="index.php?edit=<?php echo $row['id'];?>"
                        class="btn btn-info">Edit</a>
                    <a href="crud.php?delete=<?php echo $row['id']; ?>"
                        class="btn btn-danger">Delete</a>

                </td>
            </tr> 
            <?php endwhile; ?>  
        </table>    
    </div>    

    <?php
    pre_r($result->fetch_assoc());
    function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
?>
<div class="row justify-content-center">
    <form action="crud.php" method="POST">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>" 
            class="form-control" placeholder="Enter your name">
        </div>
        <div class="form-group col-md-6">
            <label>Location</label>
            <input type="text" name="location" value="<?php echo $location; ?>"
            class="form-control" placeholder="Enter your location">
        </div>
    </div>
    <div class="form-row">    
        <div class="form-group col-md-6">
            <label>ID</label>
            <input type="text" name="id" value="<?php echo $id_number; ?>"
            class="form-control" placeholder="Your ID">
        </div>
        <div class="form-group col-md-6">
            <label>Birthday</label>
            <input type="text" name="birthday" value="<?php echo $birthday; ?>" 
            class="form-control" placeholder="Your birthday">
        </div>
    </div>    
        <div class="form-group">
        <button type="submit" name="save" class="btn btn-primary">Save</button>
        
        </div>
    </form>
</div>
</div>
</body>
</html>