# Six Food: El Coyote Hambriento

_El proyecto consiste en crear una página web con maquetado en HTML, PHP y base de datos SQL para la cafetería de una preparatoria en Coyoacán. Se incluye en el proyecto páginas de registro de usuarios, página principal, páginas para hacer pedidos y secciones que permiten orientar al cliente al momento de realizar sus pedidos. En la base de datos se almacena el registro de los pedidos de los usuarios, el menú disponible en el momento y las existencias que se tienen del producto, permitiendo de esa manera una mejor interacción con el cliente al mostrarle únicamente los productos con lo que cuenta la cafetería._

## Comenzando 🚀
### Pre-requisitos 📋

*Antes de comenzar la instalación, por favor asegúrese de tener espacio disponible en su dispositivo y una buena conexión Wi-Fi para evitar problemas durante el proceso.*

*Debe tener instalado Mamp si cuenta con un dispositio Mac para que pueda revisar y/o hacer cambios que ayudan a mejorar el proyecto. Si no cuenta con el programa, puede descargarlo en el siguiente enlace [Descargar Mamp](https://www.mamp.info/en/downloads/).*

*En caso de tener Windows, debe tener instalado Xampp para revisar y/o hacer cambios que ayudan a mejorar la base de datos y pueda abrir los archivos php en el navegador. Para descargarlo sólo siga el enlace [Descargar Xampp](https://www.apachefriends.org/es/index.html).*

*También cerciórese de haber descargado GIT en su ordenador. Puede descargarlo gratuitamente en el siguiente enlace [Descargar Git](https://git-scm.com/downloads).*

*Por último, para evitar molestias en el funcionamiento y desarrollo del proyecto, sugerimos que su editor de texto sea Atom.*
#### Por favor, siga cuidadosamente las siguientes instrucciones:

### Instalación 🔧
1. _Una vez instalado Xampp (o Mamp), asegúrese de que el campo MySQL y Apache estén encendidos y en Actions se encuentre el botón 'stop'._

```
Module | PID(s) | Port(s) | Actions
-----------------------------------
Apache |        |         | Stop
MySQL  |        |         | Stop
```

2. _Haga una carpeta dentro de xampp (o mamp) para descargar el archivo. De preferencia que tenga el mismo nombre de este repositorio, uno parecido o que pueda ser relacionado con este proyecto._

```
 📖 SixFood-El-Coyote-Hambriento
 📖 Proyecto-de-cafeteria
 📖 Repo-ej-pag-cafeteria
```

3. _En el repositorio, diríjase a [inicio](https://github.com/LuisAntMendoza/SixFood-El-Coyote-Hambriento) y busqué el recuadro de CLONE OR DOWLAND. Este se encuentra en la parte superior izquierda del cuadro "Proyecto Coyo Eats" y es de color verde._

4. _Al presionarlo se desplegará una pequeña ventana donde debe elegir **Clone with HTTPS** y presionar el icono de portapapeles 📄._

5. _Abra la terminal de su dispositivo para poder descargar los archivos. Windows + r (en Windows) y escriba 'cmd'. En caso de tener Mac, haga clic en el icono de Launchpad en el Dock, escribe Terminal en el campo de búsqueda y, a continuación, haga clic en Terminal; o nn el Finder , abre la carpeta /Aplicaciones/Utilidades y, a continuación, haga doble clic en Terminal._

6. _Ingrese a la carpeta creada, usando cd, para poder clonar el repositorio._

```
C:\Users\astri>

C:\Users\astri> cd\xampp\x\htdocs\SixFood-El-Coyote-Hambriento

C:\xampp\x\htdocs\SixFood-El-Coyote-Hambriento>

```

7. _Una vez dentro de su carpeta, escriba **git clone** y pegué el enlace que copió previamnete usando ctrl + v._

```
C:\xampp\x\htdocs\SixFood-El-Coyote-Hambriento>

C:\xampp\x\htdocs\SixFood-El-Coyote-Hambriento> git clone https://github.com/
```

8. _Ahora puede ir a su Explorador de Archivos, a la carpeta que creó para este proyecto, y encontrará todos los archivos necesarios para el correcto funcionamiento de la página._

## Funcionamiento de la página
_El php de nuestro trabajo integra gran parte de conocimientos en materia de seguridad web, bases de datos, php y html, contando de este modo con toda clase de elementos para su optimo funcionamiento. Está enfocado al desarrollo de una página funcional de utilidad en una Cafetería/Puesto de comida que se encuentra, en este caso, en la preparatoria 6 "Antonio Caso"._

_La página cuenta con distintas funciones, tales como inicio de sesiones, registro de productos, validación de usuarios, encargo de pedidos, etc., los cuales cuentan con un sistema de seguridad para la protección de nuestros usuarios, además de un diseño sencillo pero
agradable  la vista._

_Indagando más en el funcionamiento del php podemos encontrar multiples aplicaciones relacionales entre módulos que nos permiten
operaciones tales como, añadir un producto a la base de datos desde el php, denegar el acceso a ciertas acciones dentro de la interface según el rango de acceso del usuario (esto para evitar ataques o corrupciones tanto en el código como en el
funcionamiento de la base de datos), asimilaciones de productos y usuarios según sus datos de registro, protección
de contraseñas y datos sencibles mediante codificación y hasheo, además de otras funcionalidades que el mismo usuario podrá notar haciendo uso de esta página._


## Construido con 🛠️

* [Atom](https://atom.io/) - El editor de texto
* [Xampp](https://www.apachefriends.org/es/index.html) - Manejador de base de datos y despliegue de PHP

## Autores ✒️
#### Equipo Sombra:
* **Mendoza Ramirez Luis Antonio** - *Maquetado y despliegue de PHP* - [LuisAntMendoza](https://github.com/LuisAntMendoza)

* **Ramos Maldonado David Alexander** - *Maquetado HTML y PHP* - [Alexander-Chef](https://github.com/Alexander-Chef)

* **Umaña Aguirre Cristian Alberto** - *Diseño y despliegue PHP* - [CristianUmAg](https://github.com/CristianUmAg)

* **Veiga Cruz Astrid Xanat** - *Base de datos y documentación* - [astridveiga](https://github.com/astridveiga)
