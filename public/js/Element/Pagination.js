$(document).ready(function() {
    // page selector click
    $(".pagination > li:not(.active)").click(function() {
        window.location.hash = $(this).children('a').text();
    });
    // first page selector click
    $(".pagination > li:first").click(function() {
        window.location.hash = parseInt($(".pagination > li.active").text()) - 1;
    });
    // last page selector click
    $(".pagination > li:last").click(function() {
        window.location.hash = parseInt($(".pagination > li.active").text()) + 1;
    });
});
