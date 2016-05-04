@extends('dashboard.dashboard_admin')
<!--
* Copyright (C) 2015  WiSe Lab, Computer Science Department, Western Michigan University
* Project Members Involved: Ajay Gupta, Aakash Gupta, Baba Shiv, Praneet Soni, Shrey Gupta and Vinay B Gavirangaswamy
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>
-->

@section('page-content') 

<div class="row">
    <div class="col-lg-12">       
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
<div class="col-lg-12">

   <!-- About Section -->
   <section class="container content-section text-justify">
    
        
                 <p class="h4 page-header"><b>About RDMTk</b></p>
                
                <p align="justify">The process or activity of making choices when subject to possibility of loss can be understood as risky decision-making (RDM). Results from computational decision-making are used in a variety of disciplines including marketing, sales, inventory management, psychology, behavioral research and finance. Researchers in RDM typically analyze data collected through empirical experiments. These experiments involve data from participant’s performance on a certain task/game. These tasks are designed to measure a specific aspect of decision making. Conventional approach to conducting empirical experiment is limited to local setting in a lab, where only restricted number of participants can be accommodated. Facilitating global studies for bigger and diverse participant’s pool would allow practioners to extract precise knowledge. Most of the available alternatives are proprietary, not specifically geared towards RDM and are not built to scale for bigger diverse participants pool. Proposed toolkit RDMTk (a Risky Decision Making Toolkit) is an attempt to build such a platform. RDMTk is intended to be a one-stop shop for conducting global-scale empirical experiments.</p>

                <p align="justify">RDMTk toolkit is envisioned to represent collective experience of experts and resources geared towards researching in decision-making and, in particular, RDM. Researchers would benefit tremendously from incorporating best practices, tools and techniques at one convenient place. Automating commonly practiced activities and integrating external tools, such as mTurk, Qualtrics, etc. used in setting up empirical studies furthers its cause. Bundling data analysis tools along with empirical experimentation features will empower researchers and practitioners to identify decision patterns with ease. Toolkit is open source, highly extensible and web-based solution. It is implemented using latest technologies such as PHP 5.4, Laravel, MySql, javascript and runs on Ubuntu based LAMP server.</p>

                <p align="justify">Current implementation of the toolkit supports a good number of constituent elements. RDMTk architecture is split into 2 different components. First component is the dashboard, which aids in managing users, experiments, tasks, data managements, and analysis tools. Dashboard is primarily targeted to 3 types of users. Administrators maintain and are overall responsible for technical aspects of the toolkit; researchers have access to features that help in conducting empirical studies, analyzing data and to facilitate collaboration. Third types of users are participants who can just access experiments assigned to them. Second component is the collection of tasks/games, which facilitate empirical studies and collection of pertinent data. There are currently six tasks implemented and more tasks can be added through manage tasks feature. Experiments are created based on these tasks and data can be downloaded as an excel file at the end of the study for further analysis. Downloaded data can either be summary of participant’s performance or detailed raw listing.</p>
                <p align="justify">
                    RDMTk integrates data analysis features alongside other tools used to conduct empirical studies to reduce work load
on the researcher. This feature will enable RDMTk to be eventually grown towards being an expert system over time. Currently, it supports a feature to monitor an experiment using power test and a model to analyze data from
IGT. Models implemented for IGT are to show proof of concept on the capabilities of RDMTk.
                </p>
                <p align="justify">
                    RDMTk’s analysis backend is implemented to run on Amazon Web Services (AWS) to support compute-intensive
operations. AWS is a collection of computing services that can scale to meet varying application resources. It is
commonly referred to as cloud computing.
                </p>
                <p align="justify">
                    Its integration with advanced data analysis tools such as R statistical package will empower researchers. Even
though RDMTk does not provide extensive set of models to complement currently implemented tasks, it is designed
to incorporate new techniques and models written in the R programming language seamlessly.
                </p>
          
    </section>
</div>
</div>

@stop



 
