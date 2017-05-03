<?php 
include("inc/cards.php");
//TODO: 
//allow users to select game cards
    //validate against selecting too many cards
    //validate against selecting incongruous card and deck combinations.

$pageTitle = "Generator";

if (!empty($_POST)) {
    $valid = true;
    $error = null;
   
  if(empty($_POST['deck'])) {//validate selecting at least one deck
      $error = "You have to select at least one set to play with";
      $valid = false;
  }

  if(count(array_intersect($_POST['deck'], ['base', 
                                            'intrigue', 
                                            'cornucopia', 
                                            'hinterlands', 
                                            'dark ages'])) == 0 
    && $_POST['require_moat'] == true){
      $error = "You have not selected any decks that include reaction cards, 
      so no reaction cards can be required. Base, Intrigue, Cornucopia, 
      Hinterlands and Dark Ages include include reaction cards";
      $valid = false;
  }

if($valid == true){
    session_start();
    $_SESSION['interaction'] = serialize($_POST['interaction']);
    $_SESSION['speed'] = serialize($_POST['speed']);
    $_SESSION['attack'] = serialize($_POST['attack']);
    $_SESSION['draw'] = serialize($_POST['draw']);
    $_SESSION['purchase'] = serialize($_POST['purchase']);
    $_SESSION['action'] = serialize($_POST['action']);
    $_SESSION['deck'] = serialize($_POST['deck']);  
    if(isset($_POST['require_moat'])){$require_moat = true;} else {$require_moat = false;}
    if(isset($_POST['require_trash'])){$require_trash = true;} else {$require_trash = false;}
    $_SESSION['require_moat'] = $require_moat;
    $_SESSION['require_trash'] = $require_trash;
    
    // if(isset($_POST['require_moat'])){$_SESSION['require_moat'] = serialize($_POST['require_moat']);} 
    // if(isset($_POST['require_trash'])){$_SESSION['require_trash'] = serialize($_POST['require_trash']);}
    $_SESSION['came_from'] = serialize('generator.php');
    header("Location:game_cards.php");
   }
}

include("inc/header.php");

//messages of validation

if(empty($_POST)){echo
"<div align='center' class='content__description hidden-sm-down'><h6 style='white-space: pre;'>***Welcome to the Generator Beta. Currently, the Generator only works with Base and Intrigue Sets***

***Use this tool to generate a custom Dominion scenario***</h6></div>";}

if(!empty($error)){echo "<div class='content__description'><h6>***".$error."***</h6></div>";}

?>

<div class="content__generator col-sm-10 col-sm-offset-1">
<form action="generator.php" method="post">
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
                    <input type="radio" name="interaction" value="L"> a bit of<br>
                    <input type="radio" name="interaction" value="M"> an average amount of <br>
                    <input type="radio" name="interaction" value="H"> lots of<br>
                    <input type="radio" name="interaction" value="R" checked> random
            </div>
            <div class="col-sm-4">
                <span class="styleQuestion">I want to play a ... game</span>
                <br>
                  <input type="radio" name="speed" value="L"> slow (60-90 minutes)<br>
                  <input type="radio" name="speed" value="M">  balanced paced (30-60 minutes)<br>
                  <input type="radio" name="speed" value="H"> fast  (10-30 minutes)<br>
                  <input type="radio" name="speed" value="R" checked> random
            </div>
            <div class="col-sm-4">
                <span class="styleQuestion">I ... Attack cards</span><span class="attack"> (?) </span>
                <br>
                    <input type="radio" name="attack" value="L"> don't f***in like<br>
                    <input type="radio" name="attack" value="M">like an average amount of<br>
                    <input type="radio" name="attack" value="H"> LOVE<br>
                    <input type="radio" name="attack" value="R" checked> random
    <!--            </form>-->
            </div>
      </div>
    <div class="row" align="center">
            <div class="col-sm-4">
                <span class="styleQuestion">Care about Draw cards?</span><span class="draw"> (?) </span>
                <br>
                  <input type="radio" name="draw" value="L"> Not many, please<br>
                  <input type="radio" name="draw" value="M"> Average will do<br>
                  <input type="radio" name="draw" value="H"> Bring em on<br>
                  <input type="radio" name="draw" value="R" checked>Random
            </div>
            <div class="col-sm-4">
                <span class="styleQuestion">Purchase preferences?</span><span class="purchase"> (?) </span>
                <br>
                  <input type="radio" name="purchase" value="L"> Not many, please<br>
                  <input type="radio" name="purchase" value="M"> Average will do<br>
                  <input type="radio" name="purchase" value="H"> Bring em on<br>
                  <input type="radio" name="purchase" value="R" checked>Random
            </div>
            <div class="col-sm-4">
                <span class="styleQuestion">Finally, Actions:</span><span class="action"> (?) </span>
                <br>
                  <input type="radio" name="action" value="L"> not many, please<br>
                  <input type="radio" name="action" value="M"> Average will do<br>
                  <input type="radio" name="action" value="H"> Bring em on<br>
                  <input type="radio" name="action" value="R" checked>Random
            </div>
      </div>
    <div class="col-sm-10 col-sm-offset-1 margin-top-bot">
        <button type='submit' class='linkButton button--play'>Generate Your Custom Scenario</button>
    </div>
</form>
</div>

<script>
  
  $("span.interaction").hover(
    function() {
     $(this).append( $( "<div style='color:rgb(55,58,60)'>Interaction is when players generally make each other do anything: show a card, discard, take a curse, etc.</div>") );
    }, function() {
    $(this).find( "div:last").remove();
    }, function() {
    $(this).fund( "br:last").remove();
    });

$( "span.attack").hover(
    function() {
     $(this).append( $( "<div style='color:rgb(55,58,60)'>Attack cards include Witch, Torturer, Spy, etc. They are action cards that allow players to impede one another's progress</div>") );
    }, function() {
    $(this).find( "div:last").remove();
    }, function() {
    $(this).fund( "br:last").remove();
    });

$( "span.draw").hover(
    function() {
     $(this).append( $( "<div style='color:rgb(55,58,60)'>Draw cards are action cards that award a player additional draws from their deck</div>") );
    }, function() {
    $(this).find( "div:last").remove();
    }, function() {
    $(this).fund( "br:last").remove();
    });

$( "span.purchase").hover(
    function() {
     $(this).append( $( "<div style='color:rgb(55,58,60)'>Purchase refers to the quantity of cards awarding players extra treasure and/or buys</div>") );
    }, function() {
    $(this).find( "div:last").remove();
    }, function() {
    $(this).fund( "br:last").remove();
    });

$( "span.action").hover(
    function() {
     $(this).append( $( "<div style='color:rgb(55,58,60)'>Here you can control the quantity of cards awarding players extra actions</div>") );
    }, function() {
    $(this).find( "div:last").remove();
    }, function() {
    $(this).fund( "br:last").remove();
    });
</script>

<?php include("inc/footer.php"); ?>
