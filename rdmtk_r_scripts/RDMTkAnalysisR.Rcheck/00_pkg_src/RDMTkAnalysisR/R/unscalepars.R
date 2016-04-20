unscalepars=function(tpars,lb,ub)				#unscales pars
  (ub-lb)/(1+exp(-tpars))+lb					#lb=lower bound, ub=upper bound
