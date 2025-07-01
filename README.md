# Hotel Management

Una aplicación full‑stack para gestionar hoteles, tipos de habitaciones y acomodos.

---

## 🔎 Descripción

Este proyecto permite:

* CRUD de **Hoteles** (nombre, dirección, ciudad, NIT, número máximo de habitaciones).
* Gestión de **Tipos de Habitación** y **Acomodaciones**.
* Asignación de combinaciones (tipo de habitación + acomodación + cantidad) por hotel.
* Visualización y edición desde un **frontend React (Vite + TypeScript)**.
* Backend RESTful con **Laravel (PHP)** y base de datos **PostgreSQL**.

---

## 📋 Requisitos

* PHP >= 8.1
* Composer
* Node.js >= 16
* npm / pnpm / yarn
* PostgreSQL >= 12

---

## ⚙️ Instalación

1. Clona el repositorio:

   ```bash
   git clone https://github.com/usuario/hotel-management.git
   cd hotel-management
   ```

2. Backend (Laravel):

   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   # Configura en .env la conexión a PostgreSQL
   php artisan migrate --seed
   ```

3. Frontend (React / Vite):

   ```bash
   cd frontend  # o carpeta src si está integrado
   npm install
   npm run dev
   ```

4. Abre:

   * Backend: [http://localhost:8000](http://localhost:8000)(https://api-hotel-01nz.onrender.com/api)
   * Frontend: [http://localhost:5173](http://localhost:5173)(https://hotel-front-rho.vercel.app)

---

## 🚀 Uso

### Rutas de la API

| Método | Endpoint                           | Descripción                         |
| ------ | ---------------------------------- | ----------------------------------- |
| GET    | `/api/hotels`                      | Listar todos los hoteles            |
| POST   | `/api/hotels`                      | Crear un hotel                      |
| GET    | `/api/hotels/{id}`                 | Obtener detalle de un hotel         |
| PUT    | `/api/hotels/{id}`                 | Actualizar hotel                    |
| DELETE | `/api/hotels/{id}`                 | Eliminar hotel                      |
| GET    | `/api/hotels/{hotel}/rooms`        | Listar asignaciones de habitaciones |
| POST   | `/api/hotels/{hotel}/rooms`        | Asignar habitación                  |
| PUT    | `/api/hotels/{hotel}/rooms/{room}` | Actualizar asignación               |
| DELETE | `/api/hotels/{hotel}/rooms/{room}` | Eliminar asignación                 |
| GET    | `/api/room-types`                  | Catalogo de tipos de habitación     |
| GET    | `/api/accommodations`              | Catalogo de acomodos                |
| GET    | `/api/hotels/{id}/accommodations`  | Obtener hotel + asignaciones        |

### Frontend

* Lista y formulario en `/hotels`.
* Gestión de asignaciones en `/accommodations/:hotelId`.

---

## 📂 Estructura del Proyecto

```text
root/
├── app/               # Lógica de Laravel (Controllers, Models, Services)
├── database/          # Migrations y seeders
├── routes/api.php     # Definición de rutas API
├── resources/js/      # Frontend React (src/ con componentes y servicios)
└── README.md          # Este documento
```

---

## 🌐 Arquitectura

```
[ React + Vite ] ←→ [ Laravel API (REST) ] ←→ [ PostgreSQL ]
```

* **Controllers** llaman a **Services** que usan **Repositories**.
* Front y back desacoplados.

---2

## 📜 Licencia

MIT © German Gonzalo Rojas Perdomo
