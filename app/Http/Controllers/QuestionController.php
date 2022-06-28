<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Statics;
use DataTables;
use Auth;
use Mail;

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
        $faqs = Faqs::find($id);
			if(isset($faqs->_id)) {
				$setErrorsBag = "khong hien thi";
				return view('vendor.adminlte.faqs.show',[])->with('faqs', $faqs);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("faqs"),
				]);
			}
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
            $question->answer = $answer;
            $question->Status = 2;
            $question->save();
            // print_r($request->Email);
            // exit;
            $this->html_mail($request->Email,$id,$answer);

        return redirect()->route('question.index')->with('success','Question updated successfully.');
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
            // $question = Question::all();
        // $question = Question::where('Status',1);
        // $faqs = Faqs::where('Category',$request->cat);
        // $faqs = Faqs::where('Language',$request->language);
        // if(empty($request->status) && empty($request->input) && empty($request->cat) && empty($request->language))
        // {
        //     $faqs = Faqs::whereNull('Status');
        // }
        // elseif(empty($request->status) && !empty($request->input) && empty($request->cat) && empty($request->language))
        // {
        //     $faqs = Faqs::where([['Status','=',$request->status],['Question','=', $request->input]]);
        // } 
        // elseif(!empty($request->cat) && empty($request->status) && empty($request->input) && empty($request->language))
        // {
        //     $faqs = Faqs::where([['Status','=',$request->status],['Category','=', $request->cat]]);
        // }
        // // elseif(!empty($request->language) && empty($request->status))
        // // {
        // //     $faqs = Faqs::where([['Language','=', $request->language],['Category','=', $request->cat]]);
        // // }
        // elseif(!empty($request->cat) && empty($request->status) && !empty($request->input) && empty($request->language))
        // {
        //     $faqs = Faqs::where([['Status','=',$request->status],['Category','=', $request->cat],['Question','=', $request->input]]);
        // }
        // elseif(!empty($request->language) && empty($request->status) && !empty($request->input))
        // {
        //     $faqs = Faqs::where([['Language','=', $request->language],['Category','=', $request->cat],['Question','=', $request->input]]);
        // }
        // elseif(!empty($request->language) && !empty($request->cat) && empty($request->status))
        // {
        //     $faqs = Faqs::where([['Status','=',$request->status],['Category','=', $request->cat],['Language','=', $request->language]]);
        // }
        // elseif(!empty($request->language) && !empty($request->cat) && empty($request->status)&& !empty($request->input))
        // {
        //     $faqs = Faqs::where([['Status','=',$request->status],['Category','=', $request->cat],['Language','=', $request->language],['Question','=', $request->input]]);
        // }
        // else if(!empty($request->language) && empty($request->cat) && empty($request->status))
        // {
        //     $faqs = Faqs::where([['Status','=',$request->status],['Language','=', $request->language]]);
        // }
        // else if(!empty($request->status) && !empty($request->cat) )
        // {
        //     $faqs = Faqs::where([['Status','=',1],['Category','=', $request->cat]]);
        // }
        // else if(!empty($request->status) && !empty($request->cat) && !empty($request->input) )
        // {
        //     $faqs = Faqs::where([['Status','=',1],['Category','=', $request->cat],['Question','=', $request->input]]);
        // }
        // else if(!empty($request->status) && !empty($request->language) )
        // {
        //     $faqs = Faqs::where([['Status','=',1],['Language','=', $request->language]]);
        // }
        // else if(!empty($request->status) && !empty($request->language)&& !empty($request->input) )
        // {
        //     $faqs = Faqs::where([['Status','=',1],['Language','=', $request->language],['Question','=', $request->input]]);
        // }
        // else if (!empty($request->status) && !empty($request->language) && !empty($request->cat) && !empty($request->input))
        // {
        //     $faqs = Faqs::where([['Status','=',1],['Category','=', $request->cat],['Language','=', $request->language],['Question','=', $request->input]]);
        // }
        // else if(!empty($request->language) && empty($request->cat))
        // {
        //     $faqs = Faqs::where([['Status','=',$request->status],['Language','=', $request->language]]);
        // }
        // $out =  Datatables::of($question->get())->make(true);
        $out =  Datatables::of(Question::all())->make(true);
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

