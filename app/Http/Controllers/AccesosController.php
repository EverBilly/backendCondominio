<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Htpp\Requests;
use App\Accesos;
use App\Modulos;
use Response;
use DB;
use Validator;

class AccesosController extends Controller
{
    //
    public function index()
    {
        return Response::json(Accesos::all(),200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'usuario'       => 'required',
            'modulo'        => 'required',
        ]);
        if($validator->fails()){
            $returnData = array(
                'status'    => 400,
                'message'   => 'Invalid Parameters',
                'validator' => $validator
            );
            return Response::json($returnData,400);
        }
        else {
            $objectUpdate = Accesos::whereRaw('modulo=? and usuario=?',[$request->get('modulo'),$request->get('usuario')])->first();
            if($objectUpdate){
                try{

                    $objectUpdate->agregar          = $reques->get('agregar', $objectUpdate->agregar);
                    $objectUpdate->eliminar         = $reques->get('eliminar', $objectUpdate->eliminar);
                    $objectUpdate->modificar        = $reques->get('modificar', $objectUpdate->modificar);
                    $objectUpdate->mostrar          = $reques->get('mostrar', $objectUpdate->mostrar);
                    $objectUpdate->save();
                    if($objectUpdate->agregar==0 && $objectUpdate->eliminar==0 && $objectUpdate->modificar==0 && $objectUpdate->mostrar==0){
                        $objectDelete = Accesos::find($objectUpdate->id);
                        if($objectDelete){
                            try{
                                Accesos::destroy($objectUpdate->id);
                                return Response::json($objectDelete,200);
                            }
                            catch(Exception $e){
                                $returnData = array(
                                    'status' =>500,
                                    'message' => $e->getMessage()
                                );
                                return Response::json($returnData, 500);
                            }
                        }
                        else {
                            $returnData = array(
                                'status' => 404,
                                'message' => 'No record found'
                            );
                            return Response::json($returnData, 404);
                        }
                    }
                    return Response::json($objectUpdate, 200);
                }
                catch(Exception $e)
                {
                    $returnData = array(
                        'status' => 500,
                        'message' => $e->getMessage()
                    );
                    return response::json($returnData, 500);
                }
            }
            else {
                try{
                    $newObject = new Accesos();
                    $newObject->agregar                     =$request->get('agregar',0);
                    $newObject->eliminar                    =$request->get('eliminar',0);
                    $newObject->modificar                   =$request->get('modificar',0);
                    $newObject->mostrar                     =$request->get('mostrar',0);
                    $newObject->usuario                     =$request->get('usuario',0);
                    $newObject->modulo                      =$request->get('modulo',0);
                    $newObject->save();
                    return Response::json($newObject, 200);
                }
                catch (\Illuminate\Database\QueryException $e) {
                    if($e->errorInfo[0] == '01000'){
                        $errorMessage = "Error Constraint";
                    }  else {
                        $errorMessage = $e->getMessage();
                    }
                    $returnData = array (
                        'status' => 505,
                        'SQLState' => $e->errorInfo[0],
                        'message' => $errorMessage
                    );
                    return Response::json($returnData, 500);
                } catch (Exception $e) {
                    $returnData = array (
                        'status' => 500,
                        'message' => $e->getMessage()
                    );
                    return Response::json($returnData, 500);
            }
        }
    }
}

public function show($id)
{
    $objectSee = Accesos::find($id);
    if($objectSee){
        return Response::json($objectSee, 200);
    }
    else{
        $returnData = array(
            'status' => 404,
            'message' => 'No Record found'
        );
        return Response::json($returnData, 404);
    }
}

    public function getAccesos($id)
    {
        	//Falta Realizar los Accesos para cada uno de los Roles
    }

    public function getAcceso($id, $id2)
    {
        $objectSee = Accesos::where('modulo','=',$id2)->where('usuario','=',$id)->first();
        if ($objectSee) {
            
            return Response::json($objectSee, 200);
        
        }
        else {
            $returnData = array (
                'status' => 404,
                'message' => 'No record found'
            );
            return Response::json($returnData, 404);
        }
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $objectDelete = Accesos::find($id);
        if($objectDelete){
            try{
                Accesos::destroy($id);
                return Response::json($objectSee, 200);
            }
            catch(Exception $e)
            {
                $returnData = array(
                    'status' => 500,
                    'message' => $e->getMessage()
                );
                return Response::json($returnData, 500);
            }
        }
        else{
            $returnData = array(
                'status' => 404,
                'message' => 'No record found'
            );
            return Response::json($returnData, 404);
        }
    }
}