<?php
namespace App\Http\Controllers\Client;

use App\Advertisement;
use App\AdvModel;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\ModelClass;
use App\Screen;
use App\Viewer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientStatisticsController extends Controller
{
    public function index()
    {
        $screen = Screen::where('user_id',Auth::user()->id)->get()->pluck('id');
        $male_id = ModelClass::where('class_name', 'male')->first();
        $female_id = ModelClass::where('class_name', 'female')->first();
        $data = [
            'users' => User::where('is_admin',false)->get(),
            'advertisements' =>Advertisement::with('viewers')
                ->join('screen_advertisement', 'advertisements.id','=', 'screen_advertisement.advertisement_id')->get(),
            'male' => $male_id ? DB::table('viewer_Model_classes')->where('model_class_id', $male_id->id)->count() : 0,
            'female' => $female_id ? DB::table('viewer_Model_classes')->where('model_class_id', $female_id->id)->count() : 0
        ];
        return view('client.statistics')->with($data);
    }

    public function get_screen(Request $request){
        $data = [];
        if(isset($request->user_id)){
            if($request->user_id != -1)
                $data = Screen::where('user_id',$request->user_id)->get();

        }else{
            if($request->screen_id != 0 and $request->screen_id != -1){
                $data = Screen::find($request->screen_id)->advertisements;
            }

        }
        return $data;

    }

    public function search(Request $request)
    {

        if($request->screen_id > 0){
            $data = Viewer::where('screen_id',$request->screen_id)->get();
            $analysis = DB::table('advanalysis')->where('screen_id',$request->screen_id)->get();
            if($request->advertisement_id > 0){
                $data =$data->where(' ',$request->advertisement_id);
                $analysis =$analysis->where('advertisement_id',$request->advertisement_id);
            }

            if($request->started != null){
                $data = $data->where('created_at','>=',$request->started);
                $analysis = $analysis->where('created_at','>=',$request->started);
            }
            if($request->ended != null){
                $data = $data->where('created_at','<=',$request->ended);
                $analysis = $analysis->where('created_at','<=',$request->ended);
            }

        }else {
            $screen = Screen::where('user_id',Auth::user()->id)->get()->pluck('id');
            $data =  Viewer::whereIn('screen_id',$screen)->get();
            $analysis =  DB::table('advanalysis')->whereIn('screen_id',$screen)->get();
        }
        $filtered_data = [];
        $filtered_data['smilling']= [];
        $filtered_data['total']= [];
        $filtered_data['models']=[];
        $filtered_data['gender']=[];
        $filtered_data['age']=[];
        $filtered_data['attention'] = [];
        $data = $data->groupBy(function($val) {
            return Carbon::parse($val->created_at)->format('Y-m-d');
        });
        $attentions = $analysis->groupBy('created');
        $analysis = $analysis->groupBy('name');
        $gender = $analysis['gender']->groupBy('class_name');
        foreach($gender as $key=>$items){
            $people = 0;
            foreach($items as $item){
                $people += $item->num_people;
            }
            array_push($filtered_data['gender'],['name'=>$key,'points'=>$people,'color'=>'#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT),'bullet'=>'https://www.amcharts.com/lib/images/faces/D02.png']);
        }
        foreach($attentions as $key=>$items){
            $value1 = 0;
            $value2 = 0;
            $value3 = 0;
            $value4 = 0;
            foreach($items as $item){
                $value1 += $item->num_people;
                $value2 += $item->time_front;
                $value3 += $item->smilling;
                $value4 += $item->adv_watcher;
            }
            array_push($filtered_data['attention'],['date'=>$key,'market1'=>$value1,'market2'=>$value2,'sales1'=>$value3,'sales2'=>$value4]);
        }
        usort($filtered_data['attention'], function ($item1, $item2) {
            return $item1['date'] <=> $item2['date'];
        });

        $age = $analysis['age']->groupBy('class_name');
        foreach($age as $key=>$items){
            $people = 0;
            foreach($items as $item){
                $people += $item->num_people;
            }
            array_push($filtered_data['age'],['country'=>$key,'visits'=>$people,'color'=>'#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT)]);
        }
        foreach($analysis as $key=>$items){
            $people = 0;
            foreach($items as $item){
                $people += $item->num_people;
            }
            array_push($filtered_data['models'],['country'=>$key,'litres'=>$people]);
        }
        foreach($data as $key=>$items){
            $smiling = 0;
            $time = 0;
            $people = 0;

            foreach($items as $item){

                // foreach($item->classes as $class){
                //     $models_usage[$class->model->name] ++;
                // }
                $smiling += $item->smiling_percentage;
                $time += $item->time_in_front_of_camera;
                $people += $item->number_of_people;
            }
            array_push($filtered_data['smilling'],['date'=>$key,'value'=>$smiling]);
            array_push($filtered_data['total'],['date'=>$key,'hits'=>$smiling,'visits'=>$people,'views'=>$time]);
        }
        return $filtered_data;
    }
}
