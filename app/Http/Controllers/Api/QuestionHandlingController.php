<?php

namespace App\Http\Controllers\Api;

use App\Models\Term;
use App\Models\Collage;
use App\Models\Question;
use App\Models\Specialization;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuestionAnswerResource;
use App\Http\Controllers\Api\Traits\ApiResponse;
use App\Http\Requests\QuestionsCorrectionRequest;
use App\Http\Resources\AnswerResource;
use App\Models\Answer;

class QuestionHandlingController extends Controller
{
    use ApiResponse;
    public function spcializationTermQuestions(Specialization $specialization)
    {
        //get  all questions of all terms of specific specialization
        $questions = $specialization->questions()->whereNotNull('term_id')
            ->inRandomOrder()
            ->limit(50)
            ->get();

        return $this->successResponse(QuestionAnswerResource::collection($questions), 'Questions of All Terms');
    }

    public function spcializationBookQuestions(Specialization $specialization)
    {
        //get  book questions of specific specialization

        $questions = $specialization->questions()->whereNull('term_id')
            ->inRandomOrder()
            ->limit(50)
            ->get();

        return $this->successResponse(QuestionAnswerResource::collection($questions), 'Questions of Specialization');
    }

    public function getTermQuestions(Term $term)
    {
        //get  all questions of specific term

        $questions = $term->questions()->get();

        return $this->successResponse(QuestionAnswerResource::collection($questions), 'Questions of Term');
    }

    public function getTestQuestions(Collage $collage)
    {
        //get 50 random questions
        $questionRand = $collage->questions()
            ->inRandomOrder()
            ->limit(50)
            ->get();

        return $this->successResponse(QuestionAnswerResource::collection($questionRand), "Show 50 Random Questions");
    }

    public function questionsCorrection(QuestionsCorrectionRequest $request)
    {
        $count = 0;
        $wrong_qusetions = [];
        foreach ($request['questions'] as $question_data) {

            $question = Question::where('uuid', $question_data['id'])->first();

            $answer = Answer::where('uuid', $question_data['answer'])->first();

            $correct_answer = $question->answers->where('is_correct', true)->first();

            if ($answer->id === $correct_answer->id) {
                $count++;
            }
            else{
                $wrong_qusetions[]['worng_question'] = new QuestionResource($question);
                $wrong_qusetions[]['your_answer'] = new AnswerResource($answer);
                $wrong_qusetions[]['correct_answer'] = new AnswerResource($correct_answer);
            }
        }

        $data = ['Your Mark Is ' => (2 * $count), 'Count of Correct Answers' => $count];

        return $this->successResponse([$data,$wrong_qusetions], "Show The Mark of Test.");
    }
}