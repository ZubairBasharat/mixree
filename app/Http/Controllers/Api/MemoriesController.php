<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use Auth;
use Carbon\Carbon;
use App\ShareProgramMemory;
use App\EventProgramDetail;
use Illuminate\Support\Facades\DB as FacadesDB;

class MemoriesController extends Controller
{
    /*/////////////////////////////////////
     Create Momory For Event
     /////////////////////////////////////*/

    public function add_memories(Request $request)
    {
        // print_r($request->all());
        $data['user_id'] = Auth::user()->id;
        $data['note']    = $request->note;
        $data['note_title'] = $request->note_title;
        $data['event_id'] = $request->event_id;
        $data['type'] = $request->type;
        $data['status'] = 0;    // status will be zero if memory is note
        $data['image'] = "";
        if($request->hasFile('image'))
        {
        $file = $request->file('image');
        $filename = str_replace(' ', '', 'memory_'.time().'.'.$file->getClientOriginalName());
        $location = app()->basePath('public/images/memory_images/');
        $file->move($location, $filename);
        $data['image'] = "public/images/memory_images"."/".$filename;
        // $data['type'] = "file";
        $data['status'] = 1;    // status will be one if memory is image
        }
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();
        $qry = DB::table('event_memories')->insert($data);
        $data['memory_id'] = DB::getPdo()->lastInsertId();
        if($qry)
        {
            return response()->json(['status' => 200, 'message' => 'Memory Created Successfully', 'memory'=>$data]);
        }
        else
        {
            return response()->json(['status' => 200, 'message' => 'Error:']);
        }
    }

     /*/////////////////////////////////////
     Edit Memory
     /////////////////////////////////////*/

     public function edit_memory(Request $request)
     {
        $memory = DB::table('event_memories')->select('id','note_title','image','note','created_at','updated_at')->where('id',$request->memory_id)->first();
        if(!empty($memory))
        {
            return response()->json(['status' => 200, 'message' => 'Memory Found' , 'memory'=>$memory]);
        }
        else
        {
            return response()->json(['status' => 200, 'message' => 'No Memory Found']);
        }
     }

      /*/////////////////////////////////////
      Update Memory
     /////////////////////////////////////*/

     public function update_memory(Request $request)
     {
        $data['user_id'] = Auth::user()->id;
        $data['note']    = $request->note;
        $data['note_title'] = $request->note_title;
        // $data['event_id'] = $id;
        $data['type'] = $request->type;
        $data['status'] = 0;    // status will be zero if memory is note
        $data['image'] = "";
        if($request->hasFile('image'))
        {
        $file = $request->file('image');
        $filename = str_replace(' ', '', 'memory_'.time().'.'.$file->getClientOriginalName());
        $location = app()->basePath('public/images/memory_images/');
        $file->move($location, $filename);
        $data['image'] = $location."/".$filename;
        $data['type'] = "file";
        $data['status'] = 1;    // status will be one if memory is image
        }
        $data['updated_at'] = Carbon::now();
        $qry = DB::table('event_memories')->where('user_id',Auth::user()->id)->where('id',$request->memory_id)->update($data);
        if($qry)
        {
            return response()->json(['status' => 200, 'message' => 'Memory Updated Successfully']);
        }
        else
        {
            return response()->json(['status' => 200, 'message' => 'Error:']);
        }
     }
      /*/////////////////////////////////////
      Get Users Who Create Memory for an event
     /////////////////////////////////////*/
     
     public function get_users(Request $request)
     {
       $users = DB::table('users as t1')
                  ->join('event_memories as t2', 't2.user_id','=','t1.id')
                  ->select('t2.event_id','t1.id as user_id','t1.name','t1.last_name','t1.image')
                  ->where('t2.event_id',$request->event_id)->where('t2.status',$request->status)->groupBy('t2.user_id')->orderBy('t1.name','ASC')->get();
       if(!empty($users))
       {
           return response()->json(['status'=>200, 'message'=> 'Users Found', 'users'=>$users ]);
       }
       else
       {
          return response()->json(['status'=>200, 'message'=> 'No Record Found' ]);
       }
     }
      /*/////////////////////////////////////
      Get Users Who Create Memory for an event (notes)
      /////////////////////////////////////*/

      public function user_memories_notes(Request $request)
      {
        $memories = DB::table('event_memories as t1')->select('t1.id','t1.note','t1.note_title','t1.event_id','t1.created_at','t1.updated_at')->where('t1.user_id',$request['user_id'])->where('status',0)->where('t1.event_id',$request['event_id'])->get();
        $user_name = DB::table('users')->where('id',$request['user_id'])->select('name')->first();
        if(!empty($memories))
        {
            return response()->json(['status'=>200, 'message'=> 'Memories Found', 'users'=>$memories , 'user_name'=>$user_name]);
        }
        else
        {
            return response()->json(['status'=>200, 'message'=> 'Error:']);
        }
      }
       /*/////////////////////////////////////
      Get Users Who Create Memory for an event (notes)
      /////////////////////////////////////*/

      public function user_memories_media(Request $request)
      {
        $memories = DB::table('event_memories as t1')->select('t1.id','t1.type','t1.image','t1.event_id','t1.created_at','t1.updated_at')->where('t1.user_id',$request['user_id'])->where('status',1)->where('t1.event_id',$request['event_id'])->get();
        $username  = Auth::user()->name;
        if(!empty($memories))
        {
            return response()->json(['status'=>200, 'message'=> 'Memories Found', 'users'=>$memories ,'user_name'=>$username]);
        }
        else
        {
            return response()->json(['status'=>200, 'message'=> 'Error:']);
        }
      }

       /*/////////////////////////////////////
      Get Participants
      /////////////////////////////////////*/

      public function get_participants(Request $request)
      {
          $participant = array();
            // $participants = DB::table('event_participants as t1')
            //                 ->join('users as t2', 't1.user_id','=','t2.id')
            //                 ->select('t1.event_id','t1.owner_id','t1.user_id', 't1.status','t2.name','t2.last_name','t2.image','t2.email')
            //                 ->where('t1.event_id',$request->event_id)->get(); 
            $event_programs = DB::table('event_program_details')
                              ->join('event_program_descriptions','event_program_details.id','=','event_program_descriptions.event_program_details_id')
                              ->where('event_program_details.event_id',$request->event_id)
                              ->select('event_program_descriptions.*','event_program_details.event_location_id')->get();
            foreach($event_programs as $pro)
            {
                $pro->isSelect = false;
            } 
            $event_creater =  DB::table('users')->join('events','users.id','=','events.user_id')
                              ->select('events.id as event_id','events.user_id as owner_id','users.id as user_id','users.name','users.last_name','users.image','users.email')
                              ->where('events.id',$request->event_id)->get();
            $event_creater->isSelect = false;                              
            return response()->json(['status'=>200, 'message'=> 'Participants Found', 'programs'=>$event_programs,'event_creater'=>$event_creater]);
      }
        /*/////////////////////////////////////
        Share Memory with Participants
      /////////////////////////////////////*/

      public function share_memory(Request $request)
      {
        $share_memory_data['user_id'] = Auth::user()->id;
        $share_memory_data['event_id'] = $request->event_id;
        $share_memory_data['memory_id'] = $request->memory_id;
        foreach($request->location_id as $share_memory)
        {
             $share_memory_data['event_location_id'] =  $share_memory[0]; 
             $share_memory_data['event_program_id'] = $share_memory[1]; 
             ShareProgramMemory::create($share_memory_data);  
        }
        //   $data['user_id']   = Auth::user()->id; 
        //   $data['memory_id'] = $request->memory_id;
        //   $data['event_id']  = $request->event_id;
        //   $data['created_at'] = Carbon::now();
        //   $data['updated_at'] = Carbon::now();
        //   foreach($request->participents_id as $participent)
        //   {
        //       $data['participent_id'] = $participent;
        //       $qry = DB::table('share_memories')->insert($data);
        //   }
        //   if($qry)
        //   {
              return response()->json(['status'=>200, 'message'=>'Memory Shared Successfully']);
        //   }
      }


      public function program_memories(Request $request)
      {
         $event_programs = DB::table('event_program_details')
        ->join('event_program_descriptions','event_program_details.id','=','event_program_descriptions.event_program_details_id')
        ->where('event_program_details.event_location_id',$request->day_id)
        ->select('event_program_descriptions.*','event_program_details.event_location_id','event_program_details.start_time','event_program_details.start_date')->get();

        $programs = array();
        foreach($event_programs as $program)
        {
            // $users = ShareProgramMemory::where('event_program_id',$program->id)->with('user')->get();
            $users = DB::table('share_program_memories')
                     ->join('users','share_program_memories.user_id','users.id')
                     ->where('share_program_memories.event_program_id',$program->id)
                     ->select('users.*')->get();
             $programs[] = array('program_name'=>$program->description,
                          'program_id'=>$program->id,
                          'start_time'=>$program->start_time,
                          'start_date'=>$program->start_date,
                           'users' => $users);
        }
        return response()->json(['status'=>200, 'message'=>'programs with users list', 'data'=>$programs]);
      }  
}
