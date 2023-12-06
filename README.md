# Simple CRUD MVC

Esta aplicación está desarrollada en PHP como lenguaje de programación. Se trata de un CRUD simple que realiza operaciones en una base de datos MySQL, aplicando la arquitectura MVC (Modelo-Vista-Controlador).

## Características Principales

- **Lenguaje de Programación:** PHP
- **Operaciones:** CRUD (Crear, Leer, Actualizar, Eliminar)
- **Base de Datos:** MySQL
- **Arquitectura:** Modelo-Vista-Controlador (MVC)

## Funcionalidades

La aplicación permite realizar operaciones básicas de creación, lectura, actualización y eliminación de datos en la base de datos MySQL. La implementación de la arquitectura MVC proporciona una estructura organizada y modular para facilitar el mantenimiento y la escalabilidad del código.


# Arquitectura MVC (Modelo-Vista-Controlador)

La arquitectura MVC es un patrón de diseño utilizado en el desarrollo de software para separar las responsabilidades de una aplicación en tres componentes principales: el **Modelo (Model)**, la **Vista (View)** y el **Controlador (Controller)**. A continuación, se presenta una breve descripción de cada componente:

## Modelo (Model)

- Representa la lógica de negocio y los datos de la aplicación.
- Se encarga de la manipulación y gestión de datos, así como de las reglas de negocio.
- Puede comunicarse con la base de datos y notificar a la Vista sobre los cambios en los datos.

## Vista (View)

- Representa la interfaz de usuario y la presentación de la información.
- Muestra los datos proporcionados por el Modelo y recibe la entrada del usuario.
- No realiza procesamiento de datos ni toma decisiones; simplemente muestra la información y comunica las acciones del usuario al Controlador.

## Controlador (Controller)

- Actúa como intermediario entre el Modelo y la Vista.
- Recibe las interacciones del usuario desde la Vista y actualiza el Modelo según sea necesario.
- Se encarga de gestionar el flujo de la aplicación y toma decisiones basadas en la entrada del usuario y el estado del Modelo.
- Puede actualizar la Vista en respuesta a los cambios en el Modelo.



## Requisitos

Asegúrate de tener instalados los siguientes requisitos en tu sistema:

- Servidor web con soporte para PHP
- Servidor MySQL
- Entorno de desarrollo PHP

## Configuración

1. Clona este repositorio: 
```bash
git clone https://github.com/tu-usuario/tu-proyecto.git
```
2. Entra al directorio del proyecto: 
```bash
cd tu-proyecto
```
3. Levanta un servidor Local en PHP: 
```bash 
php -S localhost:8000 -t=public
```
## Estrucutura de carpetas
```
📁mvc-contacts
└── 📁app
    └── 📁Controllers
        └── ContactController.php
        └── Controller.php
    └── 📁Models
        └── Contact.php
        └── Model.php

└── 📁config
    └── database.php
└── 📁lib
    └── Router.php
└── 📁public
    └── 📁css
    └── 📁js
    └── index.php
    └── .htaccess
└── 📁resources
    └── 📁css
    └── 📁js
    └── 📁views
        └── 📁assets
            └── pagination.php
        └── 📁contacts
            └── create.php
            └── edit.php
            └── index.php
            └── show.php
└── autoload.php


