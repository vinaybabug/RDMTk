filternarmed=function(v0,x,lambda,nArms)
{

  modv0=v0/lambda
  tempevmat=array(NA,c(dim(x)[1],4))
  for (curArm in 1:nArms)
  {
    tempterm=c(modv0,x[x[,1]==curArm,2])
    evTemp=filter(lambda*tempterm,1-lambda,method="recursive")
    tempevmat[,curArm]=evTemp[cumsum(x[,1]==curArm)+1]
  }
  return(tempevmat)
}
