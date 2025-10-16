# 🎵 **Sonora**

**Sonora** es una aplicación web minimalista inspirada en Spotify, que permite **subir, reproducir y gestionar canciones** fácilmente.  
Incluye autenticación completa (registro, login, logout) y un **CRUD total** para canciones.

---

## 🚀 **Características principales**
- 🔐 Autenticación de usuarios (registro, login, logout).  
- 🎧 Subida y reproducción de canciones en formato MP3.  
- 🗂️ CRUD completo (crear, ver, editar y eliminar canciones).  
- 🧰 API REST con endpoints protegidos.  
- 💾 Almacenamiento de archivos mediante Laravel Storage.  
- 🌙 Interfaz simple, limpia y funcional.

---

## 🧩 **Requisitos**
- PHP **>= 8.3**
- **Composer**
- **MySQL** o **MariaDB**
- Servidor local: **Laragon**, **XAMPP**, **Valet**, etc.
- *(Opcional)* **Node.js / NPM** si se compilan assets con Vite.

---

## ⚙️ **Instalación rápida (Windows / Laragon)**

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/tuusuario/sonora.git
   cd sonora
   ```

2. **Configurar el entorno**
   Copia el archivo `.env.example` y ajústalo:
   ```bash
   cp .env.example .env
   ```
   Edita los valores según tu configuración:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sonora
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_password
   ```

3. **Instalar dependencias PHP**
   ```bash
   composer install
   ```

4. **Generar la APP key y migrar la base de datos**
   ```bash
   php artisan key:generate
   php artisan migrate
   ```

5. **Crear enlace simbólico para archivos subidos**
   ```bash
   php artisan storage:link
   ```

6. *(Opcional)* **Compilar assets con Vite**
   ```bash
   npm install
   npm run dev
   ```

7. **Iniciar el servidor de desarrollo**
   ```bash
   php artisan serve --host=127.0.0.1 --port=8000
   ```
   🔗 Abre en tu navegador: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🧭 **Rutas principales**

### 🔓 Autenticación
| Método | Ruta | Descripción |
|--------|------|--------------|
| GET | `/register` | Formulario de registro |
| POST | `/register` | Crear usuario |
| GET | `/login` | Formulario de inicio de sesión |
| POST | `/login` | Autenticarse |
| POST | `/logout` | Cerrar sesión |

### 🎵 Canciones (requiere login)
| Método | Ruta | Descripción |
|--------|------|--------------|
| GET | `/songs` | Listado de canciones |
| GET | `/songs/create` | Formulario para subir canción |
| POST | `/songs` | Crear canción |
| GET | `/songs/{id}` | Ver canción |
| PUT | `/songs/{id}` | Actualizar canción |
| DELETE | `/songs/{id}` | Eliminar canción |

---

## 🧑‍💻 **Uso desde el frontend**
1. Regístrate y haz login.  
2. Ve a `/songs/create` para subir una canción.  
3. Cada canción se muestra con su título, autor y un reproductor `<audio>` integrado.  
4. Puedes **editar o eliminar** canciones desde la lista principal.

---

## 🧱 **Ejemplos de uso de la API (curl)**

### ➕ Crear canción (multipart)
```bash
curl -X POST -F "title=Mi canción" -F "artist=Autor" -F "file=@/ruta/archivo.mp3" -u usuario:password http://127.0.0.1:8000/songs
```

### ✏️ Actualizar canción
```bash
curl -X PUT -F "title=Nuevo título" -F "_method=PUT" -u usuario:password http://127.0.0.1:8000/songs/1
```

### ❌ Eliminar canción
```bash
curl -X DELETE -u usuario:password http://127.0.0.1:8000/songs/1
```

---

## 🧩 **Solución de problemas comunes**

| Problema | Solución |
|-----------|-----------|
| ⚠️ `Error "storage link"` | Ejecuta `php artisan storage:link` y revisa permisos en `storage` y `public/storage`. |
| ❌ `Class "Laravel\Pail\PailServiceProvider" not found` | Ejecuta:<br> `composer update`<br> `composer dump-autoload`<br> `php artisan package:discover` |
| 🧠 `ParseError` en vistas Blade | Revisa que no falten etiquetas como `@endsection`, `</form>` o comillas cerradas en `resources/views/...`. |

---

## 💡 **Notas**
- Puedes personalizar estilos o el reproductor según tus necesidades.  
- Las canciones se almacenan en `storage/app/public`.  
- Si deseas usar un hosting real, configura el `.env` para tu base de datos y dominio.

---

## 🧑‍🎤 **Autor**
**Samuel Ponce Luna**  
💻 Desarrollador Web — *Proyecto Sonora (Laravel)*
