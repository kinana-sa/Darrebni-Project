<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Collagepicalization;
use App\Http\Resources\TermResource;
use App\Models\Collage;
use App\Models\Question;
use App\Models\Specialization;
use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $new_terms=  Term::where('collage_id',$id)->get();
      if($new_terms){return $this->successResponse(TermResource::collection($new_terms),'This All terms',200);
      }else{
        return $this->errorResponse('error');
      }

    }
    public function termspcialization($id){
        $questions = Question::all();


$final_questions=$questions->where('specialization_id',$id);
             // Access the terms through the collage
            // Do something with $terms

       return $this->successResponse(Collagepicalization::collection($final_questions));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
