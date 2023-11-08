<?php

namespace App\Livewire;

use App\Models\Exam;
use Livewire\Component;

class Category extends Component
{
    public $exams;

    public \App\Models\Category $category;

    public function mount(\App\Models\Category $category)
    {
        $this->category = $category;
        $this->exams = Exam::where('category_id', $category->id)->get();
    }
    public function render()
    {
        return view('livewire.category');
    }
}
