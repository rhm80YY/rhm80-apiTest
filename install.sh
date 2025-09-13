#!/bin/bash

# 🚀 Script de Instalación Automática - Laravel API Test
# Este script automatiza todo el proceso de instalación

echo "🚀 Iniciando instalación de Laravel API Test..."
echo "================================================="

# Verificar si Composer está instalado
if ! command -v composer &> /dev/null; then
    echo "❌ Error: Composer no está instalado"
    echo "📥 Instala Composer desde: https://getcomposer.org"
    exit 1
fi

# Verificar si PHP está instalado
if ! command -v php &> /dev/null; then
    echo "❌ Error: PHP no está instalado"
    exit 1
fi

echo "✅ PHP $(php -v | head -1 | cut -d' ' -f2) encontrado"
echo "✅ Composer encontrado"

# Instalar dependencias
echo ""
echo "📦 Instalando dependencias de Composer..."
composer install --no-interaction --prefer-dist --optimize-autoloader

if [ $? -ne 0 ]; then
    echo "❌ Error instalando dependencias"
    exit 1
fi

# Configurar archivo .env
echo ""
echo "⚙️  Configurando variables de entorno..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "✅ Archivo .env creado desde .env.example"
else
    echo "ℹ️  Archivo .env ya existe, manteniéndolo"
fi

# Generar clave de aplicación
echo ""
echo "🔑 Generando clave de aplicación..."
php artisan key:generate --no-interaction

# Limpiar cache
echo ""
echo "🧹 Limpiando cache..."
php artisan config:clear --no-interaction

# Verificar configuración de base de datos
echo ""
echo "🗄️  Verificando configuración de base de datos..."

# Leer configuración del .env
DB_DATABASE=$(grep -E '^DB_DATABASE=' .env | cut -d'=' -f2)
DB_USERNAME=$(grep -E '^DB_USERNAME=' .env | cut -d'=' -f2)
DB_PASSWORD=$(grep -E '^DB_PASSWORD=' .env | cut -d'=' -f2)

if [ -z "$DB_DATABASE" ] || [ -z "$DB_USERNAME" ]; then
    echo "⚠️  IMPORTANTE: Debes configurar tu base de datos MySQL en el archivo .env:"
    echo ""
    echo "   DB_DATABASE=laravel_api"
    echo "   DB_USERNAME=tu_usuario_mysql"
    echo "   DB_PASSWORD=tu_contraseña_mysql"
    echo ""
    echo "📝 Edita el archivo .env y luego ejecuta:"
    echo "   php artisan migrate:fresh --seed"
    echo ""
else
    echo "✅ Configuración de BD encontrada: ${DB_DATABASE}"
    
    # Intentar ejecutar migraciones y seeders
    echo ""
    echo "🏗️  Configurando base de datos..."
    echo "   (Esto creará la BD, tablas y datos automáticamente)"
    
    php artisan migrate:fresh --seed --no-interaction
    
    if [ $? -eq 0 ]; then
        echo ""
        echo "🎉 ¡INSTALACIÓN COMPLETADA EXITOSAMENTE!"
        echo "================================================="
        echo ""
        echo "🌐 Para iniciar el servidor:"
        echo "   php artisan serve"
        echo ""
        echo "📱 Luego visita:"
        echo "   http://localhost:8000/products"
        echo ""
        echo "📚 Documentación completa en README.md"
        echo ""
    else
        echo ""
        echo "⚠️  Las migraciones fallaron. Posibles causas:"
        echo "   • MySQL no está corriendo"
        echo "   • Credenciales incorrectas en .env"
        echo "   • Base de datos no accesible"
        echo ""
        echo "🔧 Para solucionarlo:"
        echo "   1. Verifica que MySQL esté corriendo"
        echo "   2. Revisa las credenciales en .env"
        echo "   3. Ejecuta: php artisan migrate:fresh --seed"
        echo ""
    fi
fi

echo ""
echo "📖 Para más información, consulta el README.md"
echo "================================================="