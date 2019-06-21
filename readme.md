# Report From EDI

Esta é uma aplicação de exemplo com PHP sem frameworks, porém com algumas libs muito boas de PHP.

As libs que usei:

* PHP-DI

Pra fazer os exemplos de inversão de controle (resolução de dependências para injetar)

* Fast Route

Para resolver as rotas e seus parâmetros

* Twig

Excelente template engine

* Guzzle

Para usar as implementações da PSR-7 de request e response

Todo o sistema tem testes unitários desenvolvidos com PHP unit

## Como usar?

Faça o clone deste repositório.

Rode composer install.

Rode composer serve.

Acesse localhost:8000 e faça os testes.

Você também pode rodar testes com o phpunit para verificar as assertions do projeto.

## Sobre a estratégia que usei para desenvolver

### Bootstraping

Tentei ser bem organizado nesse projeto.

Para isso, antes de começar a falar sobre os padrões de design e projeto, eu vou falar sobre o start da aplicação.

A aplicação, naturalmente, começa pelo index.php. Ele está na pasta public e chama os scripts de bootstraping da aplicação.

Na pasta bootstrap temos os scripts de bootstraping, nele temos o arquivo app.php que carrega as dependências do projeto. 
Nesse script também é criada a instância do container de injeção de dependências.

As definições das dependências estão no arquivo kernel.php.

Já no arquivo routes, temos as definições de rotas que direcionam para seus respectivos controllers e métodos.

### Views

As views desse projeto estão na pasta resources/views.

Utilizei o twig como lib e materialize apenas para deixar mais organizada a view.
Não dei tanta importância para a parte de views, mas posso dar uma melhorada futuramente.
Usei javascript puro para escutar os eventos de tela e fazer requisições ajax.

PS: geralmente eu uso axios para fazer requisições, gosto de trabalhar com SPA's e tenho um projeto aqui no 
github que fiz uma <a href="https://github.com/fabiobranis/room-bookings-frontend">SPA sem ajuda de framework</a>

### Classes

A aplicação está na pasta src. Criei um namespace chamado App (muita criatividade rsrsrs).

Dividi as tarefas da aplicação dentro das classes usando Strategy, SRP e DRY.

Por exemplo, a classe App/Storage/FileManager apenas gerencia arquivos, ja a classe App/Reader/FileStream
lê o arquivo e retorna o Stream com métodos de Iteração e controle do arquivo.

Para fazer a tradução das linhas do arquivo, criei DTO's.

Esses DTO's são resolvidos de acordo com a classe LineToDtoFactory, onde identificadndo o id da linha
ele determina qual instância criar (Factory Method).

Para o relatório eu também criei um DTO que tem o objetivo apenas de transportar os dados das linhas em arrays
que contém as instâncias dos DTO's que representam as linhas.

Com relação aos serviços, eu criei um para upload (UploadFile), que usa funcioalidades do Guzzle para copiar da pasta temporária para
a pasta da aplicação e um serviço de criação do modelo de relatório (uma espécie de Builder mais simplificado).

No namespace Reports temos o relatório em si. A classe SalesReports concentra os métodos que fazem os cálculos do relatório.
Criei uma trait para serializar os dados em Array.