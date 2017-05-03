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