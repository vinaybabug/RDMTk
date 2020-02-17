#!/bin/bash

#mkdir -p /home/ocpu/rdmtk_script_started

# for testing make instance id hardcoded

instance_id="i-0fbda295";

echo $instance_id;

# A researcher in RDMTk would have created list of 
# analysis jobs for a perticular aws instance_id.
# Get list of jobs assigned to this instance.

results=$(mysql -uocpu -ppassword -hrdmtk.wise.cs.wmich.edu -e "SELECT username FROM rdmtoolkit.aws_rdmtk_config where aws_instanceid='$instance_id'")


#echo $results;

#results=($(mysql --user root -pwelcome ts -Bse "SELECT type, network_id, subnet_msk FROM remote_subnet;"))

read -ra vars <<< $results;


#for i in "${vars[@]}";
#do
#    echo $i;
#done

echo "USERNAME:" ${vars[1]};

# Now that we know which user owns this instance
# call/invoke root R script that will list all the
# assigned jobs at the time and run corrsponding 
# analysis functions.

Rscript /home/ubuntu/startup_rdmtk.r ${vars[1]}

