<?php

class Element {
    private string $title;
    private array $beats;

    public function __construct(string $title) {
        $this->title = $title;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setBeats(Element $element): void {
        $this->beats [] = $element; // array_push did not seem to work here if wanting to give 2 parameters straight away and push both in the beats array
    }

    public function getBeats(): array {
        return $this->beats;
    }
}

class GamePlay {
    public function Main() {
        $elements = [];
        $rock = new Element('rock');
        $paper = new Element('paper');
        $scissors = new Element('scissors');
        $lizard = new Element('lizard');
        $spock = new Element('spock');
        $rock->setBeats($scissors); $rock->setBeats($lizard);
        $paper->setBeats($rock); $paper->setBeats($spock);
        $scissors->setBeats($paper); $scissors->setBeats($lizard);
        $lizard->setBeats($paper); $lizard->setBeats($spock);
        $spock->setBeats($scissors); $spock->setBeats($rock);
        array_push($elements, $rock, $paper, $scissors, $lizard, $spock);
        //var_dump($elements);
        echo "Selection of elements =>\n";
        foreach ($elements as $key => $element) {
            echo "[$key]" . $element->getTitle() . PHP_EOL;
        }
        $selection = (int)readline('Select your element (0-4) >> ');
        $playerSelection = $elements[$selection];
        $PC_SELECTION = $elements[array_rand($elements)];
        echo $playerSelection->getTitle() . ' VS ' . $PC_SELECTION->getTitle() . PHP_EOL;

        if ($playerSelection === null) {
            echo 'Invalid selection' . PHP_EOL;
            exit;
        }

        if ($PC_SELECTION === $playerSelection) {
            echo "It's a tie" . PHP_EOL;
            exit;
        }

        foreach ($playerSelection->getBeats() as $element) {
            if ($PC_SELECTION->getTitle() === $element->getTitle()) {
                echo "You won!" . PHP_EOL;
                exit;
            }
        }
        echo "Computer won!" . PHP_EOL;
    }
}

$gamePlay = new GamePlay;
$gamePlay->Main();