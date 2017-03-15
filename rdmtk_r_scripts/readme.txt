#install packages for IGT analysis
install.packages("fOptions" , lib="/usr/lib/R/library/")
install.packages("DBI" , lib="/usr/lib/R/library/")

#Install Package ‘RMySQL’

Dependecnies:
sudo apt-get install libmariadbclient-dev

install.packages('RMySQL', type = 'source', lib="/usr/lib/R/library/")

Install Package ‘pwr’
install.packages("pwr", repos="http://cran.r-project.org", lib="/usr/lib/R/library/")


Install OpenCPU

#requires ubuntu 14.04 (Trusty)
sudo add-apt-repository -y ppa:opencpu/opencpu-1.5
sudo apt-get update 
sudo apt-get upgrade <-- optional

#install opencpu server
sudo apt-get install -y opencpu

#to make package to go dirctory containing package dir RDMTkAnalysisR
R CMD build RDMTkAnalysisR

#to insall package
install.packages(path_to_file, repos = NULL, type="source", lib="/usr/lib/R/library/")


# to add aws bootstrap on the ubuntu machine do

1. Edit corn job sudo crontab -e
2. Add this to end of the file @reboot /home/ubuntu/startup_rdmtk.sh
3. halt system after (2)

