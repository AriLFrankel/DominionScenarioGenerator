<?php

//TODO: include set up information
    require('inc/database_heroku.php');
    include("inc/cards.php");
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: saver.php");
    } else {
        $pdo = Database::connect();
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM savored_games where id = ?";
        $q = $pdo->prepare($sql);
        $q -> execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $game_cards = unserialize($data['game_cards']); $game_cards = array_sort($game_cards);
        $game_decks = explode(" ", $data['decks']);
      }
$pageTitle = "Play";
include("inc/header.php");
?>

<div class="content__read col-sm-10 col-sm-offset-1">
  <div class="row">
          <div class="col-sm-3 offset1">
            <h5 class="margin-top-bot">Game Details</h5>
              <label class="control-label"><strong>Name: </strong><?php echo $data['name'];?></label><br>
              <label class="control-label"><strong>Date Played: </strong><?php echo $data['date_played'];?></label><br>
              <label class="control-label"><strong>Game Length (min): </strong><?php echo $data['game_length'];?></label><br>
              <label class="control-label"><strong>Decks: </strong><?php echo $data['decks'];?></label><br>
              <label class="control-label"><strong>Commentary: </strong><?php echo $data['commentary'];?></label><br>
          </div>    

          <div class="col-sm-3">
            <h5 class="margin-top-bot">Kingdom Cards</h5>
              <ol>
                 <?php foreach($game_cards as $game_card){
                  if($game_card != null){
                    echo "<li>".ucwords($game_card)."</li>";
                    }
                  }
                  ?> 
              </ol>
          </div>
          <div class="col-sm-3">
            <h5 class="margin-top-bot">Setup</h5>
              <ul>
                <?php 
                  if(in_array('Adventures', $game_decks)){
                    echo "<li>Adventures Materials</li>";
                  }
                  
                  if(in_array('Cornucopia', $game_decks)){
                    echo "<li>Hamlet</li>
                          <li>Bag of Gold</li>
                          <li>Diadem</li>
                          <li>Followers</li>
                          <li>Princess</li>
                          <li>Trusty Steed</li>";
                  }
                  if(in_array('Dark Ages', $game_decks)){
                    echo "<li>Madman</li>
                          <li>Spoils</li>
                          <li>Hovel</li>
                          <li>Necropolis</li>
                          <li>Overgrown Estate</li>";
                  }
                ?>
                <li>Copper</li>
                <li>Silver</li>
                <li>Gold</li>
                <?php 
                if(in_array('Prosperity', $game_decks)){
                  echo "<li>Platinum</li>";
                }
                if(in_array('Alchemy', $game_decks)){
                  echo "<li>Potion</li>";
                } ?>
                <li>Estate</li>
                <li>Duchy</li>
                <li>Province</li>
                <?php 
                if(in_array('Prosperity', $game_decks)){
                  echo "<li>Colony</li>";
                } 
                foreach($game_cards as $game_card){
                  if(in_array($game_card, $curse_cards)){
                  echo "<li>Curse</li>";  
                  break;
                  }
                }
                ?>
                <li>Trash</li>
    </ul>
  </div>
  <a class="linkButton button--back" href="saver.php">Back</a>
</div>
</div>

<?php include("inc/footer.php"); ?>