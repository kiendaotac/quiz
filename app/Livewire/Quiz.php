<?php

namespace App\Livewire;

use App\Enums\ExamStatusEnum;
use App\Models\Exam;
use Livewire\Component;

class Quiz extends Component
{
    public $exam;
    public $currentQuestion;

    public function mount(Exam $exam)
    {
        if (!in_array($exam->status, [ExamStatusEnum::READY, ExamStatusEnum::PROCESSING]) || $exam->user_id !== auth()->id()) {
            abort(403, 'Bài thi không hợp lệ');
        }
        $this->exam->load(['questions' => function ($query) {
            $query->with(['question' => function ($query) {
                $query->with('answers');
            }]);
        }]);
        $this->currentQuestion = $this->exam->questions->whereNull('answer_id')->first();
        if (!$this->currentQuestion) {
            $exam->update(['status' => ExamStatusEnum::COMPLETE]);
            $this->redirect(route('dashboard'));
        }
    }

    public function render()
    {
        return view('livewire.quiz')->layout('components.layouts.empty');
    }

    public function answer($answerId): void
    {
        $this->currentQuestion->update(['answer_id' => $answerId]);
        $this->updateCurrentQuestion();
    }

    private function updateCurrentQuestion(): void
    {
        $this->currentQuestion = $this->exam->questions->whereNull('answer_id')->first();
        if ($this->currentQuestion) {
            $this->currentQuestion->load(['question' => function ($query) {
                $query->with('answers');
            }]);
        } else {
            $this->exam->update(['status' => ExamStatusEnum::COMPLETE]);
            $this->redirect(route('dashboard'));
        }
    }
}
