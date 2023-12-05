// Importar Axios si estás usando npm
// import axios from 'axios';

// Asociar evento de clic al botón
$('#btnActualizar').click(function() {
    // Obtener el valor de "ci" desde el input
    var ci = $('#ci').val();
  
    // URL de tu API con el parámetro ci
    const apiUrl = 'http://localhost/Federacion/api/infoSocio.php?ci=' + ci;
  
    // Realizar una solicitud GET
    axios.get(apiUrl)
      .then(response => {
        // Manejar la respuesta exitosa
        const data = response.data;
  
        // Actualizar los valores de los elementos HTML
        $('#Nombre').val(data.Nombre);
        $('#Cedula').val(data.Cedula);
        $('#Apellido').val(data.Apellido);
        $('#Correo').val(data.CorreoElectronico);
        $('#Telefono').val(data.NumeroTelefono);
        $('#Direccion').val(data.Direccion);
      })
      .catch(error => {
        // Manejar el error
        console.error('Error en la solicitud:', error);
      });
  });
  