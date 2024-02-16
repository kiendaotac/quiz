<?php

namespace App\Livewire;

use App\Models\Exam;
use Livewire\Component;

class Dasboard extends Component
{
    public $exams;

    public function mount()
    {
        $this->exams = Exam::where('user_id', auth()->id())
            ->with('questions.answer')
            ->get();
    }

    public function render()
    {
        return view('livewire.dasboard');
    }
}
