<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Http\Requests\StoreAbsensiRequest;
use App\Http\Requests\UpdateAbsensiRequest;
use Exception;
use Illuminate\Database\QueryException;
use PDOException;
use Illuminate\Support\Facades\DB;
use App\Exports\AbsenExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AbsenImport;
use Barryvdh\DomPDF\Facade\Pdf;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['absensi'] = Absensi::all();
        return view('absensi.index')->with($data);
    }
    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new AbsenExport, $date . '_absensi.xlsx');
    }
    public function importData()
    {
        Excel::import(new AbsenImport, request()->file('import'));

        return redirect(request()->segment(1) . '/absen')->with('Data berhasil ditambah!');
    }
    public function exportPDF()
    {
        $absensi = Absensi::all();
        $pdf = PDF::loadView('pdf.absensi', compact('absensi'));
        return $pdf->download('absensi.pdf');
    }
    public function updateStatus(Absensi $request, $id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->status = $request->status;
        $absensi->save();

        return response()->json(['message' => 'Status updated successfully'], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAbsensiRequest $request)
    {
        Absensi::create($request->all());
        return redirect('absensi')->with('success', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAbsensiRequest $request, Absensi $absensi)
    {
        $absensi->update($request->all());

        return redirect('absensi')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        try {
            DB::beginTransaction();
            $absensi->delete();
            DB::commit();
            return redirect('absensi')->with('success', 'Data berhasil dihapus!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollBack();
            return redirect('absensi')->with('Terjadi Kesalahan!' . $error->getMessage());
        }
    }
}
