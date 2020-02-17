rdmtkTTest<-function(taskType, exprID1, exprID2, ...){
  library(DBI);
  # Connect to my-db as defined in ~/.my.cnf
  conn <- dbConnect(RMySQL::MySQL(), group = "my-db");
  
  SQL1 <- "";
  SQL2 <- "";
  
  if(taskType == "BART"){
    
    # Based on total_pts and noofpumps of given experid
    SQL1 <- paste("select * from bart_expr_data where experid ='", exprID1, "';", sep = "");
    res1 <- dbSendQuery(conn, SQL1);
    tempRslt1 <- dbFetch(res1);
    dbClearResult(res1);
    SQL2 <- paste("select * from bart_expr_data where experid ='", exprID2, "';", sep = "");
    res2 <- dbSendQuery(conn, SQL2);
    tempRslt2 <- dbFetch(res2);
    dbClearResult(res2);
    ttest_res<-t.test(as.numeric(tempRslt1$total_pts), as.numeric(tempRslt2$total_pts));
  }
  else
    if(taskType == "CUPS"){
      
      # Based on trial pts and total pts of given experid
      SQL1 <- paste("select * from cups_expr_data where experid ='", exprID1, "';", sep = "");
      res1 <- dbSendQuery(conn, SQL1);
      tempRslt1 <- dbFetch(res1);
      dbClearResult(res1);
      SQL2 <- paste("select * from cups_expr_data where experid ='", exprID2, "';", sep = "");
      res2 <- dbSendQuery(conn, SQL2);
      tempRslt2 <- dbFetch(res2);
      dbClearResult(res2);
      ttest_res<-t.test(as.numeric(tempRslt1$total_pts), as.numeric(tempRslt2$total_pts));
      
    }
  else if(taskType == "IGT"){
    
    # Based on final total and initial total of given experid
    SQL1 <- paste("select * from igt_expr_data where experid ='", exprID1, "';", sep = "");
    res1 <- dbSendQuery(conn, SQL1);
    tempRslt1 <- dbFetch(res1);
    dbClearResult(res1);
    SQL2 <- paste("select * from igt_expr_data where experid ='", exprID2, "';", sep = "");
    res2 <- dbSendQuery(conn, SQL2);
    tempRslt2 <- dbFetch(res2);
    dbClearResult(res2);
    ttest_res<-t.test(as.numeric(tempRslt$final_total), as.numeric(tempRslt1$final_total));
    
  }
  else if(taskType == "DelayD"){
    
    # No data
  }
  else if(taskType == "NBACK"){
    
    # Based on score and response of given experid
    SQL1 <- paste("select * from nback_expr_data where experid ='", exprID1, "';", sep = "");
    res1 <- dbSendQuery(conn, SQL1);
    tempRslt1 <- dbFetch(res1);
    dbClearResult(res1);
    SQL2 <- paste("select * from nback_expr_data where experid ='", exprID2, "';", sep = "");
    res2 <- dbSendQuery(conn, SQL2);
    tempRslt2 <- dbFetch(res2);
    dbClearResult(res2);
    ttest_res<-t.test(as.numeric(tempRslt1$score), as.numeric(tempRslt2$score));
    
  }
  else if(taskType == "STROOP"){
    
    # Based on  score and response of given experid
    SQL1 <- paste("select * from stroop_expr_data where experid ='", exprID1, "';", sep = "");
    res1 <- dbSendQuery(conn, SQL1);
    tempRslt1 <- dbFetch(res1);
    dbClearResult(res1);
    SQL2 <- paste("select * from stroop_expr_data where experid ='", exprID2, "';", sep = "");
    res2 <- dbSendQuery(conn, SQL2);
    tempRslt2 <- dbFetch(res2);
    dbClearResult(res2);
    ttest_res<-t.test(as.numeric(tempRslt1$score), as.numeric(tempRslt2$score));
    
  }
  
  # Disconnect from the database
  dbDisconnect(conn);
  return(ttest_res);
}

