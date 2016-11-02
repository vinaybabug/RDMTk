rdmtkSApply <- function(taskType, exprID, ...) {

  result <- NULL;
  #dev.off();
  library(DBI);
  # Connect to my-db as defined in ~/.my.cnf
  con <- dbConnect(RMySQL::MySQL(), group = "my-db");

  #data <- rdmtkGetData(taskType, exprID);

  if(taskType == "BART"){

    SQL <- paste("select * from bart_expr_data where experid ='", exprID, "' group by mid;", sep = "");
    res <- dbSendQuery(con, SQL);
    tempRslt <- dbFetch(res);
    dbClearResult(res);

    result<-summary(as.numeric(tempRslt$total_pts));


    #print(as.numeric(data$total_pts));
  }
  else
    if(taskType == "CUPS"){


      SQL <- paste("select sum(total_pts) as total_pts from cups_expr_data where experid ='", exprID, "' group by mid;", sep = "");
      res <- dbSendQuery(con, SQL);
      tempRslt <- dbFetch(res);
      dbClearResult(res);

      result<-summary(as.numeric(tempRslt$total_pts));

    }
  else if(taskType == "IGT"){

    SQL <- paste("select max(trialno) as last_trial from igt_expr_data where experid ='", exprID, "';", sep = "");
    res <- dbSendQuery(con, SQL);
    last_trial <- dbFetch(res);
    dbClearResult(res);


    SQL <- paste("select final_total from igt_expr_data where experid ='", exprID, "' and trialno= '", last_trial ,"';", sep = "");
    res <- dbSendQuery(con, SQL);
    tempRslt <- dbFetch(res);
    dbClearResult(res);

    result<-summary(as.numeric(tempRslt$final_total));

  }
  else if(taskType == "DelayD"){


  }
  else if(taskType == "NBACK"){

    SQL <- paste("select sum(score) as total_pts from nback_expr_data where experid ='", exprID, "' group by mid;", sep = "");
    res <- dbSendQuery(con, SQL);
    tempRslt <- dbFetch(res);
    dbClearResult(res);

    result<-summary(as.numeric(tempRslt$total_pts));

  }
  else if(taskType == "STROOP"){

    SQL <- paste("select sum(score) as total_pts from stroop_expr_data where experid ='", exprID, "' group by mid;", sep = "");
    res <- dbSendQuery(con, SQL);
    tempRslt <- dbFetch(res);
    dbClearResult(res);

    result<-summary(as.numeric(tempRslt$total_pts));

  }

  # Disconnect from the database
  dbDisconnect(con);
  result<-stack(result);
  returnList <- list("min" = result$values[1], "fst_qu" = result$values[2], "median" = result$values[3], "mean"= result$values[4], "trd_qu" = result$values[5], "max"=result$values[6]);

  return(returnList);

}
