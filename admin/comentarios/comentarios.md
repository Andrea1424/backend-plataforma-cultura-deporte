# Añadir un comentario

http://localhost/tutorias/admin/comentarios/add.php
{
  "idPublicacion" : 1,
  "idUsuario" : 1,
  "comentario" : "Tutoria deportiva GOD"
}

# Eliminar un comentarios

http://localhost/tutorias/admin/comentarios/delete.php?idComentario=2

# Obtener todos los comentarios

http://localhost/tutorias/admin/comentarios/getAll.php

# Obtener un comentario

http://localhost/tutorias/admin/comentarios/getOne.php?idComentario=1

# Obtener los comentarios de una publicacion

http://localhost/tutorias/admin/comentarios/getOneId.php?idPublicacion=1

# Actualizar un comentario

http://localhost/tutorias/admin/comentarios/update.php?idComentario=1
{
  "idPublicacion" : 1,
  "idUsuario" : 1,
  "comentario" : "Tutoria deportiva GOD"
}