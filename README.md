# Get Started

```bash
docker compose up -d
```

```bash
 docker compose exec php sh -c '
    set -e
    apk add openssl
    php bin/console lexik:jwt:generate-keypair
    setfacl -R -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
    setfacl -dR -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
'


docker compose exec php php bin/console d:s:u --force

docker compose exec php php bin/console d:f:l
```

# Production

Install Heroku CLI
```bash
    curl https://cli-assets.heroku.com/install-ubuntu.sh | sh
```

Login to Heroku
```bash
    heroku login
```

Create Git repository
```bash
    cd front/
    git init
    heroku git:remote -a spadoption-front
```

Deploy
```bash
    git add .
    git commit -am "make it better"
    git push heroku master
```
