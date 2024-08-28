<?php

class ReadCharitiesFromCsvState extends State {
    private ModelCreator $creator;
    public function __construct(ModelCreator $creator) {
        $this->creator = $creator;
    }
    public function initialize(): void {

    }

    public function render() :void {
        $pathToFile = trim(readline("Specify a path to charity file (<= 1GB): "));
        $fileHandle = @fopen($pathToFile, "rb");
        if(!$fileHandle) {
            $this->context->changeState(
                new SimpleErrorState(
                    [["The chosen file could not be opened."]],
                    new CharityListState(),
                    new ReadCharitiesFromCsvState($this->creator)
                )
            );
            return;
        }
        $fileSize = filesize($pathToFile);
        if($fileSize > pow(1024, 3)) {
            fclose($fileHandle);
            $this->context->changeState(
                new SimpleErrorState(
                    [["The chosen file is too large."]],
                    new CharityListState(),
                    new ReadCharitiesFromCsvState($this->creator)
                )
            );
            return;
        }
        $lines = Utils::countLinesInFile($fileHandle);
        $progress = new ProgressIndicator($lines);
        $currentLine = 1;
        $charities = [];
        $errors = [];
        $fillables = $this->creator->getFillables();
        while(($data = fgetcsv($fileHandle)) != false) {
            $counter = 0;
            foreach($fillables as $key => $text) {
                $fields[$key] = array_key_exists($counter, $data) ? trim($data[$counter]) : "";
                $counter++;
            }
            $charity = $this->creator->createOrUpdate($fields);
            if($charity instanceof Charity) {
                array_push($charities, $charity);
            } else {
                $errors[$currentLine] = $charity;
            }
            $progress->render($currentLine);
            $currentLine++;
        }
        fclose($fileHandle);
        if(count($errors)) {
            $this->context->changeState(
                new CsvErrorState(
                    $errors,
                    new CharityListState(),
                    new ReadCharitiesFromCsvState($this->creator)
                )
            );
            return;
        }
        $container = $this->context->getCharityContainer();
        foreach($charities as $charity) {
            $container->addModel($charity);
        }
        $this->context->changeState(new CharityListState());
    }
}