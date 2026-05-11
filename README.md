<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 📊 API de Gestão Financeira Empresarial

## 📌 Visão Geral

Esta API foi desenvolvida com foco em **controladoria e gestão financeira empresarial**, permitindo o gerenciamento de entidades fundamentais como empresas.

O projeto foi estruturado utilizando:

* **PHP + Laravel**
* **DDD (Domain-Driven Design)**
* **Clean Architecture**

O objetivo é garantir:

* Separação clara de responsabilidades
* Domínio rico com regras de negócio
* Baixo acoplamento com o framework

---

## 🧠 Arquitetura

O projeto segue os princípios de **Clean Architecture**, dividido em camadas:

```
app/
 ├── Domain/           # Regras de negócio
 ├── Application/      # Casos de uso
 ├── Infrastructure/   # Persistência (Eloquent)
 ├── Interfaces/       # Controllers / HTTP
```

### 🔹 Domain

Contém as entidades e regras de negócio.

Exemplo:

* `Enterprise`

---

### 🔹 Application

Responsável por orquestrar as regras através de casos de uso.

Exemplos:

* `CreateEnterprise`
* `RetrieveEnterpriseById`
* `RetrieveEnterprises`
* `UpdateEnterprise`
* `DeleteEnterprise`

---

### 🔹 Infrastructure

Camada responsável pela comunicação com o banco de dados.

Exemplo:

* `EloquentEnterpriseRepository`

---

### 🔹 Interfaces

Camada de entrada da aplicação (HTTP).

Exemplo:

* `EnterpriseController`

---

## 🚀 Como rodar o projeto

### 📦 Instalação

```bash
git clone <repo-url>
cd gestao-financeira-api

composer install
```

---

### ⚙️ Configuração

Configure o arquivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestao_empresarial
DB_USERNAME=laravel
DB_PASSWORD=123456
```

---

### 🧱 Rodar migrations

```bash
php artisan migrate
```

---

### ▶️ Subir servidor

```bash
php artisan serve
```

A API estará disponível em:

```
http://127.0.0.1:8000
```

---

## 📡 Endpoints disponíveis

### ➕ Criar empresa

```http
POST /api/enterprise
```

**Body:**

```json
{
  "name": "Empresa X"
}
```

---

### 📄 Listar empresas

```http
GET /api/enterprise
```

---

### 🔍 Buscar empresa por ID

```http
GET /api/enterprise/{id}
```

---

### ✏️ Atualizar empresa

```http
PUT /api/enterprise/{id}
```

**Body:**

```json
{
  "name": "Empresa Atualizada"
}
```

---

### ❌ Remover empresa

```http
DELETE /api/enterprise/{id}
```

---

## 🧪 Ferramentas de teste

A API pode ser testada utilizando:

* Bruno
* Postman
* cURL

---

## 📚 Documentação da API (Swagger)

A documentação da API foi integrada utilizando o Swagger/OpenAPI através do pacote L5-Swagger.

### 🚀 Gerar documentação

Execute o comando:

```bash
php artisan l5-swagger:generate
```

### ▶️ Executar aplicação
```bash
php artisan serve
```

### 🌐 Acessar Swagger UI

Com a aplicação em execução, acesse:
http://127.0.0.1:8000/api/documentation

### 📌 Endpoints documentados

Atualmente a API possui documentação para os seguintes módulos:

  - Empresas (Enterprise)
  - Centros de custo (Cost Center)
  - Lançamentos financeiros (Financial Entry)
  - Fluxo de caixa (Cash Flow)
  - Fechamento mensal (Monthly Closing)
---
## 🧠 Decisões Técnicas

* Separação entre **domínio e infraestrutura**
* Uso de **Repository Pattern**
* Entidades independentes do framework
* Uso de **Use Cases** para orquestração de regras

---

## 🚧 Próximos passos

* Implementação de **Centro de Custo**
* Lançamentos financeiros
* Fluxo de caixa
* Regras de fechamento mensal

---

## 👨‍💻 Autor

Projeto desenvolvido como estudo e demonstração de boas práticas de arquitetura backend.
