<?php

//TODO:
//update settings schema


include("inc/cards.php");

session_start();
$interaction_setting = unserialize($_SESSION['interaction']);
$speed_setting = unserialize($_SESSION['speed']);
$attack_setting = unserialize($_SESSION['attack']);
$draw_setting = unserialize($_SESSION['draw']);
$purchase_setting = unserialize($_SESSION['purchase']);
$action_setting = unserialize($_SESSION['action']);
$selected_decks = unserialize($_SESSION['deck']);
$require_moat = unserialize($_SESSION['require_moat']);
$require_trash = unserialize($_SESSION['require_trash']);
// $selected_cards = unserialize($_SESSION['selected_cards']);
$selected_decks = unserialize($_SESSION['deck']);

// var_dump($interaction_setting);
// var_dump($speed_setting);
// var_dump($attack_setting);
// var_dump($draw_setting);
// var_dump($purchase_setting);
// var_dump($action_setting);
// var_dump($selected_decks);
// var_dump($require_moat);
// var_dump($require_trash);
// var_dump($selected_decks);
// var_dump($selected_cards);

if( !empty($selected_cards) ){ 
    foreach($selected_cards as $key=>$card){
       $game_cards[]=$card;
    }
}

switch($interaction_setting){
        case 'L':
        $interaction_upper_limit = .33;
        $interaction_lower_limit = 0;
        break;
        case 'M':
        $interaction_upper_limit = .69;
        $interaction_lower_limit = .33;
        break;
        case 'H':
        $interaction_upper_limit = 10;
        $interaction_lower_limit = .69;
        break;
        case 'R':
        $interaction_upper_limit = 10;
        $interaction_lower_limit = 0;
        break;
    }
    //Speed limit: Base: .5 Intrigue: .7 Combined: .6 
    switch($speed_setting){
        case 'L':
        $speed_upper_limit = .4;
        $speed_lower_limit = 0;
        break;
        case 'M':
        $speed_upper_limit = .8;
        $speed_lower_limit = .4;
        break;
        case 'H':
        $speed_upper_limit = 10;
        $speed_lower_limit = .8;
        break;
        case 'R':
        $speed_upper_limit = 10;
        $speed_lower_limit = 0;
        break;
    }
    //Attack: Base: .34 Intrigue: .34 combined: .34
    switch($attack_setting){
        case 'L':
        $attack_upper_limit = .24;
        $attack_lower_limit = 0;
        break;
        case 'M':
        $attack_upper_limit = .24;
        $attack_lower_limit = .48;
        break;
        case 'H':
        $attack_upper_limit = 10;
        $attack_lower_limit = .48;
        break;
        case 'R':
        $attack_upper_limit = 10;
        $attack_lower_limit = 0;
        break;
    }

    //Draw: Base: .78   Intrigue: .69 Combined: .735
    switch($draw_setting){
        case 'L':
        $draw_upper_limit = .5;
        $draw_lower_limit = 0;
        break;
        case 'M':
        $draw_upper_limit = 1;
        $draw_lower_limit = .5;
        break;
        case 'H':
        $draw_upper_limit = 10;
        $draw_lower_limit = 1;
        break;
        case 'R':
        $draw_upper_limit = 10;
        $draw_lower_limit = 0;
        break;
    }
    //(Money) Purchase: Base: .68 Intrigue: .9 Combined: .79
    switch($purchase_setting){
        case 'L':
        $purchase_upper_limit = .6;
        $purchase_lower_limit = 0;
        break;
        case 'M':
        $purchase_upper_limit = 1.2;
        $purchase_lower_limit = .6;
        break;
        case 'H':
        $purchase_upper_limit = 10;
        $purchase_lower_limit  = 1.2;
        break;
        case 'R':
        $purchase_upper_limit = 10;
        $purchase_lower_limit = 0;
        break;
    }
    //Action: Base: .36 Intrigue: .5 Combined: .43
    switch($action_setting){
        case 'L':
        $action_upper_limit = .3;
        $action_lower_limit = 0;
        break;
        case 'M':
        $action_upper_limit = .3;
        $action_lower_limit = .6;
        break;
        case 'H':
        $action_upper_limit = 10;
        $action_lower_limit = .6;
        break;
        case 'R':
        $action_upper_limit = 10;
        $action_lower_limit = 0;
        break;
    }

// }
//pick the rest of $game_cards:

$interaction_total = 0; 
$speed_total = 0; 
$attack_total = 0; 
$draw_total = 0; 
$purchase_total = 0; 
$action_total = 0;
$has_reaction = 0;
$has_trash = 0;
$has_curse = 0; 

$valid = false;
while($valid==false){ 
        //take stock of what's in game cards and pull values from sets
        
    $game_cards=[null]; //array of cards to return as cards to play with

    while(count($game_cards) < 11){ //NULL Starter value + 10 cards
        $random_index = mt_rand(101, 354);
        
        if(!empty($cards[$random_index]) &&
          in_array($cards[$random_index]['set'], $selected_decks) &&  
          ((($cards[$random_index]['interaction'] + $interaction_total)/count($game_cards)) <= $interaction_upper_limit) &&
          ((($cards[$random_index]['speed'] + $speed_total)/count($game_cards)) <= $speed_upper_limit) &&  
          ((($cards[$random_index]['attack'] + $attack_total)/count($game_cards)) <= $attack_upper_limit) &&
          ((($cards[$random_index]['draw'] + $draw_total)/count($game_cards)) <= $draw_upper_limit) &&
          ((($cards[$random_index]['purchase'] + $purchase_total)/count($game_cards)) <= $purchase_upper_limit)&&
          ((($cards[$random_index]['action'] + $action_total)/count($game_cards)) <= $action_upper_limit) &&
          (array_search($cards[$random_index]['name'],$game_cards)==false)
        )
        {
            //update game_cards totals
            $speed_total+=$cards[$random_index]['speed'];
            $attack_total+=$cards[$random_index]['attack'];
            $draw_total+=$cards[$random_index]['draw'];
            $purchase_total+=$cards[$random_index]['purchase'];
            $action_total+=$cards[$random_index]['action'];

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
        if(
            $speed_total < $speed_lower_limit ||
            $attack_total < $attack_lower_limit ||
            $draw_total < $draw_lower_limit ||
            $purchase_total < $purchase_lower_limit ||
            $action_total < $action_lower_limit ||
            ($require_trash == true && $has_curse > 0 && $has_trash == 0) ||
            ($require_moat == true && $attack_total > 0 && $has_reaction == 0)
        ){$valid=false; $game_cards=[];} //flush the cards and start over
}
//store $game_cards in $_SESSION, then create.php
$_SESSION['game_cards']=serialize($game_cards);
$_SESSION['came_from']='generator.php';
header("Location:read_generated.php");
