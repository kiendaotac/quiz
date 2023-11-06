<div class="container py-3">
    <header>
        <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
            <h1 class="display-4 fw-normal text-body-emphasis">Bài thi</h1>
            <p class="fs-5 text-body-secondary">Danh sách bài thi</p>
        </div>
    </header>

    <main>
        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
            @foreach($exams ?? [] as $exam)
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">{{ $exam->name }}</h4>
                        </div>
                        <div class="card-body">
                            @if($exam->status == \App\Enums\ExamStatusEnum::COMPLETE)
                                <h1 class="card-title pricing-card-title">Điểm số: {{ $exam->questions->countBy(function ($item) {return $item->answer->correct;})->count() }}<small class="text-body-secondary fw-light">/{{ $exam->questions->count() }}</small></h1>
                            @else
                                <h1 class="card-title pricing-card-title">Điểm số: 0<small class="text-body-secondary fw-light">/{{ $exam->questions->count() }}</small></h1>
                            @endif
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Số câu đã trả lời:{{ $exam->questions->whereNotNull('answer_id')->count() }} <small class="text-body-secondary fw-light">/{{ $exam->questions->count() }}</small></li>
                            </ul>
                            @if(in_array($exam->status, ['ready', 'processing']))
                                <a href="{{ route('quiz', $exam->id) }}" class="w-100 btn btn-lg btn-outline-primary">Làm bài thi</a>
                            @else
                                <div class="w-100 btn btn-lg btn-outline-primary">{{ $exam->status->value() }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</div>