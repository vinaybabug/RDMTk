scalepars=function(tpars,lb,ub)  				#scales pars for bounded optim
  -log(((ub-lb)/(tpars-lb))-1)					#lb=lower bound, ub=upper bound
