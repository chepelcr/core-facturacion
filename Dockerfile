# 1. Usar una imagen base de Ubuntu
FROM ubuntu:22.04

# 2. Configuraciones de seguridad del servidor.

# Instalar paquetes de seguridad
RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y nmap rkhunter chkrootkit iptables fail2ban

# Descargar script de firewall
RUN wget -c https://linux.jcampos.me/public/files/firewall.sh && \
    bash firewall.sh

# Protección de ataques de fuerza bruta
RUN cp -a /etc/fail2ban/jail.conf /etc/fail2ban/jail.local && \
    systemctl restart fail2ban

# 2. Actualizar e instalar paquetes necesarios para LAMP
RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y apache2 sudo

RUN a2enmod rewrite && \
    systemctl restart apache2

# Agregar el repositorio de PHP
RUN add-apt-repository ppa:ondrej/php

# Instalar librerias de PHP
RUN apt install php8.1 && \
 apt install php8.1-fpm libapache2-mod-fcgid && \
 apt install -y php8.1-mysql php8.1-dom php8.1-simplexml php8.1-ssh2 php8.1-xml php8.1-xmlreader php8.1-curl php8.1-ftp php8.1-gd  php8.1-iconv php8.1-imagick php8.1-mbstring php8.1-posix php8.1-sockets php8.1-tokenizer && \
 apt install -y php8.1-mysqli php8.1-pdo  php8.1-sqlite3 php8.1-ctype php8.1-fileinfo php8.1-zip php8.1-exif && \
 apt install php8.1-{cli,fpm,common,intl,tidy,soap,bcmath,xmlrpc}

# 3. Crear un usuario sysadmin y agregarlo al grupo sudo
RUN useradd -ms /bin/bash sysadmin && \  # Crear el usuario sysadmin
    echo 'sysadmin:Chpcr0971.' | chpasswd && \  # Establecer la contraseña del usuario sysadmin
    usermod -aG sudo sysadmin  # Agregar sysadmin al grupo sudo

# 4. Deshabilitar acceso por root en SSH
#COPY sshd_config /etc/ssh/sshd_config  # Archivo de configuración para SSH que deshabilita root

# 6. Configurar Apache para trabajar con PHP y MySQL/MariaDB

# Copiar tu aplicación web PHP al servidor
COPY . /var/www/html/

# 7. Habilitar servicios para que se inicien al arrancar el contenedor
RUN systemctl enable apache2 && \
    systemctl enable ssh

# 8. Exponer puertos para la aplicación web, SSH y MySQL/MariaDB

# Apache
EXPOSE 80

# SSH
EXPOSE 22

# 9. Definir el comando para ejecutar al iniciar el contenedor
CMD ["/bin/bash", "-c", "service apache2 start && service ssh start && tail -f /dev/null"]
