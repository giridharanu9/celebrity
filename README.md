
Git global setup

git config --global user.name "Govinda Yadav"
git config --global user.email "govinda.yadav@synergytop.com"

Create a new repository

git clone http://synerhytop.local:8888/govinda.yadav/laravel-celebrity.git
cd laravel-celebrity
touch README.md
git add README.md
git commit -m "add README"
git push -u origin master

Existing folder or Git repository

cd existing_folder
git init
git remote add origin http://synerhytop.local:8888/govinda.yadav/laravel-celebrity.git
git add .
git commit
git push -u origin master
