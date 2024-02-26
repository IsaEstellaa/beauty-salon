
# Sistema de Cabeleireiro

Esse projeto consiste em um sistema de gerenciamento de usuarios e agendamentos para o salão de cabeleireiro da "Cabeleleila Leila". O projeto foi desenvolvido por mim, Isabella Estella, para o processo seletivo da empresa DSIN.

Video do projeto: [Video](https://www.loom.com/share/78554db1934f4aa091425f75d3f2d3a8)



#### Projeto

O projeto consiste em fazer um sistema que permite aos clientes agendarem e gerenciarem seus agendamentos no salão da Cabeleleila Leila, para facilitar sua usabilidade e ganhar tempo. O sistema também facilita a administração do salão, permitindo que o administrador gerencie todos os agendamentos, suas situações, edite e exclua-os conforme necessário. Além disso, o sistema permite a configuração de diferentes níveis de acesso, para que outros líderes do salão possam ter permissões específicas para editar agendamentos.

### Tecnologias utilizadas
Foi desenvolvido utilizando tecnologias como PHP para o desenvolvimento da lógica do servidor, HTML e CSS para a estruturação e estilização do conteúdo visual, e jQuery, uma biblioteca de JavaScript, para adicionar funcionalidades interativas ao sistema. O MySQL foi utilizado como sistema de gerenciamento de banco de dados, armazenando informações como detalhes do cliente, agendamentos e configurações de níveis de acesso. 
#### Como rodar o projeto
- Banco: Utilizei o phpMyAdmin. É necessário baixar o "salon-beauty.sql" (pasta sql) e importar em um database com o mesmo nome (salon-beauty) e com a 
```bash
  utf8mb4_general_ci
```

- Para rodar o projeto é necessário ter o [XAMPP](https://www.apachefriends.org/pt_br/download.html) (minha versão é a 8.1.17 / PHP 8.1.17) ou o Wampserver.

- Baixar os arquivos e coloca-los dentro da pasta XAMPP > htdocs (para conseguir rodar no local)

## Explicação do projeto

- Pagina home.php
Nessa pagina temos a possibilidade de realizar um cadastro ou um login, para conseguir entrar no sistema.


Para teste:

Usuario administrador máximo
- leilacabelosunhas@email.com
- admin

Usuario administrador não editor
- sobrinhoneto@email.com
- sobrinho

Usuario normal
- cliente@email.com
- 123

![Tela de Login/cadastro](https://i.imgur.com/u2LILSd.png)


### Entrando com o usuario normal

Na página de lista de agendamentos, o usuario normal consegue visualizar apenas os seus agendamentos e permite realizar a alteração em até 2 dias antes do agendado e após esse tempo bloqueia a opção.

![Tela de agendamentos normal](https://i.imgur.com/SugxTiA.png)

Tela de edição

![Tela de edição](https://i.imgur.com/09M85Tb.png)

Ao clicar em cadastrar um horario, o usuario consegue realizar um cadastro de agendamento (que é inserido sempre com a situação 'Em processamento', pois somente o adm tem a permissão de mudar a situação)

![Tela de cadastro de agendamento](https://i.imgur.com/ZPKLmVB.png)

### Entrando com o administrador não editor

Na página de lista de agendamentos, esse usuario consegue visualizar todos os agendamentos cadastrados em seu sistema e edita-los independente da data em que estão marcados.

![Tela de agendamentos adm](https://i.imgur.com/5zIeffE.png)

O usuario tambem consegue filtrar a pesquisa por determinadas datas, para melhor visualização (mostrando a funcionalidade com esse usuario para ter mais agendamentos e melhorar a demostração, mas todos os usuarios conseguem filtrar)

![Filtro](https://i.imgur.com/NNkSpSs.png)

![Resultado do filtro](https://i.imgur.com/6UAI7Dh.png)

Obs: No editar para os usuários ADM's, é possivel alterar a situacao do agendamento (cadastro tambem).
![Resultado do filtro](https://i.imgur.com/CL0qkJ9.png)

Clicando no cabeçalho, em "Ver usuarios", podemos visualizar uma pagina de gerenciamento contendo primeiramente um card explicativo dos niveis de acesso do sistema.

![Ver usuarios](https://i.imgur.com/yUrLtQZ.png)

Logo abaixo temos o gerenciamento de usuarios, onde é possivel visualizar todos os usuarios do sistema, seu email e o nivel de acesso.
A parte filtrar por semana consiste no mesmo filtro já explicado, mas filtrado por semana.
O informaçõs de agendamentos mostra quantos agendamentos existem concluidos e quantos existem com outras situações (exceto concluido e negado).

![Gerenciamento de usuarios](https://i.imgur.com/3PklQvS.png)

### Entrando com o administrador máximo

O administrador máximo tem exatamente todas as funções descritas anteriormente, com exceção da página de Gerenciamento ("Ver usuarios" para o ADM não editor)
Com a permissão máxima, o ADM tem a possibilidade de editar as permissões dos outros usuarios (exceto a dele), pensando caso ele queira adicionar mais usuarios para fazer a edição dos agendamentos (como uma secretária, ou alguma cabelereira).

![Tela de gerenciamento adm max](https://i.imgur.com/MlknL9e.png)

A tela de edição de usuario permite que o nível seja alterado.

![Atualizar usuario](https://i.imgur.com/RfgFuv7.png)
