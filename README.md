# Rusky Vet - Teste Energié

## Alterações Principais
- Implementação do Cadastro de Pacientes com Foto: Adiciona a funcionalidade de upload de fotos no cadastro de animais.

- Implementação do Agendamento de Consultas: Cria um sistema de agendamento funcional, com verificação de horários disponíveis via AJAX.

- Implementação do Painel do Veterinário: Permite que veterinários visualizem e finalizem as consultas, adicionando observações.

- Correção da Estrutura do Banco de Dados: A arquitetura da base de dados foi corrigida para armazenar consultas e pacientes em tabelas separadas e adequadas, resolvendo a falha mais crítica do projeto original.

- Correção de Segurança: O armazenamento de senhas foi corrigido para utilizar o sistema de hash do Laravel, em vez de texto plano.

## Como Executar
1. Clonar o repositório: 
```shell
    git clone https://github.com/GLazzari1428/code-test
```

2. Instalar as dependências.
```shell
    composer install
```

3. Modificar o `.env` com as credenciais corretas do banco de dados.
```.env
    DB_DATABASE={nome_db}
    DB_USERNAME={user_db}
    DB_PASSWORD={senha_db}
```
4. Rode os comandos abaixo para gerar as keys, criar & popular o banco de dados e habilitar a visualização das fotos.
```shell
    php artisan key:generate
    php artisan migrate:fresh --seed
    php artisan storage:link
```
    
5. Por último rode o projeto : 
```shell
    php artisan serve
```

## Acesso
Acesse o localhost ([127.0.0.1:8000](127.0.0.1:8000)) e utilize as credencias abaixo ou crie novas pelo site.
- Cliente: 
```shell
joaodasilva@gmail.com
```

- Veterinário: 
```shell
mariovet@gmail.com
```

- Senha (para ambos): 
```shell
123123123
```