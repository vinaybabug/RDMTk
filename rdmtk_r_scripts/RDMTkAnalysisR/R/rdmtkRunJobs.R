rdmtkRunJobs <- function(userId,...) {

  #Insert results in the database
  library(RDMTkAnalysisR)
  library(DBI);
  library(pwr);
  # Connect to my-db as defined in ~/.my.cnf
  con <- dbConnect(RMySQL::MySQL(), group = "my-db");

  # Count number of records in bart_expr_data for given exprAID and exprBID:
  SQL <- paste("select * from expr_anlys_job where owner ='", userId, "' and doExec = 1;", sep = "");

  res <- dbSendQuery(con, SQL);
  tempRslt <- dbFetch(res);

  # Disconnect from the database
  dbDisconnect(con);


  for(i in 1:nrow(tempRslt)) {
    row <- tempRslt[i,]
    # do stuff with row

    if(row$anlys_mdl == "BASE_MDL" &  row$expertype == 'IGT'){
      print(row$anlys_mdl);
      rdmtkIGTBaselineModel(row$expertype, row$experid);

    }
    else if(row$anlys_mdl == 'EVL_MDL' &  row$expertype == 'IGT' ){
      print(row$anlys_mdl);
      rdmtkIGTEVLModel(row$expertype, row$experid);
    }
    else if(row$anlys_mdl == 'RND_MDL' &  row$expertype == 'IGT'){
      print(row$anlys_mdl);
      rdmtkIGTRandomModel(row$expertype, row$experid);
    }
  }


  dbClearResult(res);

}
