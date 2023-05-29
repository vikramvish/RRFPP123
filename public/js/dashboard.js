// function myFunction() {
//     alert("I am an alert box!");
// }



$("#showPopUp").ready(function() {
    var popUpList = $(
        '<div><input type="radio">A<br><input type="radio">B</div>'
    );

    $('#showPopUp').on('click', function() {
        popUpList.dialog();
    });
});

// js for loader


$(window).load(function() {
    $('#loading').hide();
});