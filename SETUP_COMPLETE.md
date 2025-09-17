# 🚀 Guía Completa de Configuración - Laravel API Test

## 📋 **Resumen del Proyecto**

Este proyecto Laravel demuestra cómo consumir **dos tipos diferentes de APIs externas**:

### 🌐 **1. API Pública (JSONPlaceholder)**
- **Tipo:** API de prueba sin autenticación
- **Datos:** Productos ficticios para desarrollo
- **Uso:** Seeder automático al instalar
- **Configuración:** Ninguna requerida ✅

### 🔐 **2. API con Credenciales (NewsAPI)**
- **Tipo:** API comercial con autenticación
- **Datos:** Artículos de noticias reales
- **Uso:** Sincronización manual y automática
- **Configuración:** API Key requerida 🔑

---

## 🛠️ **Requisitos Previos**

### **Software Necesario:**
- **PHP:** >= 8.2
- **Composer:** Última versión
- **MySQL:** >= 8.0 (o MariaDB >= 10.4)
- **Git:** Para clonar el repositorio
- **Conexión a internet:** Para consumir APIs externas

### **Cuentas Requeridas:**

**🟢 Para funcionalidad básica (Productos):**
- Ninguna cuenta requerida ✅

**🟡 Para funcionalidad completa (Artículos):**
- **NewsAPI:** Registro gratuito en https://newsapi.org/register

---

## 📥 **Paso 1: Clonar y Configurar Proyecto**

```bash
# Clonar repositorio
git clone https://github.com/rhm80YY/rhm80-apiTest.git
cd rhm80-apiTest

# Instalar dependencias
composer install

# Configurar archivo de entorno
cp .env.example .env
php artisan key:generate
```

---

## 🔑 **Paso 2: Configurar Variables de Entorno**

Edita el archivo `.env` con tu configuración:

```bash
# ===========================================
# CONFIGURACIÓN DE BASE DE DATOS
# ===========================================
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_api_test
DB_USERNAME=tu_usuario_mysql
DB_PASSWORD=tu_contraseña_mysql

# ===========================================
# CONFIGURACIÓN DE NEWSAPI (OBLIGATORIO)
# ===========================================
# Obtener en: https://newsapi.org/register
NEWS_API_URL=https://newsapi.org/v2/top-headlines
NEWS_API_TOKEN=tu_api_key_aqui
NEWS_API_COUNTRY=us

# ===========================================
# CONFIGURACIÓN DE APLICACIÓN
# ===========================================
APP_NAME="Laravel API Test"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000
```

---

## 📊 **Paso 3: Obtener API Key de NewsAPI**

### **3.1 Registrarse:**
1. Ir a https://newsapi.org/register
2. Completar registro gratuito
3. Verificar email si es necesario

### **3.2 Obtener API Key:**
1. Acceder a https://newsapi.org/account
2. Copiar tu API Key
3. Pegarla en `.env` como `NEWS_API_TOKEN`

### **3.3 Verificar Límites:**
- **Plan gratuito:** 100 requests por día
- **Suficiente para desarrollo y pruebas**

---

## 🗄️ **Paso 4: Configurar Base de Datos**

### **4.1 Crear Base de Datos:**
```bash
# IMPORTANTE: Laravel NO crea la BD automáticamente
mysql -u tu_usuario_mysql -p

# Dentro de MySQL:
CREATE DATABASE laravel_api_test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### **4.2 Verificar Conexión:**
```bash
# Probar conexión desde Laravel
php artisan migrate:status
```

---

## 🔧 **Paso 5: Configuración por Niveles**

### **🟢 Nivel 1: Configuración Básica (Solo Productos)**

```bash
# Ejecutar migraciones y seeders
php artisan migrate:fresh --seed
```

**✅ Que hace:**
- Crea tablas en MySQL
- Descarga 100 productos desde JSONPlaceholder (API pública)
- No requiere credenciales

**🎯 Resultado:** http://localhost:8000/products funcionando

---

### **🟡 Nivel 2: Configuración Completa (Productos + Artículos)**

```bash
# Después del Nivel 1, sincronizar artículos:
php artisan articles:sync
```

**✅ Que hace:**
- Descarga artículos actuales desde NewsAPI
- Requiere API Key configurada
- Configura sincronización automática

**🎯 Resultado:** http://localhost:8000/articles funcionando

---

## 🌐 **Paso 6: Iniciar Aplicación**

```bash
# Iniciar servidor de desarrollo
php artisan serve
```

**🔗 Aplicación disponible en:** http://localhost:8000

### **URLs Principales:**
- **Home:** http://localhost:8000/
- **Productos:** http://localhost:8000/products
- **Artículos:** http://localhost:8000/articles

---

## ✅ **Paso 7: Verificación Completa**

### **7.1 Verificar Base de Datos:**
```bash
mysql -u tu_usuario -p laravel_api_test

# Verificar datos:
SELECT COUNT(*) FROM products;    -- Debería mostrar ~100
SELECT COUNT(*) FROM articles;   -- Debería mostrar 15-20
```

### **7.2 Verificación por Niveles:**

#### **🟢 Nivel 1: Productos (API Pública)**
1. **Ir a:** http://localhost:8000/products
2. **Verificar:**
   - ✅ Lista de ~100 productos con paginación
   - ✅ Datos ficticios de JSONPlaceholder
   - ✅ Hacer clic en producto para ver detalles
   - ✅ Navegación entre páginas

#### **🟡 Nivel 2: Artículos (API con Credenciales)**
1. **Ir a:** http://localhost:8000/articles
2. **Verificar:**
   - ✅ Lista de artículos de noticias **reales**
   - ✅ Fechas visibles en cada artículo
   - ✅ Botón "🔄 Refrescar Noticias" funciona
   - ✅ Botones "Ver más" abren **sitios de noticias reales**
   - ✅ Paginación sin duplicación

---

## ⚙️ **Configuración Avanzada**

### **Sincronización Automática de Artículos**

El proyecto está configurado para sincronizar artículos automáticamente cada hora.

**Para activar en producción:**
```bash
# Agregar a crontab (Linux/Mac):
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1

# Ver scheduled tasks:
php artisan schedule:list
```

**Para desarrollo (ejecutar manualmente):**
```bash
# Ejecutar scheduler una vez:
php artisan schedule:run

# Sincronizar artículos manualmente:
php artisan articles:sync
```

---

## 🎯 **Comandos Útiles Diarios**

### **Gestión de Datos:**
```bash
# Refrescar todo (CUIDADO: borra datos)
php artisan migrate:fresh --seed && php artisan articles:sync

# Solo actualizar artículos
php artisan articles:sync

# Ver estado de migraciones
php artisan migrate:status
```

### **Mantenimiento:**
```bash
# Limpiar cache
php artisan optimize:clear

# Ver rutas disponibles
php artisan route:list

# Ver logs en tiempo real
tail -f storage/logs/laravel.log
```

---

## 🐛 **Solución de Problemas**

### **Problema: Error SSL en Windows**
```powershell
# Descargar certificados SSL
mkdir C:\php\extras\ssl
Invoke-WebRequest -Uri "https://curl.se/ca/cacert.pem" -OutFile "C:\php\extras\ssl\cacert.pem"

# Configurar php.ini:
curl.cainfo = "C:\php\extras\ssl\cacert.pem"
openssl.cafile = "C:\php\extras\ssl\cacert.pem"
```

### **Problema: NewsAPI Error 401/403**
```bash
# Verificar API Key
php -r "echo env('NEWS_API_TOKEN');"

# Limpiar cache
php artisan config:clear
php artisan cache:clear

# Probar API manualmente
curl -H "X-Api-Key: TU_API_KEY" "https://newsapi.org/v2/top-headlines?country=us"
```

### **Problema: "Base de datos no existe"**
```bash
# Laravel NO crea BD automáticamente, crearla primero:
mysql -u tu_usuario -p -e "CREATE DATABASE laravel_api_test"
```

---

## 📁 **Estructura del Proyecto**

```
laravel_api_test/
├── app/
│   ├── Console/Commands/
│   │   └── SyncArticles.php          # Comando de sincronización
│   ├── Http/Controllers/
│   │   ├── ProductController.php     # Controlador productos
│   │   └── ArticleController.php     # Controlador artículos
│   └── Models/
│       ├── Product.php               # Modelo productos
│       └── Article.php               # Modelo artículos
├── database/
│   ├── migrations/
│   │   ├── create_products_table.php
│   │   └── create_articles_table.php
│   └── seeders/
│       └── ProductSeeder.php         # Seeder productos
├── resources/views/
│   ├── products/
│   │   ├── index.blade.php          # Lista productos
│   │   └── show.blade.php           # Detalle producto
│   └── articles/
│       └── index.blade.php          # Lista artículos
└── routes/
    ├── web.php                      # Rutas web
    └── console.php                  # Scheduler config
```

---

## 🚀 **Funcionalidades Implementadas**

### ✅ **APIs Integradas:**
- [x] **JSONPlaceholder API** (sin autenticación)
- [x] **NewsAPI** (con API Key)

### ✅ **Backend:**
- [x] Comandos Artisan personalizados
- [x] Sincronización automática (scheduler)
- [x] Manejo robusto de errores
- [x] Prevención de datos duplicados
- [x] Paginación optimizada

### ✅ **Frontend:**
- [x] Interfaz responsive con Tailwind CSS
- [x] Botón de refresco manual
- [x] Fechas en múltiples formatos
- [x] Enlaces externos seguros
- [x] Paginación sin duplicación

---

## 📞 **Soporte**

Si encuentras problemas:

1. **Revisar logs:** `tail -f storage/logs/laravel.log`
2. **Verificar configuración:** `php artisan about`
3. **Limpiar cache:** `php artisan optimize:clear`
4. **Crear issue** en GitHub con detalles del error

---

## 🎉 **¡Listo!**

Tu aplicación Laravel está completamente configurada y funcionando con:
- ✅ Productos desde JSONPlaceholder
- ✅ Artículos desde NewsAPI con sincronización automática
- ✅ Interfaz web completa y responsive

**¡Disfruta desarrollando!** 🚀