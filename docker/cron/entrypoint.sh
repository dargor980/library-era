#!/bin/sh
# Iniciar el servicio de cron

crontab /var/spool/cron/crontabs/cron

cron -f
