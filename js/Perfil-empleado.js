function guardarDatos() {
    var nombre = document.getElementById('nombre').value;
    var apellidos = document.getElementById('apellidos').value;
    var telefono = document.getElementById('telefono').value;
    var email = document.getElementById('email').value;
    var contrasena = document.getElementById('contrasena').value;

    if (nombre.trim() === '' || apellidos.trim() === '' || telefono.trim() === '' || email.trim() === '' || contrasena.trim() === '') {
        alert('Por favor, complete todos los campos antes de enviar el formulario.');
    } else {
        alert('Datos guardados correctamente.');
    }
}
