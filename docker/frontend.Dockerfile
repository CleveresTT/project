# Этап сборки Vue
FROM node:24-alpine AS frontend-builder
WORKDIR /app/frontend
COPY frontend/package*.json ./
RUN npm ci
COPY frontend/ ./
RUN npm run build   # результат в ./dist

# Этап финального образа с Nginx
FROM nginx:stable-alpine

# Копируем конфиг Nginx
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Копируем собранный фронтенд
COPY --from=frontend-builder /app/frontend/dist /var/www/project/frontend/dist
