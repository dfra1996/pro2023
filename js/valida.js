// Maneja la respuesta del servidor
success: function(response) {
    if (response.success) {
      // Actualiza la tabla DataTable
      $('#example').DataTable().ajax.reload();  // Reemplaza '#tablaDatos' con el selector correcto si es diferente
  
      // Limpia el formulario
      $('#frm1')[0].reset();
  
      // Muestra el mensaje de alerta
      alert(response.message);
  
      // Otros pasos que desees realizar después de la inserción exitosa
    } else {
      // Maneja el caso de inserción fallida
      console.log('Error al insertar los datos');
    }
  },
