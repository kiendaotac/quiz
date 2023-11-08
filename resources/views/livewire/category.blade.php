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
                        Danh sách các bài thi
                        <span class="d-inline-block position-relative ms-2">
                                <span class="d-inline-block mb-2">{{ $category->name }}</span>
                                <span class="d-inline-block position-absolute h-8px bottom-0 end-0 start-0 bg-success translate rounded"></span>
                            </span>
                    </h1>

                    <div class="fw-semibold fs-2 text-gray-500 mb-10">
                        {!! $category->description !!}
                    </div>
                </div>
                <!--end::Block-->
                <!--begin::Row-->
                <div class="row g-0">
                    @foreach($exams ?? [] as $exam)
                        <!--begin::Col-->
                        <div class="col-md-6 mb-10">
                            <div class="bg-light bg-opacity-50 rounded-3 p-10 mx-md-5 h-md-100">

                                <div class="d-flex flex-center w-60px h-60px rounded-3 bg-light-success bg-opacity-90 mb-10">
                                    <i class="ki-duotone ki-design text-success fs-3x"><span class="path1"></span><span class="path2"></span></i>                </div>

                                <h1 class="mb-5">{{ $exam->name }}</h1>

                                @if($exam->status == \App\Enums\ExamStatusEnum::COMPLETE)
                                    <div class="fs-4 text-gray-600 py-3">
                                        Điểm số: {{ $exam->questions->countBy(function ($item) {return $item->answer->correct;})->count() }}<small class="text-body-secondary fw-light">/{{ $exam->questions->count() }}</small>
                                    </div>
                                @else
                                    <div class="fs-4 text-gray-600 py-3">
                                        Điểm số: 0<small class="text-body-secondary fw-light">/{{ $exam->questions->count() }}</small>
                                    </div>
                                @endif
                                <div class="fs-4 text-gray-600 py-3">
                                    Số câu đã trả lời: {{ $exam->questions->whereNotNull('answer_id')->count() }}<small class="text-body-secondary fw-light">/{{ $exam->questions->count() }}</small>
                                </div>
                                @if(in_array($exam->status, [\App\Enums\ExamStatusEnum::READY, \App\Enums\ExamStatusEnum::PROCESSING]))
                                    <a href="{{ route('quiz', $exam->id) }}" class="btn btn-lg btn-flex btn-link btn-color-success">
                                        Làm bài thi
                                        <i class="ki-duotone ki-arrow-right ms-2 fs-3"><span class="path1"></span><span class="path2"></span></i>
                                    </a>
                                @else
                                    <span href="{{ route('quiz', $exam->id) }}" class="btn btn-lg btn-flex btn-link btn-color-success">
                                        {{ $exam->status->value() }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!--end::Col-->
                    @endforeach
                </div>
                <!--end::Row-->
            </div>
            <!--end::Section-->        </div>
        <!--end::Card Body-->
    </div>
    <!--end::Card-->

</div>