# APP TODO
### David Romera Arenas

# Instrucciones despliegue en local
- [Instala Docker Desktop](https://www.docker.com/)
- Descarga los archivos de este repositirio en tu PC
    - Con Git:
        - ` git clone https://github.com/dromeraarenas/AppToDo.git `
    - Descarga manual
        - [Pulsa aquí para descargar](https://github.com/dromeraarenas/AppToDo/archive/refs/heads/main.zip)
- Una vez te hayas descargado los archivos, abre tu consola de comandos y ve donde hayas descargado los ficheros
    - ` cd /ruta/descarga `
- Ejecuta el siguiente comando
    - ` docker compose up -d `
- Una vez haya terminado de crear los contenedores virtuales, ejecuta los siguientes comandos para crear y nutrir la base de datos.
    - ` docker exec -it api /bin/bash `
    - ` sh /tmp/run.sh `
- Listo ya puedes empezar a utilizar la aplicación, para ello deber abrir la siguiente dirección en tu navegador:
    [http://localhost:8080/](http://localhost:8080/)