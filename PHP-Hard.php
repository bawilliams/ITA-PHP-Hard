<?php
/* HARD:
Bring in your createDeck and dealCards function from the previous challenges. For the specified 
number of players below, assign each player an even set of cards.
We will do this by counting out how many players there are, counting how many cards are in the 
deck and then dividing them so we know how many cards each player should get.
  
  $deck =
  $num_players = 4;
  $num_cards_in_deck = //find a function to count the # of elements in an array
  $num_cards_to_give_each_player =
  
Use a for loop to add the "dealt hands" to the $players array
Let’s create a simple game. Each player will play a card and whoever has the highest value wins. 
If there are 2 cards played that have the same value, everyone loses and that round is a draw. 
Store the results of each game and also who won that round as the value.
If the round is a draw, store the value as DRAW. Use a loop to play each game until all opponents 
are out of cards. Print out the array of all the rounds. If there was a draw, the round should say 
DRAW. If a player has won, it should displayer “Player X” where X is the index of the player.*/

class Game {
  public $num_players = 4;
  public $num_cards_in_deck;
  public $num_cards_to_give_each_player;
  public $gameDeck; 
  public $players = array();
  public $results = array();
  public $winners = array();

  // When a new Game starts, create a game deck of cards, and deal cards evenly to each player
  public function __construct() {
    $this->createGameDeck();
    $this->calculateNumCardsInDeck();
    $this->calculateNumCardsToGiveEachPlayer();
    $this->createPlayerHands();
    $this->dealCardsToPlayers();
  }

  public function createGameDeck() {
    $this->gameDeck = New Deck();
  }

  public function getPlayers() {
    return $this->num_players;
  }

  public function getNumCardsInDeck() {
    return $this->num_cards_in_deck;
  }

  public function calculateNumCardsInDeck() {
    $this->num_cards_in_deck = count($this->gameDeck->deck);
  }

  public function getNumCardsToGiveEachPlayer() {
    return $this->num_cards_to_give_each_player;
  }

  public function calculateNumCardsToGiveEachPlayer() {
    $this->num_cards_to_give_each_player = $this->num_cards_in_deck / $this->num_players;
  }

  public function createPlayerHands() {
    for ($i = 0; $i < $this->num_players; $i++) {
      $this->players[] = array();
    }
  }

  // Deal cards then push them into each of the individual player arrays inside of players[]
  public function dealCardsToPlayers() {
    $this->gameDeck->dealCards(52);

    for ($i = 0; $i < 13; $i++) {
      array_push($this->players[0], $this->gameDeck->dealtCards[$i]);
      array_push($this->players[1], $this->gameDeck->dealtCards[$i + 13]);
      array_push($this->players[2], $this->gameDeck->dealtCards[$i + 26]);
      array_push($this->players[3], $this->gameDeck->dealtCards[$i + 39]);
    }
  }

  // Function that 
  public function playGame() {
    // Loop through for the same number of rounds as each player has cards
    for ($i =0; $i < 13; $i++) {
      // Add all players with the highest value in the round to winners
      $this->winners[] = array_keys([
        $this->players[0][$i]->value, 
        $this->players[1][$i]->value, 
        $this->players[2][$i]->value, 
        $this->players[3][$i]->value
      ], max(
        $this->players[0][$i]->value, 
        $this->players[1][$i]->value, 
        $this->players[2][$i]->value, 
        $this->players[3][$i]->value
      ));

      // If there is only one winner, then display their name
      if (count($this->winners[$i]) === 1) {
        array_push($this->results, 'Player ' . $this->winners[$i][0]);
      // Otherwise it's a draw
      } else {
        $this->results[] = 'DRAW';
      }
    }
  }
}


class Deck {
  private $suits = array ("clubs", "diamonds", "hearts", "spades"); 
  private $faces = array ("ace", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "jack", "queen", "king");

  // Keep public to allow access to it for the Game class
  public $deck = array();
  public $dealtCards = array();

  // When a new Deck is created, immediately build the deck of cards and shuffle it
  public function __construct() {
    $this->createDeck();
    $this->shuffleDeck();
  }

  // Loops through the suits and faces arrays to create a card deck by filling the deck array with card objects
  public function createDeck() {
    foreach ($this->faces as $face) {
      foreach ($this->suits as $suit) {
        $this->deck[] = new Card($face, $suit);
      }    
    }
  }

  public function shuffleDeck() {
    shuffle($this->deck);
  }

  // Deals the number of cards specified by the user, adding the cards to dealtCards and removing from the remaining deck
  public function dealCards($number) {
    for ($i = 0; $i < $number; $i++) {
      $this->dealtCards[] = $this->deck[$i];
      unset($this->deck[$i]);
    }
  }

  public function getDeck() {
    return $this->deck;
  }

  public function getDealtCards() {
    return $this->dealtCards;    
  }
}

class Card {
  // Keep public so the playGame can have access to the value
  public $value;
  public $suit;
  public $face;
  public $name;

  // Immediately after creating a new Card class, set all four values based on inputed values
  public function __construct($face, $suit) {
    $this->face = $face;
    $this->suit = $suit;
    $this->name = $face . ' of ' . $suit;

    switch($face) {
      case 'ace':
        $this->value = 11;
        break;
      case 'two':
        $this->value = 2;
        break;
      case 'three':
        $this->value = 3;
        break;
      case 'four':
        $this->value = 4;
        break;
      case 'five':
        $this->value = 5;
        break;
      case 'six':
        $this->value = 6;
        break;
      case 'seven':
        $this->value = 7;
        break;
      case 'eight':
        $this->value = 8;
        break;
      case 'nine':
        $this->value = 9;
        break;
      case 'ten':
        $this->value = 10;
        break;
      case 'jack':
        $this->value = 10;
        break;
      case 'queen':
        $this->value = 10;
        break;
      case 'king':
        $this->value = 10;
        break;
    }
  }
}

$deck1 = new Deck();
$deckprint = $deck1->getDeck();

$deckprint = $deck1->dealCards(7);
$deckprint = $deck1->getDealtCards();
// var_dump($deckprint);
echo "\n<br />\n<br />";

// Show that the dealt cards have been removed from the deck
$deckprint = $deck1->getDeck();
// var_dump($deckprint);

$game1 = new Game();
$game1->playGame();
echo "<pre>"; print_r($game1->results); echo "</pre>";
echo "<pre>"; print_r($game1->players); echo "</pre>";

echo "<pre>"; print_r($game1->gameDeck->deck); echo "</pre>";
?>