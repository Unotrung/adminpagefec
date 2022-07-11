<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faqs;
use App\Models\Statics;
use DataTables;
use Excel;
use Auth;
use App\Imports\FaqsImport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

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
        return view('vendor.adminlte.faqs.create')->with('statics', $statics);
    }

    function import(Request $request)
    {
        $data = request()->file('file');
        // $data = $data->getPathName();
        // print_r($data);
        // exit;
        $fileName = time().'_'.request()->file->getClientOriginalName();
        request()->file('file')->storeAs('reports', $fileName, 'public');
        Excel::import(new FaqsImport,request()->file('file'));
        return back();
    //     $this->validate($request, [
    //         'file'  => 'required|mimes:xls,xlsx'
    //     ]);
    //     $path = $request->file('file')->getRealPath();
    //     // $path = $request->file('csv_file')->getRealPath();
    //     $data = Excel::import(new CsvImport, $path);
    //     print_r($data);
    //     exit;
    //     if($data->count() > 0)
    //     {
    //     foreach($data->toArray() as $key => $value)
    //     {
    //         foreach($value as $row)
    //         {
    //             $insert_data[] = array(
    //             'Question'  => $row['Question'],
    //             'Category'   => $row['Category'],
    //             'Status'   => $row['Status'],
    //             'Language'    => $row['Language'],
    //             // 'Answer' => $row['Category'],
    //             );
    //         }
    //     }
    //     if(!empty($insert_data))
    //     {
    //         DB::collection('faqs')->insert($insert_data);
    //     }
    //  }
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
        $date = Carbon::now();
        $date = Carbon::parse($date)->format('Y-m-d');
        $faq->Createday = $date;
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

            $id = $request['id'];
            $faq = Faqs::find($request->id);
            // print_r($faq);
            // exit;
            //
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
        $from = Carbon::parse($request->from)->format('Y-m-d');
        // $request->from = Carbon::createFromDate('2022, 6, 1)');
        // $request->to = Carbon::createFromDate('2015, 7, 1)');
        $to = Carbon::parse($request->to)->format('Y-m-d');
        //0000
        if(empty($request->status) && empty($request->input) && empty($request->cat) && empty($request->language)&& !empty($request->from) &&!empty($request->to))
        {
               $faqs = Faqs::whereNull('Status')->whereBetween('Createday', array($from,$to));
        }
        //1000
        elseif(!empty($request->status) && empty($request->input) && empty($request->cat) && empty($request->language)&& !empty($request->from) &&!empty($request->to))
        {
            $faqs = Faqs::where([['Status','=',1]])->whereBetween('Createday', array($from,$to));
        }
        //0100
        elseif(empty($request->status) && !empty($request->input) && empty($request->cat) && empty($request->language)&& !empty($request->from) &&!empty($request->to))
        {
            $faqs = Faqs::where([['Status','=',$request->status],['Question','like', '%'.$request->input.'%']])->whereBetween('Createday', array($from,$to));
        }
        //0010
        elseif(empty($request->status) && empty($request->input) && !empty($request->cat) && empty($request->language)&& !empty($request->from) &&!empty($request->to))
        {
            $faqs = Faqs::where([['Status','=',$request->status],['Category','=', $request->cat]])->whereBetween('Createday', array($from,$to));
        }
        //0001
        elseif(empty($request->status) && empty($request->input) && empty($request->cat) && !empty($request->language)&& !empty($request->from) &&!empty($request->to))
        {
            $faqs = Faqs::where([['Status','=',$request->status],['Language','=', $request->language]])->whereBetween('Createday', array($from,$to));
        }
        //1100
        elseif(!empty($request->status) && !empty($request->input) && empty($request->cat) && empty($request->language)&& !empty($request->from) &&!empty($request->to))
        {
            $faqs = Faqs::where([['Status','=',1],['Question','like', '%'.$request->input.'%']])->whereBetween('Createday', array($from,$to));
        }
        //0110
        elseif(empty($request->status) && !empty($request->input) && !empty($request->cat) && empty($request->language)&& !empty($request->from) &&!empty($request->to))
        {
            $faqs = Faqs::where([['Status','=',$request->status],['Question','like', '%'.$request->input.'%'],['Category','=', $request->cat]])->whereBetween('Createday', array($from,$to));
        }
        //0011 not fit tu day do xuong
        elseif(empty($request->status) && empty($request->input) && !empty($request->cat) && !empty($request->language)&& !empty($request->from) &&!empty($request->to))
        {
            $faqs = Faqs::where([['Status','=',$request->status],['Category','=', $request->cat],['Language','=', $request->language]])->whereBetween('Createday', array($from,$to));
        }
        //1010
        elseif(!empty($request->status) && empty($request->input) && !empty($request->cat) && empty($request->language)&& !empty($request->from) &&!empty($request->to))
        {
            $faqs = Faqs::where([['Status','=',1],['Category','=', $request->cat]])->whereBetween('Createday', array($from,$to));
        }
        //1001
        elseif(!empty($request->status) && empty($request->input) && empty($request->cat) && !empty($request->language)&& !empty($request->from) &&!empty($request->to))
        {
            $faqs = Faqs::where([['Status','=',1],['Language','=', $request->language]])->whereBetween('Createday', array($from,$to));
        }
        //1110
        elseif(!empty($request->status) && !empty($request->input) && !empty($request->cat) && empty($request->language)&& !empty($request->from) &&!empty($request->to))
        {
            $faqs = Faqs::where([['Status','=',1],['Question','like', '%'.$request->input.'%'],['Category','=', $request->cat]])->whereBetween('Createday', array($from,$to));
        }
        //0111
        elseif(empty($request->status) && !empty($request->input) && !empty($request->cat) && !empty($request->language)&& !empty($request->from) &&!empty($request->to))
        {
            $faqs = Faqs::where([['Status','=',$request->status],['Question','like', '%'.$request->input.'%'],['Category','=', $request->cat],['Language','=', $request->language]])->whereBetween('Createday', array($from,$to));
        }
        //0101 doi test
        elseif(empty($request->status) && !empty($request->input) && empty($request->cat) && !empty($request->language)&& !empty($request->from) &&!empty($request->to))
        {
            $faqs = Faqs::where([['Status','=',$request->status],['Question','like', '%'.$request->input.'%'],['Language','=', $request->language]])->whereBetween('Createday', array($from,$to));
        }
        //1011
        elseif(!empty($request->status) && empty($request->input) && !empty($request->cat) && !empty($request->language)&& !empty($request->from) &&!empty($request->to))
        {
            $faqs = Faqs::where([['Status','=',1],['Category','=', $request->cat],['Language','=', $request->language]])->whereBetween('Createday', array($from,$to));
        }
        //1101
        elseif(!empty($request->status) && !empty($request->input) && empty($request->cat) && !empty($request->language)&& !empty($request->from) &&!empty($request->to))
        {
            $faqs = Faqs::where([['Status','=',1],['Question','like', '%'.$request->input.'%'],['Language','=', $request->language]])->whereBetween('Createday', array($from,$to));
        }
        //1111
        elseif (!empty($request->status) && !empty($request->input) && !empty($request->cat) && !empty($request->language)&& !empty($request->from) &&!empty($request->to))
        {
            $faqs = Faqs::where([['Status','=',1],['Question','like', '%'.$request->input.'%'],['Category','=', $request->cat],['Language','=', $request->language]])->whereBetween('Createday', array($from,$to));
        }


        // $faqs = Faqs::whereBetween('Createday', array($from,$to));
        // $faqs = Faqs::where('Category',$request->cat);
        // $faqs = Faqs::where('Language',$request->language);
        // if(empty($request->status) && empty($request->input) && empty($request->cat) && empty($request->language))
        // {
        //     $faqs = Faqs::whereNull('Status');
        // }
        // elseif(empty($request->status) && !empty($request->input) && empty($request->cat) && empty($request->language))
        // {
        //     $faqs = Faqs::where([['Status','=',$request->status],['Question','like', '%'.$request->input.'%']]);
        // }
        // elseif(!empty($request->cat) && empty($request->status) && empty($request->input) && empty($request->language))
        // {
        //     $faqs = Faqs::where([['Status','=',$request->status],['Category','=', $request->cat]]);
        // }
        // elseif(!empty($request->cat) && empty($request->status) && !empty($request->input) && empty($request->language))
        // {
        //     $faqs = Faqs::where([['Status','=',$request->status],['Category','=', $request->cat],['Question','like', '%'.$request->input.'%']]);
        // }
        // elseif(!empty($request->language) && empty($request->status) && !empty($request->input))
        // {
        //     $faqs = Faqs::where([['Language','=', $request->language],['Category','=', $request->cat],['Question','like', '%'.$request->input.'%']]);
        // }
        // elseif(!empty($request->language) && !empty($request->cat) && empty($request->status))
        // {
        //     $faqs = Faqs::where([['Status','=',$request->status],['Category','=', $request->cat],['Language','=', $request->language]]);
        // }
        // elseif(!empty($request->language) && !empty($request->cat) && empty($request->status)&& !empty($request->input))
        // {
        //     $faqs = Faqs::where([['Status','=',$request->status],['Category','=', $request->cat],['Language','=', $request->language],['Question','like', '%'.$request->input.'%']]);
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
        //     $faqs = Faqs::where([['Status','=',1],['Category','=', $request->cat],['Question','like', '%'.$request->input.'%']]);
        // }
        // else if(!empty($request->status) && !empty($request->language) )
        // {
        //     $faqs = Faqs::where([['Status','=',1],['Language','=', $request->language]]);
        // }
        // else if(!empty($request->status) && !empty($request->language)&& !empty($request->input) )
        // {
        //     $faqs = Faqs::where([['Status','=',1],['Language','=', $request->language],['Question','like', '%'.$request->input.'%']]);
        // }
        // else if (!empty($request->status) && !empty($request->language) && !empty($request->cat) && !empty($request->input))
        // {
        //     $faqs = Faqs::where([['Status','=',1],['Category','=', $request->cat],['Language','=', $request->language],['Question','like', '%'.$request->input.'%']]);
        // }
        // else if(!empty($request->language) && empty($request->cat))
        // {
        //     $faqs = Faqs::where([['Status','=',$request->status],['Language','=', $request->language]]);
        // }
        $out =  Datatables::of($faqs->get())->make(true);
        $data = $out->getData();
           for($i=0; $i < count($data->data); $i++) {
               $output = '';
               $output .= ' <a href="'.url(route('faqs.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs"  data-toggle="tooltip" title="Show Details"  style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
            //    if(Auth::user()->can('faqs-update')){
                if(empty($request->status)){
               $output .= ' <a href="'.url(route('faqs.edit',['id'=>$data->data[$i]->_id])).'" class="btn btn-warning btn-xs"  data-toggle="tooltip" title="Edit Faqs"  style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
            //    }
               if(Auth::user()->can('faqs-update'))
               {
               $output .= '<span data-toggle="modal" data-target="#demoModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'">
               <a data-toggle="tooltip" class="btn btn-danger btn-xs" title="Deactive FAQs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-ban"></i></a></span> ';
            //    <a data-toggle="modal" data-target="#demoModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-ban"></i></a>
               $output .= '
                <form method="post" action="'.url(route('faqs.delete')).'">
                     <input type="hidden" name="id" value="'.$data->data[$i]->_id.'">
                     <input type="hidden" name="_token" value="'.csrf_token().'" />
                         <div class="modal" id="demoModal-'.$data->data[$i]->_id.'">
                                 <div class="modal-dialog">
                                     <div class="modal-content">
                                     <!-- Modal Header -->
                                     <div class="modal-header">
                                         <h4 class="modal-title">Do you want Deactive? </h4>
                                     </div>
                                     <!-- Modal footer -->
                                     <div class="modal-footer">
                                         <button type="submit" class="btn btn-danger">Deactive</button>
                                         <button type="button" class="btn" data-dismiss="modal">Close</button>
                                     </div>
                                     </div>
                             </div>
                             </div>
                     </form>
                ';
               }
            }
               $data->data[$i]->action = (string)$output;
            }
           $out->setData($data);
           return $out;
        }
    }
}

