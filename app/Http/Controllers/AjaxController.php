<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\AjaxForm;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\DataCollector\RequestDataCollector;
use Symfony\Component\HttpKernel\Profiler\Profile;

class AjaxController extends Controller
{

    public function ajaxReq(Request $request)
    {
        //return response()->json($request->para_text);
        $data = "Sakib Hasan Badhon";
        return response()->json([
            'data'=>$data,
        ]);
    }



    // data fetch
    public function studentGetData(Request $request){
        if($request->ajax()){
            $geyData = AjaxForm::latest('id')->get();
            // return response()->json($geyData);
            $code ='';

            foreach($geyData as $key=>$student){
                $serial = $key+1;
                $code .='<tr>
                            <td>'.$serial.'</td>
                            <td> <img src="images/profile/'.$student->avatar.'" class="profile-img" alt"'.$student->name.'"></td>
                            <td>'.$student->name.'</td>
                            <td>'.$student->email.'</td>
                            <td>'.$student->phone.'</td>
                            <td>'.$student->roll.'</td>
                            <td>'.$student->reg.'</td>
                            <td>'.$student->board.'</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary edit-btn" data-id="'.$student->id.'"> <i class="fas fa-edit p-1"></i> </button>
                                <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="'.$student->id.'"> <i class="fas fa-trash-alt p-1"></i> </button>
                            </td>

                        </tr>';
            }

            return response()->json($code);

        }
    }

    // $output = ['status'=>'error','message'=>'Server Error!']; //message show koranor jonno


    // data insert
    public function ajaxStore(StudentRequest $request)
    {

        $profile = $this->file_upload($request->file('avatar'),'images/profile/');

        $data= AjaxForm::create([
            'name'   => $request->name,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'roll'   => $request->roll,
            'reg'    => $request->reg,
            'board'  => $request->board,
            'avatar' => $profile
        ]);

        if ($data) {
            $output=['status'=>'success','message'=>'Data  Save has been success'];
        }else{
            $output=['status'=>'error','message'=>'Something error'];
        }

        return response()->json($output);
    }



    //  data edit

    public function studentEdit(Request $request)
    {
        if ($request->ajax()) {
            $student = AjaxForm::findOrFail($request->student_id);
            return response()->json($student);

        }
    }


    public function student_board(Request $request)
    {
        if ($request->ajax()) {
            $student = AjaxForm::findOrFail($request->student);

            // dd($student->board);

            $dhaka    = $student->board == 'Dhaka' ? 'selected' : '';
            $bogura   = $student->board == 'Bogura' ? 'selected' : '';
            $rangpur  = $student->board == 'Rangpur' ? 'selected' : '';
            $barishal = $student->board == 'Barishal' ? 'selected' : '';

            $output = '';
            $output .= '
                <label for="board" class = "form-label">Board</label>
                <select name = "board" class = "form-select" id = "board">
                <option value = "">select please</option>
                <option value = "Dhaka" '.$dhaka.'>Dhaka</option>
                <option value = "Bogura" '.$bogura.'> Bogura</option>
                <option value = "Rangpur" '.$rangpur.'> Rangpur </option>
                <option value = "Barishal" '.$barishal.'> Barishal </option>
                </select>
            ';

            return response()->json($output);

        }
    }



    // data update
    public function studentUpdate(StudentRequest $request)
    {

        if($request->ajax()){

            $student = AjaxForm::findOrFail($request->update);

            if($request->hasFile('avatar')){
                $profile = $this->file_update($request->file('avatar'),'images/profile/',$student->avatar);
            }else{
                $profile = $student->avatar;
            }


            $data=$student->update([
                'name'   => $request->name,
                'email'  => $request->email,
                'phone'  => $request->phone,
                'roll'   => $request->roll,
                'reg'    => $request->reg,
                'board'  => $request->board,
                'avatar' => $profile
            ]);

            if ($data) {
                $output=['status'=>'success','message'=>'Data has been Updated success'];
            }else{
                $output=['status'=>'error','message'=>'Something error'];
            }

            return response()->json($output);
        }
    }




    // data Delete
    public function studentDestroy(Request $request)
    {
        if ($request->ajax()) {
            $student = AjaxForm::find($request->student);
            if (file_exists('images/profile/'.$student->avatar)) {
                unlink('images/profile/'.$student->avatar);
            }

            $student->delete();
            $output = ['status'=>'success','message'=>'Student has been deleted successfully'];
            return response()->json($output);
        }
    }





}
