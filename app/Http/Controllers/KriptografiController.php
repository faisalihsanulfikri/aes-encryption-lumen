<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

class KriptografiController extends BaseController
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function enkripsi()
    {
        $body = $this->request->all(); 
        $string = $body['plain_text'];
        $output = false;
 
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'iiffns';
        $secret_iv = 'iiffns';
    
        // hash
        $key = hash('sha256', $secret_key);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
    
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    
        return response()->json([
            'chipper_text' => $output
        ]);
    }
    
    public function dekripsi()
    {
        $body = $this->request->all(); 
        $string = $body['chipper_text'];
        $output = false;
    
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'iiffns';
        $secret_iv = 'iiffns';
    
        // hash
        $key = hash('sha256', $secret_key);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
    
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    
        return response()->json([
            'dcrypt_plain_text' => $output
        ]);
    }

    public function kriptografi()
    {
        $body = $this->request->all();        

        $plain_text = $body['plain_text'];

        $enkripsi = $this->kriptoEnkripsi($plain_text);
        $chipper_text = $enkripsi->original['chipper_text'];

        $dekripsi = $this->kriptoDekripsi($chipper_text);
        $dcrypt_plain_text = $dekripsi->original['dcrypt_plain_text'];

        return response()->json([
            'plain_text' => $plain_text,
            'chipper_text' => $chipper_text,
            'dcrypt_plain_text' => $dcrypt_plain_text
        ]);
    }

    public function kriptoEnkripsi($string)
    {
        $output = false;
 
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'iiffns';
        $secret_iv = 'iiffns';
    
        // hash
        $key = hash('sha256', $secret_key);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
    
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    
        return response()->json([
            'chipper_text' => $output
        ]);
    }
    
    public function kriptoDekripsi($string)
    {
        $output = false;
    
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'iiffns';
        $secret_iv = 'iiffns';
    
        // hash
        $key = hash('sha256', $secret_key);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
    
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    
        return response()->json([
            'dcrypt_plain_text' => $output
        ]);
    }
}