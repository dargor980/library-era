# Usa la imagen base de Grafana
FROM grafana/grafana:latest

# Define variables de entorno
ENV GF_SECURITY_ADMIN_PASSWORD=admin


COPY /docker/grafana/grafana.ini /etc/grafana/grafana.ini
COPY /docker/grafana/provisioning/dasboards /etc/grafana/provisioning/dashboards
COPY /docker/grafana/dashboards /var/lib/grafana/dashboards


EXPOSE 3000


CMD ["grafana-server", "--homepath=/usr/share/grafana"]