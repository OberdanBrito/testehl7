<?php

/**
 * @namespace Oberdan\Testehl7
 *
 * Este namespace contém classes para manipulação de mensagens HL7.
 * Ele inclui funcionalidades para criar e manipular segmentos HL7.
 */

namespace Oberdan\Testehl7;
require __DIR__ . '/vendor/autoload.php';


/**
 * Representa um segmento de cabeçalho HL7.
 * Esta classe encapsula a estrutura e propriedades de um Cabeçalho de Mensagem HL7 (MSH).
 * Permite uma criação e manipulação de segmentos de cabeçalho.
 *
 * Para usar faça assim:
 * $cabecalho = new HL7HeaderSegment([
 *   'encoding_chars' => '^~&',
 *   'sending_app' => 'MEGA_REG',
 *   'sending_fac' => 'XYZHOSP',
 *   'receiving_app' => 'SUPER_OE',
 *   'receiving_fac' => 'XYZIMGCTR',
 *   'date_time' => '20060529090131-0500',
 *   'security' => 'L',
 *   'message_type' => 'ADT', -- ADT é a admissão de um paciente
 *   'control_id' => '01052901',
 *   'processing_id' => 'P',
 *   'version_id' => '2.5'
 * ]);
 * $segmento = $cabecalho->generate();
 */
class HL7HeaderSegment
{

    private string $EncodingCharacters = '^~&';
    private string $SendingApplication;
    private string $SendingFacility;
    private string $ReceivingApplication;
    private string $ReceivingFacility;
    private string $DateTimeofMessage;
    private string $Security;
    private string $MessageType;
    private string $MessageControlID;
    private string $ProcessingID = 'P';
    private string $VersionID = '2.5';

    public function __construct(array $params)
    {
        foreach ($params as $key => $value) {
            switch ($key) {
                case 'encoding_chars':
                    $this->EncodingCharacters = $value;
                    break;
                case 'sending_app':
                    $this->SendingApplication = $value;
                    break;
                case 'sending_fac':
                    $this->SendingFacility = $value;
                    break;
                case 'receiving_app':
                    $this->ReceivingApplication = $value;
                    break;
                case 'receiving_fac':
                    $this->ReceivingFacility = $value;
                    break;
                case 'date_time':
                    $this->DateTimeofMessage = $value;
                    break;
                case 'security':
                    $this->Security = $value;
                    break;
                case 'message_type':
                    $this->MessageType = $value;
                    break;
                case 'control_id':
                    $this->MessageControlID = $value;
                    break;
                case 'processing_id':
                    $this->ProcessingID = $value;
                    break;
                case 'version_id':
                    $this->VersionID = $value;
                    break;
            }
        }
    }

    public function generate(): string
    {
        // utilize esse site para tratar as informações https://www.parsehog.com/hl7/parser
        // MSH|^~&|MegaReg|XYZHospC|SuperOE|XYZImgCtr|20060529090131-0500||ADT^A01^ADT_A01|01052901|P|2.5
        return sprintf("MSH|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s",
            $this->EncodingCharacters,
            $this->SendingApplication,
            $this->SendingFacility,
            $this->ReceivingApplication,
            $this->ReceivingFacility,
            $this->DateTimeofMessage,
            $this->Security,
            $this->MessageType,
            $this->MessageControlID,
            $this->ProcessingID,
            $this->VersionID
        );
    }
}

class EventTypeSegment
{
    private string $EventType;
    private string $DateTimeofEvent;

    public function __construct(array $params)
    {
        foreach ($params as $key => $value) {
            switch ($key) {
                case 'type':
                    $this->EventType = $value;
                    break;
                case 'datetime':
                    $this->DateTimeofEvent = $value;
                    break;
            }
        }
    }

    public function generate(): string
    {
        return sprintf("EVN||%s||%s",
            $this->EventType,
            $this->DateTimeofEvent
        );
    }
}

class PIDSegment
{
    private ?string $SetID;
    private ?string $PatientID;
    private ?string $PatientIdentifierList;
    private ?string $AlternatePatientID;
    private ?string $PatientName;
    private ?string $MothersMaidenName;
    private ?string $DateTimeofBirth;
    private ?string $AdministrativeSex;
    private ?string $PatientAlias;
    private ?string $Race;
    private ?string $PatientAddress;
    private ?string $CountyCode;
    private ?string $PhoneNumberHome;
    private ?string $PhoneNumberBusiness;
    private ?string $PrimaryLanguage;
    private ?string $MaritalStatus;
    private ?string $Religion;
    private ?string $PatientAccountNumber;

    public function __construct(array $params)
    {
        foreach ($params as $key => $value) {
            switch ($key) {
                case 'set_id': $this->SetID = $value; break;
                case 'patient_id': $this->PatientID = $value; break;
                case 'patient_identifier_list': $this->PatientIdentifierList = $value; break;
                case 'alternate_patient_id': $this->AlternatePatientID = $value; break;
                case 'patient_name': $this->PatientName = $value; break;
                case 'mothers_maiden_name': $this->MothersMaidenName = $value; break;
                case 'date_time_of_birth': $this->DateTimeofBirth = $value; break;
                case 'administrative_sex': $this->AdministrativeSex = $value; break;
                case 'patient_alias': $this->PatientAlias = $value; break;
                case 'race': $this->Race = $value; break;
                case 'patient_address': $this->PatientAddress = $value; break;
                case 'county_code': $this->CountyCode = $value; break;
                case 'phone_number_home': $this->PhoneNumberHome = $value; break;
                case 'phone_number_business': $this->PhoneNumberBusiness = $value; break;
                case 'primary_language': $this->PrimaryLanguage = $value; break;
                case 'marital_status': $this->MaritalStatus = $value; break;
                case 'religion': $this->Religion = $value; break;
                case 'patient_account_number': $this->PatientAccountNumber = $value; break;
            }
        }

    }

    public function generate(): string
    {
        return sprintf("PID|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s",
            $this->SetID,
            $this->PatientID,
            $this->PatientIdentifierList,
            $this->AlternatePatientID,
            $this->PatientName,
            $this->MothersMaidenName,
            $this->DateTimeofBirth,
            $this->AdministrativeSex,
            $this->PatientAlias,
            $this->Race,
            $this->PatientAddress,
            $this->CountyCode,
            $this->PhoneNumberHome,
            $this->PhoneNumberBusiness,
            $this->PrimaryLanguage,
            $this->MaritalStatus,
            $this->Religion,
            $this->PatientAccountNumber
        );
    }
}


class Main
{
    public function addPatient(): string
    {
        $hl7Header = new HL7HeaderSegment([
            'encoding_chars' => '^~&',
            'sending_app' => 'MEGA_REG',
            'sending_fac' => 'XYZHOSP',
            'receiving_app' => 'SUPER_OE',
            'receiving_fac' => 'XYZIMGCTR',
            'date_time' => '20060529090131-0500',
            'security' => 'L',
            'message_type' => 'ADT',
            'control_id' => '01052901',
            'processing_id' => 'P',
            'version_id' => '2.5'
        ]);

        $eventType = new EventTypeSegment([
            'type' => 'ADT',
            'datetime' => '20060529090000'
        ]);

        $pidData = [
            'set_id' => '',
            'patient_id' => '',
            'patient_identifier_list' => '56782445^^^UAReg^PI',
            'alternate_patient_id' => '',
            'patient_name' => 'KLEINSAMPLE^BARRY^Q^JR',
            'mothers_maiden_name' => '',
            'date_time_of_birth' => '19620910',
            'administrative_sex' => 'M',
            'patient_alias' => '',
            'race' => '2028-9^^HL70005^RA99113^^XYZ',
            'patient_address' => '260 GOODWIN CREST DRIVE^^BIRMINGHAM^AL^35209^^M~NICKELL’S PICKLES^10000 W 100TH AVE^BIRMINGHAM^AL^35200^^O',
            'county_code' => '',
            'phone_number_home' => '',
            'phone_number_business' => '',
            'primary_language' => '',
            'marital_status' => '',
            'religion' => '',
            'patient_account_number' => '0105I30001^^^99DEF^AN',
        ];

        $pidSegment = new PIDSegment($pidData);
        return sprintf("%s\n%s\n%s", $hl7Header->generate(), $eventType->generate(), $pidSegment->generate());
    }

}

$main = new Main();
$mensagem = $main->addPatient();
$filename = 'output.hl7';
file_put_contents($filename, $mensagem);
echo "HL7 message saved to $filename";
