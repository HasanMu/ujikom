<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\KompetensiKeahlian;

class KompetensiKeahlianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return KompetensiKeahlian::orderBy('created_at', 'desc')->with('bidangstudi')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $custom_message = [
            'required'  => 'Bidang :attribute harus diisi',
            'unique'    => 'Bidang :attribute sudah terdaftar',
        ];

        $this->validate($request, [
            'kode'  => 'required|unique:kompetensi_keahlians',
            'bidang_id' => 'required',
            'nama'  => 'required|unique:kompetensi_keahlians'
        ], $custom_message);

        $kompkeah = new KompetensiKeahlian;

        $kompkeah->kode = $request->kode;
        $kompkeah->bidang_id = $request->bidang_id;
        $kompkeah->nama = $request->nama;
        $kompkeah->save();

        $response = [
            'success'   => true,
            'message'   => 'Data berhasil disimpan!'
        ];

        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $kompkeah = KompetensiKeahlian::findOrFail($id);

        $custom_message = [
            'required'  => 'Bidang :attribute harus diisi',
            'unique'    => 'Bidang :attribute sudah terdaftar',
        ];

        $this->validate($request, [
            'kode'  => 'required|unique:kompetensi_keahlians,kode,'.$kompkeah->id,
            'bidang_id' => 'required',
            'nama'  => 'required|unique:kompetensi_keahlians,nama,'.$kompkeah->id
        ], $custom_message);

        $kompkeah->kode = $request->kode;
        $kompkeah->bidang_id = $request->bidang_id;
        $kompkeah->nama = $request->nama;
        $kompkeah->save();

        $response = [
            'success'   => true,
            'message'   => 'Data berhasil di perbarui!'
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kompkeah = KompetensiKeahlian::findOrFail($id)->delete();

        return ['message' => 'Data berhasil dihapus permanen!'];
    }
}
