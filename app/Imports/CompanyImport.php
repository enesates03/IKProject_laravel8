<?php

namespace App\Imports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;


class CompanyImport implements
    ToModel,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure
{
    use Importable,SkipsFailures,SkipsErrors;

    public function model(array $row)
    {
        return new Company([
            'name'=>$row['name'],
            'address'=>$row['address'],
            'phone'=>$row['phone'],
            'email'=>$row['email'],
            'website'=>$row['website'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.name'=>['required',
                'unique:companies'],
            '*.address'=>['nullable'],
            '*.phone'=>['nullable','regex:/^([0-9\s\-\+\(\)]*)$/','min:10'],
            '*.email'=>['email','nullable'],
            '*.website'=>['nullable'],
        ];
    }
}
