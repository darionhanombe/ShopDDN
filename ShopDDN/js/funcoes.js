function aparecer() { //Barra de Navegacao aparece
    document.getElementById("navbarHeader").classList.toggle("active")
}

function lateral() { //Barra lateral(Menu) aparece
    document.getElementById("lateral").classList.toggle("active")
}
// POPUP
var modal = document.getElementById("popup")//Variavel do popup

function mostrar() {//mostrar popup
    modal.classList.add("mostrar-popup")
}

function fechar() {//Fechar popup
    modal.classList.remove("mostrar-popup")
}

//BLOQUEAR DATAS PASSADAS PARA VALIDADE DO PRODUTO
let validade = document.getElementById("validade")
validade.min =  new Date().toISOString().split("T")[0];


// COLOCAR O NOME DA IMAGEM NO INPUT FILE
document.querySelector("#imagem").addEventListener("change", function () {//PASSA O NOME DA IMAGEM PARA O INPUT FILE
    document.querySelector(".nome_imagem").textContent = this.files[0].name
})




    






