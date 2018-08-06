<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartamentosController extends Controller
{
    //

    public function index()
    {
        return Response::json(Departamentos::all(), 200);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        $objectSee = Departamentos::find($id);
        if($objectSee){
            return Response::json($objectSee, 200);
        }
        else{
            $returnData = array(
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
        $objectDelete = Departamentos::find($id);
        if($objectDelete){
            try{
                Departamentos::destroy($id);
                return Response::json($objectDelete, 200);
            }
            catch(Exception $e){
                $returnData = array(
                    'status' => 500,
                    'message' => $e->getMessage()
                );
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
