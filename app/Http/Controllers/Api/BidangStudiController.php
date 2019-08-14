<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BidangStudiResource;
use App\BidangStudi;

class BidangStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bidang_studi = BidangStudi::orderBy('created_at', 'desc')->paginate(5);

        return BidangStudiResource::collection($bidang_studi);
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
            'unique'    => 'Bidang :attribute sudah terdaftar'
        ];

        $this->validate($request, [
            'kode'  => 'required|unique:bidang_studis',
            'nama'  => 'required'
        ], $custom_message);

        $bidang_studi = new BidangStudi;

        $bidang_studi->kode = $request->kode;
        $bidang_studi->nama = $request->nama;
        $bidang_studi->save();

        $response = [
            'success'   => true,
            'message'   => 'Data berhasil di simpan!'
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
        $bidang_studi = BidangStudi::findOrFail($id);

        $bidang_studi->kode = $request->kode;
        $bidang_studi->nama = $request->nama;
        $bidang_studi->save();

        $response = [
            'success'   => true,
            'message'   => 'Data berhasil di ubah!'
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
        $bidang_studi = BidangStudi::findOrFail($id)->delete();

        return ['message' => 'Berhasil masuk method destroy!'];
    }
}
