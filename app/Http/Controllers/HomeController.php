<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Team;
use App\Role;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    #######################################################################################################################
    ################################################ TEAM SECTION START HERE ##############################################
    #######################################################################################################################

    /**
    * Function Name : teams
    * Params        : None
    * Description   : Show the Add team view along with lists of the team.
    * Return        : Render a team view along with data.
    * Author        : Mobilyte solutions.
    * Date          : 08-April-2019 
    */

    public function teams()
    {
        
        $teams = Team::orderBy('id', 'desc')->paginate(5);
        return view('/teams/teams',['teams' => $teams]);
    }


    /**
    * Function Name : SaveTeam
    * Params        : array()
    * Description   : Insert the team data.  
    * Return        : Render a team view with data and flash message.
    * Author        : Mobilyte solutions.
    * Date          : 08-April-2019 
    */

    public function SaveTeam(Request $request)
    {

        $validatedData = $request->validate(['name' => 'required|string|unique:teams|max:255']);

        $team           = Team::create($validatedData);

        return redirect('/teams')->with('success', 'Team is successfully saved');

    }

    /**
    * Function Name : EditTeam
    * Params        : $id
    * Description   : Get a edit form of the team along with list.
    * Return        : Render a team view with data.
    * Author        : Mobilyte solutions.
    * Date          : 08-April-2019 
    */

    public function EditTeam($id=null)
    {
        if(!empty($id)){        
            $data  = Team::where('id', $id)->first();              
            $teams = Team::orderBy('id', 'desc')->paginate(5);     
            return view('/teams/teams',['datas' => $data,'teams'=>$teams]);
        }       
    }


    /**
    * Function Name : UpdateTeam
    * Params        : array()
    * Description   : Update the  team data.
    * Return        : Render a team view with data and flash message.
    * Author        : Mobilyte solutions.
    * Date          : 08-April-2019 
    */

    public function UpdateTeam(Request $request)
    {

        $id   = $request->input('id');
        $data = Team::where([['name', '=', $request->input('name')],['id', '!=', $id]])->get();

        if($data->isEmpty()){

            $response  = Team::where('id',$id)->update(['name' => $request->input('name')]);

            if($response){

                return redirect('/teams')->with('success', 'Team is updated successfully');

            }

        }  else {

            return redirect('/editteam/'.$id)->with('error', 'Team is already exist');
        }   
    }



    /**
    * Function Name : DeleteTeam
    * Params        : $id
    * Description   : Show the list of the teams along with add team form.
    * Return        : Render a team view with data  or flash message.
    * Author        : Mobilyte solutions.
    * Date          : 08-April-2019 
    */

    public function DeleteTeam($id=null)
    {

        if($id){

            $response  = Team::where('id',$id)->delete();

            if($response){

                return redirect('/teams')->with('success', 'Team is deleted successfully');

            }

        }  else {

            return redirect('/teams')->with('error', 'Team is not deleted');
        }   
    }


    #######################################################################################################################
    ################################################ TEAM SECTION END HERE ################################################
    #######################################################################################################################



    #######################################################################################################################
    ################################################ USER SECTION START HERE ##############################################
    #######################################################################################################################


    /**
    * Function Name : users
    * Params        : None
    * Description   : Show the list of the user along with user register form.
    * Return        : Render a user view with data  or flash message.
    * Author        : Mobilyte solutions.
    * Date          : 08-April-2019 
    */

    public function users()
    {    
        
        $users = DB::table('users')
                ->leftJoin('roles', 'users.role_id', '=', 'roles.id')            
                ->select('users.*', 'roles.name as rname')        
                ->orderBy('id', 'desc')->paginate(5); 

        $teams = Team::orderBy('id', 'asc')->get();
        $roles = Role::orderBy('name','desc')->get(); 

        return view('/users/users',['users' => $users,'teams'=>$teams,'roles'=>$roles]);
    }


    /**
    * Function Name : SaveUsers
    * Params        : array()
    * Description   : Save user insert data form.
    * Return        : Render a user view with data  or flash message.
    * Author        : Mobilyte solutions.
    * Date          : 08-April-2019 
    */
    
    public function SaveUsers(Request $request)
    {

        $validatedData = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users']                
            ]
        );

        $data = $request->all();

        if($request->input('assigned_teams')){
           $data['assigned_teams']  = implode(',', $request->input('assigned_teams'));
        }
        
        User::create($data);

        return redirect('/users')->with('success', 'User is successfully saved');
    }


    /**
    * Function Name : EditUser
    * Params        : $id
    * Description   : Open edit user form and filled with the existing data. 
    * Return        : Render a user view with data  or flash message.
    * Author        : Mobilyte solutions.
    * Date          : 08-April-2019 
    */
 
     public function EditUser($id=null)
    {
        if(!empty($id)){        
            $data  = User::where('id', $id)->first();          
            $teams = Team::orderBy('name','desc')->get(); 
            $roles = Role::orderBy('name','desc')->get(); 

            $users = DB::table('users')
                ->leftJoin('roles', 'users.role_id', '=', 'roles.id')            
                ->select('users.*', 'roles.name as rname')        
                ->orderBy('id', 'desc')->paginate(5); 
            
            return view('/users/users',['datas' => $data,'users'=>$users,'teams'=>$teams,'roles'=>$roles]);
        }       
    }


    /**
    * Function Name : UpdateUser
    * Params        : array()
    * Description   : Update the user data on update request.
    * Return        : Render a user view with data  or flash message.
    * Author        : Mobilyte solutions.
    * Date          : 08-April-2019 
    */
      
    public function UpdateUser(Request $request)
    {

        $request->validate(['name' => ['required', 'string', 'max:255'], 'email' => ['required', 'string', 'email', 'max:255']]);

        $id   = $request->input('id');
        $data = User::where([['email', '=', $request->input('email')],['id', '!=', $id]])->get();

        if($data->isEmpty()){

            $updatedArr = array('name' => $request->input('name'),'email'=>$request->input('email'),'role_id'=>$request->input('role_id'),'assigned_teams'=>implode(',',$request->input('assigned_teams')),'assigned_team_owner'=> $request->input('assigned_team_owner'));

            $response  = User::where('id',$id)->update($updatedArr);

            if($response){

                return redirect('/users')->with('success', 'User is updated successfully');

            }

        }  else {

            return redirect('/edituser/'.$id)->with('error', 'Email is already exist');
        }   
    }


    /**
    * Function Name : DeleteUser
    * Params        : $id
    * Description   : Delete the user and render the list of left users.
    * Return        : Render a user view with data  or flash message.
    * Author        : Mobilyte solutions.
    * Date          : 08-April-2019 
    */

    public function DeleteUser($id=null)
    {

        if($id){

            $response  = User::where('id',$id)->delete();

            if($response){

                return redirect('/users')->with('success', 'User is deleted successfully');
            }

        }  else {

            return redirect('/users')->with('error', 'User is not deleted');
        }   
    }


    #######################################################################################################################
    ################################################ USER SECTION END HERE ##############################################
    #######################################################################################################################




    #######################################################################################################################
    ################################################ ROLE SECTION START HERE ##############################################
    #######################################################################################################################


    /**
    * Function Name : roles
    * Params        : None
    * Description   : Show the add roles list and form. 
    * Return        : Render a roles view with flash message.
    * Author        : Mobilyte solutions.
    * Date          : 09-April-2019 
    */

    public function roles()
    {            
        $roles = Role::orderBy('id', 'desc')->paginate(5);  
        return view('/roles/roles',['roles' => $roles]);
    }



    /**
    * Function Name : SaveRoles
    * Params        : array()
    * Description   : Save the roles data on request. 
    * Return        : Render a roles view with flash message.
    * Author        : Mobilyte solutions.
    * Date          : 09-April-2019 
    */

    public function SaveRoles(Request $request)
    {

        $validatedData = $request->validate(
            ['name' => ['required', 'string', 'max:255']]
        );

        $role = Role::create($validatedData);

        return redirect('/roles')->with('success', 'Role is successfully saved');
    }



    /**
    * Function Name : EditRole
    * Params        : $id
    * Description   : Edit form with relative values  on behalf of the given id. 
    * Return        : Render a roles view with flash message.
    * Author        : Mobilyte solutions.
    * Date          : 09-April-2019 
    */

    public function EditRole($id=null)
    {
        if(!empty($id)){        
            $data  = Role::where('id', $id)->first();  
            $roles = Role::orderBy('id', 'desc')->paginate(5);             
            return view('/roles/roles',['datas' => $data,'roles'=>$roles]);
        }       
    }



    /**
    * Function Name : UpdateRole
    * Params        : $id
    * Description   : Update the role on behalf of the given id. 
    * Return        : Render a roles view with flash message.
    * Author        : Mobilyte solutions.
    * Date          : 09-April-2019 
    */
 
    public function UpdateRole(Request $request) 
    {

        $request->validate(['name' => ['required', 'string', 'max:255']]);

        $id   = $request->input('id');
        $data = Role::where([['name', '=', $request->input('name')],['id', '!=', $id]])->get();

        if($data->isEmpty()){

            $updatedArr = array('name' => $request->input('name'));

            $response  = Role::where('id',$id)->update($updatedArr);

            if($response){

                return redirect('/roles')->with('success', 'Role is updated successfully');

            }

        }  else {

            return redirect('/editrole/'.$id)->with('error', 'Role is already exist');
        }   
    }


    /**
    * Function Name : DeleteRole
    * Params        : $id
    * Description   : Delete the role on behalf of the given id. 
    * Return        : Render a roles view with flash message.
    * Author        : Mobilyte solutions.
    * Date          : 09-April-2019 
    */

    public function DeleteRole($id=null) 
    {

        if($id){
            
            $response  = Role::where('id',$id)->delete();

            if($response){

                return redirect('/roles')->with('success', 'Role is deleted successfully');
            }

        }  else {

            return redirect('/roles')->with('error', 'Role is not deleted');
        }   
    }


    #######################################################################################################################
    ################################################ ROLE SECTION END HERE ##############################################
    #######################################################################################################################




}
