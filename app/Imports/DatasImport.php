<?php

namespace App\Imports;

use App\MasterPayrollInput;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;

class DatasImport implements ToModel, WithHeadingRow, WithValidation
{

    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $arrayInput = [];
        $payrollInput = new MasterPayrollInput();
        foreach ($payrollInput->getFillable() as $field) {
            if($field == 'nip'){
                if (MasterPayrollInput::where('nip', $row[$field])->exists()) {
                    continue;
                }
            }
            if (array_key_exists($field, $row)) {
                $arrayInput[$field] = $row[$field];
            }
        }
        return new MasterPayrollInput($arrayInput);
    }

    public function rules(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'nip'  => 'Custom message for :attribute.',
            'periode' => 'Custom message for :attribute.',
        ];
    }
}
