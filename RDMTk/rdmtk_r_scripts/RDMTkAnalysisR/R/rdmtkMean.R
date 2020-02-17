rdmtkMean<-function(taskType, exprID, ...){
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
    mean_res<-mean(as.numeric(tempRslt$total_pts));
    
    
  }
  else
    if(taskType == "CUPS"){
      
      # Based on trial pts and total pts of given experid
      SQL <- paste("select * from cups_expr_data where experid ='", exprID, "';", sep = "");
      res <- dbSendQuery(conn, SQL);
      tempRslt <- dbFetch(res); 
      dbClearResult(res);
      mean_res<-mean(as.numeric(tempRslt$total_pts));
      
    }
  else if(taskType == "IGT"){
    
    # Based on final total and initial total of given experid
    SQL <- paste("select * from igt_expr_data where experid ='", exprID, "';", sep = "");
    res <- dbSendQuery(conn, SQL);
    tempRslt <- dbFetch(res); 
    dbClearResult(res);
    mean_res<-mean(as.numeric(tempRslt$final_total));
    
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
    mean_res<-mean(as.numeric(tempRslt$score));
    
  }
  else if(taskType == "STROOP"){
    
    # Based on  score and response of given experid
    SQL <- paste("select * from stroop_expr_data where experid ='", exprID, "';", sep = "");
    res <- dbSendQuery(conn, SQL);
    tempRslt <- dbFetch(res); 
    dbClearResult(res);
    mean_res<-mean(as.numeric(tempRslt$score));
    
  }
  
  # Disconnect from the database
  dbDisconnect(conn);
  return(mean_res);
}

