# Geração de Boletim Escolar em PDF

Este projeto utiliza **Docker**, **Docker Compose**, **CodeIgniter 3** e **PostgreSQL** para criar um ambiente de desenvolvimento eficiente e escalável. O mesmo se refere a um teste de Aptidão de Geração de Boletim Escolar em PDF.

## 🛠 Tecnologias Utilizadas
- **Docker**: Para containerização do ambiente.
- **Docker Compose**: Para orquestração dos containers.
- **CodeIgniter 3**: Framework PHP para desenvolvimento web.
- **PostgreSQL**: Banco de dados relacional.
- **FPDF**: Lib para geração de PDFs.

## Pré-requisitos
Antes de rodar o projeto, você precisa ter os seguintes pré-requisitos instalados em sua máquina:

- [Docker](https://www.docker.com/get-started) (e Docker Compose)
- [Git](https://git-scm.com/)

## 📦 Estrutura do Projeto
```
.
├── application/
│   ├── controllers/       # Controladores do CodeIgniter
│   ├── models/            # Modelos do CodeIgniter
│   ├── views/             # Visões do CodeIgniter
│   ├── config/            # Configurações do CodeIgniter
├── docker-compose.yml     # Arquivo de configuração do Docker Compose
├── Dockerfile             # Arquivo para a construção da imagem Docker da aplicação
├── vendor/                # Dependências do Composer
└── README.md              # Documentação do projeto
```

## 🚀 Como Rodar o Projeto

### 1. Instalar o Docker e Docker Compose
Certifique-se de que o Docker e o Docker Compose estão instalados no seu sistema. Se não estiverem, siga as instruções [oficiais do Docker](https://docs.docker.com/get-docker/) para instalação.

Este projeto já vem com um arquivo docker-compose.yml que irá configurar os containers necessários para o funcionamento da aplicação, incluindo o banco de dados PostgreSQL.

### 1. Inicie os containers
Dentro do diretório do projeto, execute o seguinte comando para iniciar os containers:
```bash
docker-compose up -d
```

Esse comando vai:

Construir a imagem da aplicação (app) e o banco de dados (db).
Rodar a aplicação PHP (CodeIgniter) no container codeigniter_app.
Rodar o PostgreSQL no container postgres_db.

### 2. Clonar o repositório
Clone este repositório para sua máquina local:
```bash
git clone https://github.com/suelsantos/boletim-escolar.git
```

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

### Inserir dados Fakes
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

### Acessar o Projeto
O projeto utiliza a biblioteca FPDF para gerar boletins em formato PDF. Para gerar o boletim, você pode acessar a URL:
- Aplicação: http://localhost:8080/boletim/gerar_pdf/{id_do_aluno}
- PostgreSQL: Porta `5432`

## 📝 Licença
Este projeto é de uso interno e pode ser adaptado conforme necessário.
