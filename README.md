# todoList

#### Clone le projet ####

    git clone https://github.com/ezekiela0701/todoList.git

#### basculer branch develop et install composant ####

    git checkout develop

    composer install

    yarn add

#### creer la base de données ####

    php bin/console doctrine:database:create

    php bin/console d:s:u -f

#### Lancer server vuejs ####

    yarn encore dev-server 

#### Creer le vhost de symfony ####
le mieux c'est d'utiliser un vhost mais vous pouvez lancer aussi php bin/console server:run

