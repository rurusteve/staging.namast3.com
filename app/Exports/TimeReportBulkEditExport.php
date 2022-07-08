<?php

namespace App\Exports;

use App\MasterTask;
use App\MasterEmployee;
use App\TimeReport;
use App\TimeReportHead;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Cell\DataValidator;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

use function App\getEndPeriod;
use function App\getStartPeriod;

class TimeReportBulkEditExport implements FromCollection, WithHeadings, WithEvents, ShouldAutoSize, WithColumnFormatting
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    private $period;
    protected $selects;
    protected $row_count;
    protected $column_count;

    public function __construct(int $period = null)
    {
        $this->period = $period;
        switch (Auth::user()->logintype) {
            case 'professionalaudit':
                $division = 'aud';
                break;
            case 'professionalaccounting':
                $division = 'acc';
                break;
            case 'professionaltax':
                $division = 'tax';
                break;
            case 'nonprofessional':
                $division = 'adm';
                break;
            default:
        }
        $roles=MasterTask::where('division', $division)->select('id', 'taskname')->get()->toArray();
        $selects=[  //selects should have column_name and options
            ['columns_name'=>'C','options'=>$roles],
            ['columns_name' => 'H', 'options' => [
                0 => ['type' => 'REGULAR_HOUR'], 
                1 => ['type' => 'OVERTIME_HOUR']
            ]]
        ];
        $this->selects=$selects;
        $this->row_count=100;//number of rows that will have the dropdown
        $this->column_count=2;//number of columns to be auto sized
        $this->user = MasterEmployee::where('nip', Auth::user()->nip)->first();
    }

    public function sendPara($request)
    {
        $this->request = $request;

        return $this;
    }

    public function withErrors($errors){
        $this->errors = $errors;

        return $this;
    }

    public function collection()
    {
        $start_period = getStartPeriod($this->period);
        $end_period = getEndPeriod(($this->period));

        $timereports = TimeReport::whereBetween('date', [$start_period->format('Y-m-d'), $end_period->format('Y-m-d')])
            ->where('nip', Auth::user()->nip)->get();

        $data = [];

        foreach ($timereports as $timereport)
        {
            $task   = MasterTask::find($timereport->task);
            $date   = Carbon::createFromFormat('Y-n-d',  $timereport->date);
            
            $type = 'REGULAR_HOUR';

            if($timereport->overtimes > 0){
                $type = 'OVERTIME_HOUR';
            }

            $selectedData = [
                'nip'           => $timereport->nip,
                'date'          => $date->format('m/d/Y'),
                'task'          => $task->id.'.'.$task->taskname,
                'clientcode'    => $timereport->clientid,
                'starttime'     => $timereport->starttime,
                'finishtime'    => $timereport->finishtime,
                'description'   => $timereport->description,
                'type'          => $type
            ];
            if($this->user->lembur === 'T'){
                unset($selectedData['type']); 
            }
            array_push($data, $selectedData);
        }
        return collect($data);
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'E' => '@'
        ];
    }

    public function headings(): array
    {
        $arrayHeadings = [
            'NIP',
            'Date',
            'Task',
            'Client ID',
            'Start Time',
            'Finish Time',
            'Description',
            'Type'
        ];
        
        if($this->user->lembur === 'T'){
            unset($arrayHeadings[7]); 
        }
        
        return $arrayHeadings;
    }

    public function registerEvents(): array
    {
        return [
            // handle by a closure.
            AfterSheet::class => function(AfterSheet $event) {
                $row_count = $this->row_count;
                $column_count = $this->column_count;
                foreach ($this->selects as $select){
                    $drop_column = $select['columns_name'];
                    $options = [];
                    foreach ($select['options'] as $option) {
                        if(isset($option['id'])){
                            $option = $option['id'] . '.' . $option['taskname'];
                            array_push($options, $option);
                        }else{
                            if ($this->user->lembur === 'Y') {
                                $option = $option['type'];
                                array_push($options, $option);
                            }
                        }
                    }

                    $validation = $event->sheet->getCell("{$drop_column}{$column_count}")->getDataValidation();
                    $validation->setType( DataValidation::TYPE_LIST );
                    $validation->setErrorStyle( DataValidation::STYLE_INFORMATION );
                    $validation->setAllowBlank(false);
                    $validation->setShowInputMessage(true);
                    $validation->setShowErrorMessage(true);
                    $validation->setShowDropDown(true);
                    $validation->setErrorTitle('Input error');
                    $validation->setError('Value is not in list.');
                    $validation->setPromptTitle('Pick from list');
                    $validation->setPrompt('Please pick a value from the drop-down list.');
                    $validation->setFormula1(sprintf('"%s"',trim(implode(',',$options))));

                    // clone validation to remaining rows
                    for ($i = 3; $i <= $row_count; $i++) {
                        $event->sheet->getCell("{$drop_column}{$i}")->setDataValidation(clone $validation);
                    }
                    // set columns to autosize
                    for ($i = 1; $i <= $column_count; $i++) {
                        $column = Coordinate::stringFromColumnIndex($i);
                        $event->sheet->getColumnDimension($column)->setAutoSize(true);
                    }
                }

            },
        ];
    }
}


