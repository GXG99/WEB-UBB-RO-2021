$('#good_games').dblclick(function () {
    $('#bg').append(this.options[this.selectedIndex]);
});
$('#bad_games').dblclick(function () {
    $('#gg').append(this.options[this.selectedIndex]);
})