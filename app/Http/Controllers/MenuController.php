<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Faker\Provider\Image;
use Illuminate\Database\QueryException;
use PDOException;
use Illuminate\Support\Facades\DB;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu'] = Menu::get();
        $data['jenis'] = Jenis::get();
        return view('Menu.index')->with($data);
    }
    public function exportPDF()
    {
        $menu = menu::all();
        $pdf = PDF::loadView('pdf.menu', compact('menu'));
        return $pdf->download('menu.pdf');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRequest $request)
    {
        $image = $request->file('image');

        $filename = date('Y-m-d') . $image->getClientOriginalName();
        // dd($filename);
        $path = 'menu-image/' . $filename;

        Storage::disk('public')->put($path, file_get_contents($image));

        $data['jenis_id'] = $request->jenis_id;
        $data['name'] = $request->name;
        $data['harga'] = $request->harga;
        $data['stok'] = $request->stok;
        $data['image'] = $filename;
        $data['deskripsi'] = $request->deskripsi;

        Menu::create($data);
        return redirect('menu')->with('success', 'Data berhasil ditambahkan :D');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $Menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $Menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $Menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $Menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMenuRequest  $request
     * @param  \App\Models\Menu  $Menu
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuRequest $request, menu $Menu)
    {
        if ($request->file('image')) {
            if ($request->old_image) {
                Storage::disk('public')->delete('menu-image/' . $request->old_image);
            }
            $image = $request->file('image');

            $filename = date('Y-m-d') . $image->getClientOriginalName();

            $path = 'menu-image/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($image));

            $data['image'] = $filename;
        }

        $data['jenis_id'] = $request->jenis_id;
        $data['name'] = $request->name;
        $data['harga'] = $request->harga;
        $data['stok'] = $request->stok;
        $data['deskripsi'] = $request->deskripsi;

        $Menu->update($data);
        return redirect('menu')->with('success', 'Update data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $Menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $Menu)
    {
        if ($Menu->image) {
            Storage::disk('public')->delete('menu-image/' . $Menu->old_image);
        }
        $Menu->delete();
        return redirect('menu')->with('success', 'data berhasil dihapus');
        // try {
        //     DB::beginTransaction();
        //     $Menu->delete();
        //     DB::commit();
        //     return redirect('menu')->with('success', 'data berhasil dihapus');
        // } catch (QueryException | Exception  | PDOException $error) {
        //     DB::rollback();
        //     return redirect('menu')->with("terjadi kesalahan" . $error->getMessage());
        // }
    }
}
