document.querySelector("form").addEventListener("submit", (e) => {
    //puxar nome
    const name = document.getElementById("name")
    const password = document.getElementById("password")

    //colocar valores
    nameV = name.value
    passwordV = password.value

    //puxar spans
    const spanname = document.querySelector(".name-span")
    const spanpassword = document.querySelector(".password-span")

    //verificar nome vazio
    if(nameV === ""){
        spanname.innerHTML = "Insira um nome!";
        e.preventDefault()
    } else {
        spanname.innerHTML = ""
    }

    //verificar senha vazia
    if(passwordV === ""){
        spanpassword.innerHTML = "Insira uma senha!"
        e.preventDefault()
    } else {
        spanpassword.innerHTML = ""
    }
});


document.querySelector("img").addEventListener("click", (e) => {
    document.querySelector("span").textContent = "Quack!"

    setTimeout(() => {
        document.querySelector("span").textContent = ""
    }, 1000)
})