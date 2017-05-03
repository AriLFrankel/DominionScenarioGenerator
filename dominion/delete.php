<?php
    require 'inc/database_heroku.php';
    $pageTitle = "Delete";
    
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM savored_games  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: saver.php");
    }
    include("inc/header.php");
?>

    <div>
        <form class="form-horizontal" action="delete.php" method="post">
          <input type="hidden" name="id" value="<?php echo $id;?>"/>
          <h5 align="center" class="margin-top-bot">Are you sure to delete this scenario?</h5>
          <div class="margin-top-bot" align="center">
              <button type="submit" class="linkButton button--play">Yes</button>
              <a class="linkButton button--back" href="saver.php">No</a>
            </div>
        </form>
    </div>

<?php include("inc/footer.php") ?>