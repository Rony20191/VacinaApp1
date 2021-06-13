# Como rodar o projeto ?

### Descrição: <br/>

  Projeto VacinaApi criado com Laravel PHP + Docker + Vuejs + Vuetify 
 

#### 1 - Passo:<br/>
```docker-compose up -d --build```


#### 2 -  Passo:
Para verificar se o banco de dados foi criado.
Entra no container e executar os seguintes comandos: 
``` 
    composer install
    php artisan key:generate
    php artisan migrate
    
    npm run install
    npm run watch
```

#### 3 - Passo:

```http://127.0.0.1:8100/```
