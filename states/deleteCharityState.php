<?php 

class DeleteCharityState extends State {
    private int $charityId;

    public function __construct(int $charityId) {
        $this->charityId = $charityId;
    }

    public function initialize(): void {
        
    }

    public function render() :void {
        $donations = $this->context->getDonationContainer()->getModels();
        foreach($donations as $donation) {
            if($donation->getCharity() == $this->charityId) {
                $this->context->getDonationContainer()->deleteModel($donation->getId());
            }
        }
        $this->context->getCharityContainer()->deleteModel($this->charityId);
        $this->context->changeState(new CharityListState());
    }
}