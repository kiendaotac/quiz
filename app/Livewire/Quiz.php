<?php

namespace App\Livewire;

use App\Models\Exam;
use Livewire\Component;

class Quiz extends Component
{
    public $exam;
    public $currentQuestion;

    public function mount()
    {
        $examProcessing = Exam::where('user_id', auth()->id())->whereStatus('processing')->first();
        if (!$examProcessing) {
            $examReady = Exam::where('user_id', auth()->id())->whereStatus('ready')->first();
            if (!$examReady) {
                abort(403, 'Bạn đang không có bài thi nào để thi');
            }
            $examReady->update(['status' => 'processing']);
            $this->exam = $examReady;
        } else {
            $this->exam = $examProcessing;
        }
        $this->exam->load(['questions' => function($query) {
            $query->with(['question' => function($query) {
                $query->with('answers');
            }]);
        }]);
        $this->currentQuestion = $this->exam->questions->whereNull('answer_id')->first();
    }
    public function render()
    {
        return view('livewire.quiz');
    }
}
