<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Notification extends Controller
{
    public function notification($message){
        try{
            if($message){  
                $url        = 'https://notify-api.line.me/api/notify';
                $token      = 'KD5kkoddmmlMavdN3NhcpUNgoDp6gNl1j1zzhNSLkZW';
                $headers    = [
                                'Content-Type: application/x-www-form-urlencoded',
                                'Authorization: Bearer '.$token
                            ];
        
                $fields     = "message=\nแจ้งเตือนสมัครสมาชิก\n";
                $fields     .= "ชื่อ : " . $message->firstname . "  " . $message->lastname ."\n";
                $fields     .= "อีเมลล์ : " . $message->email ."\n";
                $fields     .= "ชื่อผู้ใช้ :  " . $message->username ."\n";
                $fields     .= "เบอร์โทร : " . $message->phone ."\n";
                $fields     .= "วันที่สมัคร : " . $message->craete_ad ;
               
                $ch = curl_init();
                curl_setopt( $ch, CURLOPT_URL, $url);
                curl_setopt( $ch, CURLOPT_POST, 1);
                curl_setopt( $ch, CURLOPT_POSTFIELDS,$fields);
                curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec( $ch );
                curl_close( $ch );}
                echo json_encode([
                    "status" => "failed",
                    "message" => "สำเร็จ",
                    "data" => $result ,
    
                ]);
        }catch (Exception $e){
            echo json_encode([
                "status" => "failed",
                "message" => "เกิดข้อผิดพลาด",
                "data" => $e,

            ]);
        }
    
                 
    }
}
