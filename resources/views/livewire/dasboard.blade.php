{{--
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
                            @if(in_array($exam->status, [\App\Enums\ExamStatusEnum::READY, \App\Enums\ExamStatusEnum::PROCESSING]))
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
</div>--}}
    <div class="d-flex flex-column flex-lg-row" id="kt_docs_content_container">
        <!--begin::Card-->
        <div class="card card-docs flex-row-fluid mb-2" id="kt_docs_content_card">
            <!--begin::Card Body-->
            <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">


                <!--begin::Section-->
                <div class="px-md-10 pt-md-10 pb-md-5">
                    <!--begin::Block-->
                    <div class="text-center mb-20">
                        <h1 class="fs-2tx fw-bold mb-8">
                            <span class="d-inline-block position-relative ms-2">
                                <span class="d-inline-block mb-2">Dashboard</span>
                                <span class="d-inline-block position-absolute h-8px bottom-0 end-0 start-0 bg-success translate rounded"></span>
                            </span>
                        </h1>

                        <div class="fw-semibold fs-2 text-gray-500 mb-10">
                            Cuộc thi lịch sử
                        </div>
                    </div>
                    <!--end::Block-->
                </div>
                <!--end::Section-->
            </div>
            <!--end::Card Body-->
        </div>
        <!--end::Card-->
    </div>