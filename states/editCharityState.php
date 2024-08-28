<?php

class EditCharityState extends State {
    private modelForm $form;
    private int $charityId;
    public function __construct(int $charityId) {
        $this->charityId = $charityId;
    }

    public function initialize(): void {
        $this->form = new ModelForm(new CharityCreator());
    }

    public function render() :void {
        $container = $this->context->getCharityContainer();
        $charity = $container->getModel($this->charityId);
        $newCharity = $this->form->getModel($charity);
        if(!$newCharity instanceof Charity) {
            $this->context->changeState(
                new SimpleErrorState(
                    $newCharity,
                    new CharityListState(),
                    new EditCharityState($this->charityId)
                )
            );
            return;
        }
        $container->changeModel($this->charityId, $newCharity);
        $this->context->changeState(new CharityListState());
    }
}