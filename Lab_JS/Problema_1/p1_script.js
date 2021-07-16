document.getElementById('good_games').ondblclick = function myFunction() {
    var selectedOption = this.options[this.selectedIndex];
    var select = document.getElementById('bg');
    select.appendChild(selectedOption);
}

document.getElementById('bad_games').ondblclick = function myFunction() {
    var selectedOption = this.options[this.selectedIndex];
    var select = document.getElementById('gg');
    select.appendChild(selectedOption);
}