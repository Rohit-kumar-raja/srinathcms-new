//  var type= document.getElementById('type').value
//  var board= document.getElementById('board').value
//  console.log(board)
// // if(type=="school"){
// //     document.getElementById('board').style.display = 'block'
// //     document.getElementById('affiliated').style.display = 'none'
// //     document.getElementById('board_name').style.display = 'none'
// // }



// // if(board=="others"){
// //     document.getElementById('board').style.display = 'block'
// //     document.getElementById('affiliated').style.display = 'none'
// //     document.getElementById('board_name').style.display = 'block'
// // }





function change(name) {
    console.log(name)
    if (name == "university") {
        document.getElementById('affiliated').style.display = 'none'
        document.getElementById('board').style.display = 'none'
        document.getElementById('board_name').style.display = 'none'
    } else if (name == 'school') {
        document.getElementById('board').style.display = 'block'
        document.getElementById('affiliated').style.display = 'none'
        document.getElementById('board_name').style.display = 'none'
    } else {
        document.getElementById('affiliated').style.display = 'block'
        document.getElementById('board').style.display = 'none'
        document.getElementById('board_name').style.display = 'none'
    }
}

function change_board(board) {
    if (board == 'others') {
        document.getElementById('board_name').style.display = 'block'
    } else {
        document.getElementById('board_name').style.display = 'none'
    }
}


// event = "18";
// var xhttp = new XMLHttpRequest();
// xhttp.onload = function () {
//     document.getElementById('all_data').innerHTML = xhttp.responseText;
// }
// xhttp.open("GET", "./asset/ajax/ajax.php?event=" + event, true);
// xhttp.send();




function pin(pincode) {
    if (pincode.length == 6) {
        var xhttp = new XMLHttpRequest();
        xhttp.onload = function () {

            var string = xhttp.responseText
            var array = string.split(",").map(String);
            console.log(array);
            document.getElementById('state').value = array[2]
            document.getElementById('city').value = array[1]
            document.getElementById('district').value = array[4]
            document.getElementById('country').value = array[3]
        }
        xhttp.open("GET", "./asset/ajax/pincode.php?code=" + pincode, true);
        xhttp.send();

    }
}