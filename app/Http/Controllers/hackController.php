<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\hackModel;
use App\ratings;
use Google_Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;

class hackController extends Controller
{
    public function addData(Request $request)
    {
        $this->validate(request(),['category'=>'required|max:15','place'=>'required','service'=>'required','case'=>'required','_token'=>'required']);
        $msg = array('Your case has been uploaded! :)');
        $errormsg = array('There was some error processing your request. :(');
        $model = new hackModel;
        $model->category = $request->category;
        $model->subcat = $request->subcat;
        $model->place = $request->place;
        $model->officer = $request->officer;
        $model->service = $request->service;
        $model->case = $request->case;
        $model->proof = $request->proof;
        $model->anonymous = $request->anonymous;
        $model->remember_token = $request->_token;
        $model->userid = Auth::user()->id;
        if($request->proof == 1)
        {
            $extension = $request->file('fileupload')->extension();
            $file = $request->file('fileupload')->storeAs('recordings/user',$request->_token.'.'.$extension);
            $model->proof = $request->proof;
            $model->file = $file;
        }
        if($model->save())
            echo json_encode($msg);
        else
            echo json_encode($errormsg);
    }
    public function language($language)
    {
        if($language == 'en')
            return back()->with('language','en');
        else if($language == 'hi')
            return back()->with('language','hi');
        else
            return back();

    }
    public function printPDF(Request $request)
    {
        $dynamic1='';
        $name = $request->name;
        $place = $request->place;
        $culprit = $request->culprit;
        $service = $request->service;
        $category = $request->category;
        $subcat = $request->subcat;
        $case = $request->case;
        $date = $request->date;
        $genderuser = $request->genderuser;
        $gendercul = $request->gendercul;
        if(strcmp($gendercul,'male') == 0)
            $sal = 'Mr.';
        else
            $sal = 'Mrs.';
        if(strcmp($subcat,'Police'))
        {
            $dynamic1 = 'a police officer';
        }
        if(strcmp($subcat,'Political'))
        {
            $dynamic1 = 'a politician';
        }
        if(strcmp($subcat,'Judicial'))
        {
            $dynamic1 = 'a judge';
        }
        if(strcmp($subcat,'Sports'))
        {
            $dynamic1 = 'a sports player';
        }
        if(strcmp($subcat,'Health'))
        {
            $dynamic1 = 'a doctor';
        }
        if(strcmp($subcat,'Health'))
        {
            $dynamic1 = 'a doctor';
        }
        if(strcmp($subcat,'Govt. Officials'))
        {
            $dynamic1 = 'a govt. officical';
        }
        if(strcmp($subcat,'Govt. Officials'))
        {
            $dynamic1 = 'a defence person';
        }
        if(strcmp($subcat,'Private Companies'))
        {
            $dynamic1 = 'the private company';
        }

        $title = "Suspend corrupt officer $sal $culprit at $place!";

        $person = 'CBI';

        $content = "An anonymous user (a possible $genderuser human) 
        has reported that $dynamic1 named \" $sal $culprit \" who 
        is one of the officers at $place has 
        been demanding for bribe in order to provide $service. 
        The full case as reported by the user was: 
        \" $case \" 
        Will there be a day when this country runs without bribe? 
        How long can this go on? On the behalf of the anonymous user, 
        we would like to raise this concern to CBI to take action against 
        the corrupt officer. The user has relevant proof against \" $sal $culprit \".
        We will provide the proof on the request of the concerned officer.
        Please help us to raise it to the CBI and get this issue resolved.
        Support us by signing below. Your one sign can create a lot of difference!
        Case retreived on $date (UTC)";
        $data = array($title,$person,$content);
        echo json_encode($data);
    }

    public function addRate(Request $request)
    {
        $model = new hackModel();
        $ratemodel = new ratings();
        $response = array();
        $check = $ratemodel->select('caseid')->where('userid',Auth::user()->id)->get();
        if(!empty($check[0]))
        {
            foreach($check as $item)
            {
                if($item->caseid == $request->caseid)
                {
                    $response['error'] = 'Already rated';
                    echo json_encode($response);
                    die();
                }
            }
        }
            $ratemodel->userid = Auth::user()->id;
            $ratemodel->caseid = $request->caseid;
            $entry = $model->find($request->caseid);
            $total_rating = $entry->total_rating;
            $entry->total_rating = $total_rating + ($request->rating / 5);
            if ($entry->save() && $ratemodel->save()) {
                $response['success'] = $entry->total_rating;
                echo json_encode($response);
            } else {
                $response['failure'] = 'There was some error';
                echo json_encode($response);
            }
    }

    public function checkRate(Request $request)
    {
        $model = new Ratings();
        $cases = array();
        $query = $model->select('caseid')->where('userid',$request->id)->get();
        foreach($query as $case)
        {
            array_push($cases,$case->caseid);
        }
        echo json_encode($cases);
    }

    public function getRate(Request $request)
    {
        $model = new hackModel();
        $data = $model->select('total_rating')->where('id',$request->caseid)->get();
        echo json_encode($data);

    }
    public function filterCase(Request $request)
    {
        $query = DB::select("SELECT * FROM `documentCase` WHERE `category` LIKE ? OR `subcat` LIKE ? OR `place` LIKE ? OR `officer` LIKE ? OR `service` LIKE ? OR `case` LIKE ?",["%$request->value%","%$request->value%","%$request->value%","%$request->value%","%$request->value%","%$request->value%"]);
        echo json_encode($query);
    }

    public function googleSignIn(Request $request)
    {
        require_once '/home/wassan/hackathon/vendor/autoload.php';
        $model = new User();
        $CLIENT_ID = '376328505155-1kv7ipkgvb6nvilnhh2ubpbp9qm9u2lj.apps.googleusercontent.com';
        $client = new Google_Client(['client_id' => $CLIENT_ID]);
        $client->setRedirectUri('http://localhost:8000/home');
        $useremail = '';
        $userid = $client->getClientId();
        $payload = $client->verifyIdToken($request->id_token);
        if ($payload) {
                $email = $model->select('email')->get();
                $found = false;
                foreach($email as $user)
                {
                    if($user->email == $payload['email'])
                    {
                        $useremail = $user->email;
                        $found = true;
                        break;
                    }
                }
                if($found == false)
                {
                    if($user = User::create([
                        'name'  => $payload['name'],
                        'email' => $payload['email'],
                        'password' => bcrypt($userid)
                    ]))
                    {
                        Auth::login($user);
                    }
                }
                else
                {
                    $id = $model->select('id')->where('email',$useremail)->get();
                    $loginid = $id[0]->id;
                    if(Auth::loginUsingId($loginid))
                    {
                        echo 'Done';
                    }
                    else
                    {
                        echo 'Error';
                    }
                }
                /*$model->name = $payload['name'];
                $model->email = $payload['email'];
                $model->password = bcrypt($userid);
                $model->save();
                Auth::login($model);
                return redirect('/');*/
            // If request specified a G Suite domain:
            //$domain = $payload['hd'];
        }

        else {
            // Invalid ID token
            echo 'Not set';
        }
    }
}
