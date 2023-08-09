<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class LaporanExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function __construct($search)
    {
        $this->search = $search;
    }

    public function query()
    {
        $post = Post::where(function ($query) {
            if ($this->search) {
                $query->where('nocm', 'like', '%' . $this->search . '%')
                      ->orWhere('nama', 'like', '%' . $this->search . '%')
                      ->orWhere('user', 'like', '%' . $this->search . '%')
                      ->orWhere('sctid', 'like', '%' . $this->search . '%')
                      ->orWhere('diagnosa', 'like', '%' . $this->search . '%')
                      ->orWhere('pelayanan', 'like', '%' . $this->search . '%')
                      ->orWhere('kunjungan', 'like', '%' . $this->search . '%');
            }
        })
        ->select("user", "nocm", "nama", "pelayanan", "kunjungan", "diagnosa", "created_at", "updated_at");
        return $post;
    }

    public function headings(): array
    {
        return [
            'Petugas',
            'No RM',
            'Nama Pasien',
	    'Jenis Pelayanan',
            'Tanggal Kunjungan',
	    'Diagnosa',
            'Tanggal Upload',
            'Tanggal Update'
        ];
        
    }
}
