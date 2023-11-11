<div class="millionaire-wrap container">
    <div class="millionaire">
        <div class="millionaire-overlay" style="background-image: url('https://quiz.kiendaotac.com/images/img.png');"></div>
        <div class="millionaire-ui">
            <div class="millionaire-top ui">
                <div class="millionaire-hints">
                    <div class="millionaire-hints__item millionaire-hints__hint millionaire-hints__hint-half"><i class="fas fa-balance-scale"></i></div>
                    <!-- <div class="millionaire-hints__item millionaire-hints__hint millionaire-hints__hint_disabled"><i class="fas fa-balance-scale"></i></div> -->
                    <div class="millionaire-hints__item millionaire-hints__hint millionaire-hints__hint-double"><i class="fas fa-check-double"></i></div>
                    <div class="millionaire-hints__item millionaire-hints__hint millionaire-hints__hint-protect"><i class="fas fa-shield-alt"></i></div>
                </div>
                <div class="millionaire-timer">
                    <div class="millionaire-timer__text">30</div>
                    <div class="millionaire-timer__bg"></div>
                </div>
                <div class="millionaire-hints__item millionaire-end-game"><i class="fas fa-hand-holding-usd"></i></div>
            </div>
            <div class="millionaire-ui__question ui">
                <div class="millionaire-ui__question-text">
                    {!! $currentQuestion->question->content !!}
                </div>
            </div>
            <!-- <div class="millionaire-ui-answers millionaire-ui-answers_picked"> -->
            <div class="millionaire-ui-answers">
                @foreach($currentQuestion->question->answers ?? [] as $answer)
                    <div wire:click.prevent="answer({{ $answer->id }})" class="millionaire-ui-answers__item ui">{!! $answer->content !!}</div>
                @endforeach
                <!-- <div class="millionaire-ui-answers__item ui">One</div>
                <div class="millionaire-ui-answers__item millionaire-ui-answers__item_picked ui">Two</div>
                <div class="millionaire-ui-answers__item millionaire-ui-answers__item_fail ui">Three</div>
                <div class="millionaire-ui-answers__item millionaire-ui-answers__item_accept ui">Four</div> -->
            </div>
        </div>
        <div class="millionaire-progress ui">
            <div class="millionaire-progress-header">Danh sách câu hỏi:</div>
            <div class="millionaire-progress-list">
                @foreach($exam->questions as $question)
                    <div class="millionaire-progress-list__item @if($question->answer_id) millionaire-progress-list__item_complete @endif @if($question->id == $currentQuestion->id) millionaire-progress-list__item_active @endif">Câu {{ $loop->iteration }}</div>
                @endforeach
                <!-- <div class="millionaire-progress-list__item">100</div>
                <div class="millionaire-progress-list__item">200</div>
                <div class="millionaire-progress-list__item">300</div>
                <div class="millionaire-progress-list__item">500</div>
                <div class="millionaire-progress-list__item">1 000</div>
                <div class="millionaire-progress-list__item">2 000</div>
                <div class="millionaire-progress-list__item">4 000</div>
                <div class="millionaire-progress-list__item">8 000</div>
                <div class="millionaire-progress-list__item">16 000</div>
                <div class="millionaire-progress-list__item">32 000</div>
                <div class="millionaire-progress-list__item">64 000</div>
                <div class="millionaire-progress-list__item">125 000</div>
                <div class="millionaire-progress-list__item millionaire-progress-list__item_active">250 000</div>
                <div class="millionaire-progress-list__item millionaire-progress-list__item_complete">500 000</div>
                <div class="millionaire-progress-list__item millionaire-progress-list__item_complete">1 000 000</div> -->
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal-overlay modal-overlay_fill-bg">
        <div class="modal-window modal-window-welcome ui">
            <div class="modal-window-welcome__col">
                <div class="modal-window-welcome__item">
                    <h2 class="modal__title">Sự trợ giúp:</h2>
                    <div class="modal-hint-list">
                        <div class="modal-hint-item">
                            <i class="modal-hint-item__icon fas fa-balance-scale"></i>
                            <div class="modal-hint-item__info">
                                <h3 class="modal-hint-item__title">50 : 50</h3>
                                <div class="modal-hint-item__descr">Loại bỏ hai câu trả lời sai</div>
                            </div>
                        </div>
                        <div class="modal-hint-item">
                            <i class="modal-hint-item__icon fas fa-check-double"></i>
                            <div class="modal-hint-item__info">
                                <h3 class="modal-hint-item__title">Nhân đôi cơ hội</h3>
                                <div class="modal-hint-item__descr">Cho bạn cơ hội chọn hai phương án trả lời, nếu một trong số đó đúng, chúc bạn may mắn :)</div>
                            </div>
                        </div>
                        <div class="modal-hint-item">
                            <i class="modal-hint-item__icon fas fa-shield-alt"></i>
                            <div class="modal-hint-item__info">
                                <h3 class="modal-hint-item__title">Bảo hiểm</h3>
                                <div class="modal-hint-item__descr">Tạo cơ hội mắc lỗi, nếu bạn trả lời sai, trò chơi sẽ không kết thúc, tiền thắng vẫn giữ nguyên và bạn sẽ được trả lời một câu hỏi khác.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-window-welcome__col">
                <div class="modal-window-welcome__item">
                    <h2 class="modal__title">Quy tắc:</h2>
                    <div class="modal-window-welcome__rules">Bạn cần phải trả lời chính xác câu hỏi. Mỗi câu hỏi có thời gian 30 giây. Mỗi câu hỏi thứ năm bạn nhận được một "số tiền chống cháy", đây là số tiền bạn nhận được nếu thua. Hoặc bất cứ lúc nào bạn có thể lấy đi những gì bạn hiện có bằng cách sử dụng chìa khóa
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                </div>
                <div class="modal-window-welcome__item">
                    <input value="Bông ngoáy tai" type="text" autofocus class="modal__input ui" placeholder="Nhập tên của bạn">
                    <button class="modal__button modal-window-welcome__btn ui">Bắt đầu trò chơi</button>
                </div>
            </div>
        </div>

        <div class="banter-loader">
            <div class="banter-loader__box"></div>
            <div class="banter-loader__box"></div>
            <div class="banter-loader__box"></div>
            <div class="banter-loader__box"></div>
            <div class="banter-loader__box"></div>
            <div class="banter-loader__box"></div>
            <div class="banter-loader__box"></div>
            <div class="banter-loader__box"></div>
            <div class="banter-loader__box"></div>
        </div>
    </div>
</div>