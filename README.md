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
    composer install
```
Execute php artisan key:generate.
```shell
    composer install
```
Execute php artisan migrate:fresh --seed para criar e popular o banco de dados. Este comando é essencial.
```shell
    composer install
```
Execute php artisan storage:link para habilitar a visualização das fotos.
```shell
    composer install
```
Inicie o servidor com php artisan serve.
```shell
    composer install
```

Credenciais de Acesso
Cliente: joaodasilva@gmail.com

Veterinário: mariovet@gmail.com

Senha (para ambos): 123123123