<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Favorite;

class HomeController extends BaseController{

    public function show() {

        if(!Session::get('user_id'))
        {
            return redirect('login');
        }
        
        $user = User::find(Session::get('user_id'));

        return view('homepage')->with("username", $user->username);
       
        
    }

    public function fetch_posts(){

        if(!Session::get('user_id'))
        {
            return redirect('login');
        }

        $user = User::find(Session::get('user_id'));

        $results=User::join('posts','users.id','=','posts.user')->select('posts.id as postid','users.id as userid','posts.title as title','posts.content as content',
            'users.username as username','posts.time as time','posts.nlikes as nlikes','posts.ncomments as ncomments',
            DB::raw("EXISTS(SELECT user FROM likes WHERE post=postid AND user = $user->id ) as liked"),
            DB::raw("EXISTS(SELECT user FROM posts WHERE posts.id=postid and posts.user = $user->id ) as posted"))->orderBy('postid','desc')->get();

        $assoc=json_decode($results,true);
        $post_array=array();
        foreach($assoc as $entry){
            $time=Self::getTime($entry['time']);
            $post_array[]= array('userid' => $entry['userid'],  
                            'username' => $entry['username'],'postid' => $entry['postid'],
                            'content' => $entry['content'],'title'=>$entry['title'], 'nlikes' => $entry['nlikes'], 
                            'ncomments' => $entry['ncomments'], 'time' => "$time", 'liked' => $entry['liked'],'posted'=>$entry["posted"]);
        }

        return json_encode($post_array);
    }

    public function like_post(){
        if(!Session::get('user_id'))
        {
            return redirect('login');
        }

        $user = User::find(Session::get('user_id'));
        $postid=request('postid');
        $user->likedPosts()->attach($postid);
        $res=Post::select('nlikes')->where('posts.id',$postid)->get();

        if($entry=json_decode($res,true)){
            $returndata = array('ok' => true, 'nlikes' => $entry[0]['nlikes']);
            return json_encode($returndata);
        }
        else
            return json_encode(array('ok' => false));
    }

    public function unlike_post(){
        if(!Session::get('user_id'))
        {
            return redirect('login');
        }

        $user = User::find(Session::get('user_id'));
        $postid=request('postid');
        $user->likedPosts()->detach($postid);
        $res=Post::select('nlikes')->where('posts.id',$postid)->get();

        if($entry=json_decode($res,true)){
            $returndata = array('ok' => true, 'nlikes' => $entry[0]['nlikes']);
            return json_encode($returndata);
        }
        else
            return json_encode(array('ok' => false));
        

        
    }

    public function fetch_send_comments(){
        if(!Session::get('user_id'))
        {
            return redirect('login');
        }
        $postid=request('postid');

        if((request('comment')!==null)){
            $newComment=Comment::create([
                'user' => Session::get('user_id'),
                'post' =>$postid,
                'text' =>request('comment')
                ]);
        }

        $res=Comment::leftJoin('users','user','=','users.id')->select('comments.id as id',
        'username','text','time')->where('comments.post',request('postid'))->orderBy('id','desc')->get();
        
        $ncomms= Post::select('posts.ncomments as ncomments')->where('posts.id',$postid)->get();
        
        if($entry1=json_decode($ncomms,true))
            $ncomments=$entry1[0]['ncomments'];

        $assoc=json_decode($res,true);

        $arr=array();

        foreach($assoc as $entry){
            $time=Self::getTime($entry['time']) ;
            $arr[]=array('id' => $entry['id'], 'username' => $entry['username'], 
            'text' => $entry['text'],'time' => $time,'ncomments'=>$ncomments);
        }

        return json_encode($arr);
    
    }

    public function delete_post(){
        if(!Session::get('user_id'))
        {
            return redirect('login');
        }
        $postid=request('postid');
        $post=Post::find($postid);
        if($post->delete())
            return json_encode(array('ok' => true));
        else 
            return json_encode(array('ok' => false));
    }

    

    private function getTime($timestamp) {      
        // Calcola il tempo trascorso dalla pubblicazione del post       
        $old = strtotime($timestamp); 
        $diff = time() - $old;           
        $old = date('d/m/y', $old);

        if ($diff /60 <1) {
            return intval($diff%60)." secondi fa";
        } else if (intval($diff/60) == 1)  {
            return "Un minuto fa";  
        } else if ($diff / 60 < 60) {
            return intval($diff/60)." minuti fa";
        } else if (intval($diff / 3600) == 1) {
            return "Un'ora fa";
        } else if ($diff / 3600 <24) {
            return intval($diff/3600) . " ore fa";
        } else if (intval($diff/86400) == 1) {
            return "Ieri";
        } else if ($diff/86400 < 30) {
            return intval($diff/86400) . " giorni fa";
        } else {
            return $old; 
        }
    }

    public function prova(){
        
        // return User::join('posts','users.id','=','posts.user')->select('posts.id as postid','users.id as userid','posts.title as title','posts.content as content',
        // 'users.name as name','posts.time as time','posts.nlikes as nlikes','posts.ncomments as ncomments',
        // DB::select(DB::raw('EXISTS(SELECT user FROM likes WHERE post = posts.id AND user = $us) AS liked'),array('us' => $us)),
        // DB::raw('EXISTS(SELECT user FROM posts WHERE posts.id=postid and posts.user = 1 ) as posted'))->orderBy('postid','desc')->get();

            //return  DB::select(DB::raw(' EXISTS( SELECT user FROM likes WHERE post = :postid AND user= :us)'),array('us' => $us,'postid'=>$pos));

            //return DB::table('likes')->where('user',$us)->exists();

        //DB::table('likes')->where('post','posts.id')->where('user',1)->exists()
        //whereExists(select('user')->from('likes')->where('post','posts.id')->where('user',1))
        //)->get();
       //return DB::table('likes')->where('user',1)->exists();

    //    return User::join('posts','users.id','=','posts.user')->select('posts.id as postid','users.id as userid','posts.title as title','posts.content as content',
    //         'users.name as name','posts.time as time','posts.nlikes as nlikes','posts.ncomments as ncomments',
    //         DB::raw("EXISTS(SELECT user FROM likes WHERE post=postid AND user = $us ) as liked" ),
    //         DB::raw("EXISTS(SELECT user FROM posts WHERE posts.id=postid and posts.user = $us ) as posted"))
    //         ->orderBy('postid','desc')->get();



       // return DB::select("SELECT id from users where  id =?",[$us])->exists();

        //  $user = User::find(1);
        //  $postid=3;
        //  $user->likedPosts()->attach($postid);
        //$user->likedPosts()->detach($postid);
        //return Post::select('nlikes')->where('posts.id',1)->get();

        // $res=Comment::leftJoin('users','user','=','users.id')->select('comments.id as id',
        // 'username','text','time' )->where('comments.post',1)->orderBy('id','desc')->get();

        // $assoc=json_decode($res,true);
        // $arr=array();
        // foreach($assoc as $entry){
        //     $time=self::getTime($entry['time']) ;
        //     $arr[]=array('id' => $entry['id'], 'username' => $entry['username'], 
        //     'text' => $entry['text'],'time' => $time);
        // }
        // return json_encode($arr);

        // $ncomms=Post::select('posts.ncomments as ncomments')->where('posts.id',3)->get();
        // if($entry1=json_decode($ncomms,true)){
        //     $ncomments=$entry1[0]['ncomments'];
        // }
       
        // return $ncomments;

        // $post=Post::find(1);
        // if($post->delete())
        //     return json_encode(array('ok' => true));
        // else 
        //     return json_encode(array('ok' => false));

        // $results=User::join('posts','users.id','=','posts.user')->select('posts.id as postid','users.id as userid','posts.title as title','posts.content as content',
        //     'users.name as name','users.username as username','users.surname as surname','posts.time as time','posts.nlikes as nlikes','posts.ncomments as ncomments',
        //     DB::raw("EXISTS(SELECT user FROM likes WHERE post=postid AND user = 1) as liked"),
        //     DB::raw("EXISTS(SELECT user FROM posts WHERE posts.id=postid and posts.user = 1 ) as posted"))->orderBy('postid','desc')->get();

        // $assoc=json_decode($results,true);
        // $post_array=array();
        // foreach($assoc as $entry){
        //     $time=Self::getTime($entry['time']);
        //     $post_array[]= array('userid' => $entry['userid'], 'name' => $entry['name'], 'surname' => $entry['surname'], 
        //                     'username' => $entry['username'],'postid' => $entry['postid'],
        //                     'content' => $entry['content'],'title'=>$entry['title'], 'nlikes' => $entry['nlikes'], 
        //                     'ncomments' => $entry['ncomments'], 'time' => $time, 'liked' => $entry['liked'],'posted'=>$entry["posted"]);
        // }

        // //return response()->json($post_array);
        // return $post_array;
        //return time()-strtotime("2022-06-18 10:13:19");

        //return Favorite::select('id as ')where('id',1)
        
 }

}

?>