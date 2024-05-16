<?php

namespace App\Controllers;

use App\Models\RequirementModels;
use App\Models\Soa_Models;
use App\Models\AllversionModels;
use App\Models\TimelineModels;

class SOAController extends BaseController
{
    public function index($id_version = null, $num_ver = null)
    {
        $AllversionModels = new AllversionModels();
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 16)->first();
        $data['data'] = $AllversionModels->where('id_version', $id_version)->first();
        $numver = [
            'num_ver' => $num_ver
        ];
        $data['data'] = array_merge($data['data'], $numver); // Merge the new version data

        echo view('layout/header');
        echo view('Planning/SOA', $data);
    }

    //-- create SOA --//
    public function create_SOA($id_version = null, $status_version = null)
    {
        helper(['form']);
        $Soa_Models = new Soa_Models();
        $max_lc = $Soa_Models->selectMax('sec')->where('id_version', $id_version)->like('sec', 'LC%', 'after')->first();
        $lc_next = 'LC' . str_pad((int)substr($max_lc['sec'], 2) + 1, 3, '0', STR_PAD_LEFT);
        // print_r($lc_next);
        $data = [
            'sec' => $lc_next,
            'control' => $this->request->getVar('control'),
            'exclusion' => $this->request->getVar('exclusion'),
            'justification' => $this->request->getVar('justification'),
            'how_to' => $this->request->getVar('how_to'),
            'id_version' => $id_version,
        ];

        $Soa_Models->insert($data);
        $TimelineModels = new TimelineModels();
        $data_log = [
            'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Create Statement of Applicability (SOA)',
            'type_timeline' => 1,
            'status_id' => $status_version,
            'id_note' => null,
            'id_user' => session()->get('id'),
            'id_version' => $id_version,
        ];
        $TimelineModels->save($data_log);
        $response = [
            'success' => true,
            'message' => 'Successfully Created SOA',
            'reload' => true,
        ];
        return $this->response->setJSON($response);
    }

    //-- edit SOA --//
    public function edit_SOA($id_soa = null, $id_version = null, $status_version = null)
    {
        helper(['form']);
        $Soa_Models = new Soa_Models();
        $data = [
            'control' => $this->request->getVar('control'),
            'exclusion' => $this->request->getVar('exclusion'),
            'justification' => $this->request->getVar('justification'),
            'how_to' => $this->request->getVar('how_to'),
        ];
        
        $Soa_Models->update($id_soa, $data);
        $TimelineModels = new TimelineModels();
        $data_log = [
            'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Edit Statement of Applicability (SOA)',
            'type_timeline' => 1,
            'status_id' => $status_version,
            'id_note' => null,
            'id_user' => session()->get('id'),
            'id_version' => $id_version,
        ];
        $TimelineModels->save($data_log);
        
        $response = [
            'success' => true,
            'message' => 'Successfully Edit SOA',
            'reload' => true,
        ];
        return $this->response->setJSON($response);
    }

    //-- delete SOA --//
    public function delete_SOA($id_soa = null, $id_version = null, $status_version = null)
    {
        $Soa_Models = new Soa_Models();
        $Soa_Models->delete($id_soa);
        $TimelineModels = new TimelineModels();
        $data_log = [
            'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Delete Statement of Applicability (SOA)',
            'type_timeline' => 1,
            'status_id' => $status_version,
            'id_note' => null,
            'id_user' => session()->get('id'),
            'id_version' => $id_version,
        ];
        $TimelineModels->save($data_log);
        $response = [
            'success' => true,
            'message' => 'Successfully Delete SOA',
            'reload' => true,
        ];
        return $this->response->setJSON($response);
    }

    //-- copy SOA --//
    public function copy_SOA($id_soa = null, $id_version = null, $status_version = null)
    {
        $Soa_Models = new Soa_Models();
        $Soa_Models->copyDataById($id_soa);
        $new_id = $Soa_Models->getInsertID();
        $max_lc = $Soa_Models->selectMax('sec')->where('id_version', $id_version)->like('sec', 'LC%', 'after')->first();
        $lc_next = 'LC' . str_pad((int)substr($max_lc['sec'], 2) + 1, 3, '0', STR_PAD_LEFT);
        $Soa_Models->update($new_id, ['sec' => $lc_next]);
        $TimelineModels = new TimelineModels();
        $data_log = [
            'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Copy Statement of Applicability (SOA)',
            'type_timeline' => 1,
            'status_id' => $status_version,
            'id_note' => null,
            'id_user' => session()->get('id'),
            'id_version' => $id_version,
        ];
        $TimelineModels->save($data_log);
        $response = [
            'success' => true,
            'message' => 'Successfully Copy SOA',
            'reload' => true,
        ];
        return $this->response->setJSON($response);
    }
    
    //-- get data SOA --//
    public function get_data_soa($id_version = null)
    {
        $Soa_Models = new Soa_Models();
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $Soa_Models->groupStart()
                ->like('id_soa ', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('control', $searchValue)
                ->groupEnd();
        }
        $totalRecords = $Soa_Models->where('id_version', $id_version)->countAllResults();
        if ($totalRecords == 0) {
            $this->first_data_soa($id_version);
            $totalRecords = $Soa_Models->where('id_version', $id_version)->countAllResults();
        }
        $recordsFiltered = $totalRecords;

        if (!empty($searchValue)) {
            $Soa_Models->groupStart()
                ->like('id_soa', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('control', $searchValue)
                ->groupEnd();
        }
        $data = $Soa_Models->where('id_version', $id_version)->findAll($limit, $start);

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            'searchValue' => $searchValue
        ];

        return $this->response->setJSON($response);
    }

    public function first_data_soa($id_version = null)
    {
        $Soa_Models = new Soa_Models();
        $data = [
            '5' => [
                'Organizational controls',
                '5.1' => 'Policies for information security',
                '5.2' => 'Information security roles and responsibilities',
                '5.3' => 'Segregation of duties',
                '5.4' => 'Management responsibilities',
                '5.5' => 'Contact with authorities',
                '5.6' => 'Contact with special interest groups',
                '5.7' => 'Threat intelligence',
                '5.12' => 'Classification of information',
                '5.13' => 'Labelling of information',
                '5.14' => 'Information transfer',
                '5.15' => 'Access control',
                '5.16' => 'Identity management',
                '5.17' => 'Authentication information',
                '5.18' => 'Access rights',
                '5.19' => 'Information security in supplier relationships',
                '5.20' => 'Addressing information security within supplier agreements',
                '5.21' => 'Managing information security in the information and communication technology (ICT) supply chain',
                '5.22' => 'Monitoring, review and change management of supplier services',
                '5.23' => 'Information security for use of cloud services',
                '5.24' => 'Information security incident management planning and preparation',
                '5.25' => 'Assessment and decision on information security events',
                '5.26' => 'Response to information security incidents',
                '5.27' => 'Learning from information security incidents',
                '5.28' => 'Collection of evidence',
                '5.29' => 'Information security during disruption',
                '5.30' => 'ICT readiness for business continuity',
                '5.31' => 'Legal, statutory, regulatory and contractual requirements',
                '5.32' => 'Intellectual property rights',
                '5.33' => 'Protection of records',
                '5.34' => 'Privacy and protection of personal identifiable information (PII)',
                '5.35' => 'Independent review of information security',
                '5.36' => 'Compliance with policies, rules and standards for information security',
                '5.37' => 'Documented operating procedures'
            ],
            '6' => [
                'People controls',
                '6.1' => 'Screening',
                '6.2' => 'Terms and conditions of employment',
                '6.3' => 'Information security awareness, education and training',
                '6.4' => 'Disciplinary process',
                '6.5' => 'Responsibilities after termination or change of employment',
                '6.6' => 'Confidentiality or non-disclosure agreements',
                '6.7' => 'Remote working',
                '6.8' => 'Information security event reporting'
            ],
            '7' => [
                'Physical controls',
                '7.1' => 'Physical security perimeters',
                '7.2' => 'Physical entry',
                '7.3' => 'Securing offices, rooms and facilities',
                '7.4' => 'Physical security monitoring',
                '7.5' => 'Protecting against physical and environmental threats',
                '7.6' => 'Working in secure areas',
                '7.7' => 'Clear desk and clear screen',
                '7.8' => 'Equipment siting and protection',
                '7.9' => 'Security of assets off-premises',
                '7.10' => 'Storage media',
                '7.11' => 'Supporting utilities',
                '7.12' => 'Cabling security',
                '7.13' => 'Equipment maintenance',
                '7.14' => 'Secure disposal or re-use of equipment'
            ],
            '8' => [
                'Technological controls',
                '8.1' => 'User end point devices',
                '8.2' => 'Privileged access rights',
                '8.3' => 'Information access restriction',
                '8.4' => 'Access to source code',
                '8.5' => 'Secure authentication',
                '8.6' => 'Capacity management',
                '8.7' => 'Protection against malware',
                '8.8' => 'Management of technical vulnerabilities',
                '8.9' => 'Configuration management',
                '8.10' => 'Information deletion',
                '8.11' => 'Data masking',
                '8.12' => 'Data leakage prevention',
                '8.13' => 'Information backup',
                '8.14' => 'Redundancy of information processing facilities',
                '8.15' => 'Logging',
                '8.16' => 'Monitoring activities',
                '8.17' => 'Clock synchronization',
                '8.18' => 'Use of privileged utility programs',
                '8.19' => 'Installation of software on operational systems',
                '8.20' => 'Networks security',
                '8.21' => 'Security of network services',
                '8.22' => 'Segregation of networks',
                '8.23' => 'Web filtering',
                '8.24' => 'Use of cryptography',
                '8.25' => 'Secure development life cycle',
                '8.26' => 'Application security requirements',
                '8.27' => 'Secure system architecture and engineering principles',
                '8.28' => 'Secure coding',
                '8.29' => 'Security testing in development and acceptance',
                '8.30' => 'Outsourced development',
                '8.31' => 'Separation of development, test and production environments',
                '8.32' => 'Change management',
                '8.33' => 'Test information',
                '8.34' => 'Protection of information systems during audit testing'
            ]
        ];
        foreach ($data as $key => $value) {
            $Soa_Models->insert(['sec' => $key, 'control' => $value[0], 'id_version' => $id_version]);
            foreach ($value as $key2 => $value2) {
                if ($key2 != 0) {
                    $Soa_Models->insert(['sec' => $key2, 'control' => $value2 , 'id_version' => $id_version]);
                }
            }
        }
    }
}
