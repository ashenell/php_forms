function charcountupdate(str) {
    let count = str.length; //How many characters on name field
    if(count <= 20) {
        document.getElementById("info").innerText = count + " letters from 20";
    } else {
        document.getElementById("name").value = str.substring(0, 20); //20 first caharcters
    }
}