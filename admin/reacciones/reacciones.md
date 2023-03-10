# Añadir una reaccion

http://localhost/tutorias/admin/comentarios/add.php
{
  "idPublicacion" : 1,
  "idUsuario" : 1,
  "reaccion" : "Me gusta"
}

# Eliminar una reaccion

http://localhost/tutorias/admin/reacciones/delete.php?idReaccion=2

# Obtener todos las reacciones

http://localhost/tutorias/admin/comentarios/getAll.php

# Obtener una reaccion

http://localhost/tutorias/admin/reacciones/getOne.php?idReaccion=1

# Obtener una reaccion de una publicacion

http://localhost/tutorias/admin/reacciones/getOneId.php?idPublicacion=1

# Actualizar una reaccion

http://localhost/tutorias/admin/reacciones/update.php?idReaccion=1
{
  "idPublicacion" : 1,
  "idUsuario" : 1,
  "reaccion" : "Me gusta"
}
