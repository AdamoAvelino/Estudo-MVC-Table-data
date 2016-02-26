window.onload = function () {
    document.getElementById('cad').onclick = function () {
        if (document.getElementById('confirmPassword').getAttribute('class') == 'form-control esconde') {
            document.getElementById('confirmPassword').setAttribute('class', 'form-control');
            document.getElementById('confirmPassword').setAttribute('required', 'required');
            document.getElementById('tit-login').innerHTML = 'Cadastro';
            document.getElementById('form-login').setAttribute('action' , 'autenticacao/cadastro');
            
            
            
            this.innerHTML = 'Login';
        }else{
            document.getElementById('confirmPassword').setAttribute('class', 'form-control esconde');
            document.getElementById('confirmPassword').removeAttribute('required');
            document.getElementById('tit-login').innerHTML = 'Login';
            document.getElementById('form-login').setAttribute('action' , 'admin');
            this.innerHTML = 'Cadastrar Usuário';
            
        }
    }
}
//form-control esconde

