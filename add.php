<?php

  include('config/db_connect.php');

  $title = $content = '';

  $errors = array('title'=>'', 'content'=>'');
  
  if(isset($_POST['submit'])){

    // check title
    if(empty($_POST['title'])){
      $errors['title'] = 'A title is reqired';
    }else{
      $title = $_POST['title'];
    }

    // check title
    if(empty($_POST['content'])){
      $errors['content'] = 'Your Note is currently empty';
    }else{
      $content = $_POST['content'];
    }
    
    // end of check
    if(array_filter($errors)){
      // echo 'There are errors in the form';
    }else{

      $content = mysqli_real_escape_string($conn, $_POST['content']);
      $title = mysqli_real_escape_string($conn, $_POST['title']);

      // create sql
      $sql = "INSERT INTO notes(title,content) VALUES('$title', '$content')";

      //save to db and check
      if(mysqli_query($conn, $sql)){
        header('Location: index.php');
      }else{
        echo 'query error: ' . mysqli_error($conn);
      }

    }
    
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link rel="stylesheet" href="style.css">
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <title>NOTES</title>
</head>
<body>
  <!-- navbar -->
  <nav class="nav-wrapper indigo lighten-1 z-depth-2">
    <div class="container">
      <a href="index.php" class="brand-logo">Notes</a>
    </div>
  </nav>

    <div class="container s12 l12"> 
      <h3 class="center indigo-text darken-4">Add New Note</h3>
      <form action="add.php" method="POST">
        <div class="input-field">
          <input type="text" id="title" name="title">
          <label for="title" style="font-size: 1.5vw">Your Title...</label>
          <span class="helper-text red-text" style="font-size: 1.95vw">
            <?php echo $errors["title"]; ?>
          </span>
        </div>
        <div class="input-field"> 
        <textarea id="textarea1" class="materialize-textarea" name="content"></textarea>
        <label for="textarea1" style="font-size: 1.5vw">Your Notes...</label>
          <span class="helper-text red-text" style="font-size: 1.95vw">
            <?php echo $errors["content"]; ?>
          </span>
        </div>
        <div class="input-field center">
          <input type="submit" id="content" name="submit" class="btn-large indigo" value="Submit">
        </div>
      </form>
    </div>

  <?php include('templates/footer.php') ?>
</html>