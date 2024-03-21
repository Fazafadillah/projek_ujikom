<?php

namespace App\Http\Controllers;

use App\Models\produk_titipan;
use App\Http\Requests\Storeproduk_titipanRequest;
use App\Http\Requests\Updateproduk_titipanRequest;
use Exception;
use Illuminate\Database\QueryException;
use PDOException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Excelimport;
use Illuminate\Http\Request;

class ProdukTitipanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['produk_titipan'] = produk_titipan::get();
        return view('produk_titipan.index')->with($data);
    }

    public function exportPDF()
    {
        $produk_titipan = produk_titipan::all();
        $pdf = PDF::loadView('pdf.produk_titipan', compact('produk_titipan'));
        return $pdf->download('produk_titipan.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new ExcelExport, 'Produk_titipan_export.xlsx');
    }

    public function Excelimport(Request $request)
    {
        Excel::import(new Excelimport, $request->file('file'));

        return redirect()->back()->with('success', 'Data imported successfully');
    }
    public function updateStok($produkid)
    {
        $produk = produk_titipan::findOrFail($produkid);
        $produk->stok = request()->input('stok');
        $produk->save();

        return response()->json(['message' => 'Stok berhasil diperbarui'], 200);
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
    public function store(Storeproduk_titipanRequest $request)
    {
        produk_titipan::create($request->all());
        return redirect('produk_titipan')->with('success', 'Data berhasil ditambahkan :D');
    }

    /**
     * Display the specified resource.
     */
    public function show(produk_titipan $produk_titipan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(produk_titipan $produk_titipan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateproduk_titipanRequest $request, produk_titipan $produk_titipan)
    {
        $produk_titipan->update($request->all());

        return redirect('produk_titipan')->with('success', 'Update data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(produk_titipan $produk_titipan)
    {
        try {
            DB::beginTransaction();
            $produk_titipan->delete();
            DB::commit();
            return redirect('produk_titipan')->with('success', 'data berhasil dihapus');
        } catch (QueryException | Exception  | PDOException $error) {
            DB::rollback();
            return redirect('produk_titipan')->with("terjadi kesalahan" . $error->getMessage());
        }
    }
}
