<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faqs;
use App\Models\Statics;
use DataTables;
use Auth;

class FaqController extends Controller
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
        return view('vendor.adminlte.faqs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statics = Statics::all();
        return view('vendor.adminlte.faqs.create')->with('statics', $statics);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $faq = new Faqs;
        $faq->Category = $request->Category_Create;
        $faq->Language = $request->Language_Create;
        $Question = str_replace(['<p>', '</p>'], '', $request->Question_Create);
        $faq->Question = $Question;
        $Answer = str_replace(['<p>', '</p>'], '', $request->Question_Create);
        $faq->Answer = $Answer;
        $faq->Status = null;
        $faq->save();
        return redirect()->route("faqs.index")->with('FAQ created successfull');

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
    public function edit($id)
    {
        $faq = Faqs::find($id);
        return view('vendor.adminlte.faqs.edit', ['faq' => $faq]);
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
        //DB::beginTransaction();
            $request->validate([
                'name' => 'required',
                'guard_name' => 'required'
            ]);
            $id = $request['id'];
            $faq = Faqs::Where($id)->first();
            $faq->Category = $request->Category_Edit;
            $faq->Language = $request->Language_Edit;
            $faq->Question = $request->Question_Edit;
            $faq->Answer = $request->Answer_Edit;
            $faq->save();

        return redirect()->route('faqs.index')->with('success','FAQs updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $faqs = Faqs::find($request->id);
        $faqs->Status = 1;
        $faqs->save();
        return redirect()->route('faqs.index')->with('FAQs deleted successfull');
    }

    public function dtajax(Request $request)
    {
        if ($request->ajax()) 
        {
        $faqs = Faqs::where('Status',1);
        // $faqs = Faqs::where('Category',$request->cat);
        // $faqs = Faqs::where('Language',$request->language);
        if(empty($request->status) && empty($request->input) && empty($request->cat) && empty($request->language))
        {
            $faqs = Faqs::whereNull('Status');
        }
        elseif(empty($request->status) && !empty($request->input) && empty($request->cat) && empty($request->language))
        {
            $faqs = Faqs::where([['Status','=',$request->status],['Question','like', '%'.$request->input.'%']]);
        } 
        elseif(!empty($request->cat) && empty($request->status) && empty($request->input) && empty($request->language))
        {
            $faqs = Faqs::where([['Status','=',$request->status],['Category','=', $request->cat]]);
        }
        // elseif(!empty($request->language) && empty($request->status))
        // {
        //     $faqs = Faqs::where([['Language','=', $request->language],['Category','=', $request->cat]]);
        // }
        elseif(!empty($request->cat) && empty($request->status) && !empty($request->input) && empty($request->language))
        {
            $faqs = Faqs::where([['Status','=',$request->status],['Category','=', $request->cat],['Question','like', '%'.$request->input.'%']]);
        }
        elseif(!empty($request->language) && empty($request->status) && !empty($request->input))
        {
            $faqs = Faqs::where([['Language','=', $request->language],['Category','=', $request->cat],['Question','like', '%'.$request->input.'%']]);
        }
        elseif(!empty($request->language) && !empty($request->cat) && empty($request->status))
        {
            $faqs = Faqs::where([['Status','=',$request->status],['Category','=', $request->cat],['Language','=', $request->language]]);
        }
        elseif(!empty($request->language) && !empty($request->cat) && empty($request->status)&& !empty($request->input))
        {
            $faqs = Faqs::where([['Status','=',$request->status],['Category','=', $request->cat],['Language','=', $request->language],['Question','like', '%'.$request->input.'%']]);
        }
        else if(!empty($request->language) && empty($request->cat) && empty($request->status))
        {
            $faqs = Faqs::where([['Status','=',$request->status],['Language','=', $request->language]]);
        }
        else if(!empty($request->status) && !empty($request->cat) )
        {
            $faqs = Faqs::where([['Status','=',1],['Category','=', $request->cat]]);
        }
        else if(!empty($request->status) && !empty($request->cat) && !empty($request->input) )
        {
            $faqs = Faqs::where([['Status','=',1],['Category','=', $request->cat],['Question','like', '%'.$request->input.'%']]);
        }
        else if(!empty($request->status) && !empty($request->language) )
        {
            $faqs = Faqs::where([['Status','=',1],['Language','=', $request->language]]);
        }
        else if(!empty($request->status) && !empty($request->language)&& !empty($request->input) )
        {
            $faqs = Faqs::where([['Status','=',1],['Language','=', $request->language],['Question','like', '%'.$request->input.'%']]);
        }
        else if (!empty($request->status) && !empty($request->language) && !empty($request->cat) && !empty($request->input))
        {
            $faqs = Faqs::where([['Status','=',1],['Category','=', $request->cat],['Language','=', $request->language],['Question','like', '%'.$request->input.'%']]);
        }
        else if(!empty($request->language) && empty($request->cat))
        {
            $faqs = Faqs::where([['Status','=',$request->status],['Language','=', $request->language]]);
        }
        $out =  Datatables::of($faqs->get())->make(true);
        $data = $out->getData();
           for($i=0; $i < count($data->data); $i++) {
               $output = '';
               $output .= ' <a href="'.url(route('faqs.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
            //    if(Auth::user()->can('faqs-update')){
               $output .= ' <a href="'.url(route('faqs.edit',['id'=>$data->data[$i]->_id])).'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
            //    }
               if(Auth::user()->can('faqs-update'))
               {
               $output .= ' <a data-toggle="modal" data-target="#demoModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-ban"></i></a>';
               $output .= '
                <form method="post" action="'.url(route('faqs.delete')).'">
                     <input type="hidden" name="id" value="'.$data->data[$i]->_id.'">
                     <input type="hidden" name="_token" value="'.csrf_token().'" />
                         <div class="modal" id="demoModal-'.$data->data[$i]->_id.'">
                                 <div class="modal-dialog">
                                     <div class="modal-content">
                                     <!-- Modal Header -->
                                     <div class="modal-header">
                                         <h4 class="modal-title">Do you want delete? </h4>
                                     </div>
                                     <!-- Modal footer -->
                                     <div class="modal-footer">
                                         <button type="submit" class="btn btn-danger">Delete</button>
                                         <button type="button" class="btn" data-dismiss="modal">Close</button>
                                     </div>
                                     </div>
                             </div>
                             </div>
                     </form>
                ';
               }
               $data->data[$i]->action = (string)$output;
            }
           $out->setData($data);
           return $out;
        }
    }
}

