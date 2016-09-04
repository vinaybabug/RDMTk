#!/usr/bin/Rscript

args = commandArgs(trailingOnly=TRUE)

print(args[1]);


library(RDMTkAnalysisR);

rdmtkRunJobs(args[1]);

