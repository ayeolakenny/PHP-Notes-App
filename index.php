<?php
  // connect to db
  require("config/db_connect.php");

  // get data from db
  $sql = "SELECT title, content, id FROM notes ORDER BY id";

  // make query
  $data = mysqli_query($conn, $sql);

  // fetch result as an array
  $notes = mysqli_fetch_all($data, MYSQLI_ASSOC);

  // free the data
  mysqli_free_result($data);

  // close connection
  mysqli_close($conn);

?>
  
<?php require('templates/header.php') ?>

  <div class="container">
    <h2 class="center indigo-text">Notes</h2>
    <div class="row">
    <?php foreach($notes as $note): ?>

      <div class="col s12 l6">
        <div class="card">
          <div class="card-image">
            <img src="img/notes.jpg" alt="note">
              <a href="show.php?id=<?php echo $note["id"] ?>" class="btn-floating btn-large red halfway-fab">
                <i class="large material-icons">arrow_forward</i>
              </a>  
          </div>
          <div class="card-content">
            <h4 class="card-title"><?php echo $note["title"] ?></h4>
            <p class="truncate"><?php echo $note["content"] ?></p>
          </div>
        </div>      
      </div>
      <?php endforeach ?>  
      <div class="center">
        <h3>
          <?php echo empty($note) ? "You currently have no notes": null ?>
        </h3>
      </div>
    </div>
  </div>
 

<?php require('templates/footer.php'); ?>