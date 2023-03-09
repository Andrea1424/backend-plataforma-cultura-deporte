# Añadir una publicacion

http://localhost/tutorias/admin/publicaciones/add.php
{
  "idInstructor" : 2,
  "idActividad" : 2,
  "titulo" : "Futbol",
  "descripcion" : "Tutoria de Futbol",
  "imagen" : "https://naucalpan.gob.mx/wp-content/uploads/2020/07/PORTADA.png"
}			

# Eliminar una publicacion

http://localhost/tutorias/admin/publicaciones/delete.php?idPublicacion=2

# Obtener todos las publicaciones

http://localhost/tutorias/admin/publicaciones/getAll.php

# Obtener todas las publicaciones de una actividad

http://localhost/tutorias/admin/publicaciones/getOneId.php?idActividad=2 

# Obtener una publicacion

http://localhost/tutorias/admin/publicaciones/getOne.php?idPublicacion=1

# Actualizar una publicacion

http://localhost/tutorias/admin/publicaciones/update.php?idPublicacion=1
{
  "idInstructor" : 2,
  "idActividad" : 2,
  "titulo" : "Futbols",
  "descripcion" : "Tutoria de Futbols",
  "imagen" : "https://naucalpan.gob.mx/wp-content/uploads/2020/07/PORTADA.pngs"
}	
