<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Menu;
use App\Http\Requests\StoreStokRequest;
use App\Http\Requests\UpdateStokRequest;
use Exception;
use Illuminate\Database\QueryException;
use PDOException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\StokExport;
use Maatwebsite\Excel\Facades\Excel;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['stok'] = Stok::get();
        $data['menu'] = Menu::get();
        return view('Stok.index')->with($data);
    }
    public function exportPDF()
    {
        $stok = Stok::all();
        $pdf = PDF::loadView('pdf.stok', compact('stok'));
        return $pdf->download('stok.pdf');

        // redirect('jenis');
    }
    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new StokExport, $date . '_paket.xlsx');
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
    public function store(StoreStokRequest $request)
    {
        Stok::create($request->all());
        return redirect('stok')->with('success', 'Data berhasil ditambahkan :D');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stok $stok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stok $stok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStokRequest $request, Stok $stok)
    {
        $stok->update($request->all());

        return redirect('stok')->with('success', 'Update data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stok $stok)
    {
        try {
            DB::beginTransaction();
            $stok->delete();
            DB::commit();
            return redirect('stok')->with('success', 'data berhasil dihapus');
        } catch (QueryException | Exception  | PDOException $error) {
            DB::rollback();
            return redirect('stok')->with("terjadi kesalahan" . $error->getMessage());
        }
    }
}
