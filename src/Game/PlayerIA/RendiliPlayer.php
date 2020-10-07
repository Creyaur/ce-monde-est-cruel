<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class RendiliPlayers
 * @package Hackathon\PlayerIA
 * @author Alexandre GRATTON
 * 
 * J'ai 4 strats assez poussées, et je choisis intelligemment laquelle appliquer en fonction de diverses variables complexes
 */
class RendiliPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;
    protected $totalRound = 0;
    protected $strat = 0;

    public function getChoice()
    {
        ++$this->totalRound;
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------

        $roundNumber = $this->result->getNbRound();
        $myLastChoice = $this->result->getLastChoiceFor($this->mySide); //if 0 (first round)
        $opponentLastChoice = $this->result->getLastChoiceFor($this->opponentSide); // if 0 (first round)

        $myLastScore = $this->result->getLastScoreFor($this->mySide); // if 0 (first round)
        $opponentLastScore = $this->result->getLastScoreFor($this->opponentSide); // if 0 (first round)

        $allChoices = $this->result->getChoicesFor($this->mySide);
        //$opponentLastChoice = $this->result->getChoicesFor($this->opponentSide);

        $myLastScore = $this->result->getLastScoreFor($this->mySide);
        $stats = $this->result->getStats();

        if ($this->totalRound >= 60)
        {
            ++$this->strat;
            $this->totalRound = 0;
        }

        if ($this->strat % 4 == 0)
        {
            if ($opponentLastChoice == parent::scissorsChoice())
            {
                return parent::rockChoice();
            }
            if ($opponentLastChoice == parent::rockChoice())
            {
                return parent::paperChoice();
            }
            if ($opponentLastChoice == parent::paperChoice())
            {
                return parent::scissorsChoice();
            }
        }
        else if ($this->strat % 4 == 1)
        {
            if ($opponentLastChoice == parent::scissorsChoice())
            {
                return parent::paperChoice();
            }
            if ($opponentLastChoice == parent::rockChoice())
            {
                return parent::scissorsChoice();
            }
            if ($opponentLastChoice == parent::paperChoice())
            {
                return parent::rockChoice();
            }
        }
        else if ($this->strat % 4 == 2)
        {
            return $opponentLastChoice;
        }
        else
        {
            return parent::paperChoice();
        }


        return parent::scissorsChoice();

    }
};
