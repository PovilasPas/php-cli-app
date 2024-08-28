<?php

class Donation extends Model {
    private string $donorName;
    private float $amount;
    private int $charity;
    private DateTime $dateTime;

    public function __construct(string $donorName, float $amount, int $charity) {
        $this->donorName = $donorName;
        $this->amount = $amount;
        $this->charity = $charity;
        $this->dateTime = new DateTime("now", new DateTimeZone('GMT'));
    }

    public function getCharity() :int {
        return $this->charity;
    }

    public function getDonorName() :string {
        return $this->donorName;
    }

    public function getAmount() :float {
        return $this->amount;
    }

    public function getDateTime() :string {
        return $this->dateTime->format("Y-m-d H:i:s");
    }
}