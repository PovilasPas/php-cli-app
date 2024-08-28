<?php

class AddCharityState extends State {
    private modelForm $form;

    public function initialize() :void {
        $this->form = new ModelForm(new CharityCreator());
    }

    public function render() :void {
        $newCharity = $this->form->getModel();
        if(!$newCharity instanceof Charity) {
            $this->context->changeState(
                new SimpleErrorState(
                    $newCharity,
                    new CharityListState(),
                    new AddCharityState()
                )
            );
            return;
        }
        $this->context->getCharityContainer()->addModel($newCharity);
        $this->context->changeState(new CharityListState());
    }
}