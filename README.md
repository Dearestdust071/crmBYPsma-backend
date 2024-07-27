# Proyecto de Gestión de Inventario y Personal para una Estación de Bomberos

## Descripción

Proyecto desarrollado en laravel

## Tabla de Contenidos

- [Descripción](#descripción)
- [Instalación](#instalación)
- [Uso](#uso)
- [Configuración](#configuración)
- [Contribuir](#contribuir)
- [Pruebas](#pruebas)
- [Licencia](#licencia)
- [Contacto](#contacto)
- [Documentación Adicional](#documentación-adicional)

## Instalación

1. Clona este repositorio:
    ```bash
    git clone https://github.com/Dearestdust071/crmBYPsma-backend.git
    ```
2. Navega al directorio del proyecto:
    ```bash
    cd tu-repositorio
    ```
3. Configura tu entorno Docker:
    ```bash
    docker-compose up -d
    ```
4. Instala las dependencias:
    ```bash
    docker-compose exec app composer install
    docker-compose exec app npm install
    docker-compose exec app npm run dev
    ```

## Uso

1. Inicia la aplicación:
    ```bash
    docker-compose up
    ```
2. Accede a la aplicación en tu navegador en `http://localhost:8080`.

## Configuración

Configura las variables de entorno en el archivo `.env`:
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=bomberos
DB_USERNAME=root
DB_PASSWORD=admin


## Pruebas 
Para ejecutar las pruebas, usa los siguientes comandos:

docker-compose run --rm php php artisan test