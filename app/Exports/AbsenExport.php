<?php

namespace App\Exports;

use App\Models\Absensi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AbsenExport implements FromVIew, ShouldAutoSize
{
    protected $id, $filter, $sampai, $dari;

    public function __construct($id, $dari, $sampai, $filter)
    {
        $this->id = $id;
        $this->dari = $dari;
        $this->sampai = $sampai;
        $this->filter = $filter;
    }

    public function view(): View
    {
        if($this->dari != null || $this->sampai != null){
            if($this->filter == null) {
                $absen = Absensi::where('id_kelas', $this->id)->whereBetween('tanggal', [$this->dari, $this->sampai])->get();
            } else {
                $absen = Absensi::where('id_kelas', $this->id)->whereBetween('tanggal', [$this->dari, $this->sampai])->where('status', $this->filter)->get();
            }
        } else {
            $absen = Absensi::where('id_kelas', $this->id)->get();
        }

        return view('export.absen', [
            'absen' => $absen
        ]);
    }

}
