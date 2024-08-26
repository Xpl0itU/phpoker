<?php

namespace App\PokerEngine;

class Deck {
    private $cards;
    private $is_shuffled;

    public function __construct() {
        $this->cards = array();

        foreach (Suit::cases() as $suit) {
            foreach (Value::cases() as $value) {
                array_push($cards, new Card($suit, $value));
            }
        }
    }

    public function shuffle_cards() {
        if ($this->is_shuffled) {
            shuffle($this->cards);
            $this->is_shuffled = true;
        }
    }

    public function pop_n_cards(int $n): array {
        $res = array();
        for ($i = 0; $i < $n; ++$i) {
            array_push($res, array_pop($this->cards));
        }
        return $res;
    }
}
?> 