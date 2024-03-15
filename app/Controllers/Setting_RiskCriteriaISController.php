<?php

namespace App\Controllers;

use App\Models\RequirementModels;

class Setting_RiskCriteriaISController extends BaseController
{
    public function indexConsequence()
    {
        echo view('layout/header');
        echo view('Setting/Risk_Criteria_IS_Consequence');
    }
    
    public function indexLikelihood()
    {
        echo view('layout/header');
        echo view('Setting/Risk_Criteria_IS_Likelihood');
    }

    public function indexRiskLevel()
    {
        echo view('layout/header');
        echo view('Setting/Risk_Criteria_IS_Risk_Level');
    }

    public function indexRiskOption()
    {
        echo view('layout/header');
        echo view('Setting/Risk_Criteria_IS_Risk_Option');
    }

}
