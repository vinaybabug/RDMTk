rdmtkIGTEVLModel <- function(taskType, exprID,  ...) {
  #This program does the EVL (expectancy-valance learning model), Baseline, & Random Models for the IGT
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

  rm(list=ls(all=TRUE))  					#This clears memory

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
  advdecks=c(3,4)		#advantagous decks should be listed inside the parentheses
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
  g2rand=rep(NA,numsubj)
  g2evl=rep(NA,numsubj)
  parsevl=matrix(nrow=numsubj,ncol=3)
  trialstarters=((dat$trial==1)*seq(1,length(dat$trial)))[dat$trial==1]
  firstminvec=rep(NA,numsubj)

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
    loglikerand=(numtrials-1)*log(.0001+.9998/numdecks)
    g2base[cursubj]=-2*loglikebase
    g2rand[cursubj]=-2*loglikerand

    #run evl model
    for (curiter in 1:iterations)
    {
      initpars=initparmatscaled[curiter,]
      subjmat$wins<-as.numeric(as.character(subjmat$wins)) # convert this column from string to numeric
      tempmod=optim(initpars,rlcG2fun,tempparbounds=parbounds,deckchoices=subjmat$deck,wins=abs(subjmat$wins),losses=subjmat$losses,control=list(reltol=1e-6))

      #Note that "trials=" is the number of trials modeled, which may be less than the total if…
      #one of the decks ran out before the task was over.
      #print(noquote(c("subject=",subjnumvec[cursubj],"  iter=",curiter,"  trials=",numtrials)))
      g2impr=g2base[cursubj]-tempmod$val
      curpars=unscalepars(tempmod$par,parbounds[1:3],parbounds[4:6])
      #print(noquote(c("g2imp&pars=",round(c(g2impr,curpars),3))))
      #print(noquote(""))
      #flush.console()

      if(curiter==1)
      {
        rlcmod=tempmod
        firstminvec[cursubj]=1
      } else if(tempmod$value<rlcmod$value)
      {
        if((rlcmod$value-tempmod$value)>.001) firstminvec[cursubj]=curiter
        rlcmod=tempmod
      }
    }
    g2evl[cursubj]=rlcmod$value
    parsevl[cursubj,]=unscalepars(rlcmod$par,parbounds[1:3],parbounds[4:6])
  }


  returnList <- list("parsevl" = parsevl, "g2evl" = g2evl, "subjnumvec" = subjnumvec);
  return(returnList);
}
