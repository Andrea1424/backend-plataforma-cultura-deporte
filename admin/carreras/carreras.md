# Añadir una carrera

http://localhost/tutorias/admin/carreras/add.php
Metodo: POST
{
  "carrera" : "Gastronomia"
}

# Eliminar una carrera

http://localhost/tutorias/admin/carreras/delete.php?idCarrera=2
Metodo: DELETE

# Obtener todas las carreras

http://localhost/tutorias/admin/carreras/getAll.php
Metodo: GET

# Obtener una carrera

http://localhost/tutorias/admin/carreras/getOne.php?idCarrera=1
Metodo: GET

# Actualizar una carrera

http://localhost/tutorias/admin/carreras/update.php?idCarrera=1
Metodo: PUT
{
  "carrera" : "Gastronomias"
}
