<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="container mx-auto">
        <h1 class="text-2xl">Listado de contactos</h1>

        <a href="/contacts/create">Crear Contacto</a>

        <form action="/contacts">
            <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="search" name="search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required>
                <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>

        <ul class="list-disc list-inside">
            <?php foreach ($contacts['data'] as $contact) : ?>
                <li>
                    <a href="/contacts/<?= $contact['id'] ?>">
                        <?= $contact['id'] ?> - <?= $contact['name'] ?>
                    </a>
                </li>
            <?php endforeach ?>
        </ul>
        <!-- Pagination -->
        <?php
            $paginate = 'contacts';
            require_once '../resources/views/assets/pagination.php';
        ?>
        <!-- End Pagination -->
    </div>
</body>
</html>