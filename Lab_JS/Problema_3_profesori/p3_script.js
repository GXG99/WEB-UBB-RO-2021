let carti = document.querySelectorAll('.carte');

let carteIntoarsa = false;
let inchide = false;
let carteUnu, carteDoi;


function checkEnd() {
    let counter = 0;
    carti.forEach(carte => {
       if(carte.classList.contains('flip')) counter++;
    });
    console.log(counter);
    if (counter === 12) {
        return true;
    } else {
        return false;
    }
}

function intoarce() {
    if (inchide) return;
    if (this === carteUnu) return;
    this.classList.add('flip');

    if (!carteIntoarsa) {
        carteIntoarsa = true;
        carteUnu = this;
    } else {
        carteIntoarsa = false;
        carteDoi = this;

        if (carteUnu.dataset.number === carteDoi.dataset.number) {
            carteUnu.removeEventListener('click', intoarce);
            carteDoi.removeEventListener('click', intoarce);
            [carteIntoarsa, inchide] = [false, false];
            [carteUnu, carteDoi] = [null, null];
        } else {
            inchide = true;
            setTimeout(() => {
                carteUnu.classList.remove('flip');
                carteDoi.classList.remove('flip');
                [carteIntoarsa, inchide] = [false, false];
                [carteUnu, carteDoi] = [null, null];
            }, 1500);
        }
    }
    if(checkEnd() === true) {
        alert("Bravo!");
    }
}

(function amestec() {
    carti.forEach(carte => {
        carte.style.order = Math.floor(Math.random() * 12);
    });
})();

carti.forEach(carte => carte.addEventListener('click', intoarce));