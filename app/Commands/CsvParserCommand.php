<?php

namespace App\Commands;

use App\DTOs\OperationDto;
use App\Services\OperationFee\OperationFeeService;
use LaravelZero\Framework\Commands\Command;
use League\Csv\Reader;

class CsvParserCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'csv:parse {file}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'This command is used for parsing csv file and calculating commisions required for each transaction respectfully';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(OperationFeeService $service)
    {
        $records = Reader::createFromPath('files/' . $this->argument('file'))->getRecords();

        foreach ($records as $record) {
            $operation = OperationDto::prepareFromCSV($record);

            echo $service->calculate($operation) . "\n";
        }

    }
}
