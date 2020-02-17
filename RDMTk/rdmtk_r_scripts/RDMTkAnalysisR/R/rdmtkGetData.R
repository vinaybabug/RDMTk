rdmtkGetData<-function(taskType, exprID, ...){
  library(DBI);
  # Connect to my-db as defined in ~/.my.cnf
  con <- dbConnect(RMySQL::MySQL(), group = "my-db");

  SQL <- "";

  if(taskType == "BART"){

    # Count number of records in expr_data for given exprAID and exprBID:
    SQL <- paste("select * from bart_expr_data where experid ='", exprID, "';", sep = "");


  }
  else
  if(taskType == "CUPS"){

    # Count number of records in expr_data for given exprAID and exprBID:
    SQL <- paste("select * from cups_expr_data where experid ='", exprID, "';", sep = "");

  }
  else
    if(taskType == "CUPS"){

      # Count number of records in expr_data for given exprAID and exprBID:
      SQL <- paste("select * from cups_expr_data where experid ='", exprID, "';", sep = "");

    }
  else if(taskType == "IGT"){

    # Count number of records in expr_data for given exprAID and exprBID:
    SQL <- paste("select * from igt_expr_data where experid ='", exprID, "';", sep = "");


  }
  else if(taskType == "DelayD"){

    # Count number of records in expr_data for given exprAID and exprBID:
    SQL <- paste("select * from delayd_expr_data where experid ='", exprID, "';", sep = "");


  }
  else if(taskType == "NBACK"){

    # Count number of records in expr_data for given exprAID and exprBID:
    SQL <- paste("select * from nback_expr_data where experid ='", exprID, "';", sep = "");


  }
  else if(taskType == "STROOP"){

    # Count number of records in expr_data for given exprAID and exprBID:
    SQL <- paste("select * from stroop_expr_data where experid ='", exprID, "';", sep = "");


  }
  res <- dbSendQuery(con, SQL);
  tempRslt <- dbFetch(res);
  dbClearResult(res);

  #rows <- dim(tempRslt)[1];


  # Disconnect from the database
  dbDisconnect(con);

  return(tempRslt);
}
