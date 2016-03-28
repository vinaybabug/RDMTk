rdmtkExprLiveStats<-function(taskType, exprAID, exprBID, exprReln, riskLvl, sig_level,...){

 exprA_participants_cnt <- 0;
 exprB_participants_cnt <- 0;
 effect_size <- 0.0;
 power <- 0.0;
 library(DBI);
 library(pwr)
 # Connect to my-db as defined in ~/.my.cnf
 con <- dbConnect(RMySQL::MySQL(), group = "my-db");

 cat(sprintf("taskType: %s exprAID: %s exprBID: %s\n", taskType,exprAID,exprBID));


 if(taskType == "BART"){

	if(exprReln == "BTW_SUBJ_DSG"){

	# Count number of records in bart_expr_data for given exprAID and exprBID:
	SQL <- paste("select count(distinct(mid)) as count from bart_expr_data where experid ='", exprAID, "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	exprA_participants_cnt<-tempRslt$count;
	dbClearResult(res);

	SQL <- paste("select count(distinct(mid)) as count from bart_expr_data where experid ='", exprBID, "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	exprB_participants_cnt<-tempRslt$count;
	dbClearResult(res);

	# Get number of pumps by participants and their max_pupms to do power analysis
	SQL <- paste("select noofpumps,  trialstopindex as max_pump_allowed from bart_expr_data as t1 where experid ='", exprAID,  "' and if(t1.noofpumps >= ",riskLvl, " * t1.trialstopindex,1,0) =1;", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	mean1 <- mean(tempRslt$noofpumps);
	var1 <- var(tempRslt$noofpumps);
	length1 <- length(tempRslt$noofpumps);
	dbClearResult(res);


	SQL <- paste("select noofpumps,  trialstopindex as max_pump_allowed from bart_expr_data as t1 where experid ='", exprBID,  "' and if(t1.noofpumps >= ",riskLvl, " * t1.trialstopindex,1,0) =1;", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	mean2 <- mean(tempRslt$noofpumps);
	var2 <- var(tempRslt$noofpumps);
	length2 <- length(tempRslt$noofpumps);
	dbClearResult(res);

	spooled <- sqrt((var1 + var2)/2);

	# calculate Cohen's d = M1 - M2 / spooled
	effect_size <- abs(mean1 - mean2)/spooled;

	# Call pwr function to get power on current data
	pwrRes <- pwr.t2n.test(n1 = length1 , n2= length2 , d = effect_size, sig.level = sig_level);
	power <- pwrRes$power;

	}
	else if(exprReln == "IND_MEAS_DSG"){

	# Count number of records in bart_expr_data for given exprAID and exprBID:
	SQL <- paste("select count(distinct(mid)) as count from bart_expr_data where experid ='", exprAID, "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	exprA_participants_cnt<-tempRslt$count;
	exprB_participants_cnt<-tempRslt$count;
	dbClearResult(res);

		# Get number of pumps by participants and their max_pupms to do power analysis
	SQL <- paste("select noofpumps,  floor(trialstopindex *", riskLvl ,") as risklvl_pump from bart_expr_data as t1 where experid ='", exprAID,  "' and if(t1.noofpumps >= ",riskLvl, " * t1.trialstopindex,1,0) =1;", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	mean1 <- mean(tempRslt$noofpumps);
	var1 <- var(tempRslt$noofpumps);
	mean2 <- mean(tempRslt$risklvl_pump);
	var2 <- var(tempRslt$risklvl_pump);
	length1 <- length(tempRslt$noofpumps);
	dbClearResult(res);

	spooled <- sqrt((var1 + var2)/2);

	# calculate Cohen's d = M1 - M2 / spooled
	effect_size <- abs(mean1 - mean2)/spooled;

	# Call pwr function to get power on current data
	pwrRes <- pwr.t.test(n = length1, d = effect_size, type = c("one.sample"))
	power <- pwrRes$power;

	}

 }
 else if(taskType == "CUPS"){

	if(exprReln == "BTW_SUBJ_DSG"){

	# Count number of records in cups_expr_data for given exprAID and exprBID:
	SQL <- paste("select count(distinct(mid)) as count from cups_expr_data where experid ='", exprAID, "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	exprA_participants_cnt<-tempRslt$count;
	dbClearResult(res);

	SQL <- paste("select count(distinct(mid)) as count from cups_expr_data where experid ='", exprBID, "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	exprB_participants_cnt<-tempRslt$count;
	dbClearResult(res);

	# Get number of pumps by participants and their max_pupms to do power analysis
	SQL <- paste("select trial_pts,  total_pts from cups_expr_data where experid ='", exprAID,  "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	storage.mode(tempRslt$total_pts) <- "numeric";
	mean1 <- mean(tempRslt$total_pts);
	var1 <- var(tempRslt$total_pts);
	length1 <- length(tempRslt$total_pts);
	dbClearResult(res);


	SQL <- paste("select trial_pts,  total_pts from cups_expr_data where experid ='", exprBID,  "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	storage.mode(tempRslt$total_pts) <- "numeric";
	mean2 <- mean(tempRslt$total_pts);
	var2 <- var(tempRslt$total_pts);
	length2 <- length(tempRslt$total_pts);
	dbClearResult(res);

	spooled <- sqrt((var1 + var2)/2);

	# calculate Cohen's d = M1 - M2 / spooled
	effect_size <- abs(mean1 - mean2)/spooled;

	# Call pwr function to get power on current data
	pwrRes <- pwr.t2n.test(n1 = length1 , n2= length2 , d = effect_size, sig.level = sig_level);
	power <- pwrRes$power;

	}
	else if(exprReln == "IND_MEAS_DSG"){

	# Count number of records in cups_expr_data for given exprAID and exprBID:
	SQL <- paste("select count(distinct(mid)) as count from cups_expr_data where experid ='", exprAID, "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	exprA_participants_cnt<-tempRslt$count;
	exprB_participants_cnt<-tempRslt$count;
	dbClearResult(res);

		# Get number of pumps by participants and their max_pupms to do power analysis
	SQL <- paste("select trial_pts,  total_pts from cups_expr_data where experid ='", exprAID,  "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	storage.mode(tempRslt$total_pts) <- "numeric";
	storage.mode(tempRslt$trial_pts) <- "numeric";
	mean1 <- mean(tempRslt$total_pts);
	var1 <- var(tempRslt$total_pts);
	mean2 <- mean(tempRslt$trial_pts);
	var2 <- var(tempRslt$trial_pts);
	length1 <- length(tempRslt$trial_pts);
	dbClearResult(res);

	spooled <- sqrt((var1 + var2)/2);

	# calculate Cohen's d = M1 - M2 / spooled
	effect_size <- abs(mean1 - mean2)/spooled;

	# Call pwr function to get power on current data
	pwrRes <- pwr.t.test(n = length1, d = effect_size, type = c("one.sample"))
	power <- pwrRes$power;

	}

 }
 else if(taskType == "IGT"){

	if(exprReln == "BTW_SUBJ_DSG"){

	# Count number of records in igt_expr_data for given exprAID and exprBID:
	SQL <- paste("select count(distinct(mid)) as count from igt_expr_data where experid ='", exprAID, "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	exprA_participants_cnt<-tempRslt$count;
	dbClearResult(res);

	SQL <- paste("select count(distinct(mid)) as count from igt_expr_data where experid ='", exprBID, "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	exprB_participants_cnt<-tempRslt$count;
	dbClearResult(res);

	# Get number of pumps by participants and their max_pupms to do power analysis
	SQL <- paste("select final_total from igt_expr_data where experid ='", exprAID,  "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);

	mean1 <- mean(tempRslt$final_total);
	var1 <- var(tempRslt$final_total);
	length1 <- length(tempRslt$final_total);
	dbClearResult(res);


	SQL <- paste("select final_total from igt_expr_data where experid ='", exprBID,  "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);

	mean2 <- mean(tempRslt$final_total);
	var2 <- var(tempRslt$final_total);
	length2 <- length(tempRslt$final_total);
	dbClearResult(res);

	spooled <- sqrt((var1 + var2)/2);

	# calculate Cohen's d = M1 - M2 / spooled
	effect_size <- abs(mean1 - mean2)/spooled;

	# Call pwr function to get power on current data
	pwrRes <- pwr.t2n.test(n1 = length1 , n2= length2 , d = effect_size, sig.level = sig_level);
	power <- pwrRes$power;

	}
	else if(exprReln == "IND_MEAS_DSG"){

	# Count number of records in igt_expr_data for given exprAID and exprBID:
	SQL <- paste("select count(distinct(mid)) as count from igt_expr_data where experid ='", exprAID, "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	exprA_participants_cnt<-tempRslt$count;
	exprB_participants_cnt<-tempRslt$count;
	dbClearResult(res);

		# Get number of pumps by participants and their max_pupms to do power analysis
	SQL <- paste("select final_total from igt_expr_data where experid ='", exprAID,  "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);

	mean1 <- mean(tempRslt$final_total);
	var1 <- var(tempRslt$final_total);
	mean2 <- 6000;

	length1 <- length(tempRslt$final_total);
	dbClearResult(res);

	spooled <- var1;

	# calculate Cohen's d = M1 - M2 / spooled
	effect_size <- abs(mean1 - mean2)/spooled;

	# Call pwr function to get power on current data
	pwrRes <- pwr.t.test(n = length1, d = effect_size, type = c("one.sample"))
	power <- pwrRes$power;

	}


 }
 else if(taskType == "DelayD"){

	# Count number of records in bart_expr_data for given exprAID and exprBID:
	SQL <- paste("select count(distinct(mid)) as count from delayd_expr_data where experid ='", exprAID, "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	exprA_participants_cnt<-tempRslt$count;
	dbClearResult(res);
	SQL <- paste("select count(distinct(mid)) as count from delayd_expr_data where experid ='", exprBID, "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	exprB_participants_cnt<-tempRslt$count;
	dbClearResult(res);
 }
 else if(taskType == "NBACK"){

	# Count number of records in bart_expr_data for given exprAID and exprBID:
	SQL <- paste("select count(distinct(mid)) as count from nback_expr_data where experid ='", exprAID, "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	exprA_participants_cnt<-tempRslt$count;
	dbClearResult(res);
	SQL <- paste("select count(distinct(mid)) as count from nback_expr_data where experid ='", exprBID, "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	exprB_participants_cnt<-tempRslt$count;
	dbClearResult(res);
 }
 else if(taskType == "STROOP"){

	# Count number of records in bart_expr_data for given exprAID and exprBID:
	SQL <- paste("select count(distinct(mid)) as count from stroop_expr_data where experid ='", exprAID, "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	exprA_participants_cnt<-tempRslt$count;
	dbClearResult(res);
	SQL <- paste("select count(distinct(mid)) as count from stroop_expr_data where experid ='", exprBID, "';", sep = "");
	res <- dbSendQuery(con, SQL);
	tempRslt <- dbFetch(res);
	exprB_participants_cnt<-tempRslt$count;
	dbClearResult(res);
 }

 # Disconnect from the database
 dbDisconnect(con)
 returnList <- list("exprA_participants_cnt" = exprA_participants_cnt, "exprB_participants_cnt" = exprB_participants_cnt, "effect_size" = effect_size, "power" = power);
 return(returnList);

}
