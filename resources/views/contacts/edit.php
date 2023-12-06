<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts | <?php echo $contact['name'] ?></title>
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

    <h1>Actualizar Contacto</h1>
    <form action="/contacts/<?= $contact['id'] ?>" method="post">
        <div>
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" value="<?= $contact['name'] ?>">
        </div>
        <div>
            <label for="email">E-mail</label>
            <input type="text" name="email" id="email" value="<?= $contact['email'] ?>">
        </div>
        <div>
            <label for="phone">Teléfono</label>
            <input type="text" name="phone" id="phone" value="<?= $contact['phone'] ?>">
        </div>

        <button type="submit">Actualizar</button>
    </form>

</body>
</html>