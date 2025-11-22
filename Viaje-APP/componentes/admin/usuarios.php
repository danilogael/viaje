<?php
require "../proteccion/proteger_admin.php";
require "../../LoginAPI/config/db.php";
include "../header/header.php";

$rows = $conexion->query("SELECT id,nombre,apellido_paterno,correo,telefono,rol,fecha_registro FROM usuarios ORDER BY fecha_registro DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Usuarios</h2>
<table border="1">
<tr><th>Nombre</th><th>Correo</th><th>Tel</th><th>Rol</th><th>Acción</th></tr>
<?php foreach($rows as $r): ?>
  <tr>
    <td><?=htmlspecialchars($r['nombre'].' '.$r['apellido_paterno'])?></td>
    <td><?=htmlspecialchars($r['correo'])?></td>
    <td><?=htmlspecialchars($r['telefono'])?></td>
    <td><?=htmlspecialchars($r['rol'])?></td>
    <td>
      <?php if($r['rol'] === 'cliente'): ?>
        <a href="../../LoginAPI/change_role.php?id=<?=$r['id']?>&to=admin">Hacer admin</a>
      <?php else: ?>
        <a href="../../LoginAPI/change_role.php?id=<?=$r['id']?>&to=cliente">Quitar admin</a>
      <?php endif; ?>
    </td>
  </tr>
<?php endforeach; ?>
</table>
<?php include "../footer/footer.php"; ?>
