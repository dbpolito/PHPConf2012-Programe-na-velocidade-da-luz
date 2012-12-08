# Programe na Velocidade da Luz - PHP Conference 2012 - __[Link da Palestra](http://joind.in/7742)__

Esse repositório tem o intuito de mostrar o que foi codificado ao vivo na PHP Conference 2012. Você tem duas formas de aproveitar esse guia:

1. Seguindo o passo a passo e criando utilizando o OIL
2. Clonando este repositório e instalando

Caso alguem tenha alguma dúvida crie __Issues__ e se você tem alguma ideia que pode ajudar mais alguem, fique a vontade para criar __Pull Requests__.

Se você quiser aprender mais na prática eu sugiro que você estude o repositório __[Fuel Depot](http://github.com/fuel/depot/)__. Esse sistema foi desenvolvido pelo próprio time de desenvolvedores do FuelPHP.

__Faça bom proveito. =)__

## Como criar um blog em 5 minutos

### Instalando FuelPHP

	// INSTALANDO OIL NA MAQUINA
	curl get.fuelphp.com/oil | sh

	// ENTRANDO NO DIRETÓRIO
	cd /var/www/

	// CLONANDO FUEL
	oil create phpconf2012

	// ENTANDO NA PASTA DO PROJETO
	cd phpconf2012

### Configurando Fuel

	// CONFIGURE O BANCO (veja o arquivo deste repositório)
	vim fuel/app/config/development/db.php

	// ADICIONE AUTH E ORM PARA (veja o arquivo deste repositório)
	vim fuel/app/config/config.php

	// CONFIGURE SESSÃO PARA USAR DB DRIVER (veja o arquivo deste repositório)
	vim fuel/app/config/session.php

	// CRIANDO TABELA DA SESSÃO NO BANCO
	php oil r session:create

	// CONFIGURE O SIMPLEAUTH (veja o arquivo deste repositório)
	vim fuel/app/config/simpleauth.php

### Brincando com OIL

	// GERANDO ADMIN DE USUÁRIOS
	oil g admin users group:int username:varchar[50] password:string email:string last_login:int login_hash:string profile_fields:text status:char[1] --skip

	// GERANDO ADMIN DE CATEGORIAS
	oil g admin categories parent_id:int title:string description:text status:char[1] --skip

	// GERANDO ADMIN DE POSTS
	oil g admin posts user_id:int category_id:int title:string slug:string summary:text body:text status:char[1] --skip

	// CRIANDO TABELAS NO BANCO
	oil refine migrate

	// OIL CONSOLE
	oil console

	// CRIANDO UM USUÁRIO
	Auth::create_user('admin', 'qwe123', 'contato@dbpolito.net', 100);

	// SAIR DO CONSOLE
	exit

	// SE TUDO ESTIVER OK, ACESSE A URL
	http://localhost/phpconf2012/

	// FAÇA O LOGIN E DIVIRTA-SE

No meu repositório, tem algumas alterações para exemplificar como utilizar os relacionamentos do ORM, caso vocês queiram ver isso funcionando, simplesmente copie todo o MVC daqui.

## Instalando a partir deste repositório

	// VÁ PARA A DIRETÓRIO DO PHP
	cd /var/www/

	// CLONE O REPOSITÓRIO
	git clone  phpconf2012

	// CONFIGURE O BANCO
	vim fuel/app/config/development/db.php

	// EXECUTE O OIL PARA INSTALAR O FRAMEWORK
	php oil r install

	// CRIE A TABELA DE SESSÃO NO BANCO
	php oil r session:create

	// CRIANDO TABELAS NO BANCO
	oil refine migrate

	// OIL CONSOLE
	oil console

	// CRIANDO UM USUÁRIO
	Auth::create_user('admin', 'qwe123', 'contato@dbpolito.net', 100);

	// SAIR DO CONSOLE
	exit

	// SE TUDO ESTIVER OK, ACESSE A URL
	http://localhost/phpconf2012/

# FuelPHP

* Version: 1.4
* [Website](http://fuelphp.com/)
* [Release Documentation](http://docs.fuelphp.com)
* [Development Documentation](http://fueldevdocs.exite.eu) and in its own [git repo](https://github.com/fuel/docs)
* [Forums](http://fuelphp.com/forums) for comments, discussion and community support

## Description

FuelPHP is a fast, lightweight PHP 5.3 framework. In an age where frameworks are a dime a dozen, We believe that FuelPHP will stand out in the crowd.  It will do this by combining all the things you love about the great frameworks out there, while getting rid of the bad.