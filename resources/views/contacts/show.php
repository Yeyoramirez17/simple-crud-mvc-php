<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts App | <?php echo $contact['name'] ?></title>
</head>
<body>
    <h1>Detalle del Contacto</h1>
    
    <a href="/contacts">Volver</a>

    <p>Nombre: <?= $contact['name'] ?></p>
    <p>Email: <?= $contact['email'] ?></p>
    <p>Phone: <?= $contact['phone'] ?></p>
    
    <a href="/contacts/<?= $contact['id'] ?>/edit">Editar</a>
    <form action="/contacts/<?= $contact['id'] ?>/delete" method="post">
        <button type="submit">Eliminar</button>
    </form>
</body>
</html>