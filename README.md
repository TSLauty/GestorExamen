# GestorExamen

Aplicación web para la gestión de exámenes, preguntas y resultados académicos. Permite a profesores crear pruebas y consultar resultados, mientras que los alumnos pueden realizarlas y revisar sus calificaciones.

## Funcionalidades

- Registro e inicio de sesión de usuarios.
- Separación de perfiles para profesores y alumnos.
- Creación y administración de exámenes.
- Gestión de preguntas, temas y subtemas.
- Consulta de pruebas recientes.
- Registro y consulta de resultados.

## Tecnologías

- PHP
- HTML5
- CSS
- JavaScript
- MySQL
- Docker

## Estructura del proyecto

```text
GestorExamen/
├── gestor_examenes/
│   ├── clases/              # Entidades y capa DAL
│   ├── pagina_web/          # Páginas de la aplicación
│   ├── php/                 # Procesamiento PHP y configuración
│   ├── js/                  # Scripts JavaScript
│   ├── estilos/             # Hojas de estilo CSS
│   ├── imagenes/            # Recursos gráficos
│   └── diagramas/           # Diagramas UML y de datos
├── Carpeta_de_Campo_Gestor_Examenes/
└── Daily_Scrum/
```

## Requisitos

- PHP 7.4 o superior.
- Servidor web como Apache o Nginx.
- MySQL o MariaDB.
- Navegador web moderno.
- Docker y Docker Compose, opcionalmente.

## Instalación

1. Clona el repositorio:

```bash
git clone https://github.com/TSLauty/GestorExamen.git
cd GestorExamen
```

2. Mueve `gestor_examenes` al directorio público de tu servidor web o configura un virtual host para ese directorio.

3. Crea la base de datos:

```sql
CREATE DATABASE gestor_examenes
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
```

4. Configura la conexión MySQL mediante variables de entorno:

```bash
export DB_HOST=localhost
export DB_USER=root
export DB_PASSWORD=tu_contrasena
export DB_NAME=gestor_examenes
```

La configuración predeterminada se encuentra en `gestor_examenes/php/config.php`.

5. Inicia el servidor web y MySQL, y abre:

```text
http://localhost/gestor_examenes/pagina_web/
```

## Uso

1. Abre la aplicación desde la página de inicio.
2. Crea una cuenta o inicia sesión.
3. Los profesores pueden crear exámenes y consultar resultados.
4. Los alumnos pueden realizar pruebas y consultar sus resultados.

## Documentación

- [Diagrama UML](gestor_examenes/diagramas/Diagrama%20UML.png)
- [Diagrama de casos de uso](gestor_examenes/diagramas/Diagrama%20de%20Casos%20de%20Uso.png)
- [Diagrama de modelo de datos](gestor_examenes/diagramas/Diagrama%20de%20Modelo%20de%20Datos.png)
- [Carpeta de campo](Carpeta_de_Campo_Gestor_Examenes/)
- [Seguimiento Daily Scrum](Daily_Scrum/)

## Arquitectura

La aplicación usa clases PHP y una capa DAL para separar las entidades de las operaciones de base de datos.

Entre las entidades principales se encuentran:

- Usuario
- Profesor
- Alumno
- Examen
- Pregunta
- Resultado

## Autores

Proyecto desarrollado por [TSLauty](https://github.com/TSLauty), [Kevin](https://github.com/kevin5626/), [Cesar](https://github.com/soyyocreeme2-blip/), [Leandro](https://github.com/gimenezleandro959-dot/).
