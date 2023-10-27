function guardarDatos() {
    var codigo = document.getElementById('codigo').value;
    var nombre = document.getElementById('nombre').value;
    var apellidos = document.getElementById('apellidos').value;
    var telefono = document.getElementById('telefono').value;
    var email = document.getElementById('email').value;
    var contrasena = document.getElementById('contrasena').value;
    var rol = document.getElementById('rol').value;

    if (
        codigo.trim() === '' ||
        nombre.trim() === '' ||
        apellidos.trim() === '' ||
        telefono.trim() === '' ||
        email.trim() === '' ||
        contrasena.trim() === '' ||
        rol.trim() === ''
    ) {
        alert('Por favor, complete todos los campos antes de enviar el formulario.');
    } else {
        alert('Datos guardados correctamente.');
    }
}