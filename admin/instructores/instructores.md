# Añadir un instructor

http://localhost/tutorias/admin/instructores/add.php
{
  "nombre" : "Edgar Rodolfo",
  "apellidos" : "Braquetes Lopez",
  "email" : "braquetes@gmail.com",
  "password" : "137946",
  "telefono" : "9516147030",
  "tituloAcademico" : "Ingeniero"
}

# Eliminar un instructor

http://localhost/tutorias/admin/instructores/delete.php?idInstructor=1

# Obtener todos los instructores

http://localhost/tutorias/admin/instructores/getAll.php

# Obtener un instructor

http://localhost/tutorias/admin/instructores/getOne.php?idInstructor=1

# Actualizar un instructor

http://localhost/tutorias/admin/instructores/update.php?idInstructor=2
{
  "nombre" : "Edgar Rodolfo",
  "apellidos" : "Braquetes Lopez",
  "email" : "braquetes@gmail.com",
  "password" : "137946",
  "telefono" : "9516147030",
  "tituloAcademico" : "Ingeniero"
}
