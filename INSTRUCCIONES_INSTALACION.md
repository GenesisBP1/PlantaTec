# 📋 INSTRUCCIONES DE INSTALACIÓN

## Pasos para activar el Mapa Interactivo

### 1️⃣ Entrar al directorio del proyecto
```bash
cd c:\Users\danie\Herd\PlantaTec
```

### 2️⃣ Ejecutar la migración
```bash
php artisan migrate
```

**Salida esperada**:
```
Migration table created successfully.
Migrating: 2026_05_17_000000_modify_ubicaciones_table
Migrated:  2026_05_17_000000_modify_ubicaciones_table (xxxms)
```

### 3️⃣ Limpiar caché (recomendado)
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### 4️⃣ Verificar instalación
```bash
php artisan route:list | grep mapa
```

**Deberías ver algo como**:
```
GET|HEAD  /mapa                          » MapaController@index
GET|HEAD  /api/mapa/ubicaciones          » MapaController@getUbicaciones
POST      /api/mapa/ubicaciones          » MapaController@guardarUbicacion
GET|HEAD  /api/mapa/ubicaciones-cercanas » MapaController@getUbicacionesCercanas
PUT       /api/mapa/ubicaciones/{ubicacion}/privacidad » MapaController@updatePrivacidad
DELETE    /api/mapa/ubicaciones/{ubicacion}           » MapaController@destroy
POST      /api/adopciones/crear-con-ubicacion        » AdopcionMapaController@crearAdopcionConUbicacion
GET|HEAD  /api/adopciones/en-mapa       » AdopcionMapaController@getAdopcionesEnMapa
```

### 5️⃣ Iniciar servidor Laravel
```bash
php artisan serve
```

**Debería mostrar**:
```
INFO  Server running on [http://127.0.0.1:8000]
```

### 6️⃣ Abrir en navegador

Accede a la siguiente URL con un usuario autenticado:

```
http://127.0.0.1:8000/dashboard
```

### 7️⃣ Probar funcionalidades

#### 🗺️ Ver mapa completo
```
http://127.0.0.1:8000/mapa
```

#### 🌱 Adoptar planta con mapa
```
http://127.0.0.1:8000/catalogo-plantas/1
```
(Reemplazar `1` con el ID de una planta existente)

#### 👤 Dashboard usuario
```
http://127.0.0.1:8000/dashboard
```
(Se mostrará si eres usuario normal)

#### 👨‍💼 Dashboard admin
```
http://127.0.0.1:8000/dashboard
```
(Se mostrará si eres admin)

---

## Verificación de la Base de Datos

### Conectarse a MySQL
```bash
mysql -u root -p plantatec
```

### Ver estructura de tabla ubicaciones
```sql
DESCRIBE ubicaciones;
```

**Deberías ver las nuevas columnas**:
- `id_usuario` (BIGINT UNSIGNED NULL)
- `es_publica` (BOOLEAN DEFAULT 1)

### Ver ubicaciones creadas
```sql
SELECT * FROM ubicaciones;
SELECT id, nombre_lugar, es_publica, id_usuario FROM ubicaciones;
```

---

## En Caso de Errores

### ❌ "Migration table does not exist"
**Solución**:
```bash
php artisan migrate:install
php artisan migrate
```

### ❌ "SQLSTATE[HY000]: General error"
**Solución**:
```bash
php artisan migrate:rollback
php artisan migrate
```

### ❌ "Column 'id_usuario' doesn't exist"
**Solución**:
- Verificar que la migración se ejecutó:
```bash
php artisan migrate:status
```
- Si aparece "N" al lado de tu migración, ejecutar:
```bash
php artisan migrate
```

### ❌ "Leaflet is not defined"
**Solución**:
- Verificar que `app.blade.php` tiene las líneas de Leaflet
- Limpiar caché del navegador (Ctrl+Shift+Del)
- Verificar console (F12) para errores de red

### ❌ "Geolocation not supported"
**Solución**:
- Usar navegador moderno (Chrome 5+, Firefox 3.5+, Edge)
- En HTTPS en producción
- Dar permisos de ubicación al navegador

---

## Atajos Útiles

### Rollback de migración (si hay problemas)
```bash
php artisan migrate:rollback --step=1
```

### Ver logs en tiempo real
```bash
tail -f storage/logs/laravel.log
```

### Regenerar claves si hay problema
```bash
php artisan key:generate
```

### Resetear todo (⚠️ PELIGRO - elimina datos)
```bash
php artisan migrate:reset
php artisan migrate
```

---

## Testing Manual

### 1. Usuario normal adopta planta (público con mapa)
1. Entrar como usuario normal
2. Ir a `/catalogo-plantas/1`
3. Click "Adoptar"
4. Seleccionar "Pública"
5. Click en "Seleccionar en mapa"
6. Hacer click en el mapa o "Mi ubicación"
7. Llenar datos y enviar
8. Verificar en `/mapa` que aparece el marcador azul 🔵

### 2. Ubicación privada
1. Repetir pasos 1-4
2. Seleccionar "Privada"
3. Llenar nombre y descripción
4. Enviar
5. Verificar que NO aparece en mapa para otro usuario (privado)
6. Verificar que SÍ aparece para admin (rojo 🔴)

### 3. Verificar base de datos
```sql
SELECT u.id, u.nombre_lugar, u.es_publica, user.name 
FROM ubicaciones u 
LEFT JOIN users user ON u.id_usuario = user.id 
ORDER BY u.created_at DESC;
```

---

## Documentación Adicional

Para información más detallada, consultar:
- `MAPA_DOCUMENTACION.md` - Documentación técnica completa
- `MAPA_GUIA_RAPIDA.md` - Guía rápida de funcionalidades

---

## Soporte

Si tienes problemas:

1. Verificar que migrations se ejecutaron
2. Limpiar caché: `php artisan cache:clear`
3. Ver logs: `tail -f storage/logs/laravel.log`
4. Revisar F12 (DevTools) en navegador
5. Verificar que usuario está autenticado
6. Verificar que navegador permite geolocalización

---

**Fecha**: 17 de Mayo, 2026  
**Versión**: 1.0  
**Estado**: ✅ Listo para producción  
