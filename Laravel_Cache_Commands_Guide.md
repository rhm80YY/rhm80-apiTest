# 🚀 Guía Completa de Comandos de Cache - Laravel 12

## 📋 Índice
- [Comandos de Limpieza](#comandos-de-limpieza)
- [Comandos de Optimización](#comandos-de-optimización)
- [Comandos Específicos](#comandos-específicos)
- [Escenarios de Uso](#escenarios-de-uso)
- [Comandos para Desarrollo vs Producción](#desarrollo-vs-producción)
- [Solución de Problemas](#solución-de-problemas)

---

## 🧹 Comandos de Limpieza

### ⚡ Comando TODO-EN-UNO (Recomendado para desarrollo)
```bash
php artisan optimize:clear
```
**Qué hace:** Limpia TODA la cache de una vez
**Incluye:** config, cache, compiled, events, routes, views
**Cuándo usar:** Después de cambios importantes o cuando algo no funciona

### 🎯 Comandos Individuales de Limpieza

#### Cache de Aplicación
```bash
php artisan cache:clear
```
**Qué hace:** Limpia el cache general de la aplicación
**Cuándo usar:** Cuando cambias datos que están en cache

#### Cache de Configuración
```bash
php artisan config:clear
```
**Qué hace:** Limpia el cache de archivos de configuración
**Cuándo usar:** Después de modificar archivos en `/config/`

#### Cache de Rutas
```bash
php artisan route:clear
```
**Qué hace:** Limpia el cache de rutas
**Cuándo usar:** Después de modificar `routes/web.php` o `routes/api.php`

#### Cache de Vistas
```bash
php artisan view:clear
```
**Qué hace:** Limpia el cache de vistas Blade compiladas
**Cuándo usar:** Cuando las vistas no se actualizan

#### Cache de Eventos
```bash
php artisan event:clear
```
**Qué hace:** Limpia el cache de eventos y listeners
**Cuándo usar:** Después de modificar eventos o listeners

#### Cache de Autoloader
```bash
composer dump-autoload
```
**Qué hace:** Regenera el autoloader de Composer
**Cuándo usar:** Después de crear nuevas clases

---

## ⚡ Comandos de Optimización

### 🚀 Optimización Completa (Producción)
```bash
php artisan optimize
```
**Qué hace:** Optimiza TODA la aplicación para producción
**Incluye:** config:cache, route:cache, view:cache
**Cuándo usar:** Al desplegar en producción

### 📦 Comandos Individuales de Optimización

#### Cachear Configuración
```bash
php artisan config:cache
```
**Beneficio:** Mejora velocidad de carga
**Producción:** ✅ Sí  |  **Desarrollo:** ❌ No

#### Cachear Rutas
```bash
php artisan route:cache
```
**Beneficio:** Acelera resolución de rutas
**Producción:** ✅ Sí  |  **Desarrollo:** ❌ No

#### Cachear Vistas
```bash
php artisan view:cache
```
**Beneficio:** Pre-compila todas las vistas Blade
**Producción:** ✅ Sí  |  **Desarrollo:** ❌ No

---

## 🎯 Comandos Específicos

### Queue y Jobs
```bash
# Reiniciar workers de queue
php artisan queue:restart

# Limpiar jobs fallidos
php artisan queue:flush
```

### Base de Datos
```bash
# Limpiar cache de esquema de BD
php artisan schema:cache
```

### Storage y Links
```bash
# Recrear enlaces simbólicos
php artisan storage:link
```

---

## 📝 Escenarios de Uso

### 🔧 Durante Desarrollo

```bash
# Cuando algo no funciona (comando milagroso)
php artisan optimize:clear

# Después de cambiar rutas
php artisan route:clear

# Después de modificar config
php artisan config:clear

# Después de cambiar vistas
php artisan view:clear
```

### 🚀 Para Producción

```bash
# Al desplegar (optimizar todo)
php artisan optimize

# O paso a paso:
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 🐛 Solución de Problemas

```bash
# Problema: Las rutas no funcionan
php artisan route:clear
php artisan route:cache

# Problema: Los cambios de config no se aplican
php artisan config:clear

# Problema: Las vistas no se actualizan
php artisan view:clear

# Problema: Clases no encontradas
composer dump-autoload

# Problema: TODO está roto (reinicio completo)
php artisan optimize:clear
composer dump-autoload
```

---

## 🏗️ Desarrollo vs Producción

### 👨‍💻 **DESARROLLO**
```bash
# ✅ Usar frecuentemente
php artisan optimize:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:clear

# ❌ NO usar en desarrollo
php artisan optimize
php artisan config:cache
php artisan route:cache
```

**¿Por qué NO cachear en desarrollo?**
- Los cambios no se reflejan inmediatamente
- Dificulta el debugging
- Hace lento el desarrollo

### 🌐 **PRODUCCIÓN**
```bash
# ✅ Usar siempre
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# ⚠️ Usar con cuidado
php artisan optimize:clear  # Solo para mantenimiento
```

---

## 🔄 Scripts Útiles

### Script de Desarrollo
```bash
#!/bin/bash
# desarrollo.sh
echo "🧹 Limpiando cache para desarrollo..."
php artisan optimize:clear
php artisan view:clear
composer dump-autoload
echo "✅ Listo para desarrollar!"
```

### Script de Producción
```bash
#!/bin/bash
# produccion.sh
echo "🚀 Optimizando para producción..."
php artisan optimize:clear
php artisan optimize
php artisan view:cache
echo "✅ Aplicación optimizada!"
```

---

## ⏰ Comandos por Frecuencia de Uso

### 🔥 **Diario (Desarrollo)**
```bash
php artisan optimize:clear    # El más usado
```

### 📅 **Semanal**
```bash
composer dump-autoload       # Después de crear clases
php artisan route:clear       # Después de cambiar rutas
```

### 🗓️ **Al Desplegar**
```bash
php artisan optimize          # Cada deploy a producción
```

---

## 💡 Tips y Mejores Prácticas

### ✅ **Hacer**
- Usar `optimize:clear` cuando algo no funciona
- Limpiar cache antes de hacer commits importantes
- Optimizar siempre en producción
- Documenta qué cache limpias y por qué

### ❌ **Evitar**
- Cachear rutas en desarrollo
- Olvidar limpiar cache después de cambios grandes
- Usar `optimize:clear` en producción frecuentemente
- Cachear durante debugging

---

## 🆘 Comandos de Emergencia

```bash
# 🚨 Cuando TODO está roto
php artisan optimize:clear
composer dump-autoload
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# 🔄 Reinicio completo de la aplicación
php artisan down
php artisan optimize:clear
php artisan optimize
php artisan up
```

---

## 📊 Cheat Sheet Rápido

| Comando | Desarrollo | Producción | Frecuencia |
|---------|------------|------------|------------|
| `optimize:clear` | ✅ | ⚠️ | Diaria |
| `optimize` | ❌ | ✅ | Al desplegar |
| `cache:clear` | ✅ | ⚠️ | Según necesidad |
| `config:clear` | ✅ | ❌ | Tras cambios config |
| `route:clear` | ✅ | ❌ | Tras cambios rutas |
| `view:clear` | ✅ | ❌ | Tras cambios vistas |

---

**📅 Fecha:** $(date)  
**👨‍💻 Versión:** Laravel 12  
**📖 Autor:** Guía de Comandos de Cache  

---

*💡 Tip final: Crea alias en tu `.bashrc` para los comandos más usados:*
```bash
alias lac="php artisan optimize:clear"
alias lao="php artisan optimize"
alias lvc="php artisan view:clear"
```
