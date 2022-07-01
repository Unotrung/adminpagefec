<?php

namespace App\Imports;

use App\Models\Faqs;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FaqsImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Faqs([
            'Question'  => $row[0],
            'Category'   => $row[1],
            'Status'   => $row[3],
            'Language'    => $row[4],
        ]);
    }
}
