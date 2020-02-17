rdmtkBoxPlot <- function(taskType, exprID, ...) {

  
  library(DBI);
  # Connect to my-db as defined in ~/.my.cnf
  con <- dbConnect(RMySQL::MySQL(), group = "my-db");

  #data <- rdmtkGetData(taskType, exprID);

  if(taskType == "BART"){


    SQL <- paste("select sum(total_pts) as total_pts from bart_expr_data where experid ='", exprID, "' group by mid;", sep = "");
    res <- dbSendQuery(con, SQL);
    tempRslt <- dbFetch(res);
    dbClearResult(res);

    boxplot(as.numeric(tempRslt$total_pts), main="",
            xlab="", ylab="Total Points Per Participants");
    #print(as.numeric(data$total_pts));
  }
  else
    if(taskType == "CUPS"){


      SQL <- paste("select sum(total_pts) as total_pts from cups_expr_data where experid ='", exprID, "' group by mid;", sep = "");
      res <- dbSendQuery(con, SQL);
      tempRslt <- dbFetch(res);
      dbClearResult(res);

      boxplot(as.numeric(tempRslt$total_pts), main="",
              xlab="", ylab="Total Points Per Participants");

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

      boxplot(as.numeric(tempRslt$final_total), main="",
              xlab="", ylab="Final Amount Left With Participants");

  }
  else if(taskType == "DelayD"){


  }
  else if(taskType == "NBACK"){

    SQL <- paste("select sum(score) as total_pts from nback_expr_data where experid ='", exprID, "' group by mid;", sep = "");
    res <- dbSendQuery(con, SQL);
    tempRslt <- dbFetch(res);
    dbClearResult(res);

    boxplot(as.numeric(tempRslt$total_pts), main="", xlab="", ylab="Final Score Per Participants");

  }
  else if(taskType == "STROOP"){

    SQL <- paste("select sum(score) as total_pts from stroop_expr_data where experid ='", exprID, "' group by mid;", sep = "");
    res <- dbSendQuery(con, SQL);
    tempRslt <- dbFetch(res);
    dbClearResult(res);

    boxplot(as.numeric(tempRslt$total_pts), main="", xlab="", ylab="Final Score Per Participants");

  }

  # Disconnect from the database
  dbDisconnect(con);
 

}
