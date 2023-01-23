function clickMenu() {
    if (itens.style.display == 'block') {
        itens.style.display = 'none'
    } else {
        itens.style.display = 'block'
    }
}
function closeTeste() {
    teste.style.display = 'none'
    testeback.style.display = 'none'
    titulocaixalogin.style.display='block'
}

function openTeste() {
    teste.style.display = 'block'
    testeback.style.display = 'block'
    titulocaixalogin.style.display= 'none'
}


function closeLogin() {
    loginBox.style.display = 'none'
    loginBack.style.display = 'none'
    titulocaixalogin.style.display='block'
}

function openLogin() {
    loginBox.style.display = 'block'
    loginBack.style.display = 'block'
    titulocaixalogin.style.display= 'none'
}



function closeRegister() {
    registerBox.style.display = 'none'
    registerBack.style.display = 'none'
    titulocaixalogin.style.display='block'
}

function openRegister() {
    registerBox.style.display = 'block'
    registerBack.style.display = 'block'
    titulocaixalogin.style.display= 'none'
}



function changeToLogin() {
    titulobox.style.height = '30vh'
    tituloimg.style.height = '30vh'
    indexbox.style.height = '65vh'
    indexbox.style.flexWrap = 'nowrap'
    leftSide.style.borderWidth = '0px'
    botaoLogin.style.fontSize = '2vh'
    botaoForget.style.marginRight = '0vw'
    botaoForget.style.fontSize = '2vh'
}
function changetoRegister() {
    titulobox.style.height = '30vh'
    tituloimg.style.height = '30vh'
    indexbox.style.height = '65vh'
    indexbox.style.flexWrap = 'nowrap'
    leftSide.style.borderWidth = '0px'
    botaoRegister.style.fontSize = '2vh'
    botaoReset.style.marginRight = '0vw'
    botaoReset.style.fontSize = '2vh'
    nome.style.fontSize = '5vh'
}