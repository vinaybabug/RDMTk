rdmtkAnovaTest<-function(taskType, exprID, ...){
  library(DBI);
  # Connect to my-db as defined in ~/.my.cnf
  conn <- dbConnect(RMySQL::MySQL(), group = "my-db");
  
  SQL <- "";
  
  if(taskType == "BART"){
    
    # Based on total_pts and noofpumps of given experid
    SQL <- paste("select * from bart_expr_data where experid ='", exprID, "';", sep = "");
    res <- dbSendQuery(conn, SQL);
    tempRslt <- dbFetch(res); 
    dbClearResult(res);
    aov_res<-aov(as.numeric(tempRslt$total_pts) ~ as.numeric(tempRslt$noofpumps));
    
    
  }
  else
    if(taskType == "CUPS"){
      
      # Based on trial pts and total pts of given experid
      SQL <- paste("select * from cups_expr_data where experid ='", exprID, "';", sep = "");
      res <- dbSendQuery(conn, SQL);
      tempRslt <- dbFetch(res); 
      dbClearResult(res);
      aov_res<-aov(as.numeric(tempRslt$trial_pts) ~ as.numeric(tempRslt$total_pts));
      
    }
  else if(taskType == "IGT"){
    
    # Based on final total and initial total of given experid
    SQL <- paste("select * from igt_expr_data where experid ='", exprID, "';", sep = "");
    res <- dbSendQuery(conn, SQL);
    tempRslt <- dbFetch(res); 
    dbClearResult(res);
    aov_res<-aov(as.numeric(tempRslt$final_total) ~ as.numeric(tempRslt$initial_total));
    
  }
  else if(taskType == "DelayD"){
    
    # No data
    SQL <- paste("select * from delayd_expr_data where experid ='", exprID, "';", sep = "");
    
    
  }
  else if(taskType == "NBACK"){
    
    # Based on score and response of given experid
    SQL <- paste("select * from nback_expr_data where experid ='", exprID, "';", sep = "");
    res <- dbSendQuery(conn, SQL);
    tempRslt <- dbFetch(res); 
    dbClearResult(res);
    aov_res<-aov(as.numeric(tempRslt$score) ~ as.numeric(tempRslt$response));
    
  }
  else if(taskType == "STROOP"){
    
    # Based on  score and response of given experid
    SQL <- paste("select * from stroop_expr_data where experid ='", exprID, "';", sep = "");
    res <- dbSendQuery(conn, SQL);
    tempRslt <- dbFetch(res); 
    dbClearResult(res);
    aov_res<-aov(as.numeric(tempRslt$score) ~ as.numeric(tempRslt$response));
    
  }
  
  # Disconnect from the database
  dbDisconnect(conn);
  return(aov_res);
}

