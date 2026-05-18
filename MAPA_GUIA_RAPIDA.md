# 🚀 GUÍA RÁPIDA: Mapa Interactivo PlantaTec

## Primeros Pasos

### 1. Ejecutar migración
```bash
cd c:\Users\danie\Herd\PlantaTec
php artisan migrate
```

### 2. Limpiar caché (opcional pero recomendado)
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### 3. Abrir en navegador
```
- Dashboard: http://plantatec.local/dashboard
- Mapa completo: http://plantatec.local/mapa
- Adoptar planta: http://plantatec.local/catalogo-plantas/{id}
```

## ¿Qué se implementó?

✅ **Mapa interactivo** basado en Leaflet.js  
✅ **Geolocalización HTML5** automática  
✅ **Adopción con ubicación** (pública/privada)  
✅ **Permisos de privacidad** dinámicos  
✅ **Dashboard integrado** (usuario + admin)  
✅ **APIs JSON** para datos en tiempo real  
✅ **Búsqueda geoespacial** (radio de kilómetros)  
✅ **Marcadores coloreados** (azul=público, rojo=privado)  

## Funcionalidades Principales

### Para Usuario Normal
1. Ir a "Adoptar planta"
2. Elegir una planta
3. Seleccionar ubicación:
   - **Pública**: Zona recomendada O seleccionar en mapa
   - **Privada**: Solo nombre O con ubicación en mapa
4. Si elige mapa: Click en el mapa o botón "Mi ubicación"
5. Adopción guardada ✅

### Para Administrador
1. Dashboard: Ver "Mapa de ubicaciones"
2. Puede ver TODAS las ubicaciones (públicas y privadas)
3. Acceder a `/mapa` para vista completa
4. Gestionar desde `/ubicaciones` (CRUD tradicional)

## Estructura Técnica

```
Controllers:
  └─ MapaController.php (vistas + API)
  └─ Api/AdopcionMapaController.php (lógica de adopción)
  └─ CatalogoPlantaController.php (actualizado)

Views:
  └─ components/mapa-interactivo.blade.php
  └─ mapas/index.blade.php
  └─ catalogo/show.blade.php (actualizado)
  └─ dashboard/usuario.blade.php (actualizado)
  └─ dashboard/admin.blade.php (actualizado)

Models:
  └─ Ubicacion.php (actualizado)
  └─ User.php (actualizado)

Routes:
  └─ web.php (nuevas rutas)

Database:
  └─ migrations/2026_05_17_000000_modify_ubicaciones_table.php
```

## Rutas API Disponibles

```
GET  /mapa                              # Vista del mapa
GET  /api/mapa/ubicaciones              # Obtener todas las ubicaciones
POST /api/mapa/ubicaciones              # Crear nueva ubicación
GET  /api/mapa/ubicaciones-cercanas     # Búsqueda por radio
PUT  /api/mapa/ubicaciones/{id}/privacidad  # Cambiar privacidad
DEL  /api/mapa/ubicaciones/{id}         # Eliminar ubicación

POST /api/adopciones/crear-con-ubicacion  # Adoptar + crear ubicación
GET  /api/adopciones/en-mapa            # Obtener adopciones con ubicación
```

## Debugging

### Verificar que todo funciona
```bash
# En terminal
php artisan route:list | grep mapa

# En navegador (DevTools F12)
console.log(window.mapaInstancias)
L.version
```

### Problemas comunes

**El mapa no carga:**
- Verificar que Leaflet está cargado: `console.log(L)`
- Verificar conexión a OpenStreetMap

**Geolocalización no funciona:**
- Verificar permisos del navegador
- HTTPS requerido en producción
- Probar en navegador moderno (Chrome, Firefox, Edge)

**Ubicaciones no se guardan:**
- Verificar que usuario está autenticado
- Revisar `storage/logs/laravel.log`
- Verificar coordenadas válidas (-90 a 90, -180 a 180)

## Flujo de Datos

```
Usuario en /catalogo-plantas/:id
  ↓
Selecciona: Tipo ubicación (público/privado)
  ↓
Selecciona: Método (zona recomendada / mapa)
  ↓
Si es mapa:
  - Leaflet muestra mapa interactivo
  - Usuario hace click o usa geolocalización
  - Coordenadas se guardan en window.ubicacionSeleccionada
  ↓
Usuario envía formulario
  ↓
CatalogoPlantaController.adoptar() recibe datos
  ↓
Crea Ubicacion + Adopcion en transacción
  ↓
Redirect a /adopciones con success ✅
```

## Permisos

| Acción | Usuario | Admin |
|--------|---------|-------|
| Ver ubicaciones públicas | ✅ | ✅ |
| Ver sus ubicaciones privadas | ✅ | ✅ |
| Ver TODAS las privadas | ❌ | ✅ |
| Crear ubicación | ✅ | ✅ |
| Editar propia | ✅ | ✅ |
| Editar de otros | ❌ | ✅ |

## Próximas Mejoras (Opcionales)

- [ ] Heatmap de adopciones
- [ ] Clustering de marcadores
- [ ] Filtros avanzados (planta, fecha, zona)
- [ ] Exportar datos (GeoJSON, KML)
- [ ] Notificaciones de adopciones cercanas
- [ ] Rutas de entrega para voluntarios

## Preguntas Frecuentes

**P: ¿Puedo cambiar el centro del mapa?**  
R: En `mapa-interactivo.blade.php` línea 28: `setView([25.5095, -97.1559], 13)`

**P: ¿Puedo usar otro proveedor de mapas?**  
R: Sí, cambiar `L.tileLayer` a: `https://basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png`

**P: ¿Las ubicaciones son obligatorias?**  
R: No, pueden ser sin coordenadas (solo nombre para privadas antiguas).

**P: ¿Se pueden editar ubicaciones después?**  
R: Sí, desde el controlador, pero la UI aún no lo permite. Se puede agregar fácilmente.

**P: ¿Funciona offline?**  
R: No, necesita conexión a OpenStreetMap para cargar mapa.

---

📍 **Centro**: Matamoros, Tamaulipas  
🔵 **Público**: Azul  
🔴 **Privado**: Rojo  
✅ **Estado**: Producción  
