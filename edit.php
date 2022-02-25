<?php


session_start();


require 'config.php';


if (isset($_GET['id'])) {
   $book = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
}


if(isset($_POST['submit'])){


   $collection->updateOne(
       ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
       ['$set' => [
         'name' => $_POST['name'], 
         'detail' => $_POST['detail'],
         'genre' => $_POST['genre'],
         ]
       ]
   );


   $_SESSION['success'] = "Book updated successfully";
   header("Location: index.php");
}


?>


<!DOCTYPE html>
<html>
<head>
   <title>Pemodelan Data</title>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>


<div class="container">
   <h1>Edit Book</h1>
   <a href="index.php" class="btn btn-primary" style="margin-bottom:5px;">Back</a>


   <form method="POST">
      <div class="form-group">
         <strong>Name:</strong>
         <input type="text" name="name" value="<?php echo $book->name; ?>" required="" class="form-control" placeholder="Name">
      </div>
      <div class="form-group">
         <strong>Detail:</strong>
         <textarea class="form-control" name="detail" placeholder="Detail" placeholder="Detail"><?php echo $book->detail; ?></textarea>
      </div>
      <div class="field_wrapper">
      <?php 
         for ($i=0; $i < count($book->genre); $i++) { ?>
        <div class="form-group">
            <?php if ($i == 0): ?>
               <strong><a href="javascript:void(0)" title="Klik untuk tambah genre" class="add_button">Klik untuk tambah Genre:</a></strong>
            <?php else: ?>
               <a href="javascript:void(0);" class="remove_button" title="Klik untuk hapus genre"><strong>Hapus:</strong></a>
            <?php endif ?>
            <input type="text" name="genre[]" required="" value="<?php echo $book->genre[$i] ?>" class="form-control" placeholder="Genre">
         </div>
      <?php   }
       ?>
      </div>
      <div class="form-group">
         <button type="submit" name="submit" class="btn btn-success">Submit</button>
      </div>
   </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
   $(document).ready(function(){
      var maxField = 5; //maksimal field
      var addButton = $('.add_button'); //button tambah
      var wrapper = $('.field_wrapper'); //lokasi/wrapper field
      var x = <?php echo count($book->genre) ?>; //mulai field ke 1
      // var fieldHTML = '<div class="form-group"><a href="javascript:void(0);" class="remove_button" title="Klik untuk hapus genre"><strong>Genre:</strong></a><input type="text" name="genre[]" class="form-control" placeholder="Genre" value=""/></div>'; //tambah field html 
      $(addButton).click(function(){ 
         if(x < maxField){ 
            x++; 
            $(wrapper).append('<div class="form-group"><a href="javascript:void(0);" class="remove_button" title="Klik untuk hapus genre"><strong>Hapus:</strong></a><input type="text" name="genre[]" class="form-control" placeholder="Genre '+x+'" value=""/></div>');
         }
      });
      $(wrapper).on('click', '.remove_button', function(e){ 
         e.preventDefault();
         $(this).parent('div').remove(); //hapus field html
         x--; 
      });
   });
</script>
</body>
</html>