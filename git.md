Git es un sistema de control de versiones distribuido. Permite llevar el control de los cambios realizados en archivos, especialmente código fuente, y colaborar con otros desarrolladores.

CONFIGURACIÓN INICIAL
git config --global user.name "Tu Nombre"	# Configura tu nombre, que aparecerán en tus commits
git config --global user.email "email@dominio.com" 	# Configura tu email, … aparecerán en tus commits 
Usar --global para que se aplique a todos los repositorios

CREAR UN REPOSITORIO GIT VACÍO
mkdir mi-proyecto      	# (Comando del SO) Crea una carpeta
cd = "change directory" (cambiar de directorio) 	# (Comando del SO)
cd			# Te lleva al directorio home del usuario actual
cd mi-proyecto		# Entra a la carpeta `mi-proyecto` si existe
cd ..			# Sube un nivel (al directorio padre)
cd /ruta/completa 	# Te lleva a una ruta específica en el sistema

INICIALIZAR
git init 	# (Comando de Git) Inicia un repositorio Git

CLONAR REPOSITORIO REMOTO EN LA MÁQUINA LOCAL
git clone https://github.com/usuario/repositorio.git

COMANDOS BÁSICOS DE GIT 
git status 		# Muestra el estado de los archivos en el directorio de trabajo.
git add archivo.txt       	# Agrega un solo archivo al área de preparación (staging)
git add .                 	# Agrega todos los cambios (nuevos, modificados) al área de preparación (staging) 
git commit -m "Mensaje del cambio" 	# Registra los cambios con un mensaje descriptivo
git log                   	# Muestra el historial de commits (completo)
git log --oneline         	# Muestra el historial de commits (una línea por commit)

ACTUALIZA Y FUSIONA LOS CAMBIOS DEL REPOSITORIO REMOTO A LOCAL
git pull origin main	# De REMOTO a LOCAL - Tu rama local main queda actualizada con los cambios más recientes del repositorio remoto, integrando los commits que hayan sido empujados por otros colaboradores (o por ti desde otra máquina, por ejemplo).
	Hace estas dos cosas por este orden:
git fetch origin main	# Descarga los cambios desde la rama main del repositorio remoto llamado origin (que normalmente es el repositorio en GitHub). Esto incluye commits, archivos nuevos o modificados, etc., pero todavía no los aplica a tu rama local.
git merge origin/main	# Luego, fusiona (merge) los cambios recién descargados en tu rama local actual. Si estás trabajando en la rama main en tu máquina, lo que hace lo siguiente:
•	Trae los cambios desde origin/main (el remoto)
•	Lo combina con tu rama main local

ACTUALIZA Y FUSIONA LOS COMMITS LOCALES AL REPOSITORIO REMOTO
git push origin main	# De LOCAL a REMOTO - Envía los commits de tu rama local main al repositorio remoto origin, también a su rama main.
Si otro usuario subió cambios al remoto que tú aún no tienes localmente, Git te bloqueará el push hasta que hagas un git pull primero (para evitar sobrescribir cambios).

RAMAS (BRANCHES) - Son líneas de desarrollo independientes. Por convención, la rama principal del proyecto suele llamarse main (antes solía llamarse master).
git branch                 		# Lista ramas (versiones paralelas del código)
git branch nueva-rama      	# Crea nueva rama (versiones paralelas del código)
git checkout nueva-rama    	# Cambia a nueva rama (versión)
git checkout -b dev        		# Crea y cambia a rama 'dev'
git merge			# Combina los cambios de una rama en otra.
git checkout main	# Cambia la rama actual a la rama llamada main
git merge dev		# Trae todos los cambios de la rama dev y los fusiona con la rama main

DESHACER CAMBIOS
git reset			# Deshace cambios del área de staging
git reset archivo.txt      	# Quita archivo.txt de staging
	 git checkout – archivo		# Revierte archivo al último commit (pierdes los cambios no guardados)
git checkout -- archivo.txt
git revert 			# Revierte un commit específico creando uno nuevo que lo deshace
git revert abc1234

REMOTOS
git remote				# Gestiona conexiones a repositorios remotos.
git remote -v      	              # Ver remotos
git remote add origin URL	# Agregar remoto

cambiar el mensaje del último commit, simplemente ejecuta:
git commit --amend -m "Tu nuevo mensaje aquí"

•  No cambia el contenido del commit, solo su mensaje.
•  No crea un nuevo commit, solo reemplaza el último.
Si ya hiciste push, necesitas forzar el push:
git push --force


EJEMPLO COMPLETO
# Crear repositorio
mkdir proyecto
cd proyecto
git init

# Crear archivo
echo "Hola Mundo" > hola.txt

# Guardar cambios
git add hola.txt
git commit -m "Primer commit"

# Crear rama y cambiarse
git chec	kout -b desarrollo

# Editar archivo
echo "Nueva línea" >> hola.txt

# Guardar cambios en rama desarrollo
git add .
git commit -m "Agrega línea nueva"

# Volver a main y fusionar
git checkout main
git merge desarrollo

# Subir al remoto
git remote add origin https://github.com/usuario/repositorio.git
git push -u origin main




Quick setup — if you’ve done this kind of thing before
or https://github.com/vrsirvent/s1-01-html-and-css.git
Get started by creating a new file or uploading an existing file. We recommend every repository include a README, LICENSE, and .gitignore. 
…or create a new repository on the command line
echo "# s1-01-html-and-css" >> README.md
git init
git add README.md
git commit -m "first commit"
git branch -M main
git remote add origin https://github.com/vrsirvent/s1-01-html-and-css.git
git push -u origin main
…or push an existing repository from the command line
git remote add origin https://github.com/vrsirvent/s1-01-html-and-css.git
git branch -M main
git push -u origin main

SUBIR CONTENIDO LOCAL POR PRIMERA VEZ
Pasos para subir un repositorio local a GitHub
1. Inicializa el repositorio local (si aún no lo hiciste)
git init
2. Añade y confirma tus archivos
git add .
git commit -m "Primer commit"
3. Añade el repositorio remoto (GitHub)
git remote add origin https://github.com/TUNOMBREDEUSUARIO/TUNOMBREDELREPO.git
4. Sube el contenido local al repositorio remoto
Si es la primera vez, probablemente quieras subirlo a la rama main:
git push -u origin main
Si tu rama se llama master:
git push -u origin master

