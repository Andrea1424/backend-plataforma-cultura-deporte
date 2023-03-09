# Añadir una reaccion

http://localhost/tutorias/admin/horarios/add.php
{
  "idActividad": "2",
  "dia": "25",
  "hora_inicio": "13:00",
  "hora_fin": "15:00"
}

# Eliminar un horario

http://localhost/tutorias/admin/horarios/delete.php?idHorario=1

# Obtener todos los horarios

http://localhost/tutorias/admin/horarios/getAll.php

# Obtener un horario

http://localhost/tutorias/admin/horarios/getOne.php?idHorario=2

# Actualizar un horario

http://localhost/tutorias/admin/horarios/update.php?idHorario=2
{
  "idActividad": "2",
  "dia": "Lunes",
  "hora_inicio": "12:00",
  "hora_fin": "14:00"
}