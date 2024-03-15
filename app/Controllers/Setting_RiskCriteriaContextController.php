<?php

namespace App\Controllers;

use App\Models\Consequence_level_context_Models;
use App\Models\Consequence_level_item_context_Models;
use App\Models\Impact_level_context_Models;
use App\Models\Likelihood_level_context_Models;
use App\Models\Risk_level_context_Models;
use App\Models\Risk_options_context_Models;

class Setting_RiskCriteriaContextController extends BaseController
{
    //------Consequence----//
    public function indexConsequence()
    {
        $Impact_level_context_Models = new Impact_level_context_Models();
        $Consequence_level_context_Models = new Consequence_level_context_Models();
        $Consequence_level_item_context_Models = new Consequence_level_item_context_Models();

        $data['consequence_level_context'] = $Consequence_level_context_Models->where('status', 1)->findAll();

        foreach ($data['consequence_level_context'] as $key => $item) {
            $data_item = $Consequence_level_item_context_Models->where('id_consequence_level', $item['id_consequence_level_context'])->findAll();
            // Append the new data to the existing array
            $data['consequence_level_context'][$key]['data_item'] = $data_item;
        }

        $data['impact_level'] = $Impact_level_context_Models->findAll();

        echo view('layout/header');
        echo view('Setting/Risk_Criteria_Context_Consequence', $data);
    }

    //create Consequence
    public function create_consequence()
    {
        $Consequence_level_context_Models = new Consequence_level_context_Models();
        $Consequence_level_item_context_Models = new Consequence_level_item_context_Models();
        $Impact_level_context_Models = new Impact_level_context_Models();

        $number_impact_level = $Impact_level_context_Models->select('number_level')->findAll();
        $data_level_context = [
            'consequence_name' => $this->request->getVar('consequencename_level'),
            'status' => 1
        ];

        $check_1 = $Consequence_level_context_Models->insert($data_level_context);
        $id_consequence_level_context = $Consequence_level_context_Models->getInsertID();
        if ($check_1) {
            for ($i = 0; $i < $number_impact_level[0]['number_level']; $i++) {
                $data_level_context_item = [
                    'id_consequence_level' => $id_consequence_level_context,
                    'name' => 'Waiting to enter information',
                    'impact_level' => $i + 1,
                    'description' => 'Waiting to enter information',
                ];
                $Consequence_level_item_context_Models->insert($data_level_context_item);
            }
            $response = [
                'success' => true,
                'message' => 'Consequence Level data was created successfully.',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Consequence Level data was not created.',
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);

    }

    //edit Consequence
    public function edit_consequence($id_consequence_level_item_context = null)
    {
        $Consequence_level_item_context_Models = new Consequence_level_item_context_Models();
        $data = [
            'name' => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
        ];
        $check_1 = $Consequence_level_item_context_Models->update($id_consequence_level_item_context, $data);
        if ($check_1) {
            $response = [
                'success' => true,
                'message' => 'Consequence Level data was updated successfully.',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Consequence Level data was not updated.',
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    //delete Consequence
    public function delete_consequence($id_consequence_level = null)
    {
        $Consequence_level_context_Models = new Consequence_level_context_Models();
        $Consequence_level_item_context_Models = new Consequence_level_item_context_Models();

        $check_1 = $Consequence_level_context_Models->update($id_consequence_level, [ 'status' => 0 ]);
        $count_consequence_level_item = $Consequence_level_item_context_Models->where('id_consequence_level', $id_consequence_level)->countAllResults();
        if ($check_1) {
            for ($i = 0; $i < $count_consequence_level_item; $i++) {
                $Consequence_level_item_context_Models->where('id_consequence_level', $id_consequence_level)->delete();
            }
            $response = [
                'success' => true,
                'message' => 'Consequence Level data was deleted successfully.',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Consequence Level data was not deleted.',
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    //------Likelihood Level----//
    public function indexLikelihood()
    {
        $Likelihood_level_context_Models = new Likelihood_level_context_Models();
        $data['Likelihood_level_context'] = $Likelihood_level_context_Models->findAll();
        echo view('layout/header');
        echo view('Setting/Risk_Criteria_Context_Likelihood', $data);
    }

    //edit Likelihood
    public function edit_likelihood($id_likelihood_level_context = null)
    {
        $Likelihood_level_context_Models = new Likelihood_level_context_Models();
        $data = [
            'likelihood_name' => $this->request->getVar('likelihoodname'),
            'description' => $this->request->getVar('description'),
        ];
        $check_1 = $Likelihood_level_context_Models->update($id_likelihood_level_context, $data);
        if ($check_1) {
            $response = [
                'success' => true,
                'message' => 'Likelihood Level data was updated successfully.',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Likelihood Level data was not updated.',
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    //------Risk Level----//
    public function indexRiskLevel()
    {
        $Likelihood_level_context_Models = new Likelihood_level_context_Models();
        $Risk_level_context_Models = new Risk_level_context_Models();
        $data['Likelihood_level_context'] = $Likelihood_level_context_Models->findAll();
        $data['Risk_level_context'] = $Risk_level_context_Models->findAll();

        echo view('layout/header');
        echo view('Setting/Risk_Criteria_Context_Risk_Level', $data);
    }

    //create Risk Level
    public function create_RiskLevel()
    {
        $Risk_level_context_Models = new Risk_level_context_Models();
        $data = [
            'risk_leve' => $this->request->getVar('risklevel'),
            'description' => $this->request->getVar('description'),
            'risk_color' => $this->request->getVar('riskcolor'),
            'text_color' => $this->request->getVar('textcolor'),
            'minimum' => $this->request->getVar('minranges'),
            'maximum' => $this->request->getVar('maxranges'),
        ];
        $check_1 = $Risk_level_context_Models->insert($data);
        if ($check_1) {
            $response = [
                'success' => true,
                'message' => 'Risk Level data was created successfully.',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Risk Level data was not created.',
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    //edit Risk Level
    public function edit_RiskLevel($id_likelihood_level_context = null)
    {
        $Risk_level_context_Models = new Risk_level_context_Models();
        $data = [
            'risk_leve' => $this->request->getVar('risklevel'),
            'description' => $this->request->getVar('description'),
            'risk_color' => $this->request->getVar('riskcolor'),
            'text_color' => $this->request->getVar('textcolor'),
            'minimum' => $this->request->getVar('minranges'),
            'maximum' => $this->request->getVar('maxranges'),
        ];
        $check_1 = $Risk_level_context_Models->update($id_likelihood_level_context, $data);
        if ($check_1) {
            $response = [
                'success' => true,
                'message' => 'Risk Level data was updated successfully.',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Risk Level data was not updated.',
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    //delete Risk Level
    public function delete_RiskLevel($id_likelihood_level_context = null)
    {
        $Risk_level_context_Models = new Risk_level_context_Models();
        $check_1 = $Risk_level_context_Models->delete($id_likelihood_level_context);
        if ($check_1) {
            $response = [
                'success' => true,
                'message' => 'Risk Level data was deleted successfully.',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Risk Level data was not deleted.',
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    //change assessment level
    public function change_assessment_level($id_risk_level_context = null)
    {
        $Risk_level_context_Models = new Risk_level_context_Models();
        $data_Risk_level_context = $Risk_level_context_Models->findAll();
        foreach ($data_Risk_level_context as $key => $value) {
            if ($value['id_risk_level_context'] == $id_risk_level_context) {
                $Risk_level_context_Models->update($value['id_risk_level_context'], [
                    'risk_assessment_level' => 1,
                ]);
            } else {
                $Risk_level_context_Models->update($value['id_risk_level_context'], [
                    'risk_assessment_level' => 0,
                ]);
            }
        }
        $response = [
            'success' => true,
            'message' => 'Assessment Level data was updated successfully.',
            'reload' => true,
        ];
        return $this->response->setJSON($response);

    }

    //------Risk Options----//
    public function indexRiskOption()
    {
        $Risk_options_context_Models = new Risk_options_context_Models();
        $data['risk_options'] = $Risk_options_context_Models->findAll();
        echo view('layout/header');
        echo view('Setting/Risk_Criteria_Context_Risk_Option', $data);
    }

    //create Risk Option
    public function create_RiskOption()
    {
        $Risk_options_context_Models = new Risk_options_context_Models();
        $data = [
            'options' => $this->request->getVar('riskoption'),
            'description' => $this->request->getVar('description'),
        ];
        $check_1 = $Risk_options_context_Models->insert($data);
        if ($check_1) {
            $response = [
                'success' => true,
                'message' => 'Risk Option data was created successfully.',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Risk Option data was not created.',
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    //edit Risk Option
    public function edit_RiskOption($id_likelihood_level_context = null)
    {
        $Risk_options_context_Models = new Risk_options_context_Models();
        $data = [
            'options' => $this->request->getVar('riskoption'),
            'description' => $this->request->getVar('description'),
        ];
        $check_1 = $Risk_options_context_Models->update($id_likelihood_level_context, $data);
        if ($check_1) {
            $response = [
                'success' => true,
                'message' => 'Risk Option data was updated successfully.',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Risk Option data was not updated.',
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    //delete Risk Option
    public function delete_RiskOption($id_likelihood_level_context = null)
    {
        $Risk_options_context_Models = new Risk_options_context_Models();
        $check_1 = $Risk_options_context_Models->delete($id_likelihood_level_context);
        if ($check_1) {
            $response = [
                'success' => true,
                'message' => 'Risk Option data was deleted successfully.',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Risk Option data was not deleted.',
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }
    //--- change impact level ---//
    public function change_impact_level($number_level = null)
    {
        $Consequence_level_item_context_Models = new Consequence_level_item_context_Models();
        $Consequence_level_context_Models = new Consequence_level_context_Models();
        $Impact_level_context_Models = new Impact_level_context_Models();
        $Likelihood_level_context_Models = new Likelihood_level_context_Models();

        $id_consequence_level = $Consequence_level_context_Models->select('id_consequence_level_context')->findAll();
        $count_Likelihood_level_context = $Likelihood_level_context_Models->countAllResults();

        foreach ($id_consequence_level as $key => $value) {
            $count_consequence_level = $Consequence_level_item_context_Models->where('id_consequence_level', $value['id_consequence_level_context'])->countAllResults();
            if ($count_consequence_level > $number_level) {
                for ($i = $number_level; $i < $count_consequence_level; $i++) {
                    $Consequence_level_item_context_Models->where('id_consequence_level', $value['id_consequence_level_context'])->where('impact_level', $i + 1)->delete();
                }

            } else if ($count_consequence_level < $number_level) {
                for ($i = $count_consequence_level; $i < $number_level; $i++) {
                    $data_level_context_item = [
                        'id_consequence_level' => $value['id_consequence_level_context'],
                        'name' => 'Waiting to enter information',
                        'impact_level' => $i + 1,
                        'description' => 'Waiting to enter information',
                    ];
                    $Consequence_level_item_context_Models->insert($data_level_context_item);
                }
                for ($i = $number_level; $i < $count_Likelihood_level_context; $i++) {
                    $Likelihood_level_context_Models->where('likelihood_level', $i + 1)->delete();
                }
            }
        }

        if ($count_Likelihood_level_context > $number_level) {
            for ($i = $number_level; $i < $count_Likelihood_level_context; $i++) {
                $Likelihood_level_context_Models->where('likelihood_level', $i + 1)->delete();
            }
        } else if ($count_Likelihood_level_context < $number_level) {
            for ($i = $count_Likelihood_level_context; $i < $number_level; $i++) {
                $Likelihood_level_context_Models->insert([
                    'likelihood_name' => 'Waiting to enter information',
                    'likelihood_level' => $i + 1,
                    'description' => 'Waiting to enter information',
                ]);
            }
        }
        $Impact_level_context_Models->update(1, [
            'number_level' => $number_level
        ]);
        $response = [
            'success' => true,
            'message' => 'Change impact level successfully.',
            'reload' => true,
        ];
        return $this->response->setJSON($response);

    }
}
