(function() {
    var modal         = document.querySelector('.modal-overlay'),
        preloader     = document.querySelector('.banter-loader'),
        counterWrap   = document.querySelector('.millionaire-timer'),
        counterText   = document.querySelector('.millionaire-timer__text'),
        nickNameModal = document.querySelector('.modal-window-welcome'),
        nickNameBtn   = document.querySelector('.modal__button'),
        nickNameInput = document.querySelector('.modal__input'),
        progressList  = document.querySelector('.millionaire-progress-list'),
        question      = document.querySelector('.millionaire-ui__question-text'),
        answers       = document.querySelector('.millionaire-ui-answers');

    var hints   = document.querySelectorAll('.millionaire-hints__hint:not(.millionaire-hints__hint_disabled)'),
        half    = document.querySelector('.millionaire-hints__hint-half:not(.millionaire-hints__hint_disabled)'),
        double  = document.querySelector('.millionaire-hints__hint-double:not(.millionaire-hints__hint_disabled)'),
        protect = document.querySelector('.millionaire-hints__hint-protect:not(.millionaire-hints__hint_disabled)');
    window.addEventListener('load', function() {
        modal.classList.remove('modal-overlay_fill-bg');
        preloader.classList.add('banter-loader_hidden');
        setTimeout(function() {
            nickNameModal.classList.add('modal-window_show');
        }, 800);
    });

    nickNameBtn.addEventListener('click', function() {
        if ( nickNameInput.value ) {
            modal.classList.add('modal-overlay_hidden');
            nickNameModal.classList.remove('modal-window_show');
        } else {
            nickNameInput.classList.add('modal__input_error');
        }
    });

    nickNameInput.addEventListener('keypress', checkNickName);
    nickNameInput.addEventListener('keydown', checkNickName);
    nickNameInput.addEventListener('keyup', checkNickName);
    nickNameInput.addEventListener('change', checkNickName);

    function checkNickName() {
        if ( nickNameInput.value ) nickNameInput.classList.remove('modal__input_error');
    }
}());