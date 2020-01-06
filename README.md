HMIN302: Projet Symfony

SABA Joseph et RIMA Bachar

Lien Heroku:
===============
https://hmin302-symfony-blog.herokuapp.com/

Compte admin:
===============
  username: josephsaba
  password: josephsaba


Commentaires:
===============

Nous avons eu beaucoup de difficulté pour deployer sur Heroku. Le problem venait du Procfile, ainsi que des URL Rewrite.
Nous avons eu un autre problem que nous avons pas pu resoudre:
    - Pour ajouter du Styling au pages de Login, Register (les pages qui proviennent de FoS User), nous avons fait un override des Templates
      situées dans vendor/friendsofsymfony/userbundle/Resources/views.
      Quand nous avons deployés sur Heroku, les pages ont perdus le Styling que nous avons ajouté. Heroku est en train d'ignorer nos modifications
      dans le dossier Vendor bien que se dossier est exclu du .gitignore.
      Ce lien contient deux images qui montrent les pages de Log in et Register avec leur style: https://imgur.com/a/3tH1fEj
      
Appréciation sur le cours pour l’année suivante:
==================================================
Ce cours est trés bien fait. C'etait la partie la plus interessante de cette UE. Le projet couvre bien les bases et les seances de cours etaient
facile à suivre et jamais ennuiyantes.
