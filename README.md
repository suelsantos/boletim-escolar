# Projeto CodeIgniter com Docker e PostgreSQL

Este projeto utiliza **Docker**, **Docker Compose**, **CodeIgniter 3** e **PostgreSQL** para criar um ambiente de desenvolvimento eficiente e escalável. O mesmo se refere a um teste de Aptidão de Geração de Boletim Escolar em PDF.

## 🛠 Tecnologias Utilizadas
- **Docker**: Para containerização do ambiente.
- **Docker Compose**: Para orquestração dos containers.
- **CodeIgniter 3**: Framework PHP para desenvolvimento web.
- **PostgreSQL**: Banco de dados relacional.

## 📦 Estrutura do Projeto
```
.
├── app/                  # Código-fonte do CodeIgniter
├── docker/
│   ├── php/              # Configuração do PHP
│   ├── postgresql/       # Configuração do banco de dados
├── docker-compose.yml    # Configuração do Docker Compose
├── .env                  # Variáveis de ambiente
├── README.md             # Documentação do projeto
└── scripts/              # Scripts SQL e utilitários
```

## 🚀 Como Rodar o Projeto

### 1. Configurar Variáveis de Ambiente
Crie um arquivo `.env` na raiz do projeto e adicione as seguintes configurações:
```ini
DB_HOST=db
DB_NAME=meubanco
DB_USER=usuario
DB_PASS=senha
```

### 2. Subir os Containers
Execute o comando abaixo para iniciar o ambiente:
```sh
docker-compose up -d
```

### 3. Acessar o Projeto
- Aplicação: [http://localhost:8000](http://localhost:8000)
- PostgreSQL: Porta `5432`

## 🗄 Banco de Dados
### Criação das Tabelas
```sql
CREATE TABLE alunos (
	id SERIAL PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
	matricula VARCHAR(20) UNIQUE NOT NULL
);

CREATE TABLE disciplinas (
	id SERIAL PRIMARY KEY,
	nome VARCHAR(100) NOT NULL
);

CREATE TABLE notas (
	id SERIAL PRIMARY KEY,
	aluno_id INT REFERENCES alunos(id),
	disciplina_id INT REFERENCES disciplinas(id),
	nota DECIMAL(4,2) NOT NULL
);
```

### Inserts Fakes
```sql
INSERT INTO alunos (nome, matricula) VALUES 
('João Silva', '2023001'),
('Maria Souza', '2023002'),
('Carlos Oliveira', '2023003');

INSERT INTO disciplinas (nome) VALUES 
('Matemática'),
('História'),
('Física');

INSERT INTO notas (aluno_id, disciplina_id, nota) VALUES 
(1, 1, 8.5),
(1, 2, 7.0),
(2, 1, 9.2),
(2, 3, 6.8),
(3, 2, 8.0),
(3, 3, 7.5);
```

## 📝 Licença
Este projeto é de uso interno e pode ser adaptado conforme necessário.
