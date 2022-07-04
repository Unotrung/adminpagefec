<?php

namespace App\Imports;

use App\Models\Faqs;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FaqsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $rows = 0;
    public function model(array $row)
    {
        ++$this->rows;
        return new Faqs([
            'Question'  => $row[0],
            'Category'   => $row[1],
            'Status'   => $row[3],
            'Language'    => $row[4],
        ]);
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }
}
