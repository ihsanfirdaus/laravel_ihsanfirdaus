<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\RumahSakit;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Pasien::query();

            if ($request->has('nama') && !empty($request->nama)) {
                $query->where('nama', 'like', '%' . $request->nama . '%');
            }
            
            if ($request->has('alamat') && !empty($request->alamat)) {
                $query->where('alamat', 'like', '%' . $request->alamat . '%');
            }
            
            if ($request->has('nomor_telepon') && !empty($request->nomor_telepon)) {
                $query->where('nomor_telepon', 'like', '%' . $request->nomor_telepon . '%');
            }
            
            if ($request->has('id_rumah_sakit') && !empty($request->id_rumah_sakit)) {
                $query->where('id_rumah_sakit', '=', $request->id_rumah_sakit);
            }

            return response()->json([
                'data' => $query->get()
            ]);
        }
        
        $allRumahSakit = RumahSakit::all();

        return view('pasien.index', [
            'allRumahSakit' => $allRumahSakit,
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ], [
            'nama.required' => 'Nama Rumah Sakit tidak boleh kosong',
        ]);

        $model = new Pasien();
        $model->nama = $request->post('nama');
        $model->alamat = $request->post('alamat');
        $model->nomor_telepon = $request->post('nomor_telepon');
        $model->id_rumah_sakit = $request->post('id_rumah_sakit');
        $model->save();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan.',
            'data' => $model
        ]);
    }

    public function show($id)
    {
        $model = Pasien::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $model
        ]);
    }

    public function update(Request $request, $id)
    {
        $model = Pasien::findOrFail($id);

        $request->validate([
            'nama' => 'required'
        ], [
            'nama.required' => 'Nama Rumah Sakit tidak boleh kosong',
        ]);

        $model->nama = $request->post('nama');
        $model->alamat = $request->post('alamat');
        $model->nomor_telepon = $request->post('nomor_telepon');
        $model->id_rumah_sakit = $request->post('id_rumah_sakit');
        $model->save();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diubah.',
            'data' => $model
        ]);
    }

    public function destroy($id)
    {
        $model = Pasien::findOrFail($id);

        $model->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ]);
    }
}
