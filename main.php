<?php

require_once("./models/model.php");
require_once("./models/charity.php");
require_once("./models/donation.php");
require_once("./models/modelContainer.php");
require_once("./models/inMemoryModelContainer.php");
require_once("./models/modelCreator.php");
require_once("./models/charityCreator.php");
require_once("./models/donationCreator.php");

require_once("./validators/validator.php");
require_once("./validators/regexValidator.php");
require_once("./validators/emailValidator.php");
require_once("./validators/greaterThanValidator.php");
require_once("./validators/greaterThanOrEqualValidator.php");
require_once("./validators/sequentialValidator.php");
require_once("./validators/compositeValidator.php");
require_once("./validators/validationException.php");
require_once("./validators/requiredValidator.php");

require_once("./states/stateManager.php");
require_once("./states/state.php");
require_once("./states/mainMenuState.php");
require_once("./states/charityListState.php");
require_once("./states/charitySelectionState.php");
require_once("./states/addCharityState.php");
require_once("./states/editCharityState.php");
require_once("./states/deleteCharityState.php");
require_once("./states/readCharitiesFromCsvState.php");
require_once("./states/donationListState.php");
require_once("./states/addDonationState.php");
require_once("./states/errorState.php");
require_once("./states/simpleErrorState.php");
require_once("./states/csvErrorState.php");
require_once("./states/exitState.php");

require_once("./states/ui/selectMenu.php");
require_once("./states/ui/selectMenuOption.php");
require_once("./states/ui/table.php");
require_once("./states/ui/charitiesTable.php");
require_once("./states/ui/donationsTable.php");
require_once("./states/ui/modelForm.php");
require_once("./states/ui/progressIndicator.php");

require_once("./utils.php");

$state = new MainMenuState();
$manager = new StateManager($state);

while(true) {
    $manager->render();
}