# 🛍️ Sistema de Gerenciamento de Produtos

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-3-003B57?style=for-the-badge&logo=sqlite&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

Sistema completo de CRUD para gerenciamento de produtos com dashboard interativo, gráficos e exportação de dados.

</div>

---

## 📋 Índice

- [Sobre o Projeto](#-sobre-o-projeto)
- [Funcionalidades](#-funcionalidades)
- [Tecnologias](#-tecnologias-utilizadas)
- [Requisitos](#-requisitos)
- [Instalação](#-instalação)
- [Como Usar](#-como-usar)
- [Estrutura do Projeto](#-estrutura-do-projeto)
- [Exportação de Dados](#-exportação-de-dados)
- [Contribuindo](#-contribuindo)

---

## 🎯 Sobre o Projeto

Sistema web desenvolvido em **Laravel 11** para gerenciamento completo de produtos, incluindo controle de estoque, dashboard analítico com gráficos interativos e funcionalidades avançadas de filtragem e exportação.

Este projeto foi desenvolvido como uma solução robusta e profissional para gerenciamento de inventário, demonstrando:
- Arquitetura MVC bem estruturada
- API RESTful completa
- Interface moderna e responsiva
- Validações robustas
- Visualização de dados com gráficos

---

## ✨ Funcionalidades

### 🔧 Backend (API RESTful)
- ✅ **CRUD Completo** - Criar, Listar, Atualizar e Excluir produtos
- ✅ **Paginação** - Listagem paginada para melhor performance
- ✅ **Pesquisa Inteligente** - Busca por nome com suporte a texto parcial
- ✅ **Filtros Avançados** - Por preço (mín/máx) e quantidade mínima
- ✅ **Ordenação Dinâmica** - Por qualquer campo (ASC/DESC)
- ✅ **Validação Completa** - Regras de negócio implementadas
- ✅ **Dashboard Analítico** - Estatísticas e métricas do estoque
- ✅ **Exportação** - Excel (.xlsx)

### 🎨 Frontend
- ✅ **Interface Moderna** - Design gradiente roxo/azul profissional
- ✅ **Responsivo** - Funciona em desktop, tablet e mobile
- ✅ **Operações AJAX** - Sem recarregar a página
- ✅ **Dashboard Interativo** - Com gráficos Chart.js
- ✅ **Filtros em Tempo Real** - Resultados instantâneos
- ✅ **Notificações** - Feedback visual para todas as ações
- ✅ **Modal para Formulários** - Experiência fluida
- ✅ **Badges de Status** - Indicadores visuais de estoque
- ✅ **Confirmação de Exclusão** - Previne erros

### 📊 Dashboard
- **Total de Produtos** - Contador geral do estoque
- **Valor Total** - Soma do valor de todos os produtos
- **Produtos com Baixo Estoque** - Alerta de itens < 10 unidades
- **Preço Médio** - Média dos preços dos produtos
- **Gráfico Pizza** - Distribuição por faixa de preço
- **Gráfico Barras** - Top 5 produtos mais caros
- **Tabela de Alertas** - Lista detalhada de produtos críticos

---

## 🛠 Tecnologias Utilizadas

### Backend
- **Laravel 11** - Framework PHP moderno
- **PHP 8.2+** - Linguagem de programação
- **SQLite** - Banco de dados (ou MySQL/PostgreSQL)
- **Eloquent ORM** - Mapeamento objeto-relacional
- **Laravel Excel** - Exportação para Excel

### Frontend
- **HTML5** - Estrutura semântica
- **CSS3** - Estilização moderna (gradientes, animações)
- **JavaScript (Vanilla)** - Lógica e interatividade
- **Chart.js** - Gráficos interativos
- **Fetch API** - Requisições assíncronas

---

## 📦 Requisitos

Antes de começar, certifique-se de ter instalado:

- **PHP >= 8.2**
- **Composer** (gerenciador de dependências PHP)
- **SQLite** (ou MySQL/PostgreSQL se preferir)
- Extensões PHP: `pdo`, `mbstring`, `openssl`, `fileinfo`, `xml`, `zip`

### Como verificar se você tem os requisitos:

```bash
# Verificar versão do PHP
php -v

# Verificar se o Composer está instalado
composer --version
```

Se não tiver instalado:
- **PHP**: Baixe em [php.net](https://www.php.net/downloads)
- **Composer**: Baixe em [getcomposer.org](https://getcomposer.org/download/)

---

## 🚀 Instalação

### Passo 1: Clonar o Repositório

```bash
git clone https://github.com/seu-usuario/sistema-produtos.git
cd sistema-produtos
```

### Passo 2: Instalar Dependências

```bash
composer install
```

Este comando irá baixar todas as bibliotecas necessárias do Laravel.

### Passo 3: Configurar Ambiente

```bash
# Copiar arquivo de configuração
cp .env.example .env

# Gerar chave da aplicação
php artisan key:generate
```

### Passo 4: Configurar Banco de Dados

Edite o arquivo `.env` na raiz do projeto:

#### Opção A: SQLite (Recomendado para Teste)

```env
DB_CONNECTION=sqlite
# Comente ou remova as linhas abaixo:
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

Crie o arquivo do banco:
```bash
touch database/database.sqlite
```

#### Opção B: MySQL

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistema_produtos
DB_USERNAME=root
DB_PASSWORD=sua_senha
```

Crie o banco de dados:
```bash
mysql -u root -p
CREATE DATABASE sistema_produtos;
exit;
```

### Passo 5: Executar Migrations

```bash
php artisan migrate
```

Este comando criará a tabela `produtos` no banco de dados.

### Passo 6: Popular com Dados de Exemplo (Opcional)

```bash
php artisan db:seed
```

Isso irá adicionar **15 produtos de exemplo** para você testar o sistema imediatamente.

### Passo 7: Iniciar o Servidor

```bash
php artisan serve
```

✅ **Pronto!** Acesse: [http://localhost:8000](http://localhost:8000)

---

## 💡 Como Usar

### 1. Dashboard

Ao abrir o sistema, você verá o **Dashboard** com:
- Cards de estatísticas
- Gráficos interativos
- Lista de produtos com baixo estoque

### 2. Gerenciar Produtos

Clique na aba **"📦 Produtos"** para:

#### Adicionar Novo Produto
1. Clique em **"+ Novo Produto"**
2. Preencha os campos:
   - **Nome** (obrigatório)
   - **Descrição** (opcional)
   - **Preço** (obrigatório, deve ser maior que 0)
   - **Quantidade** (obrigatório, número inteiro positivo)
3. Clique em **"Salvar"**

#### Pesquisar Produtos
- Digite no campo de busca no topo
- A pesquisa é feita automaticamente enquanto você digita

#### Filtrar Produtos
Use os filtros:
- **Preço Mínimo** - Mostrar apenas produtos acima deste valor
- **Preço Máximo** - Mostrar apenas produtos abaixo deste valor
- **Quantidade Mínima** - Filtrar por quantidade em estoque
- Clique em **"Limpar Filtros"** para resetar

#### Ordenar Produtos
- Clique nos **cabeçalhos da tabela** (ID, Nome, Preço, Quantidade)
- A seta indica a direção da ordenação (↑ crescente, ↓ decrescente)

#### Editar Produto
1. Clique no botão **"Editar"** na linha do produto
2. Modifique os dados desejados
3. Clique em **"Salvar"**

#### Excluir Produto
1. Clique no botão **"Excluir"**
2. Confirme a exclusão na janela de confirmação

### 3. Exportar Dados

#### Exportar para Excel
1. Clique em **"📊 Exportar Excel"**
2. O arquivo `.xlsx` será baixado automaticamente
3. Abra no Microsoft Excel, Google Sheets ou LibreOffice

**O arquivo Excel contém:**
- Cabeçalho formatado (fundo roxo, texto branco)
- Colunas com largura ajustada
- Valores formatados em Real (R$)
- Coluna com valor total por produto (preço × quantidade)
- Data de cadastro


### 4. Navegação e Paginação

- Use os botões **"← Anterior"** e **"Próxima →"** para navegar
- A informação de página aparece no centro (ex: "Página 1 de 4")
- Mostra quantos registros estão sendo exibidos

---

## 📁 Estrutura do Projeto

```
sistema-produtos/
├── app/
│   ├── Exports/
│   │   └── ProdutosExport.php          # Classe de exportação Excel
│   ├── Http/
│   │   └── Controllers/
│   │       └── ProdutoController.php    # Controlador principal
│   └── Models/
│       └── Produto.php                  # Model Eloquent
│
├── database/
│   ├── migrations/
│   │   └── xxxx_create_produtos_table.php  # Schema da tabela
│   └── seeders/
│       ├── DatabaseSeeder.php              # Seeder principal
│       └── ProdutoSeeder.php               # Dados de exemplo
│
├── resources/
│   └── views/
│       └── produtos/
│           └── index.blade.php          # Interface do usuário
│
├── routes/
│   └── web.php                          # Definição de rotas
│
├── .env.example                         # Exemplo de configuração
├── composer.json                        # Dependências PHP
└── README.md                            # Este arquivo
```

---

## 📊 Exportação de Dados

### Excel (.xlsx)

O arquivo Excel gerado contém:

**Formatação Profissional:**
- Cabeçalho com fundo roxo (#667eea) e texto branco
- Colunas com largura automática ajustada
- Alinhamento centralizado no cabeçalho
- Valores monetários formatados (R$ 1.234,56)

**Colunas Incluídas:**
1. ID
2. Nome
3. Descrição
4. Preço (R$)
5. Quantidade
6. Valor Total (R$) - Calculado automaticamente
7. Data de Cadastro

**Como Usar o Arquivo:**
- Abra diretamente no Microsoft Excel
- Importe no Google Sheets
- Use no LibreOffice Calc
- Importe em sistemas ERP

**Características:**
- Separador: ponto e vírgula (;)
- Encoding: UTF-8 com BOM
- Formato brasileiro (vírgula para decimais)

---

## 🎨 Design e UX

### Paleta de Cores
- **Primário**: Gradiente roxo/azul (#667eea → #764ba2)
- **Sucesso**: Verde (#48bb78)
- **Perigo**: Vermelho (#f56565)
- **Neutro**: Cinza (#718096)

### Badges de Status de Estoque
- 🔴 **Vermelho** - Estoque crítico (< 10 unidades)
- 🟠 **Laranja** - Estoque baixo (10-19 unidades)
- 🟢 **Verde** - Estoque adequado (≥ 20 unidades)

### Responsividade
- **Desktop**: Layout completo com todas as funcionalidades
- **Tablet**: Colunas ajustadas, gráficos redimensionados
- **Mobile**: Interface adaptada, botões maiores

---

## 🔒 Segurança

### Medidas Implementadas

1. **Proteção CSRF**
   - Token CSRF em todas requisições POST/PUT/DELETE
   - Laravel gera tokens únicos por sessão

2. **Validação de Dados**
   - Validação no backend (nunca confiar no frontend)
   - Mensagens de erro personalizadas
   - Tipos de dados verificados

3. **SQL Injection**
   - Eloquent ORM com queries parametrizadas
   - Proteção automática do Laravel

4. **XSS (Cross-Site Scripting)**
   - Blade escapa HTML automaticamente
   - Sanitização de inputs

5. **Mass Assignment**
   - `$fillable` definido no Model
   - Proteção contra campos não permitidos

---

## ⚡ Performance

### Otimizações Implementadas

1. **Paginação**
   - Carrega apenas 10-50 itens por vez
   - Reduz consumo de memória
   - Melhora velocidade de resposta

2. **Busca com Debounce**
   - Aguarda 500ms após digitar
   - Evita requisições excessivas
   - Melhora experiência do usuário

3. **Cache de Configurações**
   - Laravel cacheia configurações
   - Reduz leitura de arquivos

4. **Queries Otimizadas**
   - Usa índices do banco
   - Seleciona apenas campos necessários
   - Evita N+1 queries

---

## 🧪 Testando o Sistema

### Teste Manual Completo

**1. Teste de CRUD:**
```
✓ Criar produto com dados válidos
✓ Criar produto com dados inválidos (verificar validação)
✓ Editar produto existente
✓ Excluir produto (com confirmação)
✓ Listar todos os produtos
```

**2. Teste de Pesquisa:**
```
✓ Buscar por nome completo
✓ Buscar por nome parcial
✓ Buscar texto que não existe
```

**3. Teste de Filtros:**
```
✓ Filtrar por preço mínimo
✓ Filtrar por preço máximo
✓ Filtrar por quantidade
✓ Combinar múltiplos filtros
✓ Limpar filtros
```

**4. Teste de Ordenação:**
```
✓ Ordenar por ID (crescente/decrescente)
✓ Ordenar por Nome
✓ Ordenar por Preço
✓ Ordenar por Quantidade
```

**5. Teste de Exportação:**
```
✓ Exportar para Excel
✓ Exportar para CSV
✓ Abrir arquivos exportados
```

**6. Teste de Dashboard:**
```
✓ Verificar estatísticas corretas
✓ Interagir com gráficos
✓ Verificar lista de baixo estoque
```

### Teste com cURL

```bash
# Listar produtos
curl http://localhost:8000/api/produtos

# Criar produto
curl -X POST http://localhost:8000/api/produtos \
  -H "Content-Type: application/json" \
  -H "X-CSRF-TOKEN: seu-token-aqui" \
  -d '{
    "nome": "Produto Teste",
    "descricao": "Teste via cURL",
    "preco": 99.90,
    "quantidade": 10
  }'

# Buscar produto
curl http://localhost:8000/api/produtos/1

# Atualizar produto
curl -X PUT http://localhost:8000/api/produtos/1 \
  -H "Content-Type: application/json" \
  -H "X-CSRF-TOKEN: seu-token-aqui" \
  -d '{
    "nome": "Produto Atualizado",
    "descricao": "Atualizado via cURL",
    "preco": 149.90,
    "quantidade": 20
  }'

# Excluir produto
curl -X DELETE http://localhost:8000/api/produtos/1 \
  -H "X-CSRF-TOKEN: seu-token-aqui"

# Dashboard
curl http://localhost:8000/api/produtos/dashboard
```

---

## 🐛 Solução de Problemas

### Erro: "No application encryption key"
```bash
php artisan key:generate
```

### Erro: "SQLSTATE[HY000]"
Verifique a configuração do banco no `.env`

### Erro 500 ao acessar
```bash
# Limpar caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Verificar permissões
chmod -R 775 storage bootstrap/cache
```

### Página em branco
1. Verifique se o arquivo `resources/views/produtos/index.blade.php` existe
2. Verifique erros no console do navegador (F12)
3. Olhe os logs: `storage/logs/laravel.log`

### Exportação não funciona
```bash
# Reinstalar Laravel Excel
composer require maatwebsite/excel
```

---

## 🚀 Deploy em Produção

### Preparação

1. **Configure o .env para produção:**
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://seu-dominio.com

# Use banco de dados robusto (MySQL/PostgreSQL)
DB_CONNECTION=mysql
DB_HOST=seu-host
DB_PORT=3306
DB_DATABASE=seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=senha_segura
```

2. **Otimize a aplicação:**
```bash
# Cache de configuração
php artisan config:cache

# Cache de rotas
php artisan route:cache

# Cache de views
php artisan view:cache

# Otimizar autoload
composer install --optimize-autoloader --no-dev
```

3. **Configure permissões:**
```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Servidores Recomendados
- **Heroku** - Deploy fácil com Git
- **DigitalOcean** - VPS com Laravel pré-configurado
- **AWS** - Escalável para grandes volumes
- **Shared Hosting** - cPanel com PHP 8.2+

---

## 📝 Requisitos Atendidos

### ✅ Parte 1: Backend

| Requisito | Status | Implementação |
|-----------|--------|---------------|
| Tabela produtos com campos especificados | ✅ | Migration completa |
| Listar todos os produtos | ✅ | `GET /api/produtos` |
| Exibir detalhes de produto | ✅ | `GET /api/produtos/{id}` |
| Criar novo produto | ✅ | `POST /api/produtos` |
| Atualizar produto | ✅ | `PUT /api/produtos/{id}` |
| Excluir produto | ✅ | `DELETE /api/produtos/{id}` |
| Validação: nome obrigatório | ✅ | Validador Laravel |
| Validação: preço positivo | ✅ | `min:0.01` |
| Validação: quantidade positiva | ✅ | `min:0` |
| Pesquisa por nome (parcial) | ✅ | `LIKE %termo%` |

### ✅ Parte 2: Frontend

| Requisito | Status | Implementação |
|-----------|--------|---------------|
| Página HTML com tabela | ✅ | Blade com tabela dinâmica |
| Carregar via AJAX | ✅ | Fetch API |
| Preencher dinamicamente | ✅ | JavaScript renderiza HTML |
| Excluir via AJAX | ✅ | DELETE com Fetch |
| Confirmação de exclusão | ✅ | `confirm()` nativo |

---

## 🌟 Melhorias Implementadas (Diferenciais)

### Além dos Requisitos Básicos

1. **📊 Dashboard Completo**
   - Cards de estatísticas
   - Gráficos interativos (Chart.js)
   - Alertas de baixo estoque

2. **📄 Paginação**
   - Navegação entre páginas
   - Configurável (10, 25, 50 itens)
   - Info de registros exibidos

3. **🔍 Filtros Avançados**
   - Por faixa de preço
   - Por quantidade mínima
   - Combinação de múltiplos filtros

4. **⬆️⬇️ Ordenação**
   - Clique nos cabeçalhos
   - Indicadores visuais
   - Ordem crescente/decrescente

5. **📥 Exportação de Dados**
   - Excel (.xlsx) formatado
   - Dados prontos para análise

6. **🌱 Seeder**
   - 15 produtos de exemplo
   - Facilita demonstração
   - Dados realistas

7. **🎨 Design Profissional**
   - Interface moderna
   - Gradientes e animações
   - Responsivo

8. **🔔 Notificações**
   - Toast messages animadas
   - Feedback em tempo real
   - Auto-hide após 5s

9. **🏷️ Badges de Status**
   - Indicadores coloridos
   - Alertas visuais
   - Código de cores intuitivo

10. **📱 Responsividade**
    - Mobile-first
    - Adapta a qualquer tela
    - Touch-friendly

---

## 🤝 Contribuindo

Contribuições são bem-vindas! Para contribuir:

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

### Ideias para Contribuir

- 🔐 Adicionar autenticação de usuários
- 📸 Upload de imagens dos produtos
- 🏷️ Sistema de categorias
- 📊 Mais relatórios e gráficos
- 🔔 Notificações push
- 📱 App mobile (React Native/Flutter)
- 🌍 Internacionalização (i18n)
- 🧪 Testes automatizados (PHPUnit)
- 🐳 Docker para deployment
- 📝 Logs de auditoria

---

## 📄 Licença

Este projeto foi desenvolvido para fins educacionais e de demonstração técnica.

---

##
