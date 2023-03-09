# Añadir una actividad

http://localhost/tutorias/admin/actividades/add.php
{
  "idInstructor" : 2,
  "actividad" : "Futbol",
  "cupo" : 50,
  "lugar" : "Unidad deportiva de la UTVCO",
  "descripcion" : "Tutoria de Futbol 7",
  "material" : "Ropa deportiva, balon de futbol",
  "publicar" : 1
}

# Eliminar una actividad

http://localhost/tutorias/admin/actividades/delete.php?idActividad=3

# Obtener todos las actividades

http://localhost/tutorias/admin/actividades/getAll.php

# Obtener una actividad

http://localhost/tutorias/admin/actividades/getOne.php?idActividad=1

# Actualizar una actividad

http://localhost/tutorias/admin/actividades/update.php?idActividad=2
{
  "idInstructor" : 2,
  "actividad" : "Beisbol",
  "cupo" : 50,
  "lugar" : "Unidad deportiva de la UTVCO",
  "descripcion" : "Tutoria de Futbol 7",
  "material" : "Ropa deportiva, balon de futbol",
  "publicar" : 1
}