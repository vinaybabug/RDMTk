# To clone the Github project to create a local copy on system 
git clone -b migrate2laravel4.2-docker https://github.com/vinaybabug/RDMTk.git

# Run Docker commands to create Docker images using docker build command 
# and Run the container instances using docker run command utilizing the created images

docker build -f Dockerfile_rdmtk -t home/rdmtk:dev .
docker run –-name rdmtk-app -p 88:80 -p 440:443 -d home/rdmtk:dev 

docker build -f Dockerfile_mysql -t home/rdmtk_db:dev .
docker run –-name rdmtk-mysql -p 8080:80 -p 3308:3306 -d home/rdmtk_db:dev

docker build -f Dockerfile_ranalysis -t home/rdmtk_ml:dev .
docker run –-name rdmtk-r -p 8080:80 -p 3308:3306 -d home/rdmtk_ml:dev

 
