# Projeto SPA e API REST TMDB

<<<<<<< HEAD
Este projeto é uma aplicação completa com backend em **Laravel** e frontend desacoplado em **Vue.js**, que consome a [API do TMDB](https://www.themoviedb.org/) para listar e gerenciar filmes populares, em cartaz, mais bem avaliados e lançamentos futuros.
=======
Este projeto é uma aplicação completa com backend em **Laravel** e frontend desacoplado em **Vue.js**, que consome a [API do TMDB](https://www.themoviedb.org/) para listar e gerenciar filmes populares, em cartaz, mais bem avaliados e lançamentos.
>>>>>>> main

---

## Obter chave da API do TMDB

1. Acesse: [https://www.themoviedb.org/](https://www.themoviedb.org/)
2. Crie uma conta gratuita.
3. Vá em configurações da conta > **API**.
4. Siga as instruções para gerar sua chave de API.
5. Adicione a chave no `.env` do backend como `TMDB_API_KEY`.

---

## Como rodar o projeto localmente com Docker

### Passo a passo

1. **Clone o repositório:**

   ```bash
   git clone https://github.com/jhjorge/KingHost.git
   cd KingHost
   ```

2. **Crie o arquivo `.env` do `backend`:**

   Copie de `.env.example` e configure:

   ```env
   TMDB_API_KEY=sua_chave_aqui
   TMDB_BASE_URL=https://api.themoviedb.org/3

   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=laravel
   DB_PASSWORD=secret
   ```

3. **Instale as dependências do `backend`:**

   ```bash
   composer install
   ```

4. **Crie o arquivo `.env` do `frontend`:**

   Copie de `.env.example` e configure:

   ```env
   VITE_APP_NAME='Cine APP'
   VITE_API_BASE_URL=http://localhost:8000/api/v1
   ```

5. **Suba os containers com Docker Compose:**

   ```bash
   docker-compose up -d
   ```

6. **Gere a chave da aplicação Laravel:**

   ```bash
   docker-compose exec app php artisan key:generate
   ```

7. **Execute as migrations:**

   ```bash
   docker-compose exec app php artisan migrate
   ```

8. **Acesse a aplicação:**

   - SPA (frontend): [http://localhost:5173](http://localhost:5173)
   - API (backend): [http://localhost:8000](http://localhost:8000)

---

## Como testar a aplicação

### Testes completos:

```bash
docker-compose exec app php artisan test
```

### Testes unitários específicos:

- **Filmes populares:**

  ```bash
  docker-compose exec app php artisan test --filter=test_getPopularMovies
  ```

- **Filmes em cartaz:**

  ```bash
  docker-compose exec app php artisan test --filter=test_getNowPlayingMovies
  ```

- **Filmes mais bem avaliados:**

  ```bash
  docker-compose exec app php artisan test --filter=test_getTopRatedMovies
  ```

- **Filmes em breve:**

  ```bash
  docker-compose exec app php artisan test --filter=test_getUpcomingMovies
  ```

---

## Tecnologias utilizadas

- Laravel 10 (API RESTful)
- Vue 3 + Vite (SPA)
<<<<<<< HEAD
=======
- Pinia
>>>>>>> main
- TailwindCSS
- Docker + Docker Compose
- PHPUnit
- The Movie Database API (TMDB)
<<<<<<< HEAD
=======

---

##  Estrutura do projeto

```
KingHost/
├── backend/          # Laravel API
│   ├── app/
│   ├── routes/
│   ├── tests/
│   └── ...
├── frontend/         # Vue 3 SPA
│   ├── src/
│   ├── public/
│   └── ...
└── docker-compose.yml
```

---

>>>>>>> main
