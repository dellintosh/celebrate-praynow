FROM dellintosh/symfony
MAINTAINER Justus Luthy <justus@luthyenterprises.com>

# Setup default environment (as production)
ENV SYMFONY_DEBUG 0
ENV SYMFONY_ENV "prod"

COPY app .

EXPOSE 80

ENTRYPOINT ["/init"]
