<?php

class DonationsTable extends Table {
    public function __construct(StateManager $manager, int $charityId) {
        $donations = array_filter(
            $manager->getDonationContainer()->getModels(),
            fn(Donation $item) => $item->getCharity() == $charityId,
        );
        $headers = ["id", "donor name", "amount", "charity id", "date time"];
        $data = array_map(
            fn(Donation $item) => [
                $item->getId(),
                $item->getDonorName(),
                number_format($item->getAmount(), 2),
                $item->getCharity(),
                $item->getDateTime()
            ],
            $donations
        );
        $pad = [
            STR_PAD_LEFT,
            STR_PAD_RIGHT,
            STR_PAD_LEFT,
            STR_PAD_LEFT,
            STR_PAD_RIGHT
        ];
        $noData = "No donations.";
        parent::__construct($headers, $data, $pad, $noData);
    }
}