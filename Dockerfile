FROM ubuntu
#FROM laravel

RUN apt-get update

RUN apt-get install -y curl \
&& curl -sL https://deb.nodesource.com/setup_6.x | bash - \
&& apt-get install -y nodejs

RUN apt-get install -y software-properties-common python-software-properties \
&& add-apt-repository ppa:ondrej/php \
&& apt-get update \
&& apt-get install -y --allow-unauthenticated php7.0 php7.0-fpm php7.0-mysql php7.0-zip php7.0-gd mcrypt php7.0-mcrypt php7.0-mbstring php7.0-xml php7.0-curl php7.0-json php7.0-pgsql

RUN cd usr/local/sbin/  \
&& php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
&& php -r "if (hash_file('SHA384', 'composer-setup.php') === '61069fe8c6436a4468d0371454cf38a812e451a14ab1691543f25a9627b97ff96d8753d92a00654c21e2212a5ae1ff36') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
&& php composer-setup.php \
&& php -r "unlink('composer-setup.php');" \
&& mv composer.phar composer \
&& cd /

RUN apt-get install wget
# RUN cd /etc/apt/sources.list.d/ \
# && echo 'deb http://apt.postgresql.org/pub/repos/apt/ xenial-pgdg main' > pgdg.list \
# && wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | \
#   apt-key add -
# RUN apt-get update \
# && apt-get -y install postgresql-9.6
# RUN postgres psql | \
#     \password postgres | \
#     \q

RUN apt-get install -y git

RUN composer global require "laravel/installer"
RUN mkdir /var/opt/damusic \
    && cd /var/opt/damusic

EXPOSE 80
#php /var/opt/damusic/artisan serve --host=0.0.0.0 --port=80
CMD ["php","/var/opt/damusic/artisan","serve","--host=0.0.0.0","--port=80"]