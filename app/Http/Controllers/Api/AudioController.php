<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Audio;
use Symfony\Component\HttpFoundation\Response;

class AudioController extends Controller
{
    public function audioStore(Request $request){
        // $audio = $request->file('audio');
        // $this->validate($request, [
        //     'audio' =>'nullable|file|mimes:audio/mpeg,mpga,mp3,wav,aac,3gp'
        // ]);
        // $audio_uri = $request->file('audio')->store('audios', 'public');
        // $data = Audio::create([
        //     'audio' => $audio_uri
        // ]);
        // return response($data, Response::HTTP_CREATED);
        dd($request->body);
        try{
            $audioFile = new Audio();
        // customer_id
        // $audioFile->customer_id = $request->customer_id;
        // $audioFile->location = $request->location;
        // pick audio file
        dd($request->body);

        if($request->hasfile('audio')){
            $file               = $request->file('audio');
            $extension          = $file->getClientOriginalExtension();
            $filename           = time() . '.' .$extension;
            $file->move('uploads/audio_files/',$filename);
            $audioFile->audio   = url('uploads' . '/audio_files/'  . $filename);
            //save audio
            $audioFile->save();
            return response($audioFile, Response::HTTP_CREATED);
            }
        }catch(error){
            dd(error);
        }
    }

    public function getAudios(){
        $audio = Audio::get();
        return $audio;
    }
}
