# 🗺️ Documentación: Mapa Interactivo PlantaTec

## Descripción General

Se ha implementado un sistema completo de mapa interactivo para el proyecto PlantaTec utilizando:
- **Frontend**: Leaflet.js + OpenStreetMap
- **Backend**: Laravel Controllers + API JSON
- **Geolocalización**: HTML5 Geolocation API
- **Base de Datos**: MySQL con nuevas columnas en tabla `ubicaciones`

## Funcionalidades Implementadas

### 1. ✅ Adopción de plantas con ubicación
- **Usuario normal**: Puede elegir ubicación pública o privada
  - Pública: Con zona recomendada O seleccionando en mapa
  - Privada: Solo nombre O con ubicación en mapa
- **Geolocalización automática**: Permite obtener ubicación actual con un clic
- **Selección manual**: Click en el mapa para marcar ubicación

### 2. ✅ Visualización del mapa
- **Usuario normal**:
  - Ve sus propias ubicaciones privadas
  - Ve todas las ubicaciones públicas de otros usuarios
- **Administrador**:
  - Ve TODAS las ubicaciones (públicas y privadas)

### 3. ✅ Integración en dashboard
- **Dashboard Usuario**: Sección "Mis ubicaciones" con mapa incrustado
- **Dashboard Admin**: Sección "Mapa de ubicaciones" con vista de todas las adopciones
- **Vista completa**: Página `/mapa` con mapa interactivo expandido

### 4. ✅ Permisos y privacidad
- Ubicaciones públicas: Visibles para todos (marcador azul 🔵)
- Ubicaciones privadas: Solo para propietario y admin (marcador rojo 🔴)
- API filters según rol del usuario

## Cambios en la Base de Datos

### Migración: `2026_05_17_000000_modify_ubicaciones_table.php`

```sql
ALTER TABLE ubicaciones ADD COLUMN id_usuario BIGINT UNSIGNED NULL;
ALTER TABLE ubicaciones ADD COLUMN es_publica BOOLEAN DEFAULT true;
ALTER TABLE ubicaciones ADD FOREIGN KEY (id_usuario) REFERENCES users(id) ON DELETE CASCADE;
```

**Nuevos campos en tabla `ubicaciones`**:
- `id_usuario`: Relación con usuario propietario (nullable)
- `es_publica`: Boolean para distinguir ubicaciones públicas (azul) de privadas (rojo)

## Cambios en Modelos

### Modelo `Ubicacion.php`
```php
// Nuevas relaciones
public function usuario()
public function adopciones()
```

### Modelo `User.php`
```php
// Nuevas relaciones
public function adopciones()
public function ubicaciones()
```

### Modelo `Adopcion.php`
```php
// Ya tiene relaciones, sin cambios (solo validar que estén completas)
```

## Nuevos Controllers

### 1. `MapaController.php`
**Rutas principales**:
- `GET /mapa` → Vista principal del mapa
- `GET /api/mapa/ubicaciones` → Obtener ubicaciones (con permisos)
- `POST /api/mapa/ubicaciones` → Guardar ubicación
- `GET /api/mapa/ubicaciones-cercanas` → Búsqueda por radio
- `PUT /api/mapa/ubicaciones/{id}/privacidad` → Cambiar privacidad
- `DELETE /api/mapa/ubicaciones/{id}` → Eliminar ubicación

**Métodos incluidos**:
- `getUbicaciones()`: Obtiene ubicaciones según permisos del usuario
- `guardarUbicacion()`: Crea nueva ubicación
- `getUbicacionesCercanas()`: Búsqueda geoespacial (radio)
- `updatePrivacidad()`: Cambiar entre pública/privada
- `destroy()`: Eliminar ubicación

### 2. `Api/AdopcionMapaController.php`
**Rutas API**:
- `POST /api/adopciones/crear-con-ubicacion` → Crear adopción + ubicación
- `GET /api/adopciones/en-mapa` → Obtener adopciones con ubicación

**Métodos incluidos**:
- `crearAdopcionConUbicacion()`: Transacción atómica para crear adopción + ubicación
- `getAdopcionesEnMapa()`: Retorna adopciones con permisos de privacidad

### 3. `CatalogoPlantaController.php` (ACTUALIZADO)
```php
// Método adoptar() mejorado con:
// - Soporte para adopción desde mapa
// - Diferentes métodos según tipo (público/privado)
// - Validación robusta
// - Transacciones para integridad
```

## Nuevas Vistas

### 1. Componente `mapa-interactivo.blade.php`
Componente Blade reutilizable con:
- Mapa interactivo Leaflet
- Toolbar con geolocalización y búsqueda
- Carga de ubicaciones desde API
- Popups de información
- Soporte para selección manual

**Props**:
```php
@component('components.mapa-interactivo', [
    'id' => 'mapa-principal',
    'canSelectLocation' => false,
    'showToolbar' => true,
    'height' => '600px'
])
```

### 2. Vista `mapas/index.blade.php`
Página completa del mapa con:
- Mapa interactivo expandido (centrado en Matamoros)
- Leyenda de colores (público/privado)
- Estadísticas en tiempo real
- Toolbar completo

### 3. Vista `catalogo/show.blade.php` (ACTUALIZADA)
Sistema de adopción mejorado con:
- Tabs para elegir tipo de ubicación
- Subopción: Zona recomendada vs Mapa
- Mapa interactivo integrado para selección
- Validación cliente-servidor
- Geolocalización en tiempo real

### 4. Dashboard `usuario.blade.php` (ACTUALIZADO)
Se agregó:
- Card "Mapa interactivo" en acciones rápidas
- Sección de "Mis ubicaciones" con mapa incrustado
- Link a vista completa del mapa

### 5. Dashboard `admin.blade.php` (ACTUALIZADO)
Se agregó:
- Sección "Mapa de ubicaciones" con vista de todas las adopciones
- Link a vista completa del mapa

## Nuevas Rutas

```php
// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    // Mapa
    Route::get('/mapa', [MapaController::class, 'index'])->name('mapa.index');
    Route::get('/api/mapa/ubicaciones', [MapaController::class, 'getUbicaciones'])->name('api.mapa.ubicaciones');
    Route::post('/api/mapa/ubicaciones', [MapaController::class, 'guardarUbicacion'])->name('api.mapa.guardar');
    Route::get('/api/mapa/ubicaciones-cercanas', [MapaController::class, 'getUbicacionesCercanas'])->name('api.mapa.cercanas');
    Route::put('/api/mapa/ubicaciones/{ubicacion}/privacidad', [MapaController::class, 'updatePrivacidad'])->name('api.mapa.privacidad');
    Route::delete('/api/mapa/ubicaciones/{ubicacion}', [MapaController::class, 'destroy'])->name('api.mapa.destroy');

    // Adopciones con mapa
    Route::post('/api/adopciones/crear-con-ubicacion', [AdopcionMapaController::class, 'crearAdopcionConUbicacion'])->name('api.adopciones.crear-con-ubicacion');
    Route::get('/api/adopciones/en-mapa', [AdopcionMapaController::class, 'getAdopcionesEnMapa'])->name('api.adopciones.en-mapa');
});
```

## Integración de Librerías

### Leaflet.js
Se agregó al layout `resources/views/layouts/app.blade.php`:

```html
<!-- HEAD -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />

<!-- BODY (antes de cierre) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
```

**CDN**: Leaflet 1.9.4 de cdnjs
**Mapa base**: OpenStreetMap (Nominatim para búsqueda)
**Centro predeterminado**: Matamoros, Tamaulipas (25.5095, -97.1559)
**Zoom**: 13

## Marcadores en el Mapa

| Color | Significado | Visible para |
|-------|-------------|-------------|
| 🔵 Azul | Ubicación pública | Todos |
| 🔴 Rojo | Ubicación privada | Propietario + Admin |
| 🟡 Dorado | Ubicación seleccionada en adopción | Usuario en formulario |

## Flujo de Adopción

### Flujo A: Adoptar con zona recomendada (método antiguo mantienido)
1. Usuario selecciona planta
2. Elige "Adoptar"
3. Selecciona tipo: **Pública**
4. Elige método: **Zona recomendada**
5. Selecciona zona del dropdown
6. Envía formulario
7. Se crea Ubicacion + Adopcion ✅

### Flujo B: Adoptar con selección en mapa (NUEVO)
1. Usuario selecciona planta
2. Elige "Adoptar"
3. Selecciona tipo: **Pública** o **Privada**
4. Elige método: **Seleccionar en mapa**
5. Interactúa con mapa:
   - Click en mapa = marca ubicación
   - O click en "Mi ubicación" = geolocalización
6. Se actualiza el marcador dorado 🟡
7. Ingresa nombre del lugar
8. Envía formulario
9. Se crea Ubicacion + Adopcion ✅

## API de Ubicaciones

### GET `/api/mapa/ubicaciones`
**Retorna**: Array de ubicaciones según permisos

```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "latitud": 25.5095,
      "longitud": -97.1559,
      "nombre_lugar": "Mi casa",
      "descripcion": "Patio trasero",
      "tipo": "privado",
      "es_publica": false,
      "usuario_nombre": "Juan",
      "usuario_id": 2,
      "adopciones": [
        {
          "id": 5,
          "planta_nombre": "Rosa",
          "planta_imagen": "...",
          "fecha_adopcion": "01/01/2024",
          "estado": "activa"
        }
      ]
    }
  ]
}
```

### POST `/api/mapa/ubicaciones`
**Body**:
```json
{
  "latitud": 25.5095,
  "longitud": -97.1559,
  "nombre_lugar": "Mi casa",
  "descripcion": "Patio trasero",
  "es_publica": false,
  "tipo": "privado"
}
```

### GET `/api/mapa/ubicaciones-cercanas`
**Query params**:
```
?latitud=25.5&longitud=-97.1&radio=5
```

Búsqueda geoespacial usando fórmula Haversine (distancia en km).

## Instalación y Ejecución

### 1. Ejecutar migración
```bash
php artisan migrate
```

### 2. No requiere instalación de dependencias
- Leaflet se carga desde CDN
- Geolocalización es nativa del navegador
- APIs son Laravel puro

### 3. Verificar rutas
```bash
php artisan route:list | grep mapa
```

### 4. Probar en navegador
- Dashboard usuario: `/dashboard`
- Mapa completo: `/mapa`
- Adopción con mapa: `/catalogo-plantas/1` (editar planta)

## Validaciones

### Cliente (JavaScript)
- Ubicación debe estar seleccionada en el mapa antes de enviar
- Nombre del lugar es requerido
- Validación de radio de búsqueda

### Servidor (Laravel)
- Validación de coordenadas GPS (rango -90 a 90, -180 a 180)
- Usuario autenticado requerido
- Verificación de permisos (solo propietario puede editar su ubicación)
- Transacciones atómicas para adopción + ubicación

## Permisos de Acceso

| Acción | Usuario Normal | Admin |
|--------|---|---|
| Ver ubicaciones públicas | ✅ | ✅ |
| Ver propias ubicaciones privadas | ✅ | ✅ |
| Ver todas las privadas | ❌ | ✅ |
| Crear ubicación | ✅ | ✅ |
| Editar propia ubicación | ✅ | ✅ |
| Editar ubicación de otros | ❌ | ✅ |
| Eliminar propia ubicación | ✅ | ✅ |
| Eliminar ubicación de otros | ❌ | ✅ |

## Futuras Mejoras Opcionales

- [ ] Filtro de plantas en el mapa
- [ ] Búsqueda avanzada (rango de fechas, tipo de planta)
- [ ] Estadísticas por zona
- [ ] Exportar ubicaciones (GeoJSON, KML)
- [ ] Importar ubicaciones masivamente
- [ ] Heatmap de adopciones más populares
- [ ] Clustering de marcadores cuando hay zoom out
- [ ] Integración con geocódigos (dirección → coordenadas)
- [ ] Notificaciones cuando hay nuevas adopciones cercanas
- [ ] Rutas de entrega (optimización para voluntarios)

## Archivos Creados/Modificados

### ✅ Creados
- `app/Http/Controllers/MapaController.php`
- `app/Http/Controllers/Api/AdopcionMapaController.php`
- `resources/views/components/mapa-interactivo.blade.php`
- `resources/views/mapas/index.blade.php`
- `database/migrations/2026_05_17_000000_modify_ubicaciones_table.php`
- `MAPA_DOCUMENTACION.md` (este archivo)

### ✅ Modificados
- `app/Models/Ubicacion.php` → Relaciones + casts
- `app/Models/User.php` → Relaciones
- `app/Models/Adopcion.php` → (sin cambios, ya estaba bien)
- `app/Http/Controllers/CatalogoPlantaController.php` → Lógica mejorada
- `resources/views/layouts/app.blade.php` → Leaflet CSS/JS
- `resources/views/catalogo/show.blade.php` → Sistema de adopción con mapa
- `resources/views/dashboard/usuario.blade.php` → Integración del mapa
- `resources/views/dashboard/admin.blade.php` → Integración del mapa
- `routes/web.php` → Nuevas rutas

## Debugging

### Verificar ubicaciones en BD
```bash
php artisan tinker
>>> Ubicacion::all();
>>> Ubicacion::where('es_publica', true)->count();
```

### Ver logs de API
```bash
tail -f storage/logs/laravel.log
```

### Verificar geolocalización
- Abrir DevTools (F12) → Console
- Ver mensajes de error de geolocalización
- Verificar permisos del navegador en iOS/Android

### Validar Leaflet
```javascript
// En consola
L.version // debe retornar "1.9.4"
window.mapaInstancias // debe tener referencias a mapas
```

## Soporte y Contacto

Para dudas o problemas:
1. Verificar que las migraciones se ejecutaron correctamente
2. Revisar los permisos de usuario (rol = 'usuario' o 'admin')
3. Asegurar que el navegador permite geolocalización
4. Verificar que la BD tiene datos en tabla `ubicaciones`
5. Revisar console del navegador (F12) para errores de JS

---

**Versión**: 1.0  
**Fecha**: 17 de Mayo, 2026  
**Framework**: Laravel 11  
**Blade**: v2  
**Leaflet**: 1.9.4
