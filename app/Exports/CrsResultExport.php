<?php

namespace App\Exports;

use App\CrsResult;
use Maatwebsite\Excel\Concerns\FromCollection;

class CrsResultExport implements FromCollection
{
    protected $crsResult;

    public function __construct($crsResult)
    {
        $this->crsResult = $crsResult;
    }

    public function collection()
    {
        return $this->crsResult;
    }
}
