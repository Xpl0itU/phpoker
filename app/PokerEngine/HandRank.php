<?php

namespace App\PokerEngine;

use Exception;

abstract class HandRank {
    const HIGH_CARD = 'HIGH_CARD';
    const ONE_PAIR = 'ONE_PAIR';
    const TWO_PAIR = 'TWO_PAIR';
    const THREE_OF_A_KIND = 'THREE_OF_A_KIND';
    const STRAIGHT = 'STRAIGHT';
    const FLUSH = 'FLUSH';
    const FULL_HOUSE = 'FULL_HOUSE';
    const FOUR_OF_A_KIND = 'FOUR_OF_A_KIND';
    const STRAIGHT_FLUSH = 'STRAIGHT_FLUSH';
    const ROYAL_FLUSH = 'ROYAL_FLUSH';

    private static $allRanks = [
        self::HIGH_CARD,
        self::ONE_PAIR,
        self::TWO_PAIR,
        self::THREE_OF_A_KIND,
        self::STRAIGHT,
        self::FLUSH,
        self::FULL_HOUSE,
        self::FOUR_OF_A_KIND,
        self::STRAIGHT_FLUSH,
        self::ROYAL_FLUSH
    ];

    public static function matches($rank, $hand, $communityCards) {
        switch ($rank) {
            case self::HIGH_CARD:
                return false; // TODO: Implement this
            case self::ONE_PAIR:
                return false; // TODO: Implement this
            case self::TWO_PAIR:
                return false; // TODO: Implement this
            case self::THREE_OF_A_KIND:
                return false; // TODO: Implement this
            case self::STRAIGHT:
                return false; // TODO: Implement this
            case self::FLUSH:
                return self::matchesFlush($hand, $communityCards);
            case self::FULL_HOUSE:
                return self::matchesFullHouse($hand, $communityCards);
            case self::FOUR_OF_A_KIND:
                return self::matchesFourOfAKind($hand, $communityCards);
            case self::STRAIGHT_FLUSH:
                return false; // TODO: Implement this
            case self::ROYAL_FLUSH:
                return false; // TODO: Implement this
            default:
                throw new Exception("Unknown rank: $rank");
        }
    }

    private static function matchesFlush($hand, $communityCards) {
        $allCards = array_merge($hand, $communityCards);

        $suitCount = [];
        foreach ($allCards as $card) {
            $suit = $card->getSuit();
            if (!isset($suitCount[$suit])) {
                $suitCount[$suit] = 0;
            }
            $suitCount[$suit]++;
        }

        foreach ($suitCount as $count) {
            if ($count >= 5) {
                return true;
            }
        }

        return false;
    }

    private static function matchesFullHouse($hand, $communityCards) {
        $allCards = array_merge($hand, $communityCards);

        $valueCount = [];
        foreach ($allCards as $card) {
            $value = $card->getValue();
            if (!isset($valueCount[$value])) {
                $valueCount[$value] = 0;
            }
            $valueCount[$value]++;
        }

        $hasThreeOfAKind = false;
        $hasPair = false;

        foreach ($valueCount as $count) {
            if ($count == 3) {
                $hasThreeOfAKind = true;
            } elseif ($count == 2) {
                $hasPair = true;
            }
        }

        return $hasThreeOfAKind && $hasPair;
    }

    private static function matchesFourOfAKind($hand, $communityCards) {
        $allCards = array_merge($hand, $communityCards);

        $valueCount = [];
        foreach ($allCards as $card) {
            $value = $card->getValue();
            if (!isset($valueCount[$value])) {
                $valueCount[$value] = 0;
            }
            $valueCount[$value]++;
        }

        foreach ($valueCount as $count) {
            if ($count >= 4) {
                return true;
            }
        }

        return false;
    }
}

class PlayingCard {
    private $suit;
    private $value;

    public function __construct($suit, $value) {
        $this->suit = $suit;
        $this->value = $value;
    }

    public function getSuit() {
        return $this->suit;
    }

    public function getValue() {
        return $this->value;
    }
}
