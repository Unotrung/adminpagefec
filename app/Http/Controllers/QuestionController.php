<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Statics;
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

    public function dtajax(Request $request)
    {
        if ($request->ajax()) 
        {
            $start_date = new DateTime($request->from);
            // $start_date = $start_date->format("Y-m-d\TH:i:s.z\Z");
            $start_date = $start_date->format(DateTime::ISO8601);
            $end_date = new DateTime($request->to);
            $end_date = $end_date->format(DateTime::ISO8601);
            // $endDate = Carbon::createFromFormat('Y-m-d', $request->to);
            $question = Question::where('Status',1);
            if(empty($request->status) && empty($request->input))
            {
                $question = Question::whereNull('Status');
            }
            elseif(empty($request->status) && !empty($request->input))
            {
                $question = Question::where([['Status','=',$request->status],['Question','like', '%'.$request->input.'%']]);
            }
            elseif($request->status == 2 && empty($request->input))
            {
                $question = Question::where('Status',2);
            }
            elseif($request->status == 2 && !empty($request->input))
            {
                $question = Question::where([['Status','=',$request->status],['Question','like', '%'.$request->input.'%']]);
            }
            elseif($request->status == 1 && !empty($request->input))
            {
                $question = Question::where([['Status','=',$request->status],['Question','like', '%'.$request->input.'%']]);
            }
            $out =  Datatables::of($question->get())->make(true);
            // $out =  Datatables::of(Question::all())->make(true);
            $data = $out->getData();
            for($i=0; $i < count($data->data); $i++) {
                $output = '';
                
                $output .= ' <a href="'.url(route('question.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                //    if(Auth::user()->can('faqs-update')){
                $output .= ' <a href="'.url(route('question.answer',['id'=>$data->data[$i]->_id])).'" class="btn btn-success btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-reply"></i></a>';
                
                //    }
                //    if(Auth::user()->can('faqs-update')){
                $output .= ' <a data-toggle="modal" data-target="#demoModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 4px 3px 4px;"><i class="fa fa-book"></i></a>';
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
                    $output .= ' <a data-toggle="modal" data-target="#closeModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-times-circle"></i></a>';
                    $output .= '
                    <form method="post" action="'.url(route('question.delete')).'">
                        <input type="hidden" name="id" value="'.$data->data[$i]->_id.'">
                        <input type="hidden" name="_token" value="'.csrf_token().'" />
                            <div class="modal" id="closeModal-'.$data->data[$i]->_id.'">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Do You To Close This Question?</h4>
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
                //    }
                $data->data[$i]->action = (string)$output;
                }
            $out->setData($data);
            return $out;
        }
    }
}
