rdmtkIGTBaselineModel <- function(taskType, exprID,  ...) {
  #This program does the EVL, Baseline, & Random Models for the IGT
  #EVL is the 3-parameter interference version
  #This program automatically handles data files where the number of trials varies by subject.
  #It can also handle deck depletion if you modify the cardsperdeck variable.
  #This program will only model up to the trial where one deck runs out.
  #Programmed by Anthony Bishara. Model from Busemeyer & Stout (2002).
  #Version 7 uses a digital filter (kudos to Ryan Jessup for this idea)


  #First Time R Users:
  #R is free, and can be downloaded and installed from http://www.r-project.org/.  To find the download, click CRAN on the left side, then, choose a nearby geographic location to download from, then choose your operating system.  For Windows users, choose "base" when you get a chance.

  #Instructions:
  #1) Run R.
  #2) In the program, click File, then Change Dir…, then choose the directory your data is in.
  #3) Use tab-delimated text format for the data like for Eldad’s program, but add a column for subject.  Columns=trial, deck, redundant, wins, losses, and subject.
  #Extra columns after the subject column are okay.
  #Don’t use column labels.
  #4) Modify the green sections below for your dataset.
  #5) Select all the text in this document (ctrl+a), then copy and paste into R
  #6) The output file is labelled "EVLresults_" plus the name of the data file.

  #rm(list=ls(all=TRUE))  					#This clears memory

  #-------------------------------------Modify this section for modeling your dataset-----------------------------------
  #dataname="fakedatasubj11and12.txt"
  #Data to import. Columns=trial, deck, redundant, wins, loss, subject, etc.
  payscale=100 				#e.g. payscale=100 if payouts are like +100,+50, -1250, etc.
  cardsperdeck=1000			#For dealing with deck depletion. Use huge value if no depletion.
  iterations=50				#Number of quasi-random starting parameter vectors. Default=50.
  #-----------------------------------------------------------------------------------------------------------------------------------------
  #-----------------Modify this section for calculating proportion advantageous for your dataset----------------
  trialsperblock=20		#This is most commonly 20
  blocks=6			#This is most commonly 5
  advdecks=c(2,4)		#advantagous decks should be listed inside the parentheses
  #advdecks=advdecksArg		#advantagous decks should be listed inside the parentheses
  #-----------------------------------------------------------------------------------------------------------------------------------------

  if(sum(rownames(installed.packages())=="fOptions")==0)	 #If the fOptions package is not installed, …
    install.packages("fOptions") 				#…install it now.

  library(fOptions) 						#This library is used for quasi-random generation
  numdecks=4  							#This option isn’t quite ready yet; keep it at 4.
  starttime=Sys.time()						#store the time
  #dat=read.table(dataname,sep="\t")				#load data file into dataframe named dat
  dat=rdmtkGetIGTData("IGT","jviGo1iyiE");			#load data file into dataframe named dat

  standcolnames= c("trial","deck","na","wins","losses","subj")	#standard column labels for dat
  numcolumns=length(colnames(dat))				#number of columns in dat
  if(numcolumns>6) standcolnames=c(standcolnames,paste("extra",1:(numcolumns-6),sep=""))
  colnames(dat)=standcolnames
  numsubj=sum(dat$trial==1)					#compute the number of subjects

  parbounds=c(0,0,-5,1,1,5)					#parameter bounds (min,min,…,max,max,…)
  #Quasi-random numbers are used instead of an
  #initial starting grid

  initparmatscaled=matrix(nrow=iterations,ncol=3)		#This section creates a matrix of quasi-random…
  sobelmat=runif.sobol(iterations,3,1,0,Sys.time())		#starting parameters and scales them.
  sobelmat[,3]=sobelmat[,3]*2.5-1.25				#This makes c from -1.25 to +1.25
  initparmat=sobelmat
  for (i in 1:iterations) initparmatscaled[i,]=scalepars(initparmat[i,],parbounds[1:3],parbounds[4:6])

  obsp=1:numdecks
  subjnumvec=rep(NA,numsubj)
  numtrialsvec=rep(NA,numsubj)
  g2base=rep(NA,numsubj)
  #g2rand=rep(NA,numsubj)
  #g2evl=rep(NA,numsubj)
  #parsevl=matrix(nrow=numsubj,ncol=3)
  trialstarters=((dat$trial==1)*seq(1,length(dat$trial)))[dat$trial==1]
  #firstminvec=rep(NA,numsubj)

  for (cursubj in 1:numsubj)
  {
    trialpointer=trialstarters[cursubj]				#update the current trial to start from
    numtrials=sum(dat$subj==dat$subj[trialpointer])		#determine number of trials for that person
    subjmat=dat[trialpointer:(trialpointer+numtrials-1),]

    cumdeckmat=matrix(0,nrow=numtrials,ncol=numdecks)	#This section creates a matrix for a…
    cumdeckmat[1,subjmat$deck[1]]=1				#cumulative count of decks chosen…
    for (curtrial in 2:numtrials)					#and then truncates according to the…
    {							#cardsperdeck variable.
      choicevec=rep(0,numdecks)
      choicevec[subjmat$deck[curtrial]]=1
      cumdeckmat[curtrial,]=cumdeckmat[curtrial-1,]+choicevec
      if((max(cumdeckmat[curtrial,])>=cardsperdeck)&(curtrial<numtrials))
      {
        numtrials=curtrial
      }
    }
    subjmat=subjmat[1:numtrials,]

    numtrialsvec[cursubj]=numtrials
    obspmat=matrix(nrow=numtrials,ncol=numdecks)
    subjnumvec[cursubj]=as.character(subjmat$subj[1])

    #run baseline and random model
    for (curdeck in 1:numdecks)
    {
      obsp[curdeck]=sum(subjmat[,2]==curdeck)/numtrials
      obspmat[,curdeck]=subjmat[,2]==curdeck
    }
    predpbasemat=matrix(obsp,nrow=numtrials,ncol=numdecks,byrow=TRUE)
    predpbasemat= .0001 + .9998*predpbasemat
    #note that the following loglikelihoods exclude trial 1 just like EVL model
    loglikebase=sum(log(rowSums(obspmat*predpbasemat)[2:numtrials]))
    #loglikerand=(numtrials-1)*log(.0001+.9998/numdecks)
    g2base[cursubj]=-2*loglikebase
    #g2rand[cursubj]=-2*loglikerand
  }

  outputmat=matrix(c(subjnumvec,numtrialsvec,g2base),nrow=numsubj,ncol=3)

  colnames(outputmat)=c("subject","numtrials","g2base")
  # create temprory file
  #write.table(outputmat,file=tempFile,row.names=FALSE, fileEncoding = "utf8")

  ## read temp file as a binary string
  #txt_binary <-  data.frame(g = I(lapply(outputmat, function(x) { rawToChar(serialize(x, NULL, ascii=TRUE))})) )

  txt_binary <-  serialize(outputmat, NULL, ascii=TRUE)
  txt_binary <- rawToChar(txt_binary)



  #Insert results in the database
  library(DBI);
  library(pwr);
  # Connect to my-db as defined in ~/.my.cnf
  con <- dbConnect(RMySQL::MySQL(), group = "my-db");

  # Count number of records in bart_expr_data for given exprAID and exprBID:
  SQL <- paste("SELECT EXISTS(SELECT * FROM expr_anlys_data WHERE experid ='", exprID, "' and expertype = '", taskType,"' and anlys_mdl = 'BASE_MDL');", sep = "");
  res <- dbSendQuery(con, SQL);
  tempRslt <- dbFetch(res);
  dbClearResult(res);

  if(tempRslt[1] == 0){
    SQL <- sprintf("INSERT INTO `rdmtoolkit`.`expr_anlys_data`(`experid`, `expertype`, `anlys_mdl`, `anlys_rslt`, `created_by`, `modified_by`)
    VALUES ( '%s', '%s', '%s', '%s', '%s', '%s');", exprID, taskType, 'BASE_MDL', txt_binary, "R", "R");
    ## insert binary sting into a table
    res <- dbSendQuery(con, SQL);
    dbClearResult(res);
  }
  else{

    SQL <- sprintf("UPDATE `rdmtoolkit`.`expr_anlys_data`
                    SET
                    `anlys_rslt` = '%s',
                    `modified_by` = '%s'
                    WHERE `experid` = '%s' AND `expertype` = '%s' AND `anlys_mdl` = '%s';", txt_binary, "R", exprID, taskType, 'BASE_MDL');
    res <- dbSendQuery(con, SQL);
    dbClearResult(res);

  }


  # Disconnect from the database
  dbDisconnect(con);
  #returnList <- list("loglikebase" = loglikebase, "g2base" = g2base, "subjnumvec" = subjnumvec);
  #return(returnList);
}
