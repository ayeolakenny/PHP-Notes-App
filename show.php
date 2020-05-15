<?php
  require("config/db_connect.php");

  if(isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn, $_GET["id"]); 

    $sql = "SELECT title, content, id FROM notes WHERE id = $id";

    $data = mysqli_query($conn, $sql);

    $note = mysqli_fetch_assoc($data);

    mysqli_free_result($data);
    mysqli_close($conn);
  }

  if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql =  "DELETE FROM notes WHERE id = $id_to_delete";

    if(mysqli_query($conn, $sql)){
      header('Location: index.php');
    }else{
      echo 'query error: ' . mysqli_error($conn);
    }
    
  }

?>

<?php require("templates/header.php"); ?>

  <div class="container">
    <ul class="collection with-header">
      <li class="collection-header center indigo-text center text-darken-4">
        <h2><?php echo $note["title"] ?></h2>
      </li>
      <li class="collection-item"><h5><?php echo $note["content"] ?></h5></li>
    </ul class="collection-item">
    <div class="center container">
      <form action="show.php" method="post">
        <a href="edit.php?id=<?php echo $note["id"] ?>" class="btn z-depth-1 yellow darken-4 
        waves-effect waves-light">
          <span>Edit</span>
        </a>
        <input type="submit" name="delete" class="prefix btn z-depth-1 red waves-effect waves-light" value="Delete">
        <input type="hidden" name="id_to_delete" value="<?php echo $note['id'] ?>">
      </form>
    </div>
  </div>

<?php require("templates/footer.php"); ?>
