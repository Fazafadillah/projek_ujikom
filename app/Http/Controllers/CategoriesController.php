<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Http\Requests\StorecategoriesRequest;
use App\Http\Requests\UpdatecategoriesRequest;
use Exception;
use Illuminate\Database\QueryException;
use PDOException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['categories'] = categories::get();
        return view('categories.index')->with($data);
    }
    public function exportPDF()
    {
        $categories = Categories::all();
        $pdf = PDF::loadView('pdf.categories', compact('categories'));
        return $pdf->download('categories.pdf');
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
    public function store(StorecategoriesRequest $request)
    {
        categories::create($request->all());
        return redirect('categories')->with('success', 'Data berhasil ditambahkan :D');
    }

    /**
     * Display the specified resource.
     */
    public function show(categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriesRequest $request, categories $category)
    {
        $category->update($request->all());

        return redirect('categories')->with('success', 'Update data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(categories $category)
    {
        try {
            DB::beginTransaction();
            $category->delete();
            DB::commit();
            return redirect('categories')->with('success', 'data berhasil dihapus');
        } catch (QueryException | Exception  | PDOException $error) {
            DB::rollback();
            return redirect('categories')->with("terjadi kesalahan" . $error->getMessage());
        }
    }
}
