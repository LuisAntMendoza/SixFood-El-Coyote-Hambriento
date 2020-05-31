# Six Food: El Coyote Hambriento

_El proyecto consiste en crear una página web con maquetado en HTML, PHP y base de datos SQL para la cafetería de una preparatoria en Coyoacán. Se incluye en el proyecto páginas de registro de usuarios, página principal, páginas para hacer pedidos y secciones que permiten orientar al cliente al momento de realizar sus pedidos. En la base de datos se almacena el registro de los pedidos de los usuarios, el menú disponible en el momento y las existencias que se tienen del producto, permitiendo de esa manera una mejor interacción con el cliente al mostrarle únicamente los productos con lo que cuenta la cafetería._

## Comenzando 🚀
### Pre-requisitos 📋

*Antes de comenzar la instalación, por favor asegúrese de tener espacio disponible en su dispositivo, una buena conexión Wi-Fi para evitar problemas durante el proceso y que su navegador por defecto sea Google Chrome.*

*Debe tener instalado Mamp si cuenta con un dispositivo Mac para que pueda revisar y/o hacer cambios que ayudan a mejorar el proyecto. Si no cuenta con el programa, puede descargarlo en el siguiente enlace [Descargar Mamp](https://www.mamp.info/en/downloads/).*

*En caso de tener Windows, debe tener instalado Xampp para revisar y/o hacer cambios que ayudan a mejorar la base de datos y pueda abrir los archivos php en el navegador. Para descargarlo sólo siga el enlace [Descargar Xampp](https://www.apachefriends.org/es/index.html).*

*También cerciórese de tener GIT en su ordenador. Puede descargarlo gratuitamente aquí [Descargar Git](https://git-scm.com/downloads).*

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

5. _Abra la terminal de su dispositivo para poder descargar los archivos. Windows + r (en Windows) y escriba 'cmd'. En caso de tener Mac, haga clic en el icono de Launchpad en el Dock, escriba Terminal en el campo de búsqueda y, a continuación, haga clic en Terminal; o en el Finder , abra la carpeta /Aplicaciones/Utilidades y, a continuación, haga doble clic en Terminal._

6. _Ingrese a la carpeta creada, usando cd, para poder clonar el repositorio._

```
C:\Users\astri>

C:\Users\astri> cd\xampp\x\htdocs\SixFood-El-Coyote-Hambriento

C:\xampp\x\htdocs\SixFood-El-Coyote-Hambriento>

```

7. _Una vez dentro de su carpeta, escriba **git clone** y pegué el enlace que copió previamente usando ctrl + v._

```
C:\xampp\x\htdocs\SixFood-El-Coyote-Hambriento>

C:\xampp\x\htdocs\SixFood-El-Coyote-Hambriento> git clone https://github.com/
```

8. _Ahora puede ir a su Explorador de Archivos, a la carpeta que creó para este proyecto, y encontrará todos los archivos necesarios para el correcto funcionamiento de la página._

#### Importante

9. _Vuelva a entrar en la terminal de su computadora, entre a la carpeta bin de xampp (o mamp) y haga una base de datos llamada **SixFood** con uft 8._

```
C:\Users\astri>

C:\Users\astri> cd/xampp/mysql/bin

C:\Users\astri\xampp\mysql\bin>mysql -u root

MariaDB [(none)]> CREATE DATABASE SixFood CHARACTER SET utf8 COLLATE utf8_general_ci;
```

10. _Use la base de datos creada y usando el comando SOURCE descargue en ella el archivo_ DB_SixFood.sql _._

11. **Esta página fue diseñada para dispositivos Mac. Si usted tiene Windows, debe seguir las siguientes indicaciones para el correcto  funcionamiento de la página ya que aún estamos desarrollando la versión para Windows:**
      
      - Después de haber descargado el repositorio, abra en Atom los siguientes archivos con terminación .php que se encuentran dentro de la carpeta Dynamics en los archivos d de este proyecto:
        
        - Admin
        
        - Añadicion
        
        - Añadir
        
        - Borrar
        
        - Editar
        
        - Login
        
        - Registracion
        
        - Registro
        
        - Supervisor
        
        - cambiarentrega
      
      - Use "ctrl + f" en cada página y busqué 'root'. Deberá borrar el segundo de ellos (tercer elemento dentro del paréntesis) para borrar la contraseña de root y que esto no afecte el funcionamiento de su página.

## Funcionamiento de la página
_El php de nuestro trabajo integra gran parte de conocimientos en materia de seguridad web, bases de datos, php y html, contando de este modo con toda clase de elementos para su óptimo funcionamiento. Está enfocado al desarrollo de una página funcional de utilidad en una Cafetería/Puesto de comida que se encuentra, en este caso, en la preparatoria 6 "Antonio Caso"._

_La página cuenta con distintas funciones, tales como inicio de sesiones, registro de productos, validación de usuarios, encargo de pedidos, etc., los cuales cuentan con un sistema de seguridad para la protección de nuestros usuarios, además de un diseño sencillo pero
agradable la vista._

_Indagando más en el funcionamiento del php podemos encontrar múltiples aplicaciones relacionales entre módulos que nos permiten
operaciones tales como: añadir un producto a la base de datos desde el php, denegar el acceso a ciertas acciones dentro de la interface según el rango de acceso del usuario (esto para evitar ataques o corrupciones tanto en el código como en el
funcionamiento de la base de datos), asimilaciones de productos y usuarios según sus datos de registro, protección
de contraseñas y datos sensibles mediante codificación y hasheo, además de otras funciones que el mismo usuario podrá notar haciendo uso de esta página._

#### Probar la cuenta del administrador y los permisos que tiene dentro de la página

1. _Debe entrar desde el log in de alumno con los siguientes datos:_
    
    - Usuario: 998877665
    
    - Contraseña: G0dAdm!n369

## Construido con 🛠️

* [Atom](https://atom.io/) - El editor de texto
* [Xampp](https://www.apachefriends.org/es/index.html) - Manejador de base de datos y despliegue de PHP

## Autores ✒️
#### Equipo Sombra:
* **Mendoza Ramirez Luis Antonio** - *Maquetado y despliegue de PHP* - [LuisAntMendoza](https://github.com/LuisAntMendoza)

* **Ramos Maldonado David Alexander** - *Maquetado HTML y PHP* - [Alexander-Chef](https://github.com/Alexander-Chef)

* **Umaña Aguirre Cristian Alberto** - *Diseño y despliegue PHP* - [CristianUmAg](https://github.com/CristianUmAg)

* **Veiga Cruz Astrid Xanat** - *Base de datos y documentación* - [astridveiga](https://github.com/astridveiga)
