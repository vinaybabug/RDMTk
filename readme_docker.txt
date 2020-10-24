docker build -f Dockerfile_rdmtk -t home/rdmtk:dev .
docker run -d -p 80:80 -p 443:443 -p home/rdmtk:dev
docker build -f Dockerfile_mysql -t home/rdmtk_db:dev .
docker run -d -p 8080:80 -p 3308:3306 home/rdmtk_db:dev
docker build -f Dockerfile_ranalysis -t home/rdmtk_ml:dev .
docker run -d -p 8080:80 -p 3308:3306 home/rdmtk_ml:dev

 
