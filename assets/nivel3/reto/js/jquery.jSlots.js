/*
 * jQuery jSlots Plugin
 * https://github.com/matthewlein/jQuery-jSlots
 * Copyright (c) 2011 Matthew Lein
 * Version: 1.0.2 (7/26/2012)
 * Dual licensed under the MIT and GPL licenses
 * Requires: jQuery v1.4.1 or later
 */
(function ($) {
    $.jSlots = function (el, options) {
        var base = this;
        base.$el = $(el);
        base.el = el;
        base.$el.data('jSlots', base);
        base.init = function () {
            base.options = $.extend({}, $.jSlots.defaultOptions, options);
            base.setup();
            base.bindEvents();
            blockBtns();
        };
        base.arrD = [null, '1111', '2222', '3333', '4444'];
        //base.idR;
        /***********************************************************************/
        function moveUp(id) {
            var top = parseInt($('.slot').eq(id).css('top'), 10);
            var pos = Math.abs(Math.floor(top / base.$liHeight));
            if (pos >= base.liCount) {
                top = 0;
                $('.slot').eq(id).css('top', top);
            }
            var newTop = top - base.$liHeight;
            $('.slot').eq(id).animate({'top': newTop}, 100);

        }
        function moveDown(id) {
            var top = parseInt($('.slot').eq(id).css('top'), 10);
            var pos = Math.abs(Math.floor(top / base.$liHeight));
            if (pos === 0) {
                top = 0 - (base.$liHeight * base.liCount);
                $('.slot').eq(id).css('top', top);
            }
            var newTop = top + base.$liHeight;
            $('.slot').eq(id).animate({'top': newTop}, 100);
        }
        $('.btnUp').click(function () {
            var id = parseInt($(this).attr('id').split('_')[1], 10) - 1;
            moveUp(id);
        });
        $('.btnDown').click(function () {
            var id = parseInt($(this).attr('id').split('_')[1], 10) - 1;
            moveDown(id);
            if (id === 3) {
                moveUp(1);
            }
        });
        // ---------------------------------------------------------------------//
        // DEFAULT OPTIONS
        // ---------------------------------------------------------------------//
        $.jSlots.defaultOptions = {
            number: 3, // Number: number of slots
            winnerNumber: 1, // Number or Array: list item number(s) upon which to trigger a win, 1-based index, NOT ZERO-BASED
            spinner: '', // CSS Selector: element to bind the start event to
            spinEvent: 'click', // String: event to start slots on this event
            onStart: function () { // Function: runs on spin start
                //$J.numJ++;
                CronoReset();
                blockBtns();
                $('#btnPlay').addClass('disable');
                imagenAleatoria();
            },
            onEnd: function (finalNumbers) {// Function: run on spin end. It is passed (finalNumbers:Array). finalNumbers gives the index of the li each slot stopped on in order
                //console.log('finalNumbers: ' + finalNumbers.join('-'));
                unblockBtns();
                intervaloTiempo();
            },
            onWin: $.noop, // Function: run on winning number. It is passed (winCount:Number, winners:Array)
            easing: 'swing', // String: easing type for final spin
            time: 7000, // Number: total time of spin animation
            loops: 6 // Number: times it will spin during the animation
        };
        // --------------------------------------------------------------------- //
        // HELPERS
        // --------------------------------------------------------------------- //
        base.randomRange = function (low, high) {
            return Math.floor(Math.random() * (1 + high - low)) + low;
        };
        // --------------------------------------------------------------------- //
        // VARS
        // --------------------------------------------------------------------- //
        base.isSpinning = false;
        base.spinSpeed = 0;
        base.winCount = 0;
        base.doneCount = 0;
        base.$liHeight = 0;
        base.$liWidth = 0;
        base.winners = [];
        base.allSlots = [];
        // --------------------------------------------------------------------- //
        // FUNCTIONS
        // --------------------------------------------------------------------- //
        base.setup = function () {
            // set sizes
            var $list = base.$el;
            var $li = $list.find('li').first();
            base.$liHeight = $li.outerHeight();
            base.$liWidth = $li.outerWidth();
            base.liCount = base.$el.children().length;
            base.listHeight = base.$liHeight * base.liCount;
            base.increment = (base.options.time / base.options.loops) / base.options.loops;
            $list.css('position', 'relative');
            $li.clone().appendTo($list);
            base.$wrapper = $list.wrap('<div class="jSlots-wrapper"></div>').parent();
            // remove original, so it can be recreated as a Slot
            base.$el.remove();
            // clone lists
            for (var i = base.options.number - 1; i >= 0; i--) {
                base.allSlots.push(new base.Slot(i));
            }
        };
        base.bindEvents = function () {
            $(base.options.spinner).bind(base.options.spinEvent, function (event) {
                if (!base.isSpinning) {
                    base.playSlots();
                }
            });
        };
        // Slot contstructor
        base.Slot = function (i) {
            this.spinSpeed = 0;
            this.el = base.$el.clone().prop({id: 'ruleta' + i}).appendTo(base.$wrapper)[0];
            this.$el = $(this.el);
            this.loopCount = 0;
            this.number = 0;
        };
        base.Slot.prototype = {
            // do one rotation
            spinEm: function () {
                var that = this;
                that.$el.css('top', -base.listHeight).animate({'top': '0px'}, that.spinSpeed, 'linear', function () {
                    that.lowerSpeed();
                });
            },
            lowerSpeed: function () {
                this.spinSpeed += base.increment;
                this.loopCount++;
                if (this.loopCount < base.options.loops) {
                    this.spinEm();
                } else {
                    this.finish();
                }
            },
            // final rotation
            finish: function () {
                var that = this;
                var endNum = base.randomRange(1, base.liCount);
                var finalPos = -((base.$liHeight * endNum) - base.$liHeight);
                var finalSpeed = ((this.spinSpeed * 0.5) * (base.liCount)) / endNum;
                that.$el.css('top', -base.listHeight).animate({'top': finalPos}, finalSpeed, base.options.easing, function () {
                    base.isSpinning = false;
                    base.checkWinner(endNum, that);
                });
            }
        };
        base.checkWinner = function (endNum, slot) {
            base.doneCount++;
            // set the slot number to whatever it ended on
            slot.number = endNum;
            // if its in the winners array
            if (($.isArray(base.options.winnerNumber) && base.options.winnerNumber.indexOf(endNum) > -1) ||
                    endNum === base.options.winnerNumber) {
                // its a winner!
                base.winCount++;
                base.winners.push(slot.$el);
            }
            if (base.doneCount === base.options.number) {

                var finalNumbers = [];
                $.each(base.allSlots, function (index, val) {
                    finalNumbers[index] = val.number;
                });
                if ($.isFunction(base.options.onEnd)) {
                    base.options.onEnd(finalNumbers);
                }
                if (base.winCount && $.isFunction(base.options.onWin)) {
                    base.options.onWin(base.winCount, base.winners, finalNumbers);
                }
                base.isSpinning = false;
            }
        };
        base.playSlots = function () {
            base.isSpinning = true;
            base.winCount = 0;
            base.doneCount = 0;
            base.winners = [];
            if ($.isFunction(base.options.onStart)) {
                base.options.onStart();
            }
            $.each(base.allSlots, function (index, val) {
                this.spinSpeed = 0;
                this.loopCount = 0;
                this.spinEm();
            });
        };
        base.onWin = function () {
            if ($.isFunction(base.options.onWin)) {
                base.options.onWin();
            }
        };
        base.init();
        function imagenAleatoria() {
            //base.idR = $J.numJ;//base.randomRange(1, base.arrD.length - 1);
            $('#slideImagen').css('background-image', 'url(' + odir + '/images/preg/preg' + $J.numJ + '.png)').show();
            $('#rImg1').css('background-image', 'url(' + odir + '/images/r-' + grupo + '/s1_' + $J.numJ + '.png)');
            $('#rImg2').css('background-image', 'url(' + odir + '/images/r-' + grupo + '/s2_' + $J.numJ + '.png)');
            $('#rImg3').css('background-image', 'url(' + odir + '/images/r-' + grupo + '/s3_' + $J.numJ + '.png)');
            $('#rImg4').css('background-image', 'url(' + odir + '/images/r-' + grupo + '/s4_' + $J.numJ + '.png)');
            //console.log('solucion: ' + base.arrD[base.idR]);
        }
        $J.comprobar = function () {
            if ($MuevePlayer) {
                window.cancelAnimationFrame($MuevePlayer);
            }
            $MuevePlayer = 0;
            $('.caratula').stop().fadeOut(300);
            $('#pregWindow').fadeIn(400);
            var arrResp = [];
            for (var i = 0; i < base.options.number; i++) {
                var top = parseInt($('.slot').eq(i).css('top'), 10);
                var pos = Math.abs(Math.floor(top / base.$liHeight));
                arrResp[i] = $('.slot').eq(i).children('li').eq(pos).data('id');
            }
            var resp = base.arrD[$J.numJ].toLowerCase();
            if (arrResp.join('').toLowerCase() === resp) {
                playSound(window.bien);
                aumentaPtos();
                $('#pregBien').stop().delay(300).fadeIn(300);
            } else {
                $J.CTiempo = 0;
                playSound(window.audioCrash);
                $('#pregMal').stop().delay(300).fadeIn(300);
                console.log('Perdiste:' + arrResp.join('').toLowerCase());
            }
        };

    };
    // --------------------------------------------------------------------- //
    // JQUERY FN
    // --------------------------------------------------------------------- //
    $.fn.jSlots = function (options) {
        if (this.length) {
            return this.each(function () {
                (new $.jSlots(this, options));
            });
        }
    };
})(jQuery);