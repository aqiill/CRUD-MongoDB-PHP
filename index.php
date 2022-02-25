<?php
   session_start();
?>
<!DOCTYPE html>
<html>
<head>
   <title>Pemodelan Data</title>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>


<div class="container">
<h1>Pemodelan Data Tugas 2 CRUD</h1>


<a href="create.php" class="btn btn-success" style="margin-bottom:5px;">Add Book</a>


<?php


   if(isset($_SESSION['success'])){
      echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";
   }


?>


<table class="table table-borderd">
   <tr>
      <th>Name</th>
      <th>Details</th>
      <th>Genre</th>
      <th>Action</th>
   </tr>
   <?php


      require 'config.php';


      $books = $collection->find([]);


      foreach($books as $book) { ?>
         <tr>
            <td><?php echo $book->name; ?></td>
            <td><?php echo $book->detail; ?></td>
            <td>
               <ol>
               <?php 
                  for ($i=0; $i < count($book->genre) ; $i++) { 
                     echo "<li>".$book->genre[$i]."</li>";
                  }
                ?>
               </ol>
            </td>
            <td>
               <a href='edit.php?id=<?php echo $book->_id ?>' class='btn btn-primary'>Edit</a>
               <a href='delete.php?id=<?php echo $book->_id ?>' class='btn btn-danger'>Delete</a>
            </td>
         </tr>
      <?php };


   ?>
</table>


</div>

<script>
   window.onunload = function () {
      <?php session_destroy(); ?>
   }
</script>
</body>
</html>