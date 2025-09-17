# 🚀 Laravel API Test - Proyecto Completo

**Versión:** Laravel 12  
**Propósito:** Sistema de consumo de APIs externas con seeders y base de datos MySQL  

---

## 📋 **Descripción del Proyecto**

Este proyecto Laravel implementa un sistema completo que consume **dos tipos de APIs externas**:

### 🌐 **API Pública (Sin Credenciales):**
- ✅ **JSONPlaceholder API** - Productos de prueba
- ✅ **Acceso libre** sin autenticación
- ✅ **Seeder automático** al instalar

### 🔐 **API con Credenciales:**
- ✅ **NewsAPI** - Artículos de noticias reales
- ✅ **Requiere API Key** gratuita
- ✅ **Sincronización manual y automática**

### ⚙️ **Características Técnicas:**
- ✅ **Migraciones MySQL** con seeders inteligentes
- ✅ **Paginación optimizada** sin duplicación
- ✅ **Diseño responsive** con Tailwind CSS
- ✅ **Comandos Artisan** personalizados
- ✅ **Manejo de errores** robusto

---

## 🛠️ **Requisitos del Sistema**

### **Software Necesario:**
- **PHP:** >= 8.2
- **Composer:** Última versión
- **MySQL:** >= 8.0 (o MariaDB >= 10.4)
- **Node.js:** >= 18 (opcional, para assets)
- **Git:** Para clonar el repositorio

### **Extensiones PHP requeridas:**
- `php-mysql`
- `php-mbstring` 
- `php-xml`
- `php-curl`
- `php-zip`
- `php-bcmath`
- `php-tokenizer`
- `php-openssl` (importante para HTTPS/SSL)

---

## 🚀 **Instalación Paso a Paso**

> **⚠️ Importante:** Este proyecto utiliza Laravel/Guzzle para consumir APIs externas vía HTTPS. Es esencial configurar correctamente los certificados SSL para evitar errores de conexión.

### **1. Clonar el Repositorio**
```bash
git clone https://github.com/rhm80YY/rhm80-apiTest.git
cd rhm80-apiTest
```

### **2. Configuración Específica por Sistema Operativo**

#### **🐧 Linux (Ubuntu/Debian)**

**Instalar dependencias del sistema:**
```bash
# Actualizar repositorios
sudo apt update

# Instalar PHP y extensiones necesarias
sudo apt install php8.2 php8.2-cli php8.2-mysql php8.2-mbstring php8.2-xml php8.2-curl php8.2-zip php8.2-bcmath php8.2-tokenizer php8.2-openssl

# Instalar Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Verificar certificados SSL (generalmente ya están configurados)
php -r "print_r(openssl_get_cert_locations());"
```

**Para CentOS/RHEL:**
```bash
# Instalar repositorio EPEL
sudo yum install epel-release

# Instalar PHP y extensiones
sudo yum install php php-cli php-mysql php-mbstring php-xml php-curl php-zip php-bcmath php-tokenizer php-openssl
```

#### **💻 Windows**

**⚠️ Configuración OBLIGATORIA para Windows:**

PHP en Windows NO incluye certificados SSL por defecto, lo que causará errores al consumir APIs HTTPS.

**Paso 1: Descargar certificados SSL**
```powershell
# Crear directorio para certificados
mkdir C:\php\extras\ssl

# Descargar cacert.pem desde curl.se
Invoke-WebRequest -Uri "https://curl.se/ca/cacert.pem" -OutFile "C:\php\extras\ssl\cacert.pem"
```

**Paso 2: Configurar php.ini**

Editar el archivo `php.ini` y agregar/modificar las siguientes líneas:

```ini
; Configuración SSL para Windows
curl.cainfo = "C:\php\extras\ssl\cacert.pem"
openssl.cafile = "C:\php\extras\ssl\cacert.pem"

; Habilitar extensiones necesarias
extension=curl
extension=openssl
extension=mbstring
extension=pdo_mysql
extension=zip
```

**Paso 3: Reiniciar servidor web/PHP**
```powershell
# Si usas XAMPP
net stop apache2.4
net start apache2.4

# Si usas servidor integrado de PHP, reiniciar el comando
```

**Verificar configuración SSL:**
```powershell
# Verificar que los certificados estén configurados
php -r "var_dump(ini_get('curl.cainfo')); var_dump(ini_get('openssl.cafile'));"

# Probar conexión HTTPS
php -r "echo file_get_contents('https://jsonplaceholder.typicode.com/posts/1');"
```

### **3. Instalar Dependencias PHP**
```bash
# En todos los sistemas
composer install
```

### **4. Configurar Variables de Entorno**
```bash
# Copiar archivo de configuración
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate
```

### **5. Configurar Base de Datos MySQL**

#### **Editar archivo .env**
Editar el archivo `.env` con tus credenciales MySQL:

```bash
# Configuración de Base de Datos
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_api
DB_USERNAME=tu_usuario_mysql
DB_PASSWORD=tu_contraseña_mysql

# Configuración de NewsAPI (para artículos)
NEWS_API_URL=https://newsapi.org/v2/top-headlines
NEWS_API_TOKEN=tu_api_key_de_newsapi
NEWS_API_COUNTRY=us
```

### **6. Crear Base de Datos MySQL**
```bash
# PRIMERO: Crear la base de datos manualmente
mysql -u tu_usuario_mysql -p

# Dentro de MySQL:
CREATE DATABASE laravel_api CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### **7. Configurar APIs**

#### **7.1 API Pública (JSONPlaceholder) - Productos**
✅ **No requiere configuración adicional**
- Se ejecuta automáticamente con los seeders
- Acceso libre sin credenciales
- Proporciona datos de prueba para desarrollo

#### **7.2 API con Credenciales (NewsAPI) - Artículos**

**Obtener API Key de NewsAPI:**
1. Ir a https://newsapi.org/register
2. Registrarse gratuitamente (plan gratuito: 100 requests/día)
3. Copiar tu API Key desde https://newsapi.org/account
4. Agregar las variables en `.env` (ver sección anterior)

### **8. Ejecutar Migraciones y Seeders**
```bash
# Ejecutar migraciones y seeders (incluye productos)
php artisan migrate:fresh --seed

# Sincronizar artículos desde NewsAPI (requiere API Key)
php artisan articles:sync
```

**¿Qué hace este comando?**
- ✅ **Ejecuta todas las migraciones** (crea tablas)
- ✅ **Ejecuta todos los seeders** (llena datos desde API)
- ⚠️  **NO crea la base de datos** (debe existir previamente)

### **7.1 Alternativa: Paso a Paso**
Si prefieres hacerlo paso a paso:

```bash
# Limpiar cache de configuración
php artisan config:clear

# Ejecutar migraciones (crea tablas)
php artisan migrate

# Ejecutar seeder específico (llena datos)
php artisan db:seed --class=ProductSeeder
```

### **8. Configurar Storage (opcional)**
```bash
# Crear enlace simbólico para storage público
php artisan storage:link
```

### **9. Instalar Assets Frontend (opcional)**
```bash
# Instalar dependencias Node.js
npm install

# Compilar assets
npm run build
```

### **10. Iniciar Servidor de Desarrollo**
```bash
php artisan serve
```

**🌐 Aplicación disponible en:** http://localhost:8000

---

## ⚡ **Instalación Express (Para usuarios avanzados)**

### **📊 Nivel 1: Solo API Pública (Productos)**
```bash
# 1. Clonar y configurar
git clone https://github.com/rhm80YY/rhm80-apiTest.git
cd rhm80-apiTest
composer install && cp .env.example .env && php artisan key:generate

# 2. Crear base de datos MySQL
mysql -u tu_usuario -p -e "CREATE DATABASE laravel_api"

# 3. Editar .env con credenciales MySQL, luego:
php artisan migrate:fresh --seed && php artisan serve
```
**✅ Funciona:** http://localhost:8000/products (sin credenciales)

### **📰 Nivel 2: API Completa (Productos + Artículos)**
```bash
# Después del Nivel 1:
# 4. Obtener API Key de NewsAPI (newsapi.org/register)
# 5. Agregar a .env:
#    NEWS_API_TOKEN=tu_api_key_aqui

# 6. Sincronizar artículos:
php artisan articles:sync
```
**✅ Funciona:** http://localhost:8000/articles (con credenciales)

> **⚠️ Windows:** Si obtienes errores SSL, configurar certificados primero (ver sección Windows).

---

## 📁 **Estructura del Proyecto**

### **Controladores:**
- `app/Http/Controllers/ProductController.php` - Manejo de productos
- `app/Http/Controllers/ArticleController.php` - Manejo de artículos
- `app/Http/Controllers/ApiDemoController.php` - Demo de consumo de API

### **Modelos:**
- `app/Models/Product.php` - Modelo de productos con fillables y casts
- `app/Models/Article.php` - Modelo de artículos de noticias

### **Comandos Artisan:**
- `app/Console/Commands/SyncArticles.php` - Sincronización de artículos desde NewsAPI

### **Migraciones:**
- `database/migrations/2025_09_11_165800_create_products_table.php` - Tabla products
- `database/migrations/2025_09_15_212005_create_articles_table.php` - Tabla articles
- `database/migrations/2025_09_16_003727_alter_url_to_image_column_on_articles_table.php` - Ajuste columna URL imagen

### **Seeders:**
- `database/seeders/ProductSeeder.php` - Consume JSONPlaceholder API

### **Vistas:**
- `resources/views/products/index.blade.php` - Listado de productos
- `resources/views/products/show.blade.php` - Detalle de producto
- `resources/views/articles/index.blade.php` - Listado de artículos con refresco manual
- `resources/views/layouts/app.blade.php` - Layout principal

### **Rutas:**
- `/products` - Listado de productos con paginación
- `/products/{id}` - Vista individual de producto
- `/articles` - Listado de artículos de noticias
- `/articles/sync` - Sincronizar artículos manualmente
- `/posts` - Demo de consumo de API

---

## 🌐 **APIs Externas Utilizadas**

### **JSONPlaceholder Posts API**
- **URL:** https://jsonplaceholder.typicode.com/posts
- **Método:** GET
- **Respuesta:** 100 posts de prueba
- **Uso:** Poblar tabla `products` mediante seeder
- **Autenticación:** No requiere

### **NewsAPI**
- **URL:** https://newsapi.org/v2/top-headlines
- **Método:** GET
- **Respuesta:** Artículos de noticias actuales
- **Uso:** Poblar tabla `articles` mediante comando `articles:sync`
- **Autenticación:** API Key requerida (header `X-Api-Key`)
- **Configuración:** Variables `NEWS_API_*` en `.env`

### **Estructura de datos de la API:**
```json
{
  "userId": 1,
  "id": 1,
  "title": "sunt aut facere repellat provident occaecati",
  "body": "quia et suscipit suscipit recusandae..."
}
```

---

## 🗄️ **Estructura de Base de Datos**

### **Tabla: `products`**
| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | bigint (PK) | Clave primaria auto-incremental |
| `title` | varchar(255) | Título del producto |
| `body` | text | Descripción del producto |
| `user_id` | int | ID del usuario asociado |
| `api_id` | int (unique) | ID único de la API externa |
| `created_at` | timestamp | Fecha de creación |
| `updated_at` | timestamp | Fecha de actualización |

### **Tabla: `articles`**
| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | bigint (PK) | Clave primaria auto-incremental |
| `source` | varchar(255) | Fuente de la noticia |
| `author` | varchar(255) | Autor del artículo |
| `title` | varchar(255) | Título del artículo |
| `description` | text | Descripción del artículo |
| `url` | varchar(500) (unique) | URL del artículo original |
| `urlToImage` | varchar(500) | URL de la imagen destacada |
| `publishedAt` | datetime | Fecha de publicación |
| `content` | text | Contenido del artículo |
| `created_at` | timestamp | Fecha de creación |
| `updated_at` | timestamp | Fecha de actualización |

---

## ⚙️ **Comandos Útiles**

### **Base de Datos:**
```bash
# Re-ejecutar migraciones (CUIDADO: borra datos)
php artisan migrate:fresh

# Re-ejecutar migraciones y seeders
php artisan migrate:fresh --seed

# Solo ejecutar seeder específico
php artisan db:seed --class=ProductSeeder

# Verificar status de migraciones
php artisan migrate:status
```

### **Artículos (NewsAPI):**
```bash
# Sincronizar artículos desde NewsAPI
php artisan articles:sync

# Verificar sincronización automática (scheduler)
php artisan schedule:list

# Ejecutar scheduler manualmente (desarrollo)
php artisan schedule:run

# Ver logs de sincronización
tail -f storage/logs/laravel.log
```

### **Cache:**
```bash
# Limpiar toda la cache
php artisan optimize:clear

# Optimizar para producción
php artisan optimize
```

### **Información del Sistema:**
```bash
# Ver configuración actual
php artisan env

# Ver rutas disponibles
php artisan route:list

# Ver información de la aplicación
php artisan about
```

---

## 🧪 **Verificación de Instalación**

### **1. Verificar Base de Datos:**
```bash
# Comprobar conexión a BD
php artisan migrate:status

# Deberías ver las tablas: users, products, cache, jobs
```

### **2. Verificar Datos:**
```bash
# Acceder a MySQL y verificar datos
mysql -u tu_usuario -p laravel_api
SELECT COUNT(*) FROM products;
SELECT COUNT(*) FROM articles;

# Deberías ver:
# - 100 registros en products
# - N registros en articles (dependiendo de NewsAPI)
```

### **3. Verificar Aplicación Web:**
1. **Productos:** Visitar http://localhost:8000/products
   - Deberías ver lista de productos con paginación
   - Hacer clic en un producto para ver detalles

2. **Artículos:** Visitar http://localhost:8000/articles
   - Deberías ver lista de artículos de noticias
   - Probar botón "Refrescar Noticias"
   - Verificar paginación y fechas
   - Probar botón "Ver más" en cada artículo

---

## 🐛 **Solución de Problemas Comunes**

### **Error: "SSL certificate problem" o "cURL error 60"**

**💻 Problema específico de Windows:**

Este error aparece al ejecutar los seeders porque PHP no puede verificar certificados SSL de APIs externas.

```
cURL error 60: SSL certificate problem: unable to get local issuer certificate
```

**⚙️ Solución:**

1. **Verificar configuración actual:**
```powershell
php -r "var_dump(ini_get('curl.cainfo')); var_dump(ini_get('openssl.cafile'));"
```

2. **Si no está configurado, seguir pasos de la sección Windows:**
   - Descargar `cacert.pem`
   - Configurar `php.ini`
   - Reiniciar servidor

3. **Verificar conexión:**
```powershell
php -r "echo file_get_contents('https://jsonplaceholder.typicode.com/posts/1');"
```

4. **Alternativa temporal (NO recomendada para producción):**

Si necesitas una solución rápida para desarrollo, puedes deshabilitar la verificación SSL editando el seeder:

```php
// En database/seeders/ProductSeeder.php
$response = Http::withOptions([
    'verify' => false, // Solo para desarrollo
])->get('https://jsonplaceholder.typicode.com/posts');
```

**🐧 Para Linux:**

Generalmente los certificados SSL ya están configurados, pero si encuentras problemas:

```bash
# Ubuntu/Debian
sudo apt-get update && sudo apt-get install ca-certificates

# CentOS/RHEL
sudo yum update ca-certificates
```

### **Error: "could not find driver"**
```bash
# Instalar extensión MySQL para PHP
sudo apt-get install php-mysql
# o
sudo yum install php-mysql
```

### **Error: "Access denied for user"**
- Verificar credenciales en `.env`
- Asegurar que el usuario MySQL tiene permisos
- Probar conexión manual: `mysql -u usuario -p`

### **Error: "Base de datos no existe"**
**Laravel NO puede crear la BD, debes crearla manualmente:**
```bash
# OBLIGATORIO: Crear base de datos antes de migrate
mysql -u tu_usuario -p -e "CREATE DATABASE laravel_api"

# Luego ejecutar migraciones
php artisan migrate:fresh --seed
```

### **Error: "API seeder failed"**

**Posibles causas:**
1. **Problemas de SSL/certificados** (especialmente en Windows) - Ver sección anterior
2. **Conexión a internet** - Verificar conectividad
3. **API temporalmente no disponible** - JSONPlaceholder puede tener mantenimiento
4. **Timeout de conexión** - La API puede tardar en responder

**Soluciones:**
```bash
# Reintentar seeder
php artisan db:seed --class=ProductSeeder

# Verificar conectividad a la API
curl -I https://jsonplaceholder.typicode.com/posts

# Ver logs detallados del error
tail -f storage/logs/laravel.log
```

**Si el problema persiste en Windows, revisar configuración SSL.**

### **Error: "NewsAPI authentication failed"**

**Problema con credenciales de NewsAPI:**

Si al ejecutar `php artisan articles:sync` obtienes errores 401 o 403:

```
Error al conectar con NewsAPI: 401
```

**Soluciones:**
1. **Verificar API Key:**
```bash
# Comprobar que la variable esté configurada
php -r "echo env('NEWS_API_TOKEN');"
```

2. **Verificar cuenta NewsAPI:**
   - Ir a https://newsapi.org/account
   - Verificar que tu API Key esté activa
   - Comprobar límites de uso (gratuito: 100 requests/día)

3. **Probar API manualmente:**
```bash
curl -H "X-Api-Key: TU_API_KEY" "https://newsapi.org/v2/top-headlines?country=us"
```

4. **Limpiar cache de configuración:**
```bash
php artisan config:clear
php artisan cache:clear
```

### **Error: "Vistas no se actualizan"**
```bash
# Limpiar cache de vistas
php artisan view:clear
```

---

## 📊 **Funcionalidades Implementadas**

### ✅ **Backend:**
- [x] **Consumo de APIs externas** con HTTP Client (JSONPlaceholder y NewsAPI)
- [x] **Seeders automáticos** con manejo de errores
- [x] **APIs con credenciales** (NewsAPI con API Key)
- [x] **Comandos Artisan personalizados** (articles:sync)
- [x] **Sincronización automática** con scheduler
- [x] **Migraciones de base de datos** con MySQL
- [x] **Modelos Eloquent** con fillables y casts
- [x] **Controladores RESTful** con paginación
- [x] **Prevención de duplicados** con updateOrCreate
- [x] **Manejo de errores** robusto

### ✅ **Frontend:**
- [x] **Vistas Blade** responsive
- [x] **Paginación** con Tailwind CSS (sin duplicación)
- [x] **Layout base** reutilizable
- [x] **Navegación** entre listado y detalles
- [x] **Botón de refresco manual** para artículos
- [x] **Fechas visibles** en formatos completo y relativo
- [x] **Botones "Ver más"** con enlaces externos
- [x] **Mensajes de feedback** al usuario
- [x] **Diseño mobile-friendly**

### ✅ **DevOps:**
- [x] **Git workflow** con ramas de feature
- [x] **Documentación completa** del proyecto
- [x] **Guías de instalación** paso a paso
- [x] **Comandos de cache** optimizados

---

## 🚀 **Próximos Pasos Sugeridos**

### **Funcionalidades adicionales:**
1. **Autenticación** con Laravel Sanctum
2. **API REST** propia con recursos
3. **Tests unitarios** y de integración
4. **Cache de API** con Redis
5. **Background jobs** para seeders grandes
6. **Búsqueda y filtros** avanzados
7. **Exportación** de datos (CSV, PDF)

### **Optimizaciones técnicas:**
1. **Eager loading** para relaciones
2. **Database indexing** en campos frecuentes
3. **API rate limiting** 
4. **Image optimization**
5. **PWA capabilities**

---

## 📖 **Recursos y Referencias**

### **Documentación:**
- [Laravel 12 Docs](https://laravel.com/docs)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [JSONPlaceholder API](https://jsonplaceholder.typicode.com/)

### **Comandos de referencia:**
- Ver: `Laravel_Cache_Commands_Guide.md` en el proyecto
- Ver: `Documentacion_Rama_Integration_API_MySQL_Seeders.md`

---

## 🤝 **Contribuir al Proyecto**

1. Fork el repositorio
2. Crear rama de feature: `git checkout -b feature/nueva-funcionalidad`  
3. Commit cambios: `git commit -m 'feat: agregar nueva funcionalidad'`
4. Push a la rama: `git push origin feature/nueva-funcionalidad`
5. Crear Pull Request

---

## 📄 **Licencia**

Este proyecto está bajo la licencia [MIT License](https://opensource.org/licenses/MIT).

---

## 👨‍💻 **Autor**

**Proyecto Laravel API Test**  
**Repositorio:** https://github.com/rhm80YY/rhm80-apiTest  
**Fecha:** Septiembre 2025  

---

## 📞 **Soporte**

Si encuentras algún problema durante la instalación:

1. **Revisar esta documentación** completa
2. **Verificar requisitos del sistema**
3. **Comprobar logs** en `storage/logs/laravel.log`
4. **Crear un Issue** en GitHub con detalles del error

---

*💡 Esta documentación se mantiene actualizada con cada nueva funcionalidad del proyecto.*