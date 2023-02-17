# production environment
FROM nginx:1.23-alpine

COPY --chown=nginx:nginx /build /usr/share/nginx/html/admin/ciutatagora/
COPY /nginx/nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]