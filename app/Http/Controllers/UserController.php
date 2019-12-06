<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accounts;

class UserController extends Controller
{
    public function home(Request $request)
    {
        return view('home')
            ->with('login', $request->session()->get('user_id'))
            ->with('error_message', $request->session()->get('error_message') ?? null);
    }

    public function signin(Request $request)
    {
        return view('signin')
            ->with('error_message', $request->session()->get('error_message') ?? null);
    }

    public function signup(Request $request)
    {
        return view('signup')
            ->with('error_message', $request->session()->get('error_message') ?? null);
    }

    public function signout(Request $request)
    {
        $request->session()->flush();
        return redirect('home');
    }

    public function account(Request $request) {
        return view('account')
            ->with('error_message', $request->session()->get('error_message') ?? null);
    }
    public function authenticate(Request $request)
    {
        // On vérifie qu'on a bien reçu les données en POST
        if ( !$request->has(['login','password']) )
            return redirect('signin')->with('error_message','Some POST data are missing.');

        try{
            $user = Accounts::where('pseudo', $request->input('login'))
                ->orWhere('email', $request->input('login'))
                ->firstOrFail();
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return redirect('signin')->with('error_message', 'Identifiant incorrect');
        }

        if (!password_verify($request->input('password'), $user->password)) {
            return redirect('signin')->with('error_message', 'Mot de passe incorrect');
        }

        $request->session()->put('user_id',$user->id);
        return redirect('home')->with('login', $user->id);
    }

    public function adduser(Request $request)
    {
        // On vérifie qu'on a bien reçu les données en POST
        if ( !$request->has(['email','pseudo','password', 'confirmPassword', 'age', 'formation', 'city', 'description']) )
            return redirect('signup')->with('message',"Some POST data are missing.");

        if ( $request->input('password') !== $request->input('confirmPassword') )
            return redirect('signup')->with('message',"The two passwords differ.");

        $account = new Accounts;
        $account->email = $request->input('email');
        $account->pseudo = $request->input('pseudo');
        $account->password = password_hash($request->input('password'), PASSWORD_DEFAULT);
        $account->age = $request->input('age');
        $account->formation = $request->input('formation');
        $account->city = $request->input('city');
        $account->description = $request->input('description');

        try {
            $account->save();
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect('mail');
            return redirect("signup")->with("error_message", "Cet utilisateur existe déjà !");
        }
    }

    /** SECRET */
    public function secret(Request $request){
        return view('secret')->with('enigme',"L'échec est la clé")->with("numero",0);
    }
    public function secretn(Request $request, $numero){
        if ($numero == 1 && $request->pass == "ECHEC"){
            $enigme = "Pour identifier la réponse identifie toi";
            return view('secret')->with('enigme',"Pour identifier la réponse identifie toi")->with("numero",$numero);
        }elseif ($numero == 2 && $request->pass == "RGB45"){
            $enigme = "Les Romains se réunissent puis se divisent en 2 parties dont les premiers sont la clé du problème";
            return view('secret')->with('enigme',"Les Romains se réunissent puis se divisent en 2 parties dont les premiers sont la clé du problème")->with("numero",$numero);
        }elseif ($numero == 3 && $request->pass == "ACELOSAÉOST"){
            $enigme = "Qui est mettre du trésors";
            return view('secret')->with('enigme',"Qui est mettre du trésors")->with("numero",$numero);
        }elseif ($numero == 4 && $request->pass == "CROUS"){
            $enigme = "Votre identité est-elle masquée";
            return view('secret')->with('enigme',"Votre identité est-elle masquée")->with("numero",$numero);
        }elseif ($numero == 5 && $request->pass == "GUYFAWKES"){
            $enigme = "Tout les chemins mènent à Rome même une fois perdu";
            return view('secret')->with('enigme',"Tout les chemins mènent à Rome même une fois perdu")->with("numero",$numero);
        }elseif ($numero == 6 && $request->pass == "CSGROUP"){
            $enigme = "Félicitations, tu as gagné ! sponsored by CSGroup";
            return view('secret')->with('enigme',"Félicitations, tu as gagné ! sponsored by CSGroup")->with("numero",$numero);
        }else{
            return view('secret')->with('enigme',$request->enigme)->with("numero",$numero-1)->with("error_message", "Try again");
        }
    }
    public function mailing(Request $request)
    {
        $user = Accounts::where('id', $request->session()->get('user_id'))->first();

        $to      = $user->email;
        $subject = 'Confirmez votre compte';
        $message =  '<p>Bonjour <?php $user->pseudo ?>! \r\n</p>;
                    <p> Bienvenue au projet maths , veuillez confirmer votre compte: </p>
                    <a href="http://www.maths.1d-works.fr/confirm">Confirmez Ici</a>
                    ';
        $headers[] = 'From: maths@1d-works.fr';
        mail($to, $subject, $message, implode("\r\n", $headers));
        $headers[] = 'From: maths@1d-works.fr';
        mail($to, $subject, $message);
        return view('signin');
    }

    public function confirm(Request $request){
        return view('emails/mail');
    }
}
