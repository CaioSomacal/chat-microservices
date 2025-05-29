version: '3.8'

services:
  auth-api:
    build: ./auth-api
    ports:
      - "8080:80"
    environment:
      - DB_HOST=postgres
      - DB_USER=user
      - DB_PASS=password
      - DB_NAME=auth_db
      - REDIS_HOST=redis
      - JWT_SECRET=your_ultra_secure_secret_key_here
    depends_on:
      - postgres
      - redis
    volumes:
      - ./auth-api:/var/www/html
      - ./auth-api/.env:/var/www/html/.env

  postgres:
    image: postgres:13
    environment:
      POSTGRES_USER: user
      POSTGRES_PASSWORD: password
      POSTGRES_DB: auth_db
    volumes:
      - postgres_data:/var/lib/postgresql/data
    ports:
      - "5432:5432"

  redis:
    image: redis:6
    ports:
      - "6379:6379"
    volumes:
      - redis_data:/data
    command: redis-server --requirepass yourredispassword

volumes:
  postgres_data:
  redis_data: