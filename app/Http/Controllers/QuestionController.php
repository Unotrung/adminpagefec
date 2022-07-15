<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Statics;
use App\Models\Role;
use DataTables;
use Auth;
use Mail;
use Excel;
use DateTime;
use Illuminate\Support\Carbon;

class QuestionController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vendor.adminlte.question.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = Question::all();
        return view('vendor.adminlte.question.add')->with('question', $question);;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = new Question;
        $question->Email = $request->Email;
        $question->PhoneNumber = $request->PhoneNumber;
        $Question = str_replace(['<p>', '</p>'], '', $request->Question_Create);
        $question->Question = $Question;
        $question->Note = "";
        $question->Status = null;
        $date = Carbon::now();
        $date = Carbon::parse($date)->format('Y-m-d');
        $question->Createday = $date;
        $question->save();
        return redirect()->route("question.index")->with('Question created successfull');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        $length=strlen($question->Question);
        if($length>50){
          $question->Question = substr_replace($question->Questio," \n" , position, 0);
        }
        return view('vendor.adminlte.question.show',['question'=>$question]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function answer($id)
    {
        $question = Question::find($id);
        return view('vendor.adminlte.question.answer', ['question' => $question ,'questions'=>$question->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
            $id = $request['id'];
            $question = Question::find($id);
            $question->Note = $request->Note;
            $question->save();

        return redirect()->route('question.index')->with('success','Question updated successfully.');
    }

    public function updateAnswer(Request $request)
    {
            $id = $request['id'];
            $question = Question::find($id);
            $answer = str_replace(['<p>', '</p>'], '',  $request->answer);
            $check = $request->checkadd;

            $question->answer = $answer;
            $question->Status = 2;
            $question->save();
            // print_r($request->Email);
            // exit;
            // $this->html_mail($request->Email,$id,$answer);
            if(empty($request->checkadd))
            {
                return redirect()->route('question.index')->with('success','Question updated successfully.');
            }
            else
            {
                // print_r($question);
                // exit;
                return redirect()->route("faqs.add")->with(['question' => $question->Question,'answer' =>$answer]);
            }
    }

    public function html_mail($email=null , $id=null,$answer)
    {
        $info = array(
            'name' => "Voolo"
        );
        $question = Question::find($id);
        $ques = $question->Question;
        // $answer = $question->answer;
        $data = array('email'=>$email,'name'=>"info",'ques'=>$ques,'answer'=>$answer);

        Mail::send(['data' => $data], $info, function ($message) use ($data)
        {
            $message->to($data['email'])
                ->subject('Waiting for approval configuration voolo.vn');
                $message->setBody(" Thanks For Your Question: " .$data['ques']. " \r\n We talked to customer service about that question \r\n And the answer is: " .$data['answer'] ."\r\n ");
            $message->from('info@voolo.vn', 'Voolo');
        });
        echo "Successfully sent the email";
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $question = Question::find($request->id);
        $question->Status = 1;
        $question->save();
        return redirect()->route('question.index')->with('Question deleted successfull');
    }

    public function restore(Request $request)
    {
        $question = Question::find($request->id);
        $question->Status = null;
        $question->save();
        return redirect()->route('question.index')->with('Update','Question Restore Successfully');
    }
    public function dtajax(Request $request)
    {
        if ($request->ajax())
        {
            $user = Auth::user()->role_ids[0];
            $role =Role::find($user);
            $role_name = $role["name"];
            $question = Question::where('Status','1');
            $from = Carbon::parse($request->from)->format('Y-m-d');
            // $request->from = Carbon::createFromDate('2022, 6, 1)');
            // $request->to = Carbon::createFromDate('2015, 7, 1)');
            $to = Carbon::parse($request->to)->format('Y-m-d');
            // $endDate = Carbon::createFromFormat('Y-m-d', $request->to);
            // $question = Question::where('Status',1);
//010
            if(empty($request->status) && !empty($request->from) && !empty($request->to) && empty($request->input))
            {
                $question = Question::whereNull('Status')->whereBetween('Createday', array($from,$to));
            }
//110
            elseif($request->status == 1 && !empty($request->from) && !empty($request->to) && empty($request->input))
            {
                $question = Question::where([['Status',1]])->whereBetween('Createday', array($from,$to));
            }
            //111
            elseif($request->status == 1 && !empty($request->from) && !empty($request->to) && !empty($request->input))
            {
                $question = Question::where([['Status',1],['Question','like', '%'.$request->input.'%']])->whereBetween('Createday', array($from,$to));
            }
            //011
            elseif(empty($request->status) && !empty($request->from) && !empty($request->to) && !empty($request->input))
            {
                $question = Question::where([['Status','=',$request->status],['Question','like', '%'.$request->input.'%']])->whereBetween('Createday', array($from,$to));
            }
            //210
            elseif($request->status == 2 && !empty($request->from) && !empty($request->to) && empty($request->input))
            {
                $question = Question::where('Status',2)->whereBetween('Createday', array($from,$to));
            }
            //211
            elseif($request->status == 2 && !empty($request->from) && !empty($request->to) && !empty($request->input))
            {
                $question = Question::where([['Status',2],['Question','like', '%'.$request->input.'%']])->whereBetween('Createday', array($from,$to));
            }
            // if(empty($request->status) && empty($request->input))
            // {
            //     $question = Question::whereNull('Status');
            // }
            // elseif(empty($request->status) && !empty($request->input))
            // {
            //     $question = Question::where([['Status','=',$request->status],['Question','like', '%'.$request->input.'%']]);
            // }
            // elseif($request->status == 2 && empty($request->input))
            // {
            //     $question = Question::where('Status',2);
            // }
            // elseif($request->status == 2 && !empty($request->input))
            // {
            //     $question = Question::where([['Status','=',$request->status],['Question','like', '%'.$request->input.'%']]);
            // }
            // elseif($request->status == 1 && !empty($request->input))
            // {
            //     $question = Question::where([['Status','=',$request->status],['Question','like', '%'.$request->input.'%']]);
            // }
            $out =  Datatables::of($question->get())->make(true);
            // $out =  Datatables::of(Question::all())->make(true);
            $data = $out->getData();
            for($i=0; $i < count($data->data); $i++) {

                $output = '';
                if(empty($data->data[$i]->Status)){
                    if(($role_name == 'super admin') || ($role_name == 'system admin') || ($role_name == 'website admin')){
                    $output .= ' <a href="'.url(route('question.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" data-toggle="tooltip" title="Show Details" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                    }
                    //    if(Auth::user()->can('faqs-update')){
                        if(($role_name == 'super admin') || ($role_name == 'system admin') || ($role_name == 'website admin')){
                    $output .= ' <a href="'.url(route('question.answer',['id'=>$data->data[$i]->_id])).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Ans & Add question" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-reply"></i></a>';
                        }
                    //    }
                    //    if(Auth::user()->can('faqs-update')){
                        if(($role_name == 'super admin') || ($role_name == 'system admin') || ($role_name == 'website admin')){
                    $output .= ' <span data-toggle="modal" data-target="#demoModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'">
                    <a class="btn btn-warning btn-xs" data-toggle="tooltip" title="Note" style="display:inline;padding:2px 4px 3px 4px;"><i class="fa fa-book"></i></a></span>';
                    $output .= '
                        <form method="post" action="'.url(route('question.update')).'">
                            <input type="hidden" name="id" value="'.$data->data[$i]->_id.'">
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                                <div class="modal" id="demoModal-'.$data->data[$i]->_id.'">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Note </h4>
                                            </div>
                                            <div class="modal-body">
                                            <input type="string" class="form-control" name="Note" placeholder="Add Note" id="Note" >
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Update</button>
                                                <button type="button" class="btn" data-dismiss="modal">Close</button>
                                            </div>
                                            </div>
                                    </div>
                                    </div>
                            </form>
                        ';
                        }
                        if(($role_name == 'super admin') || ($role_name == 'system admin')){
                        $output .= ' <span data-toggle="modal" data-target="#closeModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'">
                        <a class="btn btn-danger btn-xs" data-toggle="tooltip" title="Close question" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-times-circle"></i></a></span>';
                        $output .= '
                        <form method="post" action="'.url(route('question.delete')).'">
                            <input type="hidden" name="id" value="'.$data->data[$i]->_id.'">
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                                <div class="modal" id="closeModal-'.$data->data[$i]->_id.'">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Do You Want To Close This Question?</h4>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Yes</button>
                                                <button type="button" class="btn" data-dismiss="modal">No</button>
                                            </div>
                                            </div>
                                    </div>
                                    </div>
                            </form>
                        ';
                        }
                    }
                    elseif(($data->data[$i]->Status) == 1)
                    {
                        if(($role_name == 'super admin') || ($role_name == 'system admin') || ($role_name == 'website admin')){
                        $output .= ' <a href="'.url(route('question.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" data-toggle="tooltip" title="Show Details" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                        }
                        if(($role_name == 'super admin') || ($role_name == 'system admin')){
                        $output .= ' <span data-toggle="modal" data-target="#closeModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'">
                         <a class="btn btn-success btn-xs" data-toggle="tooltip" title="Reopen question" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-sync "></i></a></span>';
                        $output .= '
                        <form method="post" action="'.url(route('question.restore')).'">
                            <input type="hidden" name="id" value="'.$data->data[$i]->_id.'">
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                                <div class="modal" id="closeModal-'.$data->data[$i]->_id.'">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Do You Want To Re Open This Question?</h4>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Yes</button>
                                                <button type="button" class="btn" data-dismiss="modal">No</button>
                                            </div>
                                            </div>
                                    </div>
                                    </div>
                            </form>
                        ';
                        }
                    }
                    else
                    {
                        if(($role_name == 'super admin') || ($role_name == 'system admin') || ($role_name == 'website admin')){
                        $output .= ' <a href="'.url(route('question.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" data-toggle="tooltip" title="Show Details" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                        }
                        if(($role_name == 'super admin') || ($role_name == 'system admin') || ($role_name == 'website admin')){
                        $output .= ' <span data-toggle="modal" data-target="#demoModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'">
                        <a class="btn btn-warning btn-xs" data-toggle="tooltip" title="Note" style="display:inline;padding:2px 4px 3px 4px;"><i class="fa fa-book"></i></a></span>';
                        $output .= '
                            <form method="post" action="'.url(route('question.update')).'">
                                <input type="hidden" name="id" value="'.$data->data[$i]->_id.'">
                                <input type="hidden" name="_token" value="'.csrf_token().'" />
                                    <div class="modal" id="demoModal-'.$data->data[$i]->_id.'">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Note </h4>
                                                </div>
                                                <div class="modal-body">
                                                <input type="string" class="form-control" name="Note" placeholder="Add Note" id="Note" >
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Update</button>
                                                    <button type="button" class="btn" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                        </div>
                                        </div>
                                </form>
                            ';
                        }
                    }
                //    }
                $data->data[$i]->action = (string)$output;
                }
            $out->setData($data);
            return $out;
        }
    }
}

