El proyecto consiste en desarrollar una aplicación web destinada a monitorear la salud y condición física de los estudiantes de primaria y secundaria en Nicaragua. Esta plataforma permitirá a escuelas, maestros, estudiantes, servidores de salud y entidades gubernamentales acceder a información crucial para la prevención y promoción de la salud, mejorando así el bienestar físico de los estudiantes.

Entre las funcionalidades principales, la aplicación incluirá perfiles de salud estudiantil, seguimiento de asistencia y participación en actividades físicas, planes de ejercicio personalizados, informes de progreso interactivos, herramientas de compromiso como reservas de lugares deportivos y notificaciones, integración con entidades de salud pública a través de una API, y un chatbot de ayuda orientado a estudiantes y padres.

La aplicación será desarrollada utilizando tecnologías como HTML, CSS con Bootstrap, JavaScript con jQuery, PHP, DataTables y Leaflet para mapas, enfocándose en la escalabilidad y en futuras mejoras para apoyar la salud estudiantil a nivel nacional.

    1. Configuración del Control de Versiones
        ◦ Se creó un repositorio en GitHub para el proyecto.
        ◦ Se configuraron las ramas principales (por ejemplo, main y develop) para facilitar el control y la gestión del código.
        ◦ Se establecieron directrices para commits, merges y pull requests, garantizando un flujo de trabajo coherente entre los miembros del equipo.
        
    2. Integración del Modelo Vista Controlador (MVC)
        ◦ Se incorporó el patrón de arquitectura MVC al proyecto, estructurando el código en capas claras de presentación, lógica y datos.
        ◦ Esta integración asegura una separación de responsabilidades, facilitando el mantenimiento y escalabilidad del proyecto.
        
    3. Incorporación de jQuery
        ◦ Se integró jQuery en el proyecto, permitiendo la manipulación eficiente del DOM y la creación de funcionalidades dinámicas.
        ◦ Se realizaron pruebas básicas para confirmar su correcta funcionalidad.
        
    4. Configuración del Entorno de PHP
        ◦ Se configuró un servidor PHP local en WAMP Server para el desarrollo y pruebas de funcionalidades backend.
        ◦ Se verificaron las versiones de PHP y se aseguraron las extensiones necesarias para el proyecto.
        
    5. Integración de DataTables
        ◦ DataTables se integró para facilitar la manipulación y visualización de grandes conjuntos de datos en tablas interactivas.
        ◦ Se realizaron pruebas para confirmar que las tablas funcionan correctamente con los datos de prueba.
        
    6. Inclusión de Leaflet para Mapas
        ◦ Se incluyó Leaflet en el proyecto para la visualización y manipulación de mapas interactivos.
        ◦ Se configuró un mapa de prueba para verificar la correcta integración y funcionamiento de Leaflet.
        
    7. Integración de mPDF
        ◦ mPDF se integró para la generación de documentos PDF a partir de HTML, permitiendo la creación de reportes personalizados dentro de la aplicación.
        ◦ Se realizaron pruebas para confirmar la correcta generación de PDFs.
        
    8. Integración de Sweet Alert
        ◦ Sweet Alert se incluyó para la creación de alertas y diálogos personalizados, mejorando la interacción del usuario con la aplicación.
        ◦ Se configuraron ejemplos básicos para asegurar su correcta funcionalidad.
        
    9. Inclusión de Bootstrap 5.3
        ◦ Bootstrap 5.3 se integró para el diseño y desarrollo de una interfaz de usuario responsiva y moderna.
        ◦ Se realizaron pruebas con componentes de Bootstrap para verificar su correcta aplicación.
        
    10. Inclusión de Complexify
        ◦ Se integró Complexify para la validación de contraseñas y asegurar que cumplan con criterios de complejidad.
        ◦ Se realizaron pruebas de validación en formularios de registro.
        
    11. Integración de Select2
        ◦ Se incluyó Select2 para mejorar la funcionalidad de los menús desplegables y la selección de opciones múltiples en formularios.
        ◦ Se configuraron ejemplos básicos para probar su funcionalidad.
        
    12. Inclusión de Chart JS
        ◦ Chart JS se integró para la creación de gráficos interactivos, permitiendo la visualización de datos de manera más intuitiva.
        ◦ Se realizaron pruebas con diferentes tipos de gráficos para confirmar su correcta integración.
        
Todas las tareas relacionadas con la configuración del entorno de desarrollo se completaron con éxito. El entorno está ahora totalmente preparado para soportar el desarrollo de las funcionalidades principales de la aplicación. El equipo de desarrollo puede proceder con las siguientes fases del proyecto, confiando en que el entorno es estable, funcional y bien estructurado.

#########################

Instalación

    Clonar el repositorio:

    bash

git clone https://github.com/nanypoe/Salud.Edu.git

Iniciar el servidor local, puede utilizarse XAMPP, WAMP-Server.

Ejecutar el script de la Base de Datos contenido en el archivo database.sql, en un gestor de Base de Datos como PHPmyAdmin o MySQL Workbench.

Iniciar la aplicación y hacer un Login, con el token proporcionado.

Iniciar el servidor lic


Contacto

Para consultas o problemas con la aplicación, contacta al equipo de desarrollo en:
Email: saludedu@soporte.com

########

Roles de usuario
Administrador

El administrador tiene acceso completo a las funcionales CRUD de la aplicación de los datos base de Escuelas, municipios, etc. Puede gestionar usuarios, revisar reportes de salud a nivel nacional, y configurar la plataforma.
Funcionalidades del Administrador:

    Gestión de usuarios:
        Crear, editar y eliminar cuentas de docentes y estudiantes.
        Asignar roles y permisos.

    Visualización de reportes:
        Generar reportes de salud a nivel escolar y nacional.
        Exportar datos en formatos PDF o CSV para su análisis.

    Configuración del sistema:
        Configurar eventos deportivos.
        Ajustar recomendaciones de actividades físicas basadas en criterios de salud pública.

Cómo usar:

    Inicio de sesión: Usar el email y la contraseña asignada para acceder al panel de administrador.
    Gestión: Desde el panel principal, utilizar la sección de administración para manejar usuarios y reportes.
    Reportes: En la pestaña de "Reportes", generar vistas y estadísticas según los datos de los estudiantes.

Docente

Los docentes son responsables de registrar y monitorear la salud de los estudiantes a su cargo. Tienen acceso a herramientas que les permiten generar reportes y ver el progreso de sus estudiantes.
Funcionalidades del Docente:

    Registro de salud de los estudiantes:
        Ingresar o actualizar datos como peso, talla e IMC.
        Revisar recomendaciones automáticas para cada estudiante.

    Visualización de progreso:
        Ver gráficos del progreso de la salud física de los estudiantes.
        Asignar actividades físicas y controlar el seguimiento.

    Notificaciones y recordatorios:
        Enviar alertas a estudiantes sobre eventos deportivos y actividades asignadas.

Cómo usar:

    Inicio de sesión: Usar el email registrado para acceder al panel de docente.
    Registrar datos de salud: Desde la pestaña "Estudiantes", seleccionar al estudiante y actualizar sus datos de salud.
    Generar reportes: Utilizar la sección de "Reportes" para ver el progreso individual o grupal.

Estudiante

Los estudiantes pueden revisar sus registros de salud, ver recomendaciones personalizadas y participar en eventos deportivos organizados por su escuela o comunidad.
Funcionalidades del Estudiante:

    Revisión de progreso:
        Ver su historial de peso, talla e IMC.
        Seguir recomendaciones personalizadas para mejorar su salud.

    Participación en eventos:
        Consultar eventos deportivos disponibles.
        Inscribirse a actividades físicas sugeridas por el docente.

    Notificaciones:
        Recibir alertas sobre nuevas actividades y eventos deportivos.

Cómo usar:

    Inicio de sesión: Usar el ID de estudiante para ingresar a la aplicación.
    Ver progreso: Desde el panel principal, acceder a la sección "Mi salud" para revisar sus datos.
    Eventos deportivos: Consultar eventos y confirmar participación desde la pestaña de "Eventos".
