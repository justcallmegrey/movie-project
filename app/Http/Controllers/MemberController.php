<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('movies.index');
    }

    public function datatable()
    {
        $data = Movie::select();

        return \DataTables::of($data)
            ->addColumn('action', function ($data, $action = null) {
                $action .= '<div class="d-flex">';
                if ($data->is_rented == false) {
                    $action .= '<button class="btn-action btn-modal-edit btn btn-primary-custom btn-sm"'
                    . ' data-type="edit"'
                    . ' data-href="'.route('movie.edit', $data->id).'"'
                    . ' >'
                    . ' <img class="small-icon" src="'. asset('img/write.svg') .'" />'
                    . ' </button>';
                }
                if ($data->is_rented == false) {
                    $action .= '<button class="btn-action btn-modal-delete btn btn-danger-custom ml-2 btn-sm"'
                    . ' data-type="delete"'
                    . ' data-href="'.route('movie.delete', $data->id).'"'
                    . ' >'
                    . ' <img class="small-icon" src="'. asset('img/delete.svg') .'" />'
                    . ' </button>';
                }
                $action .= '</div>';
                return $action;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
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

    public function store(Request $request)
    {
        try {
            \DB::beginTransaction();
                $requests = $request->only('title', 'genre', 'released_date');
                $requests['is_rented'] = false;

                $created = Movie::create($requests);
            \DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Movie successfully created'
            ], 200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create movie'
            ], 400);
        }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = Movie::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get data'
            ], 400);
        }
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
        try {
            \DB::beginTransaction();

            $requests = $request->only('title', 'genre', 'released_date');

            $data = Movie::findOrFail($id);
            $data->update($requests);

            \DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Movie successfully updated'
            ], 200);
        } catch (\Exception $e) {
            \DB::rollback();

            return response()->json([
                'success' => true,
                'message' => 'Failed to update movie'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            \DB::beginTransaction();

            $data = Movie::findOrFail($id);
            $data->delete();

            \DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Movie successfully deleted'
            ], 200);
        } catch (\Exception $e) {
            \DB::rollback();

            return response()->json([
                'success' => true,
                'message' => 'Failed to delete movie'
            ], 400);
        }
    }



}
