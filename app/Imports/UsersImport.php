<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UsersImport implements ToCollection ,WithStartRow
{
    /**
    * @param Collection $collection
    */
    public function startRow(): int
    {
        return 2;
    }
    public function collection(Collection $rows)
    {
        $data = [];

        foreach ($rows as $row)
        {
            $data[] = array(
                'Name'          => $row[0],
                'Address'       => $row[1],
                'Phone'         => $row[2],
                'Lead_Category' => $row[3],
            );
        }

        DB::table('leads')->insert($data);
    }


}
