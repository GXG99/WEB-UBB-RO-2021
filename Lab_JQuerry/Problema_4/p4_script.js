$('.header').on('click', function () {
    var rows;
    var table = $('#table')[0];
    var ok = true;
    let pos = this.cellIndex;
    while (ok) {
        ok = false;
        rows = $(table).find('tr');
        for (var i = 1; i < (rows.length - 1); i++) {

            let elem1 = rows[i].getElementsByTagName("td")[pos].innerHTML;
            console.log(elem1);
            let elem2 = rows[i + 1].getElementsByTagName("td")[pos].innerHTML;

            if (!isNaN(elem1)) {
                if (Number(elem1) > Number(elem2)) {
                    $(rows[i + 1]).after(rows[i]);
                    ok = true;
                }
            } else {
                if (String(elem1) > String(elem2)) {
                    $(rows[i + 1]).after(rows[i]);
                    ok = true;
                }
            }
        }
    }
});


