<?php

namespace App\Http\Controllers\Api;

use App\Models\Answer;
use App\Models\Question;
use App\Http\Controllers\Controller;
use App\Http\Requests\AnswerRequest;
use App\Http\Resources\AnswerResource;
use App\Http\Controllers\Api\Traits\ApiResponse;

class AnswerController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $answers = Answer::all();

        return $this->successResponse(AnswerResource::collection($answers), "Show All Answers", 200);
    }

    public function store(AnswerRequest $request)
    {
        $question_id = Question::where('uuid', $request->question_id)->first()->id;

        $answer = Answer::create([
            'content' => $request->content,
            'is_correct' => $request->is_correct,
            'question_id' => $question_id
        ]);
        return $this->successResponse(new AnswerResource($answer), "New Answer Created Successfully", 201);
    }

    public function show(Answer $answer)
    {
        return $this->successResponse(new AnswerResource($answer), "Show Answer Successfully", 200);
    }
    public function update(AnswerRequest $request, Answer $answer)
    {
        $question_id = Question::where('uuid', $request->question_id)->first()->id;

        $answer->update([
            'content' => $request->content,
            'is_correct' => $request->is_correct,
            'question_id' => $question_id
        ]);
        return $this->successResponse(new AnswerResource($answer), "Answer Updated Successfully", 200);
    }
    public function destroy(Answer $answer)
    {
        $answer->delete();

        return $this->successResponse(null, "Answer Deleted Successfully", 200);
    }
}