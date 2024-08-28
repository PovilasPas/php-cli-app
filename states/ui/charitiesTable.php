<?php

class charitiesTable extends Table {
    public function __construct(StateManager $manager) {
        $charities = $manager->getCharityContainer()->getModels();
        $headers = ["id", "name", "email"];
        $data = array_map(
            fn(Charity $item) => [
                $item->getId(),
                $item->getName(),
                $item->getEmail()
            ],
            $charities
        );
        $pad = [
            STR_PAD_LEFT,
            STR_PAD_RIGHT,
            STR_PAD_RIGHT
        ];
        $noData = "No charities.";
        parent::__construct($headers, $data, $pad, $noData);
    }
}