
function myFunction(x) {
    if (x.matches) { // If media query matches
        num = 2;
    } else {
       num = 8;
    }
}

var x = window.matchMedia("(max-width: 700px)")
myFunction(x) // Call listener function at run time
x.addListener(myFunction) // Attach listener function on state changes

        timeline(document.querySelectorAll('.timeline'), {
            forceVerticalMode: 100,
            mode: 'horizontal',
            verticalStartPosition: 'left',
            visibleItems: num
        });
