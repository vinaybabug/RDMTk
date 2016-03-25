pkgname <- "RDMTkAnalysisR"
source(file.path(R.home("share"), "R", "examples-header.R"))
options(warn = 1)
options(pager = "console")
library('RDMTkAnalysisR')

base::assign(".oldSearch", base::search(), pos = 'CheckExEnv')
cleanEx()
nameEx("RDMTkAnalysisR-package")
### * RDMTkAnalysisR-package

flush(stderr()); flush(stdout())

### Name: RDMTkAnalysisR-package
### Title: RDMTk Analysis Backend
### Aliases: RDMTkAnalysisR-package RDMTkAnalysisR
### Keywords: package

### ** Examples

~~ simple examples of the most important functions ~~



cleanEx()
nameEx("rdmtkGetParticipantsCntExpr")
### * rdmtkGetParticipantsCntExpr

flush(stderr()); flush(stdout())

### Name: rdmtkGetParticipantsCntExpr
### Title: rdmtkGetParticipantsCntExpr
### Aliases: rdmtkGetParticipantsCntExpr
### Keywords: ~kwd1 ~kwd2

### ** Examples

##---- Should be DIRECTLY executable !! ----
##-- ==>  Define data, use random,
##--	or do  help(data=index)  for the standard data sets.

## The function is currently defined as
function () 
{
    return(100)
  }



### * <FOOTER>
###
options(digits = 7L)
base::cat("Time elapsed: ", proc.time() - base::get("ptime", pos = 'CheckExEnv'),"\n")
grDevices::dev.off()
###
### Local variables: ***
### mode: outline-minor ***
### outline-regexp: "\\(> \\)?### [*]+" ***
### End: ***
quit('no')
