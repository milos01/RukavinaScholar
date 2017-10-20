<?php

namespace App\Http\Transformers;

use App\Problem;
use League\Fractal\TransformerAbstract;
use App\Helpers\Hasher;

class ProblemTransformer extends TransformerAbstract
{
	public function transform(Problem $problem)
	{
	    return [
	        'id' => Hasher::encode($problem->id),
	        'subject' => $problem->subject,
	        'person_from' => $problem->person_from,
	        'main_slovler' => $problem->main_slovler,
	        'problem_type' => $problem->problem_type,
	        'problem_description' => $problem->problem_description,
	        'sol_description' => $problem->sol_description,
	        'took' => $problem->took,
	        'waiting' => $problem->waiting,
	        'time_ends_at' => $problem->time_ends_at,
	        'created_at' => $problem->created_at,
	        'offers' => $problem->offers,
	        'user_from' => $problem->user_from,
	        'task_type' => $problem->task_type,
	    ];
	}
}