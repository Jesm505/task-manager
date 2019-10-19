Este aplicativo é um gerenciador de tarefas, desenvolvido com base no livro [Desenvolvimento web com PHP e MySQL](https://www.casadocodigo.com.br/products/livro-php-mysql), esta aplicação foi desenvolvida com a finalidade de por em prática conceitos aprendidos sobre a linguagem, bem como testar módulos, libs e classes desenvolvidas pela comunidade.

Ou seja, se você é apenas um entusiasta ou um iniciante muito curioso assim como eu, sinta-se a vontade para modificar, criar novas funcionalidades, testar seus próprios módulos ou mesmo errar neste projeto.

### Qual a utilidade desta aplicação?
Este gerenciador de tarefas, permite basicamente criar e organizar suas tarefas, como o próprio nome supõe. 

### Ok, só isso?
Não né.

#### Funcionalidades 
Podemos listar algumas outras funcionalidades interessantes além de somente criar tarefas, por exemplo:
- Editar a tarefa
- Remove-la
- Anexar aquivos .zip e .pdf nas tarefas
- Enviar um lembrete por email
- Adicionar descrição e data final
- Informar sua prioridade e se foi ou não finalizada

### O que eu preciso para executar o Gerenciador de Tarefas no meu computador?
**Passo 1:**  
Inicialmente você precisará de um Web Server de sua preferência com o PHP configurado e funcionando.

Para mais informações sobre como instalar o PHP junto ao Apache ou o Nginx [clique aqui](https://www.php.net/manual/en/install.php).

**Passo 2:**  
Feito isso, você deverá criar um banco de dados com as tables _tasks_ e _attachments_ para guardar as informações das tarefas, recomendo a utilização do _SQLite_, pois assim não será necessária maiores modificações no arquivo _database.php_, você só precisará apontar o caminho para o banco de dados neste caso.  
As tables deverão ser criadas da seguinte maneira:

```sh
CREATE TABLE tasks (
id INTEGER PRIMARY KEY AUTOINCREMENT,
name VARCHAR(20),
description TEXT,
deadline DATE,
priority INTEGER,
complete BOOLEAN
);

CREATE TABLE attachments(
id INTEGER PRIMARY KEY AUTOINCREMENT,
task_id INTEGER NOT NULL,
name VARCHAR(255) NOT NULL,
file VARCHAR(255) NOT NULL,
FOREIGN KEY (task_id) REFERENCES tasks(id)
);
```

**Passo 3:**  
Por ultimo, você precisará instalar as dependências do projeto, aqui a única dependência utilizada até o momento é o [PHPMailer](https://github.com/PHPMailer/PHPMailer), caso você prefira instalar o PHPMailer através do [Composer](https://getcomposer.org/doc/00-intro.md), você pode utilizar o arquivo _composer.lock_ para a instalação seguindo as instruções [aqui](https://getcomposer.org/doc/01-basic-usage.md#installing-with-composer-lock).

### Considerações finais
Note que a função _move_uploaded_file_ em _helpers.php_, utiliza como destino o diretório "attachments/", você pode criar este diretório ou apontar para outro diretório de sua preferência.

A observação acima se aplica também a função _file_put_contents_ em _helpers.php_ que utiliza o diretório "log/" como destino.

Para que o Lembrete de Email funcione corretamente, certifique-se que a opção "Acesso a app menos seguro" esteja ativada nas configurações de segurança da sua conta de email.

Não é recomendado utilizar sua conta pessoal para enviar os lembretes, já que a aplicação não é segura.

Caso esteja utilizando o **Apache**, certifique-se que o apache tenha permissão de escrita no seu aquivo de banco de dados, assim como no diretório "log/" ou equivalente, mais informações sobre [aqui](https://fideloper.com/user-group-permissions-chmod-apache).





