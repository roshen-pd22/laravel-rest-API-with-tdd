<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PosTransaction;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\ProductResource;
use Validator;

class PosTransactionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posTransaction = PosTransaction::all();
        return response(['posTransaction' => ProductResource::collection($posTransaction)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'id_transazione' => 'required',
            'num_tessera' => 'required',
            'circuito' => 'required',
            'progressivo_tessera' => 'required',
            'saldo_punti' => 'required',
            'importo_transazione' => 'required',
            'tipo_transazione' => 'required',
            'pos1' => 'required',
            'pos1_saldo_euro' => 'required',
            'pos2' => 'required',
            'pos2_saldo_euro' => 'required',
            'pos3' => 'required',
            'pos3_saldo_euro' => 'required',
            'pos4' => 'required',
            'pos4_saldo_euro' => 'required',
            'pos5' => 'required',
            'pos5_saldo_euro' => 'required',
            'giorno' => 'required|integer|digits:2',
            'mese' => 'required|integer|digits:2',
            'anno' => 'required|integer|digits:4',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error', ['error'=>$validator->errors()]);
        }

        $posTransaction = PosTransaction::create($data);

        return response(['posTransaction' => new ProductResource($posTransaction), 'message' => 'PosTransaction created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PosTransaction $posTransaction)
    {
        return response(['product' => new ProductResource($posTransaction)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosTransaction $posTransaction)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'id_transazione' => 'required',
            'num_tessera' => 'required',
            'circuito' => 'required',
            'progressivo_tessera' => 'required',
            'saldo_punti' => 'required',
            'importo_transazione' => 'required',
            'tipo_transazione' => 'required',
            'pos1' => 'required',
            'pos1_saldo_euro' => 'required',
            'pos2' => 'required',
            'pos2_saldo_euro' => 'required',
            'pos3' => 'required',
            'pos3_saldo_euro' => 'required',
            'pos4' => 'required',
            'pos4_saldo_euro' => 'required',
            'pos5' => 'required',
            'pos5_saldo_euro' => 'required',
            'giorno' => 'required|integer|digits:2',
            'mese' => 'required|integer|digits:2',
            'anno' => 'required|integer|digits:4',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $posTransaction->update($data);

        return response(['posTransaction' => new ProductResource($posTransaction), 'message' => 'PosTransaction updated successfully']);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosTransaction $posTransaction)
    {
        $posTransaction->delete();

        return response(['message' => 'PosTransaction deleted successfully']);
    }
}
