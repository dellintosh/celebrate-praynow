FROM dellintosh/symfony
MAINTAINER Justus Luthy <justus@luthyenterprises.com>

COPY app .

EXPOSE 80

ENTRYPOINT ["/init"]
