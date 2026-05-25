# TaskOrganizer - Sistema Web de Gestión de Tareas

Este repositorio contiene la solución completa para el **Tercer Desafío Práctico (DSS)**. Se trata de un sistema de gestión de tareas premium, responsivo y seguro, desarrollado bajo dos arquitecturas distintas pero compartiendo el mismo diseño visual de alto nivel.

---

## 🚀 Tecnologías y Características

1. **Diseño Visual Premium (Glassmorphism)**: 
   - Interfaz moderna en modo oscuro basada en Bootstrap 5 y custom CSS.
   - Micro-animaciones de carga y transiciones de hover.
   - Tarjetas flotantes con desenfoque de fondo y bordes brillantes.
   - Menú de estadísticas en tiempo real y filtros dinámicos sin recarga.
2. **Base de Datos (MySQL)**:
   - Base de datos relacional para el almacenamiento seguro de usuarios y tareas.
   - Relación de uno a muchos (`usuarios` -> `tareas`).
   - Contraseñas cifradas con `BCRYPT`.
3. **Versión MVC Nativo (PHP puro)**:
   - Implementado desde cero utilizando arquitectura MVC limpia sin frameworks.
   - Enrutador dinámico (`Router.php`) con soporte para rutas amigables y parámetros dinámicos (`/tareas/editar/{id}`).
   - Sistema de sesiones seguro (`Session.php`) con banners de alerta (Flash Messages).
   - Acciones asíncronas con **AJAX** (Fetch API) para el cambio de estado y actualización de contadores en tiempo real.
4. **Versión Laravel**:
   - Implementación moderna con Laravel 12.
   - Migraciones robustas para estructurar las tablas automáticamente.
   - Controladores dedicados y Blade templating.
   - Integración asíncrona mediante peticiones AJAX protegidas por Token CSRF.

---

## 📂 Estructura del Proyecto

```text
desafio-03/
├── database/
│   └── script.sql          # Script SQL para inicializar ambas bases de datos
├── mvc_nativo/             # Versión en PHP Puro (MVC Nativo)
│   ├── config/
│   │   └── config.php      # Configuración general y detección de URL base
│   ├── controllers/
│   │   ├── AuthController.php
│   │   └── TaskController.php
│   ├── libs/
│   │   ├── Database.php    # Singleton Wrapper de PDO
│   │   ├── Router.php      # Enrutador personalizado
│   │   └── Session.php     # Gestor de Sesión y Flash Alerts
│   ├── models/
│   │   ├── Task.php
│   │   └── User.php
│   ├── public/
│   │   ├── css/
│   │   │   └── styles.css  # Diseño Glassmorphism compartido
│   │   └── js/
│   │       └── ajax.js     # Script de AJAX para el panel nativo
│   ├── views/              # Vistas estructuradas (Layouts, Auth, Tareas)
│   └── index.php           # Punto de entrada (Front Controller)
├── laravel_tareas/         # Versión en Laravel
│   ├── app/
│   │   ├── Http/Controllers/
│   │   │   ├── AuthController.php
│   │   │   └── TaskController.php
│   │   └── Models/
│   │       ├── Tarea.php   # Modelo de Tareas
│   │       └── User.php    # Modelo de Usuarios con relación hasMany
│   ├── database/
│   │   └── migrations/     # Migraciones de usuarios, sesiones y tareas
│   ├── public/
│   │   └── css/
│   │       └── styles.css  # Estilos compartidos
│   ├── resources/
│   │   └── views/          # Plantillas Blade (Layouts, Auth, Tareas)
│   └── routes/
│       └── web.php         # Rutas de la aplicación (Web y AJAX)
└── README.md               # Esta documentación
```

---

## 🛠️ Instrucciones de Configuración

### 1. Base de Datos (XAMPP / MySQL)
Asegúrate de que el servicio MySQL de XAMPP esté encendido.
1. Abre tu gestor de base de datos favorito (como phpMyAdmin) o la consola de MySQL.
2. Ejecuta el script ubicado en `database/script.sql`.
   - Este script creará automáticamente dos bases de datos:
     - `taskorganizer_db` (usada por la versión MVC Nativo).
     - `taskorganizer_laravel` (usada por la versión de Laravel).
   - El script también creará las tablas necesarias e insertará datos iniciales de prueba.

### 2. Configuración de la Versión MVC Nativo
La versión nativa cuenta con detección automática de la URL base, por lo que si está alojada en `http://localhost/desafio-03/mvc_nativo/` funcionará directamente.
- Si requieres cambiar las credenciales de la base de datos, edita el archivo `mvc_nativo/config/config.php`.

### 3. Configuración de la Versión Laravel
El instalador ya ha configurado la aplicación y ejecutado las migraciones iniciales.
- El archivo `.env` en `laravel_tareas/` ya tiene configurado:
  ```env
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=taskorganizer_laravel
  DB_USERNAME=root
  DB_PASSWORD=
  ```
- Si deseas volver a ejecutar las migraciones o poblar las tablas, ejecuta el siguiente comando desde la carpeta `laravel_tareas/`:
  ```bash
  php artisan migrate:fresh --seed
  ```

---

## 🖥️ Cómo Ejecutar el Proyecto

### Opción A: A través de XAMPP (Apache)
1. Coloca la carpeta entera del proyecto (`desafio-03`) dentro de la ruta `C:\xampp\htdocs\`.
2. Inicia Apache y MySQL desde el Panel de Control de XAMPP.
3. Abre tu navegador e ingresa a las siguientes rutas:
   - **MVC Nativo**: `http://localhost/desafio-03/mvc_nativo/`
   - **Laravel**: `http://localhost/desafio-03/laravel_tareas/public/`

### Opción B: A través de los servidores de desarrollo de PHP (Recomendado)
Puedes iniciar servidores independientes desde la terminal para una experiencia más rápida y limpia.

1. **Para ejecutar la versión MVC Nativo**:
   - Abre la terminal en `desafio-03/mvc_nativo/` y ejecuta:
     ```bash
     php -S localhost:8000
     ```
   - Accede a `http://localhost:8000` en tu navegador.

2. **Para ejecutar la versión de Laravel**:
   - Abre la terminal en `desafio-03/laravel_tareas/` y ejecuta:
     ```bash
     php artisan serve
     ```
   - Accede a `http://127.0.0.1:8000` (o al puerto indicado) en tu navegador.

---

## 🔑 Credenciales de Prueba Pre-cargadas
Ambas bases de datos incluyen un usuario de demostración listo para usar:
- **Usuario**: `demo@taskorganizer.com`
- **Contraseña**: `demo1234`

*(También puedes registrar nuevos usuarios directamente desde las interfaces de registro de ambas versiones).*
