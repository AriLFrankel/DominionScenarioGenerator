
<?php 
//TODO: add Update functionality to modify games 
    $pageTitle="Scenario Saver";
    require('inc/database_heroku.php');
    include("inc/header.php");
?>

<div class="content__saver col-sm-10 col-sm-offset-1">
    <div class="align-right margin-top-bot">
            <a href="card_selector.php" class="linkButton button--back">Save a New Scenario</a>
        </div>
        <br>
                 
                <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Date</th>
                          <th>Length</th>
                          <th>Decks</th>
                          <th>Description</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM savored_games ORDER BY id DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['name'] . '</td>';
                                echo '<td>'. $row['date_played'] . '</td>';
                                echo '<td>'. $row['game_length'] . ' min.'. '</td>';
                                echo '<td>'. $row['decks'] . '</td>';
                                echo '<td>'. $row['commentary'] . '</td>';
                                echo '<td>';
                                  echo '<div class="row"><a class="linkButton button--play" href="read.php?id='.$row['id'].'">Play</a>';
                                  echo '<a class="linkButton button--back" href="delete.php?id='.$row['id'].'">Erase</a></div>';
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
        </div><!-- /container -->
    
<?php include("inc/footer.php");