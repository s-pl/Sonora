# Sonora

Sonora es una versión simple y minimalista tipo "Spotify" para subir y reproducir canciones. Interfaz en blanco/negro, responsive y sin iconos. Incluye autenticación (registro, login, logout) y CRUD completo para canciones (GET, POST, PUT, DELETE).

## Requisitos
- PHP >= 8.3
- Composer
- MySQL (o MariaDB)
- Webserver local (Laragon, Valet, XAMPP, etc.)
- (Opcional) Node/NPM si vas a compilar assets con Vite

## Instalación rápida (Windows / Laragon)
1. Copia `.env.example` a `.env` y ajusta las variables:
   - DB_CONNECTION=mysql
   - DB_HOST=127.0.0.1
   - DB_PORT=3306
   - DB_DATABASE=sonora
   - DB_USERNAME=tu_usuario
   - DB_PASSWORD=tu_pass

2. Instala dependencias PHP:
```powershell
composer install
```

3. Genera la APP key y ejecuta migraciones:
```powershell
php artisan key:generate
php artisan migrate
```

4. Crea el enlace para acceder a archivos subidos:
```powershell
php artisan storage:link
```

5. (Opcional) Si usas assets con Vite/NPM:
```powershell
npm install
npm run dev
```

6. Arranca el servidor de desarrollo:
```powershell
php artisan serve --host=127.0.0.1 --port=8000
```
Abrir: http://127.0.0.1:8000

## Rutas principales
- GET / -> Página de inicio (welcome)
- Auth:
  - GET /register, POST /register
  - GET /login, POST /login
  - POST /logout
- Songs (protegidas por auth):
  - GET /songs (lista)
  - GET /songs/create (form subir)
  - POST /songs (crear)
  - GET /songs/{id} (ver)
  - PUT /songs/{id} (actualizar)
  - DELETE /songs/{id} (borrar)

## Uso desde frontend
- Registrar un usuario y loguearse.
- Subir canciones desde `/songs/create`.
- Editar / borrar desde la lista de canciones.
- Reproductor integrado en cada tarjeta (HTML5 <audio>).

## API (ejemplos curl)
- Crear (multipart):
```bash
curl -X POST -F "title=Mi canción" -F "artist=Autor" -F "file=@/ruta/archivo.mp3" -u usuario:password http://127.0.0.1:8000/songs
```
- Actualizar:
```bash
curl -X PUT -F "title=Nuevo" -F "_method=PUT" -u usuario:password http://127.0.0.1:8000/songs/1
```
- Borrar:
```bash
curl -X DELETE -u usuario:password http://127.0.0.1:8000/songs/1
```

## Problemas comunes
- Error "storage link": ejecuta `php artisan storage:link` y revisa permisos en `storage` y `public/storage`.
- Error `Class "Laravel\Pail\PailServiceProvider" not found`: ejecuta `composer update` para sincronizar dependencias (se eliminaron referencias a Sail/Pail del composer.json; lockfile debe regenerarse).
```powershell
composer update
composer dump-autoload
php artisan package:discover
```
- ParseError en Blade (EOF): revisa que no falten `@endsection`, `</form>` o comillas sin cerrar en `resources/views/...`.

## Notas del frontend
- Estilo minimalista en blanco/negro.
- Sin iconos.
- Información del usuario en el navbar (nombre / email / logout).
- Responsive: tarjetas y reproductor adaptan tamaños.

## Desarrollo y testing
- Ejecutar pruebas unitarias si existen:
```powershell
php artisan test
```

Si surge cualquier error al seguir estos pasos, pega la salida de los comandos (`composer update`, `php artisan migrate`, logs de Laravel en storage/logs/laravel.log`) y se proporcionará una solución puntual.