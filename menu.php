    <?php
		if ( session_status() !== PHP_SESSION_ACTIVE )
		{
			session_start();
	  	}

		if(isset($_SESSION['carrinho'])) //Caso seja o primeiro produto a ser colocado no carrinho
		{
			$quantidadeitensnocarrinho = count($_SESSION['carrinho']);
		}
		else
		{
			$quantidadeitensnocarrinho = 0;
		}
	?>
	
	<!-- ------------------------------------------------------- -->
	<!--                        Menu                             -->
	<!-- ------------------------------------------------------- -->
	<header id="menu">
		<section id="conteudo-menu"> <!-- Usado para site responsivo -->
			<!-- Botão abrir menu (Mobile) -->
			<button id="button-menu-mobile" onclick="abrirMenuMobile()">&#9776;</button>
			<a href="index.php" id="logotipo-link">
				<img src="view/imagens/logotipo/logo-branco.png" id="logotipo" alt="BNG Design"> <!-- Logotipo -->
			</a>
			
			<img src="view/imagens/banner/mensagem-menu.gif" id="mensagem-menu" alt="BNG Design">
			
			<div id="login-e-cadastro"> <!-- Parte de login e cadastro do site -->
				<img src="view/imagens/figura/user-icon.png" id="login-e-cadastro-icone-login" alt="Ícone de usuário">
				<div id="login-e-cadastro-texto">
					<?php
						if((isset($_SESSION['codigo_cliente_fisico'])) || (isset($_SESSION['codigo_cliente_juridico']))) //Testar com a página index
						{
							echo "<a href='view/minha-pagina/compras.php' id='login-e-cadastro-link'>Olá, " . $_SESSION['nome'] . "</a> <br>
							      <a href='app/logout.php' id='login-e-cadastro-link'>Sair</a>";
						}
						else if(isset($_SESSION['codigo_profissional']))
						{
							echo "<a href='view/pcontrole/pcontrole.php' id='login-e-cadastro-link'>Olá, " . $_SESSION['nome'] . "</a> <br>
							      <a href='app/logout.php' id='login-e-cadastro-link'>Sair</a>";
						}
						else
						{
							echo "<a href='view/login.php' id='login-e-cadastro-link'>Entrar</a> <br>
							      <a href='view/cadastro.php' id='login-e-cadastro-link'>Cadastre-se</a>";
						}
					?>
				</div>
			</div>
		</section>
		
		<!-- Links para as páginas do site (Desktop) -->
		<section id="menu-links"> 
			<section id="conteudo-menu-links">
				<ul id="menu-links-ul">
					<li id="menu-links-li"><a href="view/contratar-servico.php" id="menu-link">CONTRATAR SERVIÇOS!</a></li>
					<li id="menu-links-li"><a href="view/saiba-como-funciona.php" id="menu-link">SAIBA COMO FUNCIONA</a></li>
					<li id="menu-links-li"><a href="view/fale-conosco.php" id="menu-link">FALE CONOSCO</a></li>
					<li id="menu-links-li"><a href="view/sobre.php" id="menu-link">SOBRE</a></li>
					<li id="menu-links-li"><a href="view/carrinho.php" id="menu-link"><i class="fas fa-shopping-cart" style="margin-right: 5px;"></i> MEU CARRINHO (<?php echo $quantidadeitensnocarrinho ?>)</a></li>
				</ul>
			</section>
		</section>
	</header>
	
	<!-- Links para as páginas do site (Mobile) -->
	<section id="conteudo-menu-mobile"> 
		<button id="button-fechar-mobile" onclick="fecharMenuMobile()">&times;</button> <!-- Botão fechar menu (Mobile) -->
		<ul>
			<li><a href="view/contratar-servico.php" id="menu-link">Contratar serviços!</a></li>
			<li><a href="view/saiba-como-funciona.php" id="menu-link">Saiba como funciona</a></li>
			<li><a href="view/fale-conosco.php" id="menu-link">Fale conosco</a></li>
			<li><a href="view/sobre.php" id="menu-link">Sobre</a></li>
			<li><a href="view/carrinho.php" id="menu-link">Meu carrinho (<?php echo $quantidadeitensnocarrinho ?>)</a></li> <br>
			<img src="view/imagens/figura/user-icon.png" id="login-e-cadastro-icone-login" alt="Ícone de usuário">
				<?php
					if((isset($_SESSION['codigo_cliente_fisico'])) || (isset($_SESSION['codigo_cliente_juridico']))) //Testar com a página index
					{
						echo "<br>";
						echo "<a href='view/minha-pagina/compras.php' id='login-e-cadastro-link'>Olá, " . $_SESSION['nome'] . "</a> <br><br>
						<a href='app/logout.php' id='login-e-cadastro-link'>Sair</a>";
					}
					else if(isset($_SESSION['codigo_profissional']))
					{
						echo "<br>";
						echo "<a href='view/pcontrole/pcontrole.php' id='login-e-cadastro-link'>Olá, " . $_SESSION['nome'] . "</a> <br><br>
						<a href='app/logout.php' id='login-e-cadastro-link'>Sair</a>";
					}
					else
					{
						echo "<br>";
						echo "<a href='view/login.php' id='login-e-cadastro-link'>Entrar</a> <br>
						<a href='view/cadastro.php' id='login-e-cadastro-link'>Cadastre-se</a>";
					}
				?>
		</ul>
	</section>