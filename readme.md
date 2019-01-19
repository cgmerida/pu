# Laradminator
**_[Laravel](https://laravel.com/) PHP Framework with [Adminator](https://github.com/puikinsh/Adminator-admin-dashboard)_**  as admin dash


## Setup:
Solo se debe correr estos comandos:
```bash
git clone https://github.com/cgmerida/plantilla-rn2018.git
cd plantilla-laravel 
composer install                   # Instala las dependencias (librerias) del backend
sudo chmod 777 storage/ -R         # Permisos de almacenamiento (linux)
cp .env.example .env               # Crear las variables de entorno
php artisan key:generate           # Generar una nueva llave para Laravel
php artisan migrate:fresh --seed   # Correr las migreciones y llenar los usuarios para probar
yarn install                       # O npm i para installar las dependencias de node(>= node 9.x)
npm run production                 # Para compilar los archivos para produccion o usar npm run dev
```


## Demo:
- Local demo:  
`php artisan serve                  # Verifica la instalación (optional)`  
Open browser at [localhost:8000/admin](http://localhost:8000/admin) 

**Nota:**  
Usuario: test
Contraseña: 123456


***

## Included Packages:
#### Laravel (php):

* [Laravel Framework](https://github.com/laravel/laravel/) (5.7.*)
* [Forms & HTML](https://github.com/laravelcollective/html) : for forms

