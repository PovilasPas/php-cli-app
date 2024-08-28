<?php 

class AddDonationState extends State {
    private modelForm $form;
    private int $charityId;

    public function __construct(int $charityId) {
        $this->charityId = $charityId;
    }

    public function initialize() :void {
        $this->form = new ModelForm(new DonationCreator($this->charityId));
    }

    public function render() :void {
        $newDonation = $this->form->getModel();
        if(!$newDonation instanceOf Donation) {
            $this->context->changeState(
                new SimpleErrorState(
                    $newDonation,
                    new DonationListState($this->charityId),
                    new AddDonationState($this->charityId)
                )
            );
            return;
        }
        $this->context->getDonationContainer()->addModel($newDonation);
        $this->context->changeState(new DonationListState($this->charityId));
    }
}