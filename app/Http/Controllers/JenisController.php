<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Http\Requests\StoreJenisRequest;
use App\Http\Requests\UpdateJenisRequest;
use Exception;
use Illuminate\Database\QueryException;
use PDOException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PaketExport;
use Maatwebsite\Excel\Facades\Excel;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['jenis'] = Jenis::get();
        return view('jenis.index')->with($data);
    }
    public function exportPDF()
    {
        $jenis = Jenis::all();
        $pdf = PDF::loadView('pdf.jenis', compact('jenis'));
        return $pdf->download('jenis.pdf');
    }
    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new PaketExport, $date . '_paket.xlsx');
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
    public function store(StoreJenisRequest $request)
    {
        Jenis::create($request->all());
        return redirect('jenis')->with('success', 'Data berhasil ditambahkan :D');
    }

    /**
     * Display the specified resource.
     */
    public function show(jenis $jenis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jenis $jenis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJenisRequest $request, Jenis $jeni)
    {
        $jeni->update($request->all());

        return redirect('jenis')->with('success', 'Update data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jenis $jeni)
    {
        try {
            DB::beginTransaction();
            $jeni->delete();
            DB::commit();
            return redirect('jenis')->with('success', 'data berhasil dihapus');
        } catch (QueryException | Exception  | PDOException $error) {
            DB::rollback();
            return redirect('jenis')->with("terjadi kesalahan" . $error->getMessage());
        }
    }
}
