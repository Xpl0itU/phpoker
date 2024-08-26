<?php

namespace App\PokerEngine;

enum Suit {
    case Clubs;
    case Hears;
    case Spades;
    case Diamonds;
}

enum Value {
    case Ace;
    case King;
    case Queen;
    case Jill;
    case Ten;
    case Nine;
    case Eight;
    case Seven;
    case Six;
    case Five;
    case Four;
    case Three;
    case Two;
}

class Card {
    private $suit;
    private $value;

    public function __construct(Suit $suit, Value $value) {
        $this->suit = $suit;
        $this->value = $value;
    }
}
?> 