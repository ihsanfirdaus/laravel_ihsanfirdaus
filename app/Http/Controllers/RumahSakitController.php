<?php

namespace App\Http\Controllers;

use App\Models\RumahSakit;
use Illuminate\Http\Request;

class RumahSakitController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = RumahSakit::query();

            if ($request->has('nama') && !empty($request->nama)) {
                $query->where('nama', 'like', '%' . $request->nama . '%');
            }

            if ($request->has('alamat') && !empty($request->alamat)) {
                $query->where('alamat', 'like', '%' . $request->alamat . '%');
            }

            if ($request->has('email') && !empty($request->email)) {
                $query->where('email', 'like', '%' . $request->email . '%');
            }
            
            if ($request->has('nomor_telepon') && !empty($request->nomor_telepon)) {
                $query->where('nomor_telepon', 'like', '%' . $request->nomor_telepon . '%');
            }

            return response()->json([
                'data' => $query->get()
            ]);
        }
        
        $allRumahSakit = RumahSakit::all();

        return view('rumah-sakit.index', [
            'allRumahSakit' => $allRumahSakit
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ], [
            'nama.required' => 'Nama Rumah Sakit tidak boleh kosong',
        ]);

        $model = new RumahSakit();
        $model->nama = $request->post('nama');
        $model->alamat = $request->post('alamat');
        $model->email = $request->post('email');
        $model->nomor_telepon = $request->post('nomor_telepon');
        $model->save();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan.',
            'data' => $model
        ]);
    }

    public function show($id)
    {
        $model = RumahSakit::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $model
        ]);
    }

    public function update(Request $request, $id)
    {
        $model = RumahSakit::findOrFail($id);

        $request->validate([
            'nama' => 'required'
        ], [
            'nama.required' => 'Nama Rumah Sakit tidak boleh kosong',
        ]);

        $model->nama = $request->post('nama');
        $model->alamat = $request->post('alamat');
        $model->email = $request->post('email');
        $model->nomor_telepon = $request->post('nomor_telepon');
        $model->save();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diubah.',
            'data' => $model
        ]);
    }

    public function destroy($id)
    {
        $model = RumahSakit::findOrFail($id);

        $model->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ]);
    }
}
