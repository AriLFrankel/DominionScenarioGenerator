<?php 

//TODO: refactor card selector loops in to a single loop using $sorted_decks and $decks instead of explicit, individual loops for each deck
      
include("inc/cards.php");

if(!empty($_POST)){
    $valid = true;

    //sort selections in to game_cards and game_decks
    //card arrays are indexed starting at 100; deck indexes start at 0
    $game_data=$_POST; 
        foreach($game_data as $data=>$value){
            if($data<100){
                $game_decks[]=$value;
            }
            else{
                $game_cards[]=$value;
            }
        }
    
    //validate
    if( count($game_cards) > 10 ){
        $cardError = "Please select at most 10 cards";
        $valid = false;
    } 
    
        
        
    if($valid == true){
//serialize then insert game data into session
//serialize then store a came_from variable for reference for the back button
    session_start();
    $_SESSION['selected_cards']=serialize($game_cards);
    $_SESSION['selected_decks']=serialize($game_decks);
    $_SESSION['came_from']='generator_card_selector.php';
    header("Location:game_cards.php");
    }
}       
    
$pageTitle="Generator";
include("inc/header.php");

 if( isset($cardError) ){
    echo "<div class='content__description'><h6>***".$cardError."***</h6></div>";
}
?>
    <div class="content__card_selector col-sm-10 col-sm-offset-1">
        <form action='card_selector.php' method='post'>
            <div class="align-right margin-top-bot">
              <button type='submit' class='linkButton button--play'>Save the New Scenario</button>
              <a class='linkButton button--back' href='saver.php'>Go Back to Saved Scenarios</a>
            </div>
            <h5 class="margin-top-bot">Which sets did you play with?</h5>
                <?php foreach($decks as $deck=>$value){
                        echo "<div class='checkbox-inline'><label>
                        <a href='#' id='".$value."'><input type='checkbox' value='" . $value . "'
                        name=".$deck."></a>" . ucwords($value) . "</label></div>";
                } ?>
            <div class="hide_on_begin">
            <h5 class="margin-top-bot">Which cards did you play with?</h5>
            </div>
            <div class="row">
                <div class='col-sm-2 offset1 span2 controls toggle_base hide_on_begin'>
                    <h6 class="title--deck"><strong>Base</strong></h6>
                    <?php foreach($sorted_base as $card=>$value){
                        echo "<div class='checkbox'><label>
                        <input type='checkbox' value='" . $value['name'] . "'
                        name=".$card.">" . ucwords($value['name']) . "</label></div>";
                    } ?>
                </div>
                <div class='col-sm-2 offset1 controls span2 toggle_intr hide_on_begin'>
                    <h6 class="title--deck"><strong>Intrigue</strong></h6>
                    <?php foreach($sorted_intrigue as $card=>$value){
                        echo "<div class='checkbox'><label>
                        <input type='checkbox' value='" . $value['name'] . "'
                        name=".$card.">" . ucwords($value['name']) . "</label></div>";
                    }?>
                </div>
                <div class='col-sm-2 offset1 controls span2 toggle_seas hide_on_begin'>
                    <h6 class="title--deck"><strong>Seaside</strong></h6>
                    <?php foreach($sorted_seaside as $card=>$value){
                        echo "<div class='checkbox'><label>
                        <input type='checkbox' value='" . $value['name'] . "'
                        name=".$card.">" . ucwords($value['name']) . "</label></div>";
                    }?>
                </div>
                <div class='col-sm-2 offset1 controls span2 toggle_hint hide_on_begin'>
                    <h6 class="title--deck"><strong>Hinterlands</strong></h6>
                    <?php foreach($sorted_hinterlands as $card=>$value){
                        echo "<div class='checkbox'><label>
                        <input type='checkbox' value='" . $value['name'] . "'
                        name=".$card.">" . ucwords($value['name']) . "</label></div>";
                    }?>
                </div>
                <div class='col-sm-2 offset1 controls span2 toggle_empi hide_on_begin'>
                    <h6 class="title--deck"><strong>Empires</strong></h6>
                    <?php foreach($sorted_empires as $card=>$value){
                        echo "<div class='checkbox'><label>
                        <input type='checkbox' value='" . $value['name'] . "'
                        name=".$card.">" . ucwords($value['name']) . "</label></div>";
                    }?>
                </div>
                <div class='col-sm-2 offset1 controls span2 toggle_pros hide_on_begin'>
                    <h6 class="title--deck"><strong>Prosperity</strong></h6>
                    <?php foreach($sorted_prosperity as $card=>$value){
                        echo "<div class='checkbox'><label>
                        <input type='checkbox' value='" . $value['name'] . "'
                        name=".$card.">" . ucwords($value['name']) . "</label></div>";
                    }?>
                </div>
                <div class='col-sm-2 offset1 controls span2 toggle_alch hide_on_begin'>
                    <h6 class="title--deck"><strong>Alchemy</strong></h6>
                    <?php foreach($sorted_alchemy as $card=>$value){
                        echo "<div class='checkbox'><label>
                        <input type='checkbox' value='" . $value['name'] . "'
                        name=".$card.">" . ucwords($value['name']) . "</label></div>";
                    }?>
                </div>
                <div class='col-sm-2 offset1 controls span2 toggle_dark hide_on_begin'>
                    <h6 class="title--deck"><strong>Dark Ages</strong></h6>
                    <?php foreach($sorted_dark_ages as $card=>$value){
                        echo "<div class='checkbox'><label>
                        <input type='checkbox' value='" . $value['name'] . "'
                        name=".$card.">" . ucwords($value['name']) . "</label></div>";
                    }?>
                </div>
                <div class='col-sm-2 offset1 controls span2 toggle_guil hide_on_begin'>
                    <h6 class="title--deck"><strong>Guilds</strong></h6>
                    <?php foreach($sorted_guilds as $card=>$value){
                        echo "<div class='checkbox'><label>
                        <input type='checkbox' value='" . $value['name'] . "'
                        name=".$card.">" . ucwords($value['name']) . "</label></div>";
                    }?>
                </div>
                <div class='col-sm-2 offset1 controls span2 toggle_adve hide_on_begin'>
                    <h6 class="title--deck"><strong>Adventures</strong></h6>
                    <?php foreach($sorted_adventures as $card=>$value){
                        echo "<div class='checkbox'><label>
                        <input type='checkbox' value='" . $value['name'] . "'
                        name=".$card.">" . ucwords($value['name']) . "</label></div>";
                    }?>
                </div> 
                <div class='col-sm-2 offset1 controls span2 toggle_corn hide_on_begin'>
                    <h6 class="title--deck"><strong>Cornucopia</strong></h6>
                    <?php foreach($sorted_cornucopia as $card=>$value){
                        echo "<div class='checkbox'><label>
                        <input type='checkbox' value='" . $value['name'] . "'
                        name=".$card.">" . ucwords($value['name']) . "</label></div>";
                    }?>
                </div>     
            </div>
        </form>
    </div>

<script type="text/javascript" src="js/card_selector.js"></script>
<?php include("inc/footer.php"); ?>