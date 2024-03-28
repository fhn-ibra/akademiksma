<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\DataPelanggaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PelanggaranExport implements FromVIew, ShouldAutoSize
{
    protected $from, $to, $search;

    public function __construct($from, $to, $search)
    {
        $this->from = $from;
        $this->to = $to;
        $this->search = $search;
    }

    public function view(): View
    {
       
        $siswa = DataPelanggaran::with('siswa', 'kelas')->get();

        $dateFrom = $this->from;
        $dateTo = $this->to;
        $search = $this->search;
        $filteredSiswa = DataPelanggaran::query();

        if ($dateFrom && $dateTo) {
            $filteredSiswa->whereBetween('tanggal', [$dateFrom, $dateTo]);
        } else {
            $today = Carbon::now()->toDateString();
            $filteredSiswa->whereDate('tanggal', $today);
        }

        if (!empty($search)) {
            $filteredSiswa->where(function ($query) use ($search) {
                $query->whereHas('siswa', function ($query) use ($search) {
                    $query->where('nama', 'like', '%' . $search . '%');
                })->orWhereHas('kelas', function ($query) use ($search) {
                    $query->where('nama_kelas', 'like', '%' . $search . '%');
                })->orWhereHas('pelanggaran', function ($query) use ($search) {
                    $query->where('nama_pelanggaran', 'like', '%' . $search . '%');
                });
            });
        }

        $filteredSiswa = $filteredSiswa->get();

        return view('export.data_pelanggaran', compact('siswa', 'filteredSiswa'));
    }

}
