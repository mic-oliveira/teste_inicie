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