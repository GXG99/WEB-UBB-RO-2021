let carteIntoarsa = false;
let inchide = false;
let carteUnu, carteDoi;

$('.carte').on('click', function () {
    if (inchide) return;
    if (this === carteUnu) return;
    $(this).addClass('flip');

    if (!carteIntoarsa) {
        carteIntoarsa = true;
        carteUnu = this;
    } else {
        carteIntoarsa = false;
        carteDoi = this;
        if (carteUnu.dataset.number === carteDoi.dataset.number) {
            $(carteUnu).off('click');
            $(carteDoi).off('click');
            [carteIntoarsa, inchide] = [false, false];
            [carteUnu, carteDoi] = [null, null];
        } else {
            inchide = true;
            setTimeout(() => {
                $(carteUnu).removeClass('flip');
                $(carteDoi).removeClass('flip');
                [carteIntoarsa, inchide] = [false, false];
                [carteUnu, carteDoi] = [null, null];
            }, 1500);
        }
    }
});

$('.carte').each(function () {
    $(this).css('order', Math.floor(Math.random() * 12));
});