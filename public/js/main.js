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
    // убрать прелоадер по загрузке
    window.addEventListener('load', function() {
        modal.classList.remove('modal-overlay_fill-bg');
        preloader.classList.add('banter-loader_hidden');
        setTimeout(function() {
            nickNameModal.classList.add('modal-window_show');
        }, 800);
    });

    // обработка ввода имени
    nickNameBtn.addEventListener('click', function() {
        if ( nickNameInput.value ) {
            modal.classList.add('modal-overlay_hidden');
            nickNameModal.classList.remove('modal-window_show');
            // инициализация объекта настроек
            gameOptions = new Game();
            gameOptions.startRound();
        } else {
            nickNameInput.classList.add('modal__input_error');
        }
    });

    // ввод после попытки начать без имени
    nickNameInput.addEventListener('keypress', checkNickName);
    nickNameInput.addEventListener('keydown', checkNickName);
    nickNameInput.addEventListener('keyup', checkNickName);
    nickNameInput.addEventListener('change', checkNickName);

    function splitIt (number, separator) {
        number += '';
        separator = ( separator == undefined ) ? ' ' : separator;

        var result = '', arr = [];

        for (var i = 0; i < number.length; i++) {
            arr.push(number[i]);

            if ( (i - number.length) % 3 == 0 && i != 0) {
                arr[i] = separator + arr[i];
            };

            result += arr[i];
        };

        return result;
    }

    function checkNickName() {
        if ( nickNameInput.value ) nickNameInput.classList.remove('modal__input_error');
    }

    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min)) + min;
    }

    function showModal(selector) {
        // body...
    }

    function hideModal(selector) {
        // body...
    }

    function Game() {
        var that = this;

        this.nickName = nickNameInput.value;
        this.timer = 30;
        this.step = 0;
        this.complexity;

        this.stepInc = function() {
            that.step++;

            switch (that.step) {
                case 5:
                    that.bank = progress[4];
                    progressList.children[4].classList.add('millionaire-progress-list__item_block');
                    break;
                case 10:
                    that.bank = progress[9];
                    break;
                case 15:
                    that.bank = progress[14];
                    break;
                default: that.bank = 0;
            }

            function lockBank(index) {
                Array.from(progressList.children).forEach(function(el) {
                    el.classList.remove('millionaire-progress-list__item_block');
                });
                progressList.children[index].classList.add('millionaire-progress-list__item_block');
            }
        };

        this.setStep = function() {
            progressList.children[that.step].classList.add('millionaire-progress-list__item_active');

            if ( progressList.children[that.step - 1] ) {
                progressList.children[that.step - 1].classList.remove('millionaire-progress-list__item_active');
                progressList.children[that.step - 1].classList.add('millionaire-progress-list__item_complete');
            }
        };

        this.getQuestions = function() {
            if ( that.step < 5 )
                that.complexity = 'firstGroupQuest';
            if ( that.step >= 5)
                that.complexity = 'secondGroupQuest';
            if ( that.step >= 10)
                that.complexity = 'thirdGroupQuest';

            that.questions = data[that.complexity];
        };

        this.getQuestion = function() {
            that.currentRound = that.questions.splice(getRandomInt(0, that.questions.length), 1)[0];
        };

        this.setQuestion = function() {
            question.innerText = that.currentRound.question;

            while (answers.children.length) answers.firstElementChild.remove();

            for (let key in that.currentRound.answer) {
                let item = document.createElement('div');
                item.classList.add('millionaire-ui-answers__item', 'ui');
                item.innerText = that.currentRound.answer[key].text;
                item.setAttribute('data-id', `${that.currentRound.id}${key}`);
                answers.appendChild(item);
            }
        };

        this.startRound = function() {
            that.timerStart();

            answers.classList.remove('millionaire-ui-answers_picked');

            that.getQuestions();
            that.getQuestion();
            that.setQuestion();

            console.log(gameOptions.currentRound.answer);
        };

        this.timerStart = function() {
            let counter = that.timer;

            document.querySelector('.millionaire-timer__bg').remove();

            let item = document.createElement('div');
            item.classList.add('millionaire-timer__bg_started', 'millionaire-timer__bg');
            item.style.animationDuration = `${that.timer}s`;
            item.style.animationDelay = `1s`;
            counterWrap.appendChild(item);

            counterText.innerText = counter;
            that.timeout = setTimeout(function countDec() {
                counter--;
                counterText.innerText = counter;
                if (counter) {
                    that.timeout = setTimeout(countDec, 1000);
                } else {
                    that.endGame();
                }
            }, 1000);
        };

        this.timerStop = function() {
            clearTimeout(that.timeout);
            document.querySelector('.millionaire-timer__bg')
                .classList.add('millionaire-timer__bg_paused');
        };

        this.getChoise = function(el) {
            el.classList.add('millionaire-ui-answers__item_picked');
            answers.classList.add('millionaire-ui-answers_picked');
            that.timerStop();

            var id      = el.getAttribute('data-id').slice(-1),
                correct = that.currentRound.answer[id].accept == 'true';

            if ( correct ) setTimeout(that.accept , 1000, el);
            else {
                setTimeout(function() {
                    that.fail(el);
                    that.showCorrect(el);
                }, 1000, el);
            }
        };

        this.accept = function(item) {
            item.classList.add('millionaire-ui-answers__item_accept');
            that.stepInc();
            setTimeout(function (){
                that.setStep();
                that.startRound();
            }, 2000);
        };

        this.fail = function(item) {
            item.classList.add('millionaire-ui-answers__item_fail');
        };

        this.showCorrect = function(item) {
            for (let key in that.currentRound.answer) {
                if ( that.currentRound.answer[key].accept == 'true' ) {
                    document.querySelector(`[data-id="${that.currentRound.id}${key}"]`)
                        .classList.add('millionaire-ui-answers__item_accept');
                    break;
                } else continue;
            }
        };

        this.endGame = function() {
            // body...
        };

        this.hint = {
            half: function() {
                let roll = [];

                for (let key in that.currentRound.answer) {
                    if ( that.currentRound.answer[key].accept == 'false' )
                        roll.push(key);
                }

                roll.splice(getRandomInt(0, roll.length), 1);

                roll.forEach(function(el) {
                    let item = document.querySelector(`[data-id="${that.currentRound.id}${el}"]`);
                    item.classList.add('millionaire-ui-answers__item_lock');
                });
            }
        };

        // отключать подсказку при клике
        for (let i = 0; i < hints.length; i++) {
            hints[i].addEventListener('click', function() {
                this.classList.add('millionaire-hints__hint_disabled');
            });
        }

        half.addEventListener('click', that.hint.half);

        // заполнить список прогресса
        progress.forEach(function(el, i) {
            let item = document.createElement('div');
            item.classList.add('millionaire-progress-list__item');
            item.innerText = `${splitIt(el)}$`;

            progressList.appendChild(item);
        });

        this.setStep();

        // обработчик для ответов
        answers.addEventListener('click', function(e) {
            let picked = event.target.closest('.millionaire-ui-answers__item:not(.millionaire-ui-answers__item_lock)');
            if (!picked) return;
            that.getChoise(picked);
        });
    }

}());