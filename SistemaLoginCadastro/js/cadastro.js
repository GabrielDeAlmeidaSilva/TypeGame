//pegar os input: nome, senha e c-senha
const name = document.querySelector("#name")
const passsword = document.querySelector("#password")
const c_password = document.querySelector("#c-password")

//pegar os spans
const span_nome = document.querySelector(".e-name")
const span_password = document.querySelector(".e-password")
const span_c_password = document.querySelector(".e-c-password")

//pegar o form
const form = document.querySelector("form")

//funcao top

function limpa_span(element){
    element.textContent = ""
}


//validar
form.addEventListener("submit", (e) => {
    
    //validar se o nome esta vazio
    if (name.value.trim() === ""){
        span_nome.textContent = "Insira um nome (Validação FrontEnd)"
        e.preventDefault()
    } else {
        limpa_span(span_nome)
    }

    //validar se a senha esta vazia
    if(passsword.value.trim() === ""){
        span_password.textContent = "Insira uma senha! (Validação FrontEnd)"
        e.preventDefault()
    } else {
        limpa_span(span_password)
    }

    //validar se a confirmação de senha esta vazia
    if(c_password.value.trim() === ""){
        span_c_password.textContent = "Insira uma senha! (Validação FrontEnd)"
        e.preventDefault()
    } else {
        limpa_span(span_c_password)
    }

    //validar se as senhas não sao iguais

    if(c_password.value.trim() !== passsword.value.trim()){
        span_c_password.textContent = "Senha não confere!"
        e.preventDefault()
    } else if(passsword.value !== ""){
        limpa_span(span_c_password)
    }
})