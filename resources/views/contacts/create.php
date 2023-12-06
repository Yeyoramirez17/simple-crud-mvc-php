<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts | Crear Contacto</title>
</head>
<body>

    <h1>Crear Contacto</h1>
    <form action="/contacts" method="post">
        <div>
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="email">E-mail</label>
            <input type="text" name="email" id="email">
        </div>
        <div>
            <label for="phone">Telefono</label>
            <input type="text" name="phone" id="phone">
        </div>

        <button type="submit">Crear Contacto</button>
    </form>

</body>
</html>