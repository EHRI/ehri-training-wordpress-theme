#!/bin/bash
#
rsync -avl . --exclude .git --exclude .idea --exclude .gitignore --exclude node_modules --exclude *.iml --exclude vendor --exclude tmp ew2:/var/www/wordpress_training/wp-content/themes/ehritraining/
