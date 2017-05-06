// Psuedocode:
var index = 0;
//call the function
window.onload = slide();

// function to display the next picture in the array
function slide() {
    //initiative a variable
    var i;
    // reach the php file
    var x = document.getElementsByClassName("picslides");
    //set all pictures display into none (hidden)
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    // increment index
    index++;
    //when index is out of range set it back to 1
    if (index > x.length) {
        index = 1;
    }  
    // always set image of index-1 into display
    x[index-1].style.display = "block";
    // Change image every 2 seconds
    setTimeout(slide, 2000); 
}