rdmtkGetIGTData<-function(taskType, exprID, ...){
  cat(sprintf("taskType: %s exprID: %s \n", taskType,exprID));
  library(DBI);
  library(pwr);
  # Connect to my-db as defined in ~/.my.cnf
  con <- dbConnect(RMySQL::MySQL(), group = "my-db");
  
  # Count number of records in bart_expr_data for given exprAID and exprBID:
  SQL <- paste("select * from igt_expr_data where experid ='", exprID, "';", sep = "");
  res <- dbSendQuery(con, SQL);
  tempRslt <- dbFetch(res);
  dbClearResult(res);
  
  rows <- dim(tempRslt)[1];
  cat(sprintf("Result count: %d \n", rows));
  # Data Frames
  returnIGTExprData<-data.frame(trial=integer(rows), deck=integer(rows), na=integer(rows), wins=character(rows), losses=character(rows), subj=character(rows), stringsAsFactors = FALSE);
  for(row in seq(rows)) {
    returnIGTExprData$trial[row]=tempRslt$trialno[row];
    if(tempRslt$selected_card[row] == 'card_A'){
      
      returnIGTExprData$deck[row]= 1;
      returnIGTExprData$na[row]= 1;
      returnIGTExprData$wins[row]= tempRslt$cash_A_win[row];
      returnIGTExprData$losses[row]= tempRslt$cash_A_lose[row];
      
    }
    else if(tempRslt$selected_card[row] == 'card_B'){
      
      returnIGTExprData$deck[row]= 2;
      returnIGTExprData$na[row]= 2;
      returnIGTExprData$wins[row]= tempRslt$cash_B_win[row];
      returnIGTExprData$losses[row]= tempRslt$cash_B_lose[row];
      
    }
    else if(tempRslt$selected_card[row] == 'card_C'){
      
      returnIGTExprData$deck[row]= 3;
      returnIGTExprData$na[row]= 3;
      returnIGTExprData$wins[row]= tempRslt$cash_C_win[row];
      returnIGTExprData$losses[row]= tempRslt$cash_C_lose[row];
      
    }
    else if(tempRslt$selected_card[row] == 'card_D'){
      
      returnIGTExprData$deck[row]= 4;
      returnIGTExprData$na[row]= 4;
      returnIGTExprData$wins[row]= tempRslt$cash_D_win[row];
      returnIGTExprData$losses[row]= tempRslt$cash_D_lose[row];
      
    }
    
    returnIGTExprData$subj[row]= tempRslt$mid[row];
    
  }
  
  # Disconnect from the database
  dbDisconnect(con);
  return(returnIGTExprData);
}