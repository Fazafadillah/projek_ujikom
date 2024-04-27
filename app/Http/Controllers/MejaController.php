<?php

namespace App\Http\Controllers;

use App\Exports\MejaExport;
use App\Exports\PaketExport;
use App\Models\meja;
use App\Http\Requests\StoremejaRequest;
use App\Http\Requests\UpdatemejaRequest;
use App\Imports\MejaImport;
use Exception;
use Illuminate\Database\QueryException;
use PDOException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['meja'] = meja::get();
        return view('meja.index')->with($data);
    }
    public function exportPDF()
    {
        $meja = Meja::all();
        $pdf = PDF::loadView('pdf.meja', compact('meja'));
        return $pdf->download('meja.pdf');
    }
    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new MejaExport, $date . '_Meja.xlsx');
    }
    public function importData()
    {

        Excel::import(new MejaImport, request()->file('import'));
        return redirect()->back()->with('success', 'Import data Produk Jenis berhasil');
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
    public function store(StoremejaRequest $request)
    {
        meja::create($request->all());
        return redirect('meja')->with('success', 'Data berhasil ditambahkan :D');
    }

    /**
     * Display the specified resource.
     */
    public function show(meja $meja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(meja $meja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemejaRequest $request, meja $meja)
    {
        $meja->update($request->all());

        return redirect('meja')->with('success', 'Update data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(meja $meja)
    {
        try {
            DB::beginTransaction();
            $meja->delete();
            DB::commit();
            return redirect('meja')->with('success', 'data berhasil dihapus');
        } catch (QueryException | Exception  | PDOException $error) {
            DB::rollback();
            return redirect('meja')->with("terjadi kesalahan" . $error->getMessage());
        }
    }
}
