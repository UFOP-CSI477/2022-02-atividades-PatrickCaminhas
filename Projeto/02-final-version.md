# **CSI606-2021-02 - Remoto - Trabalho Final - Resultados**

## *Aluno: Patrick Caminhas Matos

--------------

<!-- Este documento tem como objetivo apresentar o projeto desenvolvido, considerando o que foi definido na proposta e o produto final. -->

### Resumo

O projeto é uma plataforma web de pedidos de lanches. O back-end foi desenvolvido em PHP enquanto o front-end com Bootstrap. A plataforma fornece ao usuario a capacidade de realização de pedidos de lanches com praticidade.

### 1. Funcionalidades implementadas
Para o usuario cliente:
- Cadastro e login do usuario.
- Verificação dos pedidos abertos do cliente.
- Verificação dos pedidos fechados do cliente.
- Cancelamento de pedidos feitos.
- Alteração de endereço.

Para o usuario funcionário:
- Login do funcionario.
- Alteração do estado dos pedidos abertos.
- Verificação das informações de todos os pedidos fechados.
  
### 2. Funcionalidades previstas e não implementadas
- Alteração do estado de abertura da lanchonete para possibilitar ou impossibilitar novos pedidos.
- Verificação de dados estatisticos sobre pedidos e lanches.
- Alteração, exclusão e inserção do cardapio. 

### 3. Outras funcionalidades implementadas
- Alteração de nome, e-mail e senha do cliente pelo próprio cliente.
- Cadastrar novo funcionário.
- Promoção de funcionário para administrador.
- Rebaixamento de funcionário administrador para funcionário comum.
- Demissão de funcionário.

### 4. Principais desafios e dificuldades
As principais dificuldades foram inicialmente no back-end na construção dos formulários de novos pedidos e alteração de status de pedidos abertos. 
Posteriormente houve uma dificuldade na construção do front-end com CSS e decidi usar Bootstrap.

### 5. Instruções para instalação e execução
Instalação do servidor e banco de dados
1. Instalar o ambiente de desenvolvimento XAMPP com os recursos: servidor Apache e phpMyAdmin:
1.1 Download: https://www.apachefriends.org/pt_br/index.html
1.2 Guia: https://pt.wikihow.com/Instalar-o-XAMPP-para-Windows
2. Executar o XAMPP Control Panel, ligar Apache e MySQL nos botões start.
Exportação do banco de dados:
1. No XAMPP Control Panel acessar o admin do MySQL.
2. Acessar a opção Importar no canto superior da pagina, vá em ficheiro importar e no botão "Escolher arquivo" selecione o arquivo lanchonete.sql no caminho deste projeto "2022-02-atividades-PatrickCaminhas/Projeto/Codigo/sql/lanchonete.sql" e por fim vá em importar 
Colocando o projeto no servidor:
1. Recorte ou mova a pasta "Codigo" deste projeto (2022-02-atividades-PatrickCaminhas/Projeto/Codigo/) para a pasta htdocs do XAMPP "C:\xampp\htdocs"
Executando:
1. Acesse no navegador localhost/codigo

### 6. Referências
THE PHP GROUP. PHP: Hypertext Preprocessor. Disponível em: <https://www.php.net/>. Acesso em: 19 de fev. 2023.

PHP Session: criando sessões para login em PHP. Disponível em: <https://www.devmedia.com.br/criando-sessao-para-login-no-php/27347>. Acesso em: 25 de fev. 2023.

CELKE. Celke - Blog. Disponível em: <https://celke.com.br/blog>. Acesso em: 25 de fev. 2023.

CONTRIBUTORS, M. O., Jacob Thornton, and Bootstrap. Get started with Bootstrap. Disponível em: <https://getbootstrap.com/docs/5.3/getting-started/introduction/>. Acesso em: 07 de mar. 2023.
