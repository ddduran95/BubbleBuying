<?php  ?>
<!DOCTYPE html>
<html lang="en">
  <!-- head-->
  <head>
    <title>Buying Bubble</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./iconos/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Maven+Pro" rel="stylesheet">
	<script src="index.js"></script>
  </head>
  <body>
    <!-- INICIO header-->
    <header>
      <div class="logo"></div>
      <div class = "bloque_header" >
        <a class= "btn_buscar" href="#"><i class="fa fa-search"></i></a>
        <input type="text" class = "buscar" placeholder="buscar">
      </div>
      <div class = "bloque_header" >

          <!-- Boton si esta logeuado -->
      	<?php if (isset($currentuser)): ?>
      	  <li><?= sprintf(i18n("Hello %s"), $currentuser) ?>
      	  <a 	href="index.php?controller=users&amp;action=logout">(Logout)</a>
      	  </li>
          <!-- Boton si NO esta logeuado -->
      	<?php else: ?>
      	  <li><a href="index.php?controller=users&amp;action=login"><?= i18n("Login") ?></a></li>
      	  <?php endif ?>

          <div class="dropdown">
              <i class="fa fa-globe	 fa-2x dropbtn" aria-hidden="false"> </i>
              <div class="dropdown-content">
                  <a href="#">Español</a>
                  <a href="#">English</a>
                  <a href="#">Galego-Portuguish</a>
              </div>
          </div>
      </div>
    </header>
    <!-- FIN header-->
    <!-- INICIO article "medio" -->
    <article id="maincontent">
      <div class = "main">
        <a class="btn_producto" href="#">
            <div class="cuadro_producto">
        			<img src="imgs/taza.jpg" height="150" width="150" style="border-top-left-radius:7px;border-top-right-radius:7px">
        			<p class = "precio"> 5€</p>
        			<p class = "titulo"> Taza bonita</p>
        			<p class = "descripcion"> Esta casi sin usar, solo en dia en naviadad para brindar.</p>
                <a class="btn_categoria" href="#">
                  <div class="categorias">
        			         <div class = "categoria"><i class="fa fa-tag"></i> cosas de casa </div>
                    </div>
                </a>
                <a class="btn_vendedor" href="#">
                  <div class = "cuadro_vendedor">
                      <div class = "texto_vendedor">
                        <img src = "imgs/luky.png" height="40" width="40" style="border-radius: 100%; border: 1px solid black">
                      </div>
                      <div class = "texto_vendedor">
                        <strong> Luky Estrela Camiñador</strong>
                        <div> 32 productos </div>
                      </div>
                  </div>
                </a>
            </div>
        </a>
        <a class="btn_producto" href="#">
            <div class="cuadro_producto">
        			<img src="imgs/taza.jpg" height="150" width="150" style="border-top-left-radius:7px;border-top-right-radius:7px">
        			<p class = "precio"> 5€</p>
        			<p class = "titulo"> Taza bonita</p>
        			<p class = "descripcion"> Esta casi sin usar, solo en dia en naviadad para brindar.</p>
                <a class="btn_categoria" href="#">
                  <div class="categorias">
        			         <div class = "categoria"><i class="fa fa-tag"></i> cosas de casa </div>
                    </div>
                </a>
                <a class="btn_vendedor" href="#">
                  <div class = "cuadro_vendedor">
                      <div class = "texto_vendedor">
                        <img src = "imgs/luky.png" height="40" width="40" style="border-radius: 100%; border: 1px solid black">
                      </div>
                      <div class = "texto_vendedor">
                        <strong> Luky Estrela Camiñador</strong>
                        <div> 32 productos </div>
                      </div>
                  </div>
                </a>
            </div>
        </a>
        <a class="btn_producto" href="#">
            <div class="cuadro_producto">
        			<img src="imgs/taza.jpg" height="150" width="150" style="border-top-left-radius:7px;border-top-right-radius:7px">
        			<p class = "precio"> 5€</p>
        			<p class = "titulo"> Taza bonita</p>
        			<p class = "descripcion"> Esta casi sin usar, solo en dia en naviadad para brindar.</p>
                <a class="btn_categoria" href="#">
                  <div class="categorias">
        			         <div class = "categoria"><i class="fa fa-tag"></i> cosas de casa </div>
                    </div>
                </a>
                <a class="btn_vendedor" href="#">
                  <div class = "cuadro_vendedor">
                      <div class = "texto_vendedor">
                        <img src = "imgs/luky.png" height="40" width="40" style="border-radius: 100%; border: 1px solid black">
                      </div>
                      <div class = "texto_vendedor">
                        <strong> Luky Estrela Camiñador</strong>
                        <div> 32 productos </div>
                      </div>
                  </div>
                </a>
            </div>
        </a>
        <a class="btn_producto" href="#">
            <div class="cuadro_producto">
        			<img src="imgs/taza.jpg" height="150" width="150" style="border-top-left-radius:7px;border-top-right-radius:7px">
        			<p class = "precio"> 5€</p>
        			<p class = "titulo"> Taza bonita</p>
        			<p class = "descripcion"> Esta casi sin usar, solo en dia en naviadad para brindar.</p>
                <a class="btn_categoria" href="#">
                  <div class="categorias">
        			         <div class = "categoria"><i class="fa fa-tag"></i> cosas de casa </div>
                    </div>
                </a>
                <a class="btn_vendedor" href="#">
                  <div class = "cuadro_vendedor">
                      <div class = "texto_vendedor">
                        <img src = "imgs/luky.png" height="40" width="40" style="border-radius: 100%; border: 1px solid black">
                      </div>
                      <div class = "texto_vendedor">
                        <strong> Luky Estrela Camiñador</strong>
                        <div> 32 productos </div>
                      </div>
                  </div>
                </a>
            </div>
        </a>
        <a class="btn_producto" href="#">
            <div class="cuadro_producto">
        			<img src="imgs/taza.jpg" height="150" width="150" style="border-top-left-radius:7px;border-top-right-radius:7px">
        			<p class = "precio"> 5€</p>
        			<p class = "titulo"> Taza bonita</p>
        			<p class = "descripcion"> Esta casi sin usar, solo en dia en naviadad para brindar.</p>
                <a class="btn_categoria" href="#">
                  <div class="categorias">
        			         <div class = "categoria"><i class="fa fa-tag"></i> cosas de casa </div>
                    </div>
                </a>
                <a class="btn_vendedor" href="#">
                  <div class = "cuadro_vendedor">
                      <div class = "texto_vendedor">
                        <img src = "imgs/luky.png" height="40" width="40" style="border-radius: 100%; border: 1px solid black">
                      </div>
                      <div class = "texto_vendedor">
                        <strong> Luky Estrela Camiñador</strong>
                        <div> 32 productos </div>
                      </div>
                  </div>
                </a>
            </div>
        </a>
        <a class="btn_producto" href="#">
            <div class="cuadro_producto">
        			<img src="imgs/taza.jpg" height="150" width="150" style="border-top-left-radius:7px;border-top-right-radius:7px">
        			<p class = "precio"> 5€</p>
        			<p class = "titulo"> Taza bonita</p>
        			<p class = "descripcion"> Esta casi sin usar, solo en dia en naviadad para brindar.</p>
                <a class="btn_categoria" href="#">
                  <div class="categorias">
        			         <div class = "categoria"><i class="fa fa-tag"></i> cosas de casa </div>
                    </div>
                </a>
                <a class="btn_vendedor" href="#">
                  <div class = "cuadro_vendedor">
                      <div class = "texto_vendedor">
                        <img src = "imgs/luky.png" height="40" width="40" style="border-radius: 100%; border: 1px solid black">
                      </div>
                      <div class = "texto_vendedor">
                        <strong> Luky Estrela Camiñador</strong>
                        <div> 32 productos </div>
                      </div>
                  </div>
                </a>
            </div>
        </a>
        <a class="btn_producto" href="#">
            <div class="cuadro_producto">
        			<img src="imgs/taza.jpg" height="150" width="150" style="border-top-left-radius:7px;border-top-right-radius:7px">
        			<p class = "precio"> 5€</p>
        			<p class = "titulo"> Taza bonita</p>
        			<p class = "descripcion"> Esta casi sin usar, solo en dia en naviadad para brindar.</p>
                <a class="btn_categoria" href="#">
                  <div class="categorias">
        			         <div class = "categoria"><i class="fa fa-tag"></i> cosas de casa </div>
                    </div>
                </a>
                <a class="btn_vendedor" href="#">
                  <div class = "cuadro_vendedor">
                      <div class = "texto_vendedor">
                        <img src = "imgs/luky.png" height="40" width="40" style="border-radius: 100%; border: 1px solid black">
                      </div>
                      <div class = "texto_vendedor">
                        <strong> Luky Estrela Camiñador</strong>
                        <div> 32 productos </div>
                      </div>
                  </div>
                </a>
            </div>
        </a>
        <a class="btn_producto" href="#">
            <div class="cuadro_producto">
        			<img src="imgs/taza.jpg" height="150" width="150" style="border-top-left-radius:7px;border-top-right-radius:7px">
        			<p class = "precio"> 5€</p>
        			<p class = "titulo"> Taza bonita</p>
        			<p class = "descripcion"> Esta casi sin usar, solo en dia en naviadad para brindar.</p>
                <a class="btn_categoria" href="#">
                  <div class="categorias">
        			         <div class = "categoria"><i class="fa fa-tag"></i> cosas de casa </div>
                    </div>
                </a>
                <a class="btn_vendedor" href="#">
                  <div class = "cuadro_vendedor">
                      <div class = "texto_vendedor">
                        <img src = "imgs/luky.png" height="40" width="40" style="border-radius: 100%; border: 1px solid black">
                      </div>
                      <div class = "texto_vendedor">
                        <strong> Luky Estrela Camiñador</strong>
                        <div> 32 productos </div>
                      </div>
                  </div>
                </a>
            </div>
        </a>
        <a class="btn_producto" href="#">
            <div class="cuadro_producto">
        			<img src="imgs/taza.jpg" height="150" width="150" style="border-top-left-radius:7px;border-top-right-radius:7px">
        			<p class = "precio"> 5€</p>
        			<p class = "titulo"> Taza bonita</p>
        			<p class = "descripcion"> Esta casi sin usar, solo en dia en naviadad para brindar.</p>
                <a class="btn_categoria" href="#">
                  <div class="categorias">
        			         <div class = "categoria"><i class="fa fa-tag"></i> cosas de casa </div>
                    </div>
                </a>
                <a class="btn_vendedor" href="#">
                  <div class = "cuadro_vendedor">
                      <div class = "texto_vendedor">
                        <img src = "imgs/luky.png" height="40" width="40" style="border-radius: 100%; border: 1px solid black">
                      </div>
                      <div class = "texto_vendedor">
                        <strong> Luky Estrela Camiñador</strong>
                        <div> 32 productos </div>
                      </div>
                  </div>
                </a>
            </div>
        </a>
        <a class="btn_producto" href="#">
            <div class="cuadro_producto">
        			<img src="imgs/taza.jpg" height="150" width="150" style="border-top-left-radius:7px;border-top-right-radius:7px">
        			<p class = "precio"> 5€</p>
        			<p class = "titulo"> Taza bonita</p>
        			<p class = "descripcion"> Esta casi sin usar, solo en dia en naviadad para brindar.</p>
                <a class="btn_categoria" href="#">
                  <div class="categorias">
        			         <div class = "categoria"><i class="fa fa-tag"></i> cosas de casa </div>
                    </div>
                </a>
                <a class="btn_vendedor" href="#">
                  <div class = "cuadro_vendedor">
                      <div class = "texto_vendedor">
                        <img src = "imgs/luky.png" height="40" width="40" style="border-radius: 100%; border: 1px solid black">
                      </div>
                      <div class = "texto_vendedor">
                        <strong> Luky Estrela Camiñador</strong>
                        <div> 32 productos </div>
                      </div>
                  </div>
                </a>
            </div>
        </a>
        <a class="btn_producto" href="#">
            <div class="cuadro_producto">
        			<img src="imgs/taza.jpg" height="150" width="150" style="border-top-left-radius:7px;border-top-right-radius:7px">
        			<p class = "precio"> 5€</p>
        			<p class = "titulo"> Taza bonita</p>
        			<p class = "descripcion"> Esta casi sin usar, solo en dia en naviadad para brindar.</p>
                <a class="btn_categoria" href="#">
                  <div class="categorias">
        			         <div class = "categoria"><i class="fa fa-tag"></i> cosas de casa </div>
                    </div>
                </a>
                <a class="btn_vendedor" href="#">
                  <div class = "cuadro_vendedor">
                      <div class = "texto_vendedor">
                        <img src = "imgs/luky.png" height="40" width="40" style="border-radius: 100%; border: 1px solid black">
                      </div>
                      <div class = "texto_vendedor">
                        <strong> Luky Estrela Camiñador</strong>
                        <div> 32 productos </div>
                      </div>
                  </div>
                </a>
            </div>
        </a>
        <a class="btn_producto" href="#">
            <div class="cuadro_producto">
        			<img src="imgs/taza.jpg" height="150" width="150" style="border-top-left-radius:7px;border-top-right-radius:7px">
        			<p class = "precio"> 5€</p>
        			<p class = "titulo"> Taza bonita</p>
        			<p class = "descripcion"> Esta casi sin usar, solo en dia en naviadad para brindar.</p>
                <a class="btn_categoria" href="#">
                  <div class="categorias">
        			         <div class = "categoria"><i class="fa fa-tag"></i> cosas de casa </div>
                    </div>
                </a>
                <a class="btn_vendedor" href="#">
                  <div class = "cuadro_vendedor">
                      <div class = "texto_vendedor">
                        <img src = "imgs/luky.png" height="40" width="40" style="border-radius: 100%; border: 1px solid black">
                      </div>
                      <div class = "texto_vendedor">
                        <strong> Luky Estrela Camiñador</strong>
                        <div> 32 productos </div>
                      </div>
                  </div>
                </a>
            </div>
        </a>
        <a class="btn_producto" href="#">
            <div class="cuadro_producto">
        			<img src="imgs/taza.jpg" height="150" width="150" style="border-top-left-radius:7px;border-top-right-radius:7px">
        			<p class = "precio"> 5€</p>
        			<p class = "titulo"> Taza bonita</p>
        			<p class = "descripcion"> Esta casi sin usar, solo en dia en naviadad para brindar.</p>
                <a class="btn_categoria" href="#">
                  <div class="categorias">
        			         <div class = "categoria"><i class="fa fa-tag"></i> cosas de casa </div>
                    </div>
                </a>
                <a class="btn_vendedor" href="#">
                  <div class = "cuadro_vendedor">
                      <div class = "texto_vendedor">
                        <img src = "imgs/luky.png" height="40" width="40" style="border-radius: 100%; border: 1px solid black">
                      </div>
                      <div class = "texto_vendedor">
                        <strong> Luky Estrela Camiñador</strong>
                        <div> 32 productos </div>
                      </div>
                  </div>
                </a>
            </div>
        </a>
        </div>
	</article>

    <!-- FIN article "medio"-->
    <!-- INICIO nav "izquierda" -->
    <nav id="mainnavigation">
        <ul>
            <li> <a class="btn_menu prioridad_1" href="#"><i class="fa fa-user"></i> Mi Perfil</a></li>
			<li> <a class="btn_menu prioridad_1" href="#"><i class="fa fa-archive"></i> Mis Productos</a></li>
			<li> <a class="btn_menu prioridad_1" href="#"><i class="fa fa-arrow-up"></i> Subir Producto</a></li>
			<li> <a class="btn_menu prioridad_1" href="#"><i class="fa fa-comments"></i> Mis Chats</a></li>
			<li id="categoriasmenuitem"><a class= "btn_menu prioridad_1" href="#"><i class="fa fa-chevron-down"></i> Categorías</a>
				<ul>
					<li><a class= "btn_menu prioridad_2" href="#"><i class="fa fa-laptop"></i> Tecnologia </a></li>
					<li><a class= "btn_menu prioridad_2" href="#"><i class="fa fa-book"></i> Libros </a></li>
					<li><a class= "btn_menu prioridad_2" href="#"><i class="fa fa-home"></i> Cosas de casa </a></li>
					<li><a class= "btn_menu prioridad_2" href="#"><i class="fa fa-gamepad"></i> Consolas </a></li>
					<li><a class= "btn_menu prioridad_2" href="#"><i class="fa fa-child"></i> Niños </a></li>
					<li><a class= "btn_menu prioridad_2" href="#"><i class="fa fa-plug "></i> Electrodomesticos </a></li>
					<li><a class= "btn_menu prioridad_2" href="#"><i class="fa fa-suitcase "></i> Ropa </a></li>
					<li><a class= "btn_menu prioridad_2" href="#"><i class="fa fa-car "></i> Motor </a></li>
					<li><a class= "btn_menu prioridad_2" href="#"><i class="fa fa-futbol-o "></i> Deporte </a></li>
				</ul>
			</li>
		</ul>
    </nav>


    <!-- FIN nav "izquierda"-->
    <!-- INICIO aside "dereita" -->
    <!-- FIN aside "dereita" -->
    <!-- INICIO footer-->
    <!-- FIN footer-->
  </body>
</html>