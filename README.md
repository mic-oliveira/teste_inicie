## Teste Inicie

### Instalação

Antes de inciar os comandos abaixo deve-se copiar o arquivo .env.example, 
onde as configurações de banco de dados já estão configuradas para os containers do docker.
Após o arquivo ser copiado deve-se seguir os passo abaixo, certificando de que o docker(e docker-compose em alguns
sistemas operacionais como Linux) estejam devidamente instalados

Iniciar o container docker: <br>
`docker-compose up -d` <br>
Para realizar a instalação dos pacotes composer devemos executar o comando : <br>
`docker-compose exec laravel.test composer install`

Com estes passos já é possível acesso a API através da url: `http://localhost`

Para executar testes automáticos deve-se usar o comando: `./vendor/bin/sail test` 
e adicionalmente pode-se o usar o parâmetro `--coverage` para verificação da cobertura de teste sobre o código.

As requisições estão disponíveis através da url base ``http://localhost/api`` seguindo as requisições 
conforme disponibilizado no no link <a href="https://gorest.co.in/">gorest</a>.

1 - criação de usuário : POST `http://localhost/api/users` <br />
2 - listar usuários: GET `http://localhost/api/users` <br />
3 - retornar usuário por ID: GET `http://localhost/api/users/{user_id}` <br />
4 - criar post: POST ``http://localhost/api/users/{user_id}/posts`` <br />
5 - criar comentário para post: POST ``http://localhost/api/posts/{post_id}/comments`` <br />
6 - criar comentário para primeiro post público: POST ``http://localhost/api/comments?first_post=true`` <br />
7 - remover comentário para primeiro post público: DELETE ``http://localhost/api/comments/{comment_id}`` <br />