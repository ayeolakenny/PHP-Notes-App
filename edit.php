<?php
  require("config/db_connect.php");

  $errors = ['title'=>'', 'content'=>''];

  if(isset($_POST['submit'])){
    
    $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    
    $sql = "UPDATE notes SET title= '$title', content= '$content' WHERE id = {$id_to_update}";

    //save to db and check
    if(mysqli_query($conn, $sql)){
      header('Location: index.php');
    }else{
      echo 'query error: ' . mysqli_error($conn);
    }
  }
    
  $id = mysqli_real_escape_string($conn, $_GET['id']);

  $sql = "SELECT title, content, id FROM notes WHERE id = ".$id;

  $data = mysqli_query($conn, $sql);

  $note = mysqli_fetch_assoc($data);

  mysqli_free_result($data);
  mysqli_close($conn);

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
      <h3 class="center indigo-text darken-4">Edit <?php echo $note["title"] ?></h3>
      <form action="edit.php" method="POST">
        <div class="input-field">
          <input type="text" id="title" name="title" value="<?php echo $note["title"] ?>">
          <label for="title" style="font-size: 1.5vw"></label>
          <span class="helper-text red-text" style="font-size: 1.95vw">
            <?php echo $errors["title"]; ?>
          </span>
        </div>
        <div class="input-field"> 
        <textarea id="textarea1" class="materialize-textarea" name="content"><?php echo $note["content"] ?></textarea>
        <label for="textarea1" style="font-size: 1.5vw">Your Notes...</label>
        <span class="helper-text red-text" style="font-size: 1.95vw">
            <?php echo $errors["title"]; ?>
          </span>
        </div>
        <div class="input-field center">
          <input type="submit" id="content" name="submit" class="btn-large indigo" value="Submit">
        </div>
        <input type="hidden" name="id_to_update" value="<?php echo $note["id"] ?>">
      </form>
    </div>

<?php require("templates/footer.php"); ?>
