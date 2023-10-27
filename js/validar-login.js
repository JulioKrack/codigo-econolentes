function validarFormulario() {
    const email = document.getElementById('email').value;
    const contrasena = document.getElementById('contrasena').value;
    if (email.trim() === '') {
        alert('Por favor, ingresa tu email.');
        return false;
    }
    if (contrasena.trim() === '') {
        alert('Por favor, ingresa tu contraseña.');
        return false;
    }

    return true;
}

document.querySelector('.formulario').addEventListener('submit', function(event) {
    if (!validarFormulario()) {
        event.preventDefault();
    }
});
