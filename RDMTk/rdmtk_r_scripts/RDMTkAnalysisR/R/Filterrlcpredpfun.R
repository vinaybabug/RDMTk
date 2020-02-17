Filterrlcpredpfun=function(temppars,deckchoices,wins,losses)
{						#this function computes predicted prob. matrix of EVL model
  nt=length(deckchoices)			#number of trials
  unscaledtpars=unscalepars(temppars,parbounds[1:3],parbounds[4:6])
  r=unscaledtpars[1] 						#r=recency
  l=unscaledtpars[2] 						#l=attention to losses
  c=unscaledtpars[3] 						#c=change in consistency

  scaledwins=wins/payscale
  losses<-as.numeric(as.character(losses)) # convert this column from string to numeric
  scaledlosses=abs(losses)/payscale
  vtvec=(1-l)*scaledwins - l*scaledlosses		#Vector of valences of choices
  choicevtmat=cbind(deckchoices,vtvec)		#Col1=choice, Col2=vector of valences
  evmat=filternarmed(0,choicevtmat,r,4)		#calls a function which includes a digital filter
  sensvec=((1:nt)/10)^c
  strengthmat= exp(cbind(sensvec, sensvec, sensvec, sensvec)*evmat)+ 0.0000000001
  strsums=apply(strengthmat,1,sum)
  pmat=strengthmat/cbind(strsums, strsums, strsums, strsums)
  ppmat=.0001+.9998*pmat[1:(nt-1),]
  return(ppmat)
}
