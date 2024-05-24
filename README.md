# TP Engenharia de Software II

## Alunos 
Cleifson da Silva Araújo (mat.2021040130)

Eduardo Pinto Esteves Farias (mat.2021039921)

Pedro Gomes Santiago Pires Beltrão (mat. 2021039760)

Vitor Hugo Coelho Cruz (mat 2021039514)

## Visão Geral

Este é um projeto PHP/Laravel, empacotado em contêineres Docker e gerenciado pelo Docker Compose.

Este projeto é uma simulação de uma API para aluguel de carros, a qual possui os objetos User e Cars e realiza a associação entre esses.

## Pré-requisitos

Certifique-se de ter as seguintes ferramentas instaladas:

- [Make](https://www.gnu.org/software/make/manual/make.html)
- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Configuração do Ambiente de Desenvolvimento

*Clone o Repositório:*
   bash
   git@github.com:TPENGSOFTII/TP-ENGSOFT.git
   cd TP-ENGSOFT 
   

## Docker e Docker Compose

Este projeto utiliza Docker para encapsular a aplicação. O Docker Compose é usado para orquestrar os contêineres.
Além disso, possui um Makefile com os principais comandos para facilitar a configuração e definir as principais rotinas.

### Iniciar os Contêineres e Instalar Dependências

bash
make setup


## Configurar Projeto

bash
cp .env.example .env
make generate-key


## Migrar Tabelas e Dados
bash
make data


A aplicação estará disponível em [http://localhost:9001](http://localhost:9001).

O PHPAdmin estará disponível em [http://localhost:9002](http://localhost:9002).

### Parar os Contêineres

bash
make stop
                                                                                              ## Endpoints

O projeto conta com uma Collection do Postman na qual estão documentados todos os endpoints disponíveis:
[Collection](https://drive.google.com/file/d/1A0rxc3gIvMx0VkjBEjgfCSzh1baVE9J5/view)
