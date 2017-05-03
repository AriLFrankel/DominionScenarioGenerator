<?php
//TODO: set up information to include deck specific materials
$pageTitle = "Generator";
include("inc/cards.php");
session_start();
$_SESSION['came_from']="read_generated.php";
$data=$_SESSION;
$game_cards=unserialize($data['game_cards']); $game_cards=array_sort($game_cards);
$game_decks = unserialize($data['deck']);

include("inc/header.php");
?>
    <div class="content__read_generated col-sm-10 col-sm-offset-1">
      <div class="row">
        <div class="col-sm-3 offset1">
          <h5 class="margin-top-bot">Kingdom Cards</h5>
          <ol>
             <?php foreach($game_cards as $game_card) {
              if($game_card != null) {
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
                  if(in_array('adventures', $game_decks)){
                    echo "<li>Adventures Materials</li>";
                  }
                  
                  if(in_array('cornucopia', $game_decks)){
                    echo "<li>Hamlet</li>
                          <li>Bag of Gold</li>
                          <li>Diadem</li>
                          <li>Followers</li>
                          <li>Princess</li>
                          <li>Trusty Steed</li>";
                  }
                  if(in_array('dark ages', $game_decks)){
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
                if(in_array('prosperity', $game_decks)){
                  echo "<li>Platinum</li>";
                }
                if(in_array('alchemy', $game_decks)){
                  echo "<li>Potion</li>";
                } ?>
                <li>Estate</li>
                <li>Duchy</li>
                <li>Province</li>
                <?php 
                if(in_array('prosperity', $game_decks)){
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
          <div class="align-right margin-top-bot">
              <a class="linkButton button--play" href="create.php">Save this Scenario</a>
              <a class="linkButton button--back" href="generator_game_cards.php">Back</a>
        </div>
      </div>
    </div>      
 
<?php include("inc/footer.php"); ?>