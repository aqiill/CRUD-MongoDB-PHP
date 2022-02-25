<?php


session_start();


if(isset($_POST['submit'])){


   require 'config.php';

   if (isset($_POST['keyField']) AND isset($_POST['valueField'])) {

      $fields = $_POST['keyField'];
      $value = $_POST['valueField'];

      $insertOneResult = $collection->insertOne([
          'name' => $_POST['name'],
          'detail' => $_POST['detail'],
          'genre' => $_POST['genre'],
      ]);

      for ($i=0; $i < count($fields) ; $i++) { 
         $collection->updateOne(
             ['name' => $_POST['name']],
             ['$set' => [
               $fields[$i] => $value[$i], 
               ]
             ]
         );

      }
   }
   else{

      $insertOneResult = $collection->insertOne([
          'name' => $_POST['name'],
          'detail' => $_POST['detail'],
          'genre' => $_POST['genre'],
      ]);

   }

   $_SESSION['success'] = "Book created successfully";
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
   <h1>Pemodelan Data Tugas 2 CRUD</h1>

   <a href="index.php" class="btn btn-primary" style="margin-bottom:5px;">Back</a>


   <form method="POST">
         <div class="form-group">
            <strong>Name:</strong>
            <input type="text" name="name" required="" class="form-control" placeholder="Name">
         </div>
         <div class="form-group">
            <strong>Detail:</strong>
            <textarea required class="form-control" name="detail" placeholder="Detail" placeholder="Detail"></textarea>
         </div>
         <div class="form-group">
            <strong><a href="javascript:void(0)" title="Klik untuk tambah genre" class="add_button">Klik untuk tambah Genre:</a></strong>
            <input type="text" name="genre[]" required="" class="form-control" placeholder="Genre 1">
         </div>
         <div class="field_wrapper">
         </div>
         <div class="field_wrapper_field">
         </div>
         <div class="form-group">
            <a href="javascript:void(0)" title="Tambah Field" class="btn btn-warning add_button_field">Tambah Field</a>
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
      var addButtonField = $('.add_button_field'); //button tambah
      var wrapper_field = $('.field_wrapper_field'); //lokasi/wrapper field
      var x = 1; //mulai field ke 1
      var y = 0; //mulai field ke 1

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


      $(addButtonField).click(function(){ 
         if(y < maxField){ 
            y++; 
            $(wrapper).append('<div class="form-group"><a href="javascript:void(0);" class="remove_button" title="Klik untuk hapus key"><strong>Hapus:</strong></a><input type="text" name="keyField[]" required class="form-control" placeholder="keyField '+y+'" value=""/></div><div class="form-group"><a href="javascript:void(0);" class="remove_button" title="Klik untuk hapus value"><strong>Hapus:</strong></a><input type="text" name="valueField[]" required class="form-control" placeholder="valueField '+y+'" value=""/></div>');
         }
      });
      $(wrapper_field).on('click', '.remove_button', function(e){ 
         e.preventDefault();
         $(this).parent('div').remove(); //hapus field html
         y--; 
      });
   });
</script>
</body>
</html>