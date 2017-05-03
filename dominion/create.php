<?php
$pageTitle = "Details";
require('inc/database_heroku.php');

session_start();
    $came_from = $_SESSION['came_from'];
    $game_cards = $_SESSION['game_cards'];
    $game_decks_session = unserialize($_SESSION['deck']);
    if(isset($_SESSION['selected_decks'])){$selected_decks_session = unserialize($_SESSION['selected_decks']);}
    $game_decks = '';
    foreach($game_decks_session as $deck=>$value){
        $game_decks .= ucwords($value). " ";
    }
    if(isset($selected_decks_session)){
        foreach($selected_decks_session as $deck=>$value){
            $game_decks .= ucwords($value). " ";
            var_dump($selected_decks_session);
        }
    } 

if (!empty($_POST)){
    // keep track validation errors
    $nameError = null;
    $dateError = null;
    $game_lengthError = null;
    $commentaryError= null; //commentary not currently required 

    // keep track post values
    $name = $_POST['name'];
    $date_played = $_POST['date_played'];
    $game_length = $_POST['game_length'];
    $commentary = $_POST['commentary'];

    // validate input; doesn't require winner nor commentary currently
    $valid = true;
    if (empty($name)) {
        $nameError = 'Please enter Name';
        $valid = false;
    }

    if (empty($date_played)) {
        $dateError = 'Please enter date played';
        $valid = false;
    } 

    if (empty($game_length)) {
        $game_lengthError = 'Please enter game length';
        $valid = false;
    }

    //create an entry in the database
    if($valid){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO savored_games (name,date_played,game_length, decks, commentary, game_cards) values(?, ?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($name,$date_played,$game_length,$game_decks,$commentary, $game_cards));
        Database::disconnect();
        header("Location: saver.php");
    }
}
include("inc/header.php");
?> 
    <div class="content__card_selector col-sm-10 col-sm-offset-1">
        <div class="row">
            <h5 class="margin-top-bot">Details...</h5>
        <form class="form-horizontal" action="create.php" method="post">
          <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
            <label class="control-label">Name the Game</label>
            <div class="controls">
                <input style="color:black" name="name" type="text" Placeholder="..." value="<?php echo !empty($name)?$name:'';?>">
                <?php if (!empty($nameError)): ?>
                    <span class="help-inline"><?php echo $nameError;?></span>
                <?php endif; ?>
            </div>
          </div>
          <div class="control-group <?php echo !empty($dateError)?'error':'';?>">
            <label class="control-label">Date Played</label>
            <div class="controls">
                <input style="color:black" name="date_played" type="date" value="<?php echo date('Y-m-d'); ?>">
                <?php if (!empty($dateError)): ?>
                    <span class="help-inline"><?php echo $dateError;?></span>
                <?php endif; ?>
            </div>
          </div>
          <div class="control-group <?php echo !empty($game_lengthError)?'error':'';?>">
            <label class="control-label">Length of Game (Minutes)</label>
            <div class="controls">
                <input style="color:black" name="game_length" type="number" min="1" max="120" value="<?php echo !empty($game_length)?$game_length:'';?>">
                <?php if (!empty($game_lengthError)): ?>
                    <span class="help-inline"><?php echo $game_lengthError;?></span>
                <?php endif; ?>
            </div>
          </div>
          <div class="control-group <?php echo !empty($commentaryError)?'error':'';?>">
            <label class="control-label">Commentary</label>
            <div class="controls">
                <textarea style="color:black" name="commentary" value="<?php echo !empty($commentary)?$commentary:'';?>" placeholder="Optional bitterness here.."></textarea>
                <?php if (!empty($commentaryError)): ?>
                    <span class="help-inline"><?php echo $commentaryError;?></span>
                <?php endif; ?>
            </div>
          </div>
          <div class="margin-top-bot">
              <button type='submit' class='linkButton button--play'>Onward</button>
               <a class='linkButton button--back' href=" 
                 <?php echo $came_from; ?> ">Back</a>
          </div>
        </form>
    </div><!-- /container -->
<?php include("inc/footer.php");?> 

        