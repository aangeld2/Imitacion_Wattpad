# Imitación de Wattpad

Plataforma web para escribir, publicar y leer historias, inspirada en Wattpad.

## Tecnologías

- PHP y MySQL
- HTML, CSS y JavaScript
- Base de datos `bd_libros` (script en `bd_libros.sql`) con las tablas `usuarios`, `historias` y `comentarios`.

## Qué hace

- Registro e inicio de sesión. Las contraseñas se guardan cifradas con `password_hash`.
- Perfil de usuario editable con biografía.
- Crear, editar, publicar y eliminar historias propias.
- Sección **Descubrir** para leer historias de otros usuarios.
- Comentarios en las historias.

## Cómo correrlo

1. Instala XAMPP (o cualquier servidor con PHP y MySQL).
2. Importa `bd_libros.sql` en phpMyAdmin.
3. Copia la carpeta `misitio2` a `htdocs`.
4. Ajusta los datos de conexión en `misitio2/php/config.php`.
5. Abre `http://localhost/misitio2`.

## Mejoras pendientes

- Usar consultas preparadas (`prepare`) en todas las consultas SQL para evitar inyección SQL.
- Sacar los datos de conexión del repositorio.
