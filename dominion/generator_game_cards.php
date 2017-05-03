<?php 
include("inc/cards.php");
//TODO: 
//allow users to select game cards
    //validate against selecting too many cards
    //validate against selecting incongruous card and deck combinations.
//fix up random option -- currently posting NULL

$pageTitle = "Generator";

if (!empty($_POST)) {
    $valid = true;
    $error = null;
   
  if(empty($_POST['deck'])) {//validate selecting at least one deck
      $error = "You have to select at least one set to play with";
      $valid = false;
  }

  if( !in_array('base', $_POST['deck']) && 
      !in_array('intrigue', $_POST['deck'])
    ){
      $error = "You have to select at least one standalone deck, Base and/or Intrigue";
      $valid = false;
  }
  //not necessary because required to include intrigue and/or base:
  // if(count(array_intersect($_POST['deck'], ['base', 
  //                                           'intrigue', 
  //                                           'cornucopia', 
  //                                           'hinterlands', 
  //                                           'dark ages'])) == 0 
  //   && isset($_POST['require_moat'])){
  //     $error = "You have not selected any decks that include reaction cards, 
  //     so no reaction cards can be required. Base, Intrigue, Cornucopia, 
  //     Hinterlands and Dark Ages include include reaction cards";
  //     $valid = false;
  // }

if($valid == true){

  if( !empty($selected_cards) ){ 
      foreach($selected_cards as $key=>$card){
         $game_cards[]=$card;
      }
  }
  $interaction_setting = $_POST['interaction'];
  $speed_setting = intval($_POST['speed']);
  $attack_setting = intval($_POST['attack']);
  $draw_setting = intval($_POST['draw']);
  // $purchase_setting = intval($_POST['purchase']);
  $money_setting = intval($_POST['money']);
  $action_setting = intval($_POST['action']);
  $require_moat = isset($_POST['require_moat']);
  $require_trash = isset($_POST['require_trash']);
  $selected_decks = $_POST['deck'];

  // var_dump($_POST);
  // var_dump($speed_setting);
  // var_dump($attack_setting);
  // var_dump($draw_setting);
  // var_dump($money_setting);
  // var_dump($action_setting);


  $interaction_total = 0; 
  $speed_total = 0; 
  $attack_total = 0; 
  $draw_total = 0; 
  // $purchase_total = 0; 
  $money_total = 0;
  $action_total = 0;
  $has_reaction = false;
  $has_trash = false;
  $has_curse = false; 

  $valid = false;

  while($valid==false){ 
          //take stock of what's in game cards and pull values from sets
      $game_cards=[null]; //array of cards to return as cards to play with
      while (count($game_cards) < 11){ //NULL Starter value + 10 cards
          $random_index = mt_rand(101, 354);
          
          if(!empty($cards[$random_index]) &&
             in_array($cards[$random_index]['set'], $selected_decks) &&  
             !array_search($cards[$random_index]['name'], $game_cards) &&

            //speed = draw + money + action - 3 * attack
            ($cards[$random_index]['draw'] + $cards[$random_index]['money'] + $cards[$random_index]['action'] 
            - 3 * $cards[$random_index]['attack']) + $speed_total<= $speed_setting+40 && 
            $cards[$random_index]['attack'] + $attack_total <= $attack_setting+2 &&
            $cards[$random_index]['draw'] + $draw_total <= $draw_setting+40 &&
            $cards[$random_index]['money'] + $money_total <= $money_setting+40 &&
            $cards[$random_index]['action'] + $action_total <= $action_setting+40
            ) {
              //update game_cards totals
              $speed_total += ($cards[$random_index]['draw'] + $cards[$random_index]['money'] 
                + $cards[$random_index]['action'] - 3 * $cards[$random_index]['attack']);
              $attack_total += $cards[$random_index]['attack'];
              $draw_total += $cards[$random_index]['draw'];
              $money_total += $cards[$random_index]['money'];
              $action_total += $cards[$random_index]['action'];

              //update if deck has curse, trash and/or reaction cards. We know if it has attacks from attack_total
              $has_reaction += $cards[$random_index]['reaction'];
              $has_curse += $cards[$random_index]['curse'];
              $has_trash += $cards[$random_index]['trash'];

              //push to game cards array   
              $game_cards[]=$cards[$random_index]['name'];
          }
      //end choosing algorithm    
      }
      $valid = true;
          //validate selection of 10 cards against low balling parameters
          if($require_trash == true && $has_curse > 0 && $has_trash == 0)
          {
            foreach($cards as $key=>$card){
              if( $card['trash'] > 0 && in_array($card['set'], $selected_decks) ){
                $game_cards[9] = $card['name'];
                break;
              }
            }
          }
          if($require_moat == true && $attack_total > 0 && $has_reaction == 0)
          {
            foreach($cards as $key=>$card){
              if( $card['reaction'] > 0 && in_array($card['set'], $selected_decks) ){
                $game_cards[10] = $card['name'];
                break;
              }
            }
          }
          if(
              $speed_total <= $speed_setting/4 ||
              $attack_total <= $attack_setting/4 ||
              $draw_total <= $draw_setting/4 ||
              $money_total <= $money_setting/4 ||
              $action_total <= $action_setting/4
          ){
          $valid=false; $game_cards=[];
          } //flush the cards and start over
  }
  //store $game_cards in $_SESSION, then create.php
  session_start();
  $_SESSION['game_cards']=serialize($game_cards);
  $_SESSION['deck']=serialize($selected_decks);
  $_SESSION['came_from']='generator_game_cards.php';
  header("Location:read_generated.php");
  }
} 

include("inc/header.php");

//messages of validation

if(empty($_POST)){echo
"<div align='center' class='content__description hidden-sm-down'><h6 style='white-space: pre;'>***Welcome to the Generator (Beta)***

***Use this tool to generate a custom Dominion scenario***</h6></div>";}

if(!empty($error)){echo "<div class='content__description'><h6>***".$error."***</h6></div>";}

?>

<div class="content__generator col-sm-10 col-sm-offset-1">
<form action="generator_game_cards.php" method="post">
  <div class="row" align="center">
    <h5 class="margin-top-bot">Which sets are you playing with?</h5>
         <?php foreach($decks as $deck=>$value){
              echo "<label for='". $value ."'>" . ucwords($value) ."</label><input id='" . $value .
              "' type='checkbox' name='deck[]' value='". $value ."'>";
            }
         ?>
  </div>
  <div class="row" align="center">
        <h5 class="margin-top-bot">What are your ground rules?</h5>
            <input type="checkbox" name="require_moat" value="true">If there is an attack card, require at least one protective, reaction card (moat, e.g.)<br>
            <input type="checkbox" name="require_trash" value="true">If there are curse cards, require at least one card that can trash them
      <div class="row" align="center">
        <h5 class="margin-top-bot">How do you like to play?</h5>
            <div class="col-sm-4">
                <span class="styleQuestion">I want ... Interaction</span><span class="interaction"> (?) </span>
                <br>
                    <input type="radio" name="interaction" value='-1'> a bit of<br>
                    <input type="radio" name="interaction" value='-1'> an average amount of <br>
                    <input type="radio" name="interaction" value='-1'> lots of<br>
                    <input type="radio" name="interaction" value='-1' checked> random
            </div>
            <div class="col-sm-4">
                <span class="styleQuestion">I want to play a ... game</span>
                <br>
                  <input type="radio" name="speed" value='25'> slow (60-90 minutes)<br>
                  <input type="radio" name="speed" value='40'>  balanced paced (30-60 minutes)<br>
                  <input type="radio" name="speed" value='55'> fast  (10-30 minutes)<br>
                  <input type="radio" name="speed" value=<?php echo mt_rand(25,55);?> checked> random
            </div>
            <div class="col-sm-4">
                <span class="styleQuestion">I ... Attack cards</span><span class="attack"> (?) </span>
                <br>
                    <input type="radio" name="attack" value='2'> don't f***in like<br>
                    <input type="radio" name="attack" value='4'>like an average amount of<br>
                    <input type="radio" name="attack" value='6'> LOVE<br>
                    <input type="radio" name="attack" value=<?php echo mt_rand(2,6);?> checked> random
    <!--            </form>-->
            </div>
      </div>
    <div class="row" align="center">
            <div class="col-sm-4">
                <span class="styleQuestion">Care about Draw cards?</span><span class="draw"> (?) </span>
                <br>
                  <input type="radio" name="draw" value='10'> Not many, please<br>
                  <input type="radio" name="draw" value='20'> Average will do<br>
                  <input type="radio" name="draw" value='30'> Bring em on<br>
                  <input type="radio" name="draw" value=<?php echo mt_rand(10,30);?> checked>random
            </div>
            <div class="col-sm-4">
                <span class="styleQuestion">+Coin Cards?</span><span class="money"> (?) </span>
                <br>
                  <input type="radio" name="money" value='20'> Not many, please<br>
                  <input type="radio" name="money" value='30'> Average will do<br>
                  <input type="radio" name="money" value='40'> Bring em on<br>
                  <input type="radio" name="money" value=<?php echo mt_rand(20,40);?> checked>random
            </div>
            <div class="col-sm-4">
                <span class="styleQuestion">Finally, Actions:</span><span class="action"> (?) </span>
                <br>
                  <input type="radio" name="action" value='20'> not many, please<br>
                  <input type="radio" name="action" value='30'> Average will do<br>
                  <input type="radio" name="action" value='40'> Bring em on<br>
                  <input type="radio" name="action" value=<?php echo mt_rand(20,40);?> checked>random
            </div>
      </div>
    <div class="col-sm-10 col-sm-offset-1 margin-top-bot">
        <button type='submit' class='linkButton button--play'>Generate Your Custom Scenario</button>
    </div>
</form>
</div>

<script src="js/generator.js"></script>

<?php include("inc/footer.php"); ?>
