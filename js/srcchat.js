function generateResponse() {
    var text = document.getElementById("text");
    var response = document.getElementById("response");
    fetch("api.php", {
        method: "POST",
        body: JSON.stringify({
            text: text.value
        }),
    })
    .then((res) => res.text())
    .then((res) => {
        response.innerHTML = res;
    });
}