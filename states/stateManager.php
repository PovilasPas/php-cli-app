<?php

class StateManager {
    private State $currentState;
    private array $containers;
    private IModelContainer $charityContainer;
    private IModelContainer $donationContainer;

    public function __construct(State $initialState) {
        $this->charityContainer = new InMemoryModelContainer();
        $this->donationContainer = new InMemoryModelContainer();
        $this->changeState($initialState);
    }

    public function changeState(State $state) :void {
        $this->currentState = $state;
        $this->currentState->setContext($this);
        $this->currentState->initialize();
    }

    public function getCharityContainer() :IModelContainer {
        return $this->charityContainer;
    }

    public function getDonationContainer() :IModelContainer {
        return $this->donationContainer;
    }

    public function render() :void {
        echo "\033[H\033[J";
        $this->currentState->render();
    }
}