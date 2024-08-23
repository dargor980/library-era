FROM nginx

ADD nginx.conf /etc/nginx/nginx.conf
ADD app.conf /etc/nginx/conf.d/default.conf
RUN echo "upstream app-upstream { server app:9000; }" > /etc/nginx/conf.d/upstream.conf

EXPOSE 80

CMD ["nginx"]
